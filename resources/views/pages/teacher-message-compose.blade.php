@extends('layouts.teachers')
@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">...</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
           <ol class="breadcrumb">
            <?php $currentSeason = DB::table('seasons')->where('current', 1)->first(); ?>
            <li><a href="{{ url('teacher/dashboard')}}">Dashboard</a></li>
            <!-- <li><a href="{{ url('/teacher/students')}}"><i class="ti-back-left"></i>see all Students</a></li> -->
            <li class="active">{{$currentSeason->session}} |{{($currentSeason->term_no)}}|</li>
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- .row -->
      <div class="row">
        <div class="col-sm-12">
          <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title m-b-0">Edit Result</h3>
            @if(count($errors) > 0)

              <ul class="alert alert-danger">

                  @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                  @endforeach
              </ul>

            @endif
            
            @if(Session::has('message'))

              <p class="{{session('style')}}">{{session('message')}}</p>

            @endif

            <div class="row" id="sendMesage">
        <div class="col-sm-12 col-md-12">
          <div class="white-box p-l-20 p-r-20">
            <div class="row">
              <form class="form-material form-horizontal" method="post" action="{{url('teacher/message/send')}}">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="to" value="{{$adminPhone}}">
                <input type="hidden" name="cc" value="08174007780">
                <div class="form-group">
                  <label class="col-md-2">To</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control form-control-line" name="name" value="Admin" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <!-- <label class="col-md-2">Message</label> -->
                  <div class="col-md-12">
                    <textarea style="width: 100%; border-radius: 0.3em;">Message Here...</textarea>
                  </div>
                </div>
                      
                <div class="form-group">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-md btn-info">Send Message</button>
                  </div>
                </div>
              </form>
              
            </div>
            
          </div>
        </div>
      </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
  @endsection
  @section('other-scripts')
  <script src="{{URL::asset("plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
  <!-- Date range Plugin JavaScript -->
  <!-- <script src="{{URL::asset("plugins/bower_components/timepicker/bootstrap-timepicker.min.js")}}"></script> -->
 
  @endsection