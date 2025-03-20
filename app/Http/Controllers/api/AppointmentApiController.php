<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailabilities;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;

class AppointmentApiController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with('doctorAvailabilities')->get();
        return response()->json([
            'appointments' => $appointments
        ]);
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor_availabilities,id',
            'patient_id' => 'required',
            'date' => 'required|date',
            'time_slot' => 'required',
        ]);
        
        try {
            // Create the appointment record in the database
            $appointment = Appointment::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
                'status' => $request->status ?? 1, 
            ]);

            // Return a successful JSON response
            return response()->json([
                'message' => 'Appointment booked successfully.',
                'appointment' => $appointment
            ], 201); // 201 status code means 'Created'
            
        } catch (\Exception $e) {
            // Handle any error that might occur
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage()
            ], 500); // 500 status code means 'Internal Server Error'
        }
    }

    public function doctors_appointment($doctor_id)
    {
        //dd('Hello', $doctor_id);
        $appointments = Appointment::where('doctor_id', $doctor_id)->get();
    
        // Check if appointments are found
        if ($appointments->isEmpty()) {
            return response()->json([
                'message' => 'No appointments found for this doctor'
            ], 404);
        }
    
        return response()->json($appointments);
    }


    public function edit($patient_id)
    {
        //dd('Hello', $patient_id);
        try {
            $appointment = Appointment::with('doctorAvailabilities')->where('id', $patient_id)->first();
            // Check if the appointment exists
            if (!$appointment) {
                return response()->json([
                    'message' => 'Appointment not found for the given patient.',
                ], 404); // 404 status code means 'Not Found'
            }

            // Return the appointment details
            return response()->json([
                'appointment' => $appointment
            ], 200); // 200 status code means 'OK'

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage()
            ], 500); // 500 status code means 'Internal Server Error'
        }
    }
}
