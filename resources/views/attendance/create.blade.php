@extends('layouts.app')

@section('content')
    <h1>Create Attendance Record</h1>

    <form action="{{ route('attendances.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="in_time">In Time:</label>
            <input type="datetime-local" name="in_time" id="in_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="out_time">Out Time:</label>
            <input type="datetime-local" name="out_time" id="out_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
