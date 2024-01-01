@extends('layouts.app')

@section('content')
    <h1>Edit Salary Record</h1>

    <form action="{{ route('salaries.update', $salary->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $salary->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="basic_salary">Basic Salary:</label>
            <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="{{ $salary->basic_salary }}" required>
        </div>
        <div class="form-group">
            <label for="hra">HRA:</label>
            <input type="text" name="hra" id="hra" class="form-control" value="{{ $salary->hra }}" required>
        </div>
        <div class="form-group">
            <label for="da">DA:</label>
            <input type="text" name="da" id="da" class="form-control" value="{{ $salary->da }}" required>
        </div>
        <div class="form-group">
            <label for="other_allowances">Other Allowances:</label>
            <input type="text" name="other_allowances" id="other_allowances" class="form-control" value="{{ $salary->other_allowances }}" required>
        </div>
        <div class="form-group">
            <label for="gross_salary">Gross Salary:</label>
            <input type="text" name="gross_salary" id="gross_salary" class="form-control" value="{{ $salary->gross_salary }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
