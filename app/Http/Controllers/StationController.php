<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    /**
     * Display a listing of the stations.
     *
     * @return \Illuminate\Http\Response
     */
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
}
