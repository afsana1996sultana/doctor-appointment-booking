<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailabilities;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;

class DoctorApiController extends Controller
{
    public function index(Request $request)
    {
        $doctors_availabilities = DoctorAvailabilities::all();
        return response()->json([
            'success' => true,
            'data' => $doctors_availabilities
        ], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'date' => 'required|date', 
            'time_slot' => 'required|date_format:H:i',
        ]);

        $availability = DoctorAvailabilities::create([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time_slot' => $request->time_slot,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Doctor availability added successfully.',
            'data' => $availability,
        ], 201);
    }

    
    public function edit($id)
    {
        $availability = DoctorAvailabilities::find($id);
        if (!$availability) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Doctor details fetched successfully.',
            'data' => $availability
        ], 200);
    }

}
