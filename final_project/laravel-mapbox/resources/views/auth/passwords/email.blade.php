@extends('layouts.app')

@section('content')
<style>
    #card-header{
        border-top-left-radius: 18px;    
        border-top-right-radius: 18px;    
    }

    .card{
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0, 0, 0, 0.05);
        transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        /* padding: 14px 80px 18px 36px; */
        cursor: pointer;
    }

    .card:hover{
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }
</style>
<div class="container" style="margin-top: 5%;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <h4 class="card-header text-white bg-dark text-center" id="card-header">{{ __('Reset Password') }}</h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-block text-white rounded-lg" style="background-color: #046cdc;">
                                    {{ __('Send Password Reset Link') }}
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
