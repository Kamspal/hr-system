@extends('layouts.app')

@section('content')
    <h1>Create Employee</h1>

    <form action="{{ route('employees.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="department_id">Department:</label>
            <select name="department_id" id="department_id" class="form-control" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position_id">Position:</label>
            <select name="position_id" id="position_id" class="form-control" required>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="phone" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
            @error('phone_number')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        </div>

        <div class="form-group">
            <label for="email">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            @error('address')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
