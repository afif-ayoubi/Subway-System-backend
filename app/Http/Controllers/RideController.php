<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function Laravel\Prompts\error;

class RideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getAllRides()
    {
        try {
            $rides = Ride::with(['departureStation' => function ($query) {
                $query->select('id', 'name');
            }, 'arrivalStation' => function ($query) {
                $query->select('id', 'name');
            }])->get();

            return response()->json(['status' => 'success', 'rides' => $rides], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getRidesForDeparture($station_id)
    {
        $rides = Ride::where('departure_station_id', $station_id)->get();
        return response()->json(['status' => 'success', 'rides' => $rides], 200);
    }
    public function getRidesForArrivalStation($stationId)
    {
        $rides = Ride::where('arrival_station_id', $stationId)->get();

        return response()->json(['rides' => $rides], 200);
    }
    public function updateRide(Request $request, $rideId)
    {
        $ride = Ride::findOrFail($rideId);
        $ride->update($request->all());
        return response()->json(['status' => 'success', 'ride' => $ride], 200);
    }
    public function deleteRide($rideId)
    {
        try {
            $ride = Ride::findOrFail($rideId);

            $ride->delete();

            return response()->json(['status' => 'success', 'message' => 'Ride deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => "error", "message" => "Ride not found"], 404);
        }
    }
    public function addRide(Request $request)
    {
        try {
            $validatedData = $this->validateDataRequest($request);

            $ride = new Ride();
            $ride->departure_station_id = $validatedData['departure_station_id'];
            $ride->arrival_station_id = $validatedData['arrival_station_id'];
            $ride->departure_time = $validatedData['departure_time'];
            $ride->arrival_time = $validatedData['arrival_time'];
            $ride->status = $validatedData['status'];
            $ride->save();

            return response()->json(['status' => 'success', 'ride' => $ride], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function validateDataRequest(Request $request)
    {
        return $request->validate([
            'departure_station_id' => 'required|exists:stations,id',
            'arrival_station_id' => 'required|exists:stations,id',
            'departure_time' => 'required|',
            'arrival_time' => 'required',
            'status' => 'required|in:pending,ongoing,cancelled,completed',

        ]);
    }
}
