@extends('layouts.app')

@section('content')
    <h1>Positions</h1>

    <a href="{{ route('positions.create') }}" class="btn btn-success">Create Position</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->id }}</td>
                    <td>{{ $position->department->name }}</td>
                    <td>{{ $position->name }}</td>
                    <td>
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary">Edit</a>
                        <!-- Add delete button with a form to handle deletion -->
                        <form action="{{ route('positions.destroy', $position->id) }}" method="post" style="display: inline-block;">
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
