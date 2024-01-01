<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('attendance.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate the incoming request data
         $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'in_time' => 'required|date',
            'out_time' => 'required|date|after:in_time',
        ]);

        try {
            // Create a new attendance record
            $attendance = new Attendance();
            $attendance->employee_id = $request->employee_id;
            $attendance->in_time = $request->in_time;
            $attendance->out_time = $request->out_time;
            
             // Calculate the number of days worked
             $daysWorked = $this->calculateDaysWorked($request->in_time, $request->out_time);
             $attendance->days_worked = $daysWorked;

             $attendance->save();

            return redirect()->route('attendance.index')->with('success', 'Attendance record created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the save process
            return redirect()->back()->with('error', 'Error creating attendance record: ' . $e->getMessage());
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendance.edit', compact('employees', 'attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Attendance $attendance)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->fill($request->all());
        $attendance->save();

        // Calculate Days Worked
        $attendance->calculateDaysWorked();

        return response()->json($attendance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

     /**
     * Calculate the number of days worked based on in_time and out_time.
     *
     * @param  string  $inTime
     * @param  string  $outTime
     * @return int
     */


    public function calculateDaysWorked($inTime, $outTime)
    {
        // Convert string dates to DateTime objects
        $inDateTime = new \DateTime($inTime);
        $outDateTime = new \DateTime($outTime);

        // Calculate the difference in days
        $interval = $outDateTime->diff($inDateTime)+1; //Include both start and end day.
        $daysWorked = $interval->days;

        return $daysWorked;
    }
}
