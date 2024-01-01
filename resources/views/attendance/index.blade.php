@extends('layouts.app')

@section('content')
    <h1>Attendance Records</h1>

    <a href="{{ route('attendances.create') }}" class="btn btn-success">Create Attendance Record</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ $attendance->in_time }}</td>
                    <td>{{ $attendance->out_time }}</td>
                    <td>
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-primary">Edit</a>
                        <!-- Add delete button with a form to handle deletion -->
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
