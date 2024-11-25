@extends('layouts.auth')

@section('main-content')
<div class="container" style="background: rgba(255, 255, 255, 0.9); padding: 30px; max-width: 500px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px; color: #333;">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <img src="{{ asset('sb-admin-2/img/login/logo_kanitra.png') }}" alt="Logo" class="logo" style="display: block; margin: 0 auto 20px; max-width: 150px;">
            <h2 class="text-center" style="font-size: 28px; margin-bottom: 20px; color: navy; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);"><b>{{ __('Register') }}</b></h2>
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 15px; border-radius: 25px; background: #F44336; color: #fff;">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="user">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nrp" placeholder="{{ __('NRP') }}" required autofocus style="border-radius: 25px; border-color: navy;">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="username" placeholder="{{ __('Username') }}" required style="border-radius: 25px; border-color: navy;">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required style="border-radius: 25px; border-color: navy;">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required style="border-radius: 25px; border-color: navy;">
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block" style="background: linear-gradient(to bottom, #003366, #005ca8); border-color: navy; border-radius: 25px;">
                    {{ __('Register') }}
                </button>
            </form>

            <hr>

            <div class="text-center">
                <a class="small" href="{{ route('login') }}" style="color: navy; font-weight: bold;">
                    {{ __('Already have an account? Login!') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
