@extends('layouts.adminapp')

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">PDF Generate</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active p-3">PDF Generate</li>
        </ol>


        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">{{ __('Complete Generate Report') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pdfgeneratereportall') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="fromdate"
                                    class="col-md-4 col-form-label text-md-right">{{ __('From Date') }}</label>

                                <div class="col-md-6">
                                    <input type="date" name="fromdate" id="fromdate"class="form-select  @error('fromdate') is-invalid @enderror" required>

                                    @error('fromdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="todate"
                                    class="col-md-4 col-form-label text-md-right">{{ __('To Date') }}</label>

                                <div class="col-md-6">
                                    <input type="date" name="todate" id="todate"class="form-select  @error('todate') is-invalid @enderror" required>

                                    @error('todate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Complete Generate Report') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- Specific PDF Generate --}}
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">{{ __('PDF Generate') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pdfgenerateuser') }}">
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

                            <div class="form-group row">
                                <label for="fromdate"
                                    class="col-md-4 col-form-label text-md-right">{{ __('From Date') }}</label>

                                <div class="col-md-6">
                                    <input type="date" name="fromdate" id="fromdate"class="form-select  @error('fromdate') is-invalid @enderror" required>

                                    @error('fromdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="todate"
                                    class="col-md-4 col-form-label text-md-right">{{ __('To Date') }}</label>

                                <div class="col-md-6">
                                    <input type="date" name="todate" id="todate"class="form-select  @error('todate') is-invalid @enderror" required>

                                    @error('todate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Specific PDF Generate') }}
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
