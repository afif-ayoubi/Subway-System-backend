<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoinRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class CoinRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllRequest()
    {
        try {
            $coinRequests = CoinRequest::with('user')->get();
            return response()->json(['status' => 'success', 'coin_requests' => $coinRequests], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $coinRequest = CoinRequest::findOrFail($id);
            $coinRequest->delete();
            return response()->json(['status' => 'success', 'message' => 'Coin request deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Coin request not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $coinRequest = CoinRequest::findOrFail($id);
            $coinRequest->update($request->all());
            return response()->json(['message' => 'Coin request updated successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Coin request not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $this->validateCoinRequest($request);
            $coinRequest = new CoinRequest();
            $coinRequest->user_id = $validatedData['user_id'];
            $coinRequest->amount = $validatedData['amount'];
            $coinRequest->status = $validatedData['status'];
            $coinRequest->save();
            return response()->json(['status' => 'success', 'coin_request' => $coinRequest], 201);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    public function sumAmuountByUserId($user_id)
    {
        try {
            $userExists = User::where('id', $user_id)->exists();

            if (!$userExists) {
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }

            $sumAmount = CoinRequest::where('user_id', $user_id)
                ->where('status', 'approved')
                ->sum('amount');

            return response()->json(['status' => 'success', 'sum_amount' => $sumAmount], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    private function validateCoinRequest(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required',
            'status' => 'required|in:pending,approved,rejected'
        ]);
    }
}
