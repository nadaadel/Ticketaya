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
                        <h2> LOGIN</h2>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 align-self-center">
                                         <input id="identity" type="identity" class="form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}" name="identity"
                                             value="{{ old('identity') }}" autofocus placeholder="Enter Email Address or Phone Number">

                                             @if ($errors->has('identity'))
                                               <span class="help-block">
                                                    <strong>{{ $errors->first('identity') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                  </div>
                                <div class="form-group row">
                                    <div class=" col-sm-12 col-md-6 align-self-center">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4 text-center mt-3">
                                       <a class="info" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        <ul>
                                            <li class="mt-4"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</li>
                                        </ul>
<!--
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                            </label>
                                        </div>
-->
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mt-4">
                                    <div class="col-md-8 offset-md-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('LOGIN') }}
                                        </button>
                                        <p class="mt-4">Don't Have an Account <a href="{{URL::route('register')}}" class="info">Register </a></p>

<!--
                                        <a class="info" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</section>


<!--
<div class="form-group row">


                         <label for="identity" class="col-md-4 col-form-label text-md-right">Email or phone</label>

                         <div class="col-sm-12 col-md-6 align-self-center">
                         <input id="identity" type="identity" class="form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}" name="identity"
                                 value="{{ old('identity') }}" autofocus>

                                 @if ($errors->has('identity'))
                                   <span class="help-block">
                                        <strong>{{ $errors->first('identity') }}</strong>
                                    </span>
                                @endif
                        </div>
                        </div>
-->
@endsection
