@extends('layouts.auth')

@section('main-content')
<div class="container" style="background: rgba(255, 255, 255, 0.9); padding: 30px; max-width: 400px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); border-radius: 10px; color: #333;">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <img src="{{ asset('sb-admin-2/img/login/logo_kanitra.png') }}" alt="Logo" class="logo" style="display: block; margin: 0 auto 20px; max-width: 150px;">
            <h2 class="text-center" style="font-size: 28px; margin-bottom: 20px; color: navy; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);"><b>MEMBER LOGIN</b></h2>
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

            <form method="POST" action="{{ route('login') }}" class="user">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" style="border-radius: 25px; border-color: navy;">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" style="border-radius: 25px; border-color: navy;">
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="background: linear-gradient(to bottom, #003366, #005ca8); border-color: navy; border-radius: 25px;">Log In</button>
                <hr>

                @if (Route::has('forgot.password'))
                    <div class="text-center">
                        <a class="small" href="{{ route('forgot.password') }}" style="color: navy; font-weight: bold;">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>
                @endif

                @if (Route::has('register'))
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}" style="color: navy; font-weight: bold;">
                            {{ __('Create an Account!') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
