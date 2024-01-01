@extends('layouts.app')

@section('content')
    <h1>Employees</h1>

    <a href="{{ route('employees.create') }}" class="btn btn-success">Create Employee</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Position</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->position->name }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone_number }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                        <!-- Add delete button with a form to handle deletion -->
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="post" style="display: inline-block;">
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
