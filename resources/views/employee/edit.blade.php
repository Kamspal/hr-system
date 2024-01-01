@extends('layouts.app')

@section('content')
    <h1>Edit Employee</h1>

    <form action="{{ route('employees.update', $employee->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="department_id">Department:</label>
            <select name="department_id" id="department_id" class="form-control" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position_id">Position:</label>
            <select name="position_id" id="position_id" class="form-control" required>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $position->id == $employee->position_id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="phone" name="phone_number" id="phone_number" class="form-control" value="{{ $employee->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $employee->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
