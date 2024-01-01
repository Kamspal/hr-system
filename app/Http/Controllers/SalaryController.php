<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
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
        $salaries = Salary::all();
        return view('salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $positions = Position::all();
        return view('salary.create', compact('employees', 'positions'));
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
            'basic_salary' => 'required|numeric',
            'hra' => 'required|numeric',
            'da' => 'required|numeric',
            'other_allowances' => 'required|numeric',
            'gross_salary' => 'required|numeric'
        ]);

        try {
            // Create a new salary record
            $salary = new Salary();
            $salary->employee_id = $request->employee_id;
            $salary->basic_salary = $request->basic_salary;
            $salary->hra = $request->hra;
            $salary->da = $request->da;
            $salary->other_allowances = $request->other_allowances;

            // Calculate gross salary 
            $grossSalary = $salary->calculateGrossSalary();
            $salary->gross_salary = $grossSalary;

            $salary->save();

            return redirect()->route('salary.index')->with('success', 'Salary record created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the save process
            return redirect()->back()->with('error', 'Error creating salary record: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        $positions = Position::all();
        return view('salaries.edit', compact('salary', 'employees', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Salary $salary)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'hra' => 'required|numeric',
            'da' => 'required|numeric',
            'other_allowances' => 'required|numeric',
            'gross_salary' => 'required|numeric'
        ]);

        try {
            // Find the salary record by ID
            $salary = Salary::findOrFail($id);

            // Update the salary record with the new data
            $salary->employee_id = $request->employee_id;
            $salary->basic_salary = $request->basic_salary;
            $salary->hra = $request->hra;
            $salary->da = $request->da;
            $salary->other_allowances = $request->other_allowances;

            // Calculate gross salary
            $grossSalary = $salary->calculateGrossSalary();
            $salary->gross_salary = $grossSalary;

            $salary->save();

            return redirect()->route('salaries.index')->with('success', 'Salary record updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the update process
            return redirect()->back()->with('error', 'Error updating salary record: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }

    // ... other methods ...

    /**
     * Calculate gross salary based on the provided formula.
     *
     * @param  float  $basicSalary
     * @param  float  $hra
     * @param  float  $da
     * @param  float  $otherAllowances
     * @return float
     */


    public function calculateGrossSalary($basicSalary, $hra, $da, $otherAllowances)
    {
        // Gross salary calculation formula
        $grossSalary = $basicSalary + $hra + $da + $otherAllowances;

        return $grossSalary;
    }
}
