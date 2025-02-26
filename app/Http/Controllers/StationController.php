<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $stations = Station::all();
        return response()->json(['stations' => $stations], 200);
    }

    /**
     * Display the specified station.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $station = Station::findOrFail($id);
        return response()->json(['station' => $station], 200);
    }

    /**
     * Store a newly created station in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'manager_id' => 'required|exists:users,id',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'address' => 'required|string|max:255',
                'operating_hours' => 'nullable|string',
                'facilities' => 'nullable|string',
                'service_status' => 'required|in:operational,maintenance,closed',
            ]);

            $station = Station::create($request->all());
            return response()->json(['station' => $station], 201);
        } catch (\Exception $e) {
            return response()->json((['status' => 'error', 'message' => $e->getMessage()]), 500);
        }
    }

    /**
     * Update the specified station in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $station = Station::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'manager_id' => 'required|exists:users,id',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'address' => 'required|string|max:255',
                'operating_hours' => 'nullable|string',
                'facilities' => 'nullable|string',
                'service_status' => 'required|in:operational,maintenance,closed',
            ]);

            $station->update($request->all());
            return response()->json(['station' => $station], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    /**
     * Get the location of a station by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLocation($id)
    {
        $station = Station::findOrFail($id);
        $location = [
            'latitude' => $station->latitude,
            'longitude' => $station->longitude,
        ];
        return response()->json(['location' => $location], 200);
    }

    /**
     * Remove the specified station from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();
        return response()->json(null, 204);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $stations = Station::where('name', 'like', "%$keyword%")
            ->orWhere('address', 'like', "%$keyword%")
            ->get();
        return response()->json(['status' => 'sucees', 'stations' => $stations], 200);
    }
    public function getTopRatedStations()
    {
        $topRatedStations = Station::select('stations.*')
            ->leftJoin('reviews', 'stations.id', '=', 'reviews.station_id')
            ->selectRaw('AVG(reviews.rating) as average_rating, COUNT(reviews.id) as review_count')
            ->groupBy('stations.id')
            ->orderByDesc('average_rating')
            ->orderByDesc('review_count')
            ->limit(3)
            ->get();

        return response()->json(['status' => 'sucees', 'stations' => $topRatedStations], 200);
    }
}
