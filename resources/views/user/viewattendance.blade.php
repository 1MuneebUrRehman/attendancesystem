@extends('layouts.userapp')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">View Attendace</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">View Attendace</li>
        </ol>

        <table class="mt-3 table table-bordered">
            <thead>
                <tr>
                    @foreach ($attendance as $item)
                        <th>{{ $loop->iteration }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($attendance as $item)
                    <td>{{ $item->attendance }}</td>
                @endforeach

                </tr>
            </tbody>
        </table>

    </div>

@endsection
