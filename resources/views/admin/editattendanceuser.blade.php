@extends('layouts.adminapp')

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Attendance</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">Edit Attendance</li>
        </ol>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Attendance') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.viewattendanceuserupdate', $attendancedata->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $attendancedata->id }}">
                            <div class="form-group row">
                                <label for="attendance"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Select Attendance') }}</label>

                                <div class="col-md-6">
                                    <select name="attendance" class="form-select  @error('attendance') is-invalid @enderror"
                                        id="attendance" required>

                                        <option @if ($attendancedata->attendance == "P") selected  @endif value="P">Present</option>
                                        <option @if ($attendancedata->attendance == "L") selected  @endif value="L">Leave</option>
                                        <option @if ($attendancedata->attendance == "A") selected  @endif value="A">Absent</option>
                                    </select>
                                    @error('attendance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
