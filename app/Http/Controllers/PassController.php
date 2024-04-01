<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addPass(Request $request)
    {
        try {
            $validatedData = $this->validatePassRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->validator->errors()->first()], 422);
        }

        $pass = new Pass();
        $pass->user_id = $validatedData['user_id'];
        $pass->type = $validatedData['type'];
        $pass->valid_from = $validatedData['valid_from'];
        $pass->valid_until = $validatedData['valid_until'];
        $pass->save();

        return response()->json(['status' => 'success', 'pass' => $pass], 201);
    }

    public function getPasses($user_id)
    {
        $passes = Pass::where('user_id', $user_id)->get();
        if ($passes->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Passes not found'], 404);
        }
        return response()->json(['status' => 'success', 'passes' => $passes], 200);
    }

    private function validatePassRequest(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:daily,weekly,monthly',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date',
        ]);
    }
    
}
