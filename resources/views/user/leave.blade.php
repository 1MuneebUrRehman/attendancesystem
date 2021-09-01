@extends('layouts.userapp')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Leave Request</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active p-3">Leave Request</li>
    </ol>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Leave Request') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('leaverequest') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Leave Request') }}
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
