
@extends('master')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form id="registerUserForm" method="post" action=" {{ url('user-store') }} " >
                <div class="card shadow mb-4">
                    <div class="car-header bg-primary pt-2">
                        <div class="card-title font-weight-bold text-white text-center"> PHONE BOOK </div>
                    </div>

                    <div class="card-body">

                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif

                        <div class="form-group" >
                            <label for="name">  Name </label>  <div class="alert-message" id="nameError"></div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}"/>
                            {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                          
                        </div>


                        <div class="form-group">
                            <label for="email"> E-mail </label> <div class="alert-message" id="emailError"></div>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter E-mail" value="{{ old('email') }}"/>
                            {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
                          
                        </div>

                        <div class="form-group"> 
                            <label for="password"> Password </label> <div class="alert-message" id="passwordError"></div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" value="{{ old('password') }}"/>
                            {!! $errors->first('password', '<small class="text-danger">:message</small>') !!}
                          
                        
                        </div>

                        <div class="form-group">
                            <label for="confirm_password"> Confirm Password </label> <div class="alert-message" id="confirm_password"></div>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="{{ old('confirm_password') }}">
                            {!! $errors->first('confirm_password', '<small class="text-danger">:message</small>') !!}
                            
                        </div>

                        <div class="form-group">
                            <label for="phone"> Phone </label> <div class="alert-message" id="phoneError"></div>
                            <input type="phone" name="phone" id="phone" class="form-control" placeholder="Enter Phone" value="{{ old('phone') }}">
                            {!! $errors->first('phone', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="age">  Age </label><div class="alert-message" id="ageError"></div>
                            <input type="text" name="age" id="age" class="form-control" placeholder="Enter Age" value="{{ old('age') }}"/>
                            {!! $errors->first('age', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="about">  About </label> <div class="alert-message" id="aboutError"></div>
                            <input type="textarea" name="about" id="about" class="form-control" placeholder="Enter about yourshelf" value="{{ old('about') }}"/>
                            {!! $errors->first('about', '<small class="text-danger">:message</small>') !!}
                        </div>
                    </div>

                    <div class="card-footer d-inline-block">
                        <button type="submit" id="submitbtn" class="btn btn-primary"> Register </button>
                    <p class="float-right mt-2"> Already have an account?  <a href="{{ url('user-login')}}" class="text-primary"> Login </a> </p>
                    </div>
                    @csrf
                </div>
            </form>
         
        </div>
    </div>
</div>
@endsection
@section('custom-style')
<link href="{{ asset('style/style.css') }}" rel="stylesheet">
@endsection

@section('custom-scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{asset('js/registration.js')}}"></script>
@endsection

