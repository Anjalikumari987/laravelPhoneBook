
@extends('master')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form id="registerUserForm" method="post" action=" {{ url('user-contact-store') }} " enctype="multipart/form-data">
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
                            <label for="username">  Name </label>  <div class="alert-message" id="nameError"></div>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Name" value="{{ old('username') }}"/>
                            {!! $errors->first('username', '<small class="text-danger">:message</small>') !!}
                          
                        </div>


                        <div class="form-group">
                            <label for="useremail"> E-mail </label> <div class="alert-message" id="emailError"></div>
                            <input type="text" name="useremail" id="useremail" class="form-control"  placeholder="Enter E-mail" value="{{ old('useremail') }}"/>
                            {!! $errors->first('useremail', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="usermobile"> Phone Number</label> <div class="alert-message" id="phoneError"></div>
                            <input type="phone" name="usermobile" id="usermobile" class="form-control" placeholder="Phone number" value="{{ old('usermobile') }}">
                            {!! $errors->first('usermobile', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="userimage">Image </label> <div class="alert-message" id="userImage"></div>
                            <input type="file" name="userimage" id="userimage"  class="form-control" placeholder="Upload image" value="{{ old('userimage') }}" onchange="uploadFile(event)">
                            {!! $errors->first('userimage', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                        <img src="uploads/" id="profile-img-tag" width="200px" />
                        </div>
                           
                        <div class="form-group">
                            <label for="aboutuser">  About </label> <div class="alert-message" id="aboutError"></div>
                            <input type="textarea" name="aboutuser" id="aboutuser" class="form-control" placeholder="Enter about yourshelf" value="{{ old('aboutuser') }}"/>
                            {!! $errors->first('aboutuser', '<small class="text-danger">:message</small>') !!}
                        </div>
                    </div>

                    <div class="card-footer d-inline-block">
                        <button type="submit" id="submitbtn" class="btn btn-primary"> Save </button>
                   </div>
                    @csrf
                </div>
            </form>


         
        </div>
    </div>
</div>
@endsection
@section('custom-style')
<style>
label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}
</style>
@endsection

@section('custom-scripts')

<script src="{{asset('js/registration.js')}}"></script>
@endsection

