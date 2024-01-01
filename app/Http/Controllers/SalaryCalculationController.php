<?php

namespace App\Http\Controllers;

use App\Models\SalaryCalculation;
use Illuminate\Http\Request;

class SalaryCalculationController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryCalculation  $salaryCalculation
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryCalculation $salaryCalculation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryCalculation  $salaryCalculation
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryCalculation $salaryCalculation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryCalculation  $salaryCalculation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryCalculation $salaryCalculation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryCalculation  $salaryCalculation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryCalculation $salaryCalculation)
    {
        //
    }
}
