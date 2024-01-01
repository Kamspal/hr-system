@extends('layouts.app')

@section('content')
    <h1>Edit Attendance Record</h1>

    <form action="{{ route('attendances.update', $attendance->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $attendance->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="in_time">In Time:</label>
            <input type="datetime-local" name="in_time" id="in_time" class="form-control" value="{{ $attendance->in_time }}" required>
        </div>
        <div class="form-group">
            <label for="out_time">Out Time:</label>
            <input type="datetime-local" name="out_time" id="out_time" class="form-control" value="{{ $attendance->out_time }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
