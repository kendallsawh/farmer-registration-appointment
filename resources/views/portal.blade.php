@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style type="text/css">
    .upper-case{text-transform:uppercase}
</style>
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 75px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
  }

  .dropdown {
      position: relative;
      display: inline-block;
  }

  .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
  }

  .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
  }

  .dropdown-content a:hover {background-color: #ddd;}

  .dropdown:hover .dropdown-content {display: block;}

  .dropdown:hover .dropbtn {background-color: #3e8e41;}

  .openPopup:focus {
    outline: none;
}
</style>
@stop


@section('content')
<div class="flex-center position-ref full-height text-white bg-info">
           

            <div class="content">
                <div class="title m-b-md">
                    <p>Welcome to the Farmer Registration</p><p> Appointment Portal</p>
                </div>

                <div class="text-center">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10 text-center">
                            <h4>Click the link below to proceed to the booking form.</h4>
                        </div>
                    </div>
                    
                   
                  
                </div>
                <div class="row justify-content-md-center ">
                    <!-- <div class="col-md-1 text-center px-0">
                      <button type="button" class="btn btn-outline-light padding-0"><i class="fas fa-arrow-right"></i></button>
                    </div> -->
                    <div class="col-md-3  btn-group">
                      <!-- <button type="button" class="openPopup btn btn-outline-light padding-0"><i class="fas fa-arrow-right"></i></button> -->
                      <a href="{{route('newAppointment')}}" target="_blank" type='button' id="confirm" class='btn btn-success btn-round btn-lg btn-block padding-0'><i class="fas fa-arrow-right text-left"></i> Book an Appointment</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
<script src="https://kit.fontawesome.com/7be7b3aac4.js" crossorigin="anonymous"></script>



@endsection
