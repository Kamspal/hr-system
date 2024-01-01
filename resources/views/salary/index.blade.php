@extends('layouts.app')

@section('content')
    <h1>Salary Records</h1>

    <a href="{{ route('salaries.create') }}" class="btn btn-success">Create Salary Record</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Basic Salary</th>
                <th>HRA</th>
                <th>DA</th>
                <th>Other Allowances</th>
                <th>Gross Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
                <tr>
                    <td>{{ $salary->id }}</td>
                    <td>{{ $salary->employee->name }}</td>
                    <td>{{ $salary->basic_salary }}</td>
                    <td>{{ $salary->hra }}</td>
                    <td>{{ $salary->da }}</td>
                    <td>{{ $salary->other_allowances }}</td>
                    <td>{{ $salary->gross_salary }}</td>
                    <td>
                        <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-primary">Edit</a>
                        <!-- Add delete button with a form to handle deletion -->
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="post" style="display: inline-block;">
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
