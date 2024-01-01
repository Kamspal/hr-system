<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\SalaryCalculation;
use App\Models\Employee;
use App\Models\Attendance;

    
    class CalculateMonthlySalaries extends Command
    {
        protected $signature = 'salary:calculate-monthly';
        protected $description = 'Calculate and update monthly salaries for employees';
    
        public function handle()
        {
            $currentMonth = Carbon::now()->startOfMonth();
            $previousMonth = $currentMonth->copy()->subMonth();
    
            // Check if salary calculation already done for the current month
            if (SalaryCalculation::where('calculation_date', $currentMonth)->exists()) {
                $this->info('Monthly salary calculation already completed for ' . $currentMonth->format('F Y'));
                return;
            }
    
            // Insert a new row into the "Salary Calculation" table with "Pending" status
            // $salaryCalculation = new SalaryCalculation([
            //     'calculation_date' => $currentMonth,
            //     'status' => 'Pending'
            // ]);
            // $salaryCalculation->save();
    
            // $this->info('Monthly salary calculation initiated for ' . $currentMonth->format('F Y'));
    
            // Retrieve all employee records with their attendance records for the previous month
            $employees = Employee::with('attendance')->get();
    
            // Calculate and update salaries for each employee
            foreach ($employees as $employee) {
                // Insert a new row into the "Salary Calculation" table with "Pending" status
                $salaryCalculation = new SalaryCalculation([
                    'calculation_date' => $currentMonth,
                    'status' => 'Pending',
                    'employee_id' => $employee->id
                ]);
                $salaryCalculation->save();
                $this->info('Monthly salary calculation of '. $employee->name  .' initiated for ' . $currentMonth->format('F Y'));
                
                $totalDaysWorked = 0;
                if(!empty($employee->attendance)) {
                    $totalDaysWorked = $employee->attendance
                    ->whereBetween('in_time', [$previousMonth, $previousMonth->copy()->endOfMonth()])
                    ->sum('days_worked');
                }
    
                    // Implement your salary calculation logic based on the formulas in the Salary table
                    $calculatedSalary = $this->calculateSalary($employee, $totalDaysWorked);
        
                    // Update the salary record for the previous month
                    $employee->salary()->create([
                        'basic_salary' => $calculatedSalary['basic_salary'],
                        'hra' => $calculatedSalary['hra'],
                        'da' => $calculatedSalary['da'],
                        'other_allowances' => $calculatedSalary['other_allowances'],
                        'gross_salary' => $calculatedSalary['gross_salary'],
                        'position_id' => $employee->position_id
                    ]);
                    // Update the "Salary Calculation" record for the current month with "Completed" status
                    $salaryCalculation->update(['status' => 'Completed',
                                                 'salary_amount' => $calculatedSalary]);
                    $this->info('Monthly salary calculation of '. $employee->name  .' completed for ' . $currentMonth->format('F Y'));

                
            }
    
            
    
           
        }
    
        public function calculateSalary($employee, $totalDaysWorked)
        {
            // Implement your salary calculation logic based on the formulas in the Salary table
            // This is a placeholder. Replace it with your actual calculation logic.
            $basicSalary = $employee->position->salary->basic_salary;

            // Example: Assume a monthly salary is calculated based on the number of days worked
            $dailyRate = $basicSalary / 30; // Assuming a month has 30 days
            $calculatedBasicSalary = $totalDaysWorked * $dailyRate;

            $hra = $calculatedBasicSalary * 0.2; // Example: HRA is 20% of basic salary
            $da = $calculatedBasicSalary * 0.1;  // Example: DA is 10% of basic salary
            $otherAllowances = 500;  // Example: Other allowances
            $grossSalary = $calculatedBasicSalary + $hra + $da + $otherAllowances;
    
            return [
                'basic_salary' => $calculatedBasicSalary,
                'hra' => $hra,
                'da' => $da,
                'other_allowances' => $otherAllowances,
                'gross_salary' => $grossSalary,
            ];
        }
    }
