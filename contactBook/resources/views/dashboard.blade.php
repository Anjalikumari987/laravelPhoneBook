@extends('master')

@section('content')


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<a class="navbar-brand" href="#">PHONE BOOK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link text-white"> Welcome: {{ ucfirst(Auth()->user()->name) }} </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('logout') }}"> Logout </a>
      </li>
    </ul>
  </div>
</nav>


<div class="jumbotron">
  <div class="container text-center">
    <h1>My Account</h1>      
    <p>Welcome: {{ ucfirst(Auth()->user()->name) }}  </p>
  </div>
</div>
  
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <div class="table-responsive">   
        <div style="margin-top:50px; margin-left:10px;">       
        <p>Name: {{ ucfirst(Auth()->user()->name )}} </p>
        <p>Email-Id: {{ ucfirst(Auth()->user()->email) }}</p>
        <p>Contact-Number:{{ ucfirst(Auth()->user()->phone) }}</p>
        <p>Age:{{ ucfirst(Auth()->user()->age )}} </p>
        </div>
      </div>
    </div>
    <div>
       <div style="margin-top:10px; margin-left:35px;">
          <a href="{{ url('contact-registration') }}" class="btn btn-primary">Add contct details </a>
          <a href="{{ url('users') }}" class="btn btn-primary">List </a>
        </div>
      <form action="{{ route('search') }}" method="GET" >
          <div style="text-align:right;margin-top:-37px; width:auto; ">
            <input type="text" name="search" required/>
            <button type="submit" class="btn btn-primary">Search </button>
          </div>
      </form>
      
         @if(!empty($lists))
              <table class="table" border="1" id="contactUsers">
                  <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Image</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Disable</th>
                  </tr>
              @foreach ($contactUsers as $contactUser)
                <tr>
                  <td>{{ $contactUser->id }}</td>
                  <td>{{ $contactUser->username }}</td>
                  <td>{{ $contactUser->useremail }}</td>
                  <td>{{ $contactUser->usermobile}}</td>
                  <td><img src="{{ url('/uploads/'.$contactUser->userimage) }}" height="70" width="100" ></td>
                  <td><a href ='update/{{ $contactUser->id }}' class="btn btn-primary">Edit</a></td>
                  <td><a href = 'delete/{{ $contactUser->id }}' class="btn btn-primary" onclick="return myFunction();">Delete</a></td>
                  <td><a href = 'disable/{{ $contactUser->id }}' class="btn btn-primary" >Disable</a></td>
                  </tr>
                
              @endforeach
                </table>
        @else 
           <div class="col-sm-9">
              <table class="table" border="1" id="contactUsers">
                  <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Image</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Disable</th>
                  </tr>
                  @foreach ($contactUsers as $contactUser)
                  <tr>
                  <td>{{ $contactUser->id }}</td>
                  <td>{{ $contactUser->username }}</td>
                  <td>{{ $contactUser->useremail }}</td>
                  <td>{{ $contactUser->usermobile}}</td>
                  <td><img src="{{ url('/uploads/'.$contactUser->userimage) }}" height="70" width="100" ></td>
                  <td><a href ='update/{{ $contactUser->id }}' class="btn btn-primary">Edit</a></td>
                  <td><a href = 'delete/{{ $contactUser->id }}' class="btn btn-primary" onclick="return myFunction();">Delete</a></td>
                  <td><a href = 'disable/{{ $contactUser->id }}' class="btn btn-primary">Disable</a></td>
                  </tr>
                 @endforeach
               </table>
            </div>
         @endif
</div>
@endsection

@section('custom-style')
<link href="{{ asset('style/style.css') }}" rel="stylesheet">
@endsection

@section('custom-scripts')
  <script src="{{asset('js/registration.js')}}"></script>
@endsection