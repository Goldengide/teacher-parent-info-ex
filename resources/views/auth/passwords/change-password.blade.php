@extends('layouts.auth')
@section('content')
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      @if(count($errors) > 0)

        <ul class="alert alert-danger">

            @foreach($errors->all() as $error)

               <li>{{$error}}</li>

            @endforeach
        </ul>

      @endif

      @if (session('message'))
        <p class="{{session('style')}} session-check" style="color: black">{!! session('message') !!}</p>
      @endif
        <p class="password-confirm" style="color: black"></p>
       <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ url('/change-password') }}">
        {{ csrf_field() }}
        <h3 class="box-title m-t-40 m-b-0 text-center" style="color: black">Change Your Password</h3> 
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control password" type="password" name="password" required="" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control confirm-password" type="password" name="password_confirmation" required="" placeholder="Confirm Password">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="border-radius: 0">Change Password</button>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</section>
@endsection
@section('other-scripts')
  <script type="text/javascript">
    // consile
    $('.password, .confirm-password').keyup(function() {
      $('.session-check').text("");
      if($('.password').val() != $('.confirm-password').val()) {
        console.log('false');
        $('.password-confirm').addClass('alert-danger').text('The Passwords are not matching');
        $('.btn.btn-info.btn-lg.btn-block').attr('disabled', true).addClass('disabled').addClass('btn-outline');
      }
      else if($('.password').val() == $('.confirm-password').val()) {
        $('.password-confirm').removeClass('alert-danger').addClass('alert-success').text('Password Match Confirmed');
        $('.btn.btn-info.btn-lg.btn-block').attr('disabled', false).removeClass('disabled').removeClass('btn-outline');
        console.log('true');
      }
    })
  </script>
@endsection