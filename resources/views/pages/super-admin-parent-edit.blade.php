@extends('layouts.super-admin')
@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Edit {{$parent->firstname}} Info</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="{{ url('/super-admin/dashboard')}}">Dashboard</a></li>
            <li><a href="{{ url('/super-admin/parents')}}">See all Parents</a></li>
            <li class="active"> {{$parent->firstname}} </li>
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- .row -->
      <div class="row">
        <div class="col-sm-12">
          <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title m-b-0">Edit Parent</h3>
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

            <div class="row">
              <div class="col-md-12">
                <form class="form-material form-horizontal" method="post" action="{{url('super-admin/parent/edit')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$parent->id}}">

                  <div class="form-group">
                    <label class="col-md-12">Surname<span class="help"> e.g Awosanmi</span></label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" name="lastname" value="{{$parent->lastname}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12">First Name<span class="help"> e.gAwoyelu</span></label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" name="firstname" value="{{$parent->firstname}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12">Other names<span class="help"> e.g Taiwo</span></label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" name="othernames" value="{{$parent->othernames}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12">Phone Number</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control"  name="phone" placeholder="Phone here" value="{{$parent->phone}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12">Email</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control"  name="email" placeholder="Email here" value="{{$parent->email}}">
                    </div>
                  </div>

                  
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </div>
                  </div>
                </form>
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