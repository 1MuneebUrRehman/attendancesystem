@extends('layouts.adminapp')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">View Attendance of Students</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">View Attendance of Students</li>
        </ol>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <h6 class="mb-2">Select User : </h6>
                <select class="custom-select" onChange="window.location.href=this.value">
                    <option selected>Choose...</option>
                    @foreach ($users as $user)
                        @if ($user->id == $id)
                            <option value="" selected>{{ $user->name }}</option>
                        @endif
                        <option value="{{ route('admin.viewattendanceuser', $user->id) }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <a href="{{ route('admin.addattendance', $user->id) }}" class="mt-3 btn btn-primary">Add Attendance</a>
        <a href="{{ route('admin.pdfgenerate') }}" class="mt-3 btn btn-primary">Create Report</a>
        <table class="mt-5 table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Present</th>
                    <th>Leave</th>
                    <th>Absent</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendancedata as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        @if ($item->attendance == 'P' || $item->attendance == 'p')
                            <td>{{ $item->attendance }}</td>
                            <td> - </td>
                            <td> - </td>
                        @endif
                        @if ($item->attendance == 'L' || $item->attendance == 'l')
                            <td> - </td>
                            <td>{{ $item->attendance }}</td>
                            <td> - </td>
                        @endif
                        @if ($item->attendance == 'A' || $item->attendance == 'a')
                            <td> - </td>
                            <td> - </td>
                            <td>{{ $item->attendance }}</td>
                        @endif
                        <td><a href="{{ route('admin.viewattendanceuseredit', $item->id) }}"
                                class="btn btn-primary">Edit</a></td>
                        <td><a href="{{ route('admin.viewattendanceuserdelete', $item->id) }}"
                                class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endsection



