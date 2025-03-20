<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\DoctorAvailabilities;
use Illuminate\View\View;
use Validator;
use Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appoinments =Appointment::all();
        return view('appoinments.index', compact('appoinments'));
    }

    public function create()
    {
        $doctors = DoctorAvailabilities::all();
        return view('appoinments.create', compact('doctors'));
    }

    public function getTimeSlots($doctor_id)
    {
        $doctor_availabilities = DoctorAvailabilities::where('id', $doctor_id)->get();
        return response()->json($doctor_availabilities);
    }


    public function store(Request $request)
    {
        //dd('Hello', $request);
        $request->validate([
            'doctor_id' => 'required',  // Make sure the doctor exists
            'patient_id' => 'required',
            'date' => 'required|date',
            'time_slot' => 'required',
        ]);
        // print_r('<pre>');
        // print_r($request->all());die();
    
        // Create the appointment record in the database
        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'time_slot' => $request->time_slot,
            'status' => $request->status ?? 1,  // Default status to '1' (pending)
        ]);
    
        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully.');
    }
}
