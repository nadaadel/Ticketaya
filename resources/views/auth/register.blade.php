@extends('layouts.app')

@section('content')
<section class="login">
    <div class='slider'>
                <div class="overlay"></div>
                <div class='slide1'></div>
                <div class='slide2'></div>
                <div class='slide3'></div>
                <div class="content d-flex align-items-center">
                    <div class="card">
                        <h2>REGISTER</h2>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Your Name">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus placeholder="Your phone">

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">                     
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email Address">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mt-4">
                                    <div class="col-md-6 offset-md-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('REGISTER') }}
                                        </button>
                                        <p class="mt-4">Have an Account <a href="{{URL::route('login')}}" class="info">Login</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</section>

@endsection
