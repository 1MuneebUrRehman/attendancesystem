@extends('layouts.adminapp')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">View Student Records</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">View Student Records</li>
        </ol>

        <table class="mt-3 table table-bordered">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Users</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)

                <tr>
                    <td>No. {{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <img src="/storage/profile_image/{{ $user->profile_image }}" alt="Profile Image" style="width: 100px">
                    </td>
                    <td>
                        <a href="{{ route('admin.deleteuser', $user->id) }}" class="btn btn-danger">Delete </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

@endsection
