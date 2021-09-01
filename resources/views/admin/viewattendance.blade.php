@extends('layouts.adminapp')

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">View Attendance of Students</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">View Attendance of Students</li>
        </ol>
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <h6 class="mb-2">Select User : </h6>
                <select class="custom-select" onChange="window.location.href=this.value">
                    <option selected>Choose...</option>
                    @foreach ($users as $user)
                        <option value="{{ route('admin.viewattendanceuser', $user->id) }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
@endsection
