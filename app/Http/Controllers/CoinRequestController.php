<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoinRequest;

class CoinRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getAllRequest()
    {
        $coinRequests = CoinRequest::all();
        return response()->json(['status' => 'success', 'coin_requests' => $coinRequests], 200);
    }
    public function delete($id)
    {
        $coinRequest = CoinRequest::findOrFail($id);
        if ($coinRequest) {
            $coinRequest->delete();
            return response()->json(['status' => 'success', 'message' => 'Coin request deleted successfully'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Coin request not found'], 200);
        }
    }
    public function update(Request $request, $id)
    {
        $coinRequest = CoinRequest::findOrFail($id);
        $coinRequest->update($request->all());
        return response()->json(['message' => 'Coin request updated successfully'], 200);
    }
    public function add(Request $request){
        $validatedData = $this->validateCoinRequest($request);
        $coinRequest = new CoinRequest();
        $coinRequest->user_id = $validatedData['user_id'];
        $coinRequest->coins = $validatedData['amount'];
        $coinRequest->status = $validatedData['status'];
        $coinRequest->save();
        return response()->json(['status' => 'success', 'coin_request' => $coinRequest], 201);
    }
    private function validateCoinRequest(Request $request){
        return $request->validate([
            'user_id'=>'required|exists:users,id',
            'amount'=>'required',
            "status"=>'required|in:pending,approved,rejected'

        ]);
    }

}
