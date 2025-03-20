<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorAvailabilities;
use Illuminate\View\View;
use Validator;
use Auth;
use Carbon\Carbon;

class DoctorAvailabilitiesController extends Controller
{
    public function index(Request $request)
    {
        $doctors_availabilities =DoctorAvailabilities::all();
        return view('doctors.index', compact('doctors_availabilities'));
    }

    public function create()
    {
        return view('doctors.create');
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'doctor_id' => 'required',
            'date' => 'required|date', 
            'time_slot' => 'required|date_format:H:i',
        ]);
    
        // Create the doctor availability record in the database
        DoctorAvailabilities::create([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time_slot' => $request->time_slot,
        ]);
    
        return redirect()->route('doctors.index')->with('success', 'Doctor availability added successfully.');
    }
}
