@extends('layouts.adminapp')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">View Attendace of {{ $user->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">View Attendace of {{ $user->name }}</li>
        </ol>

        <table class="mt-3 table table-bordered">
            <thead>
                <tr>
                    @foreach ($attendancedetails as $item)
                        <th>{{ $loop->iteration }}</th>
                    @endforeach
                    <th>Present's</th>
                    <th>Leave's</th>
                    <th>Absent's</th>
                    <th>Grading</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($attendancedetails as $item)
                        <td>{{ $item->attendance }}</td>
                    @endforeach
                    <td>{{ $attendancepresentcount }}</td>
                    <td>{{ $attendanceleavecount }}</td>
                    <td>{{ $attendanceabsentcount }}</td>

                    <td>
                        @if ($grading <= 4)
                            Grade A
                        @endif
                        @if ($grading <= 10 && $grading > 4)
                            Grade B
                        @endif
                        @if ($grading <= 15 && $grading > 10) Grade C @endif
                            @if ($grading <= 20 && $grading > 15)
                            Grade D
                            @endif
                            @if ($grading <= 26 && $grading > 20) Grade E @endif
                            @if ($grading <= 30 && $grading > 26) Grade F @endif
                        </td>
                </tr>
            </tbody>
        </table>

    </div>

@endsection
