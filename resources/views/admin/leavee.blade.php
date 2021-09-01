@extends('layouts.adminapp')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leave Request of Students</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">Leave Request of Students</li>
        </ol>
        <div class="row justify-content-center">

            {{-- Specific View Attendance Details --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('View Attendance Details') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.attendancedetails') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="user"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Select User') }}</label>
                                <div class="col-md-6">
                                    <select name="user" class="form-select  @error('user') is-invalid @enderror" id="user"
                                        required>
                                        <option value="">Select any User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('user')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class=" mt-3 btn btn-primary">
                                        {{ __('View Attendance Details') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">{{ __('Leave Request') }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <table class="mt-5 table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Date</th>
                                        <th>Accept</th>
                                        <th>Reject</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leave as $item)
                                        <tr>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><a href="{{ route('admin.leaveaccept', $item->id) }}"
                                                    class="btn btn-primary">Leave
                                                    Accept</a></td>
                                            <td><a href="{{ route('admin.leavereject', $item->id) }}"
                                                    class="btn btn-danger">Leave Reject</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
