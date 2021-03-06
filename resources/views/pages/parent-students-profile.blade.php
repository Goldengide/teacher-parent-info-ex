@extends('layouts.parent')
@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{ $child->student_name }} profile</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            
              <li><a href="{{ url('/parent/dashboard')}}">Dashboard</a></li>
            @if($countChildren > 1)
              
              <li><a href="{{ url('/parent/children')}}">see all Children</a></li>
            
            @endif
            
            <li class="active"> {{ $child->student_name }} </li>
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- .row -->
      <div class="row">
        <div class="col-sm-12 col-md-3">
          <div class="white-box p-l-20 p-r-20">
            <div class="row">
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
              <dl class="dl-horizontal">
                <dt style="text-align: center; white-space: normal;">
                  <img src="{{ URL::asset('uploads/images/'. $child->img_url)}}" class="img-responsive img-center img-circle" align="center" >
                </dt> 
                <dd></dd>  <br><br>
                <form action="{{ url('/parent/child/profile/pics') }}" id = "change-profile-pics" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$child->id}}">
                  <input type="file" name="photo" class="form-control">
                  <button type="submit" class="btn btn-primary col-xs-12">Upload</button>
                </form>
                <dt style="text-align: center;"><a href="#change-profile-pics" class="user-clicker-change">Change Profile Pics</a></dt>  <br><br>
                
              </dl>
              
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-5">
          <div class="white-box p-l-20 p-r-20">
            <div class="row">
              <dl class="dl-horizontal">
                <dt style="text-align: left; white-space: normal;">Child Name:</dt> <dd>{{ $child->student_name }}</dd>  <br><br>

                <dt style="text-align: left; white-space: normal;">Class: </dt> <dd>{{ strtoupper($child->classTable($child->class_id)->name) }}</dd> <br></br>

                <dt style="text-align: left; white-space: normal;">Teacher </dt> 
                <dd> 
                  @if($child->classTable($child->class_id)->teacher_id == 0)
                    No teacher Assigned to this class
                  @else
                    {{ ($child->classTable($child->class_id)->teacher($child->classTable($child->class_id)->teacher_id)->fullname) }}
                    <a href="{{url('/parent/teacher/profile/'. $child->classTable($child->class_id)->teacher($child->classTable($child->class_id)->teacher_id)->id)}}">
                      <i class="icon icon-user"></i> 
                      <i class="icon icon-envelope"></i>
                    </a>
                  @endif
                </dd> <br></br>
                <?php 

                    $season = DB::table('seasons')->where('current', true)->first();
                    $checkIfResultIsOut = DB::table('student_summaries')
                                            ->where('student_id', $child->id)
                                            ->where('season_id', $season->id)
                                            ->count();
                ?>
                <!-- @if($checkIfResultIsOut != 0) -->
                    <!-- <dt style="text-align: left; white-space: normal;"><a href="{{ url('/parent/child/result/'.$child->id)}}">See Result</a></dt> <br></br> -->
                <!-- @endif -->
                @if($isProcessedResult)
                  <a href="{{ url('parent/result/student/'. $season->id .'/'. $child->class_id .'/'. $child->id) }}">Check Result</a>
                @endif

              </dl>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="white-box p-l-20 p-r-20">
            <div class="row">
              <dl class="dl-vertical">
                
                <dt style="text-align: left; white-space: normal;">My Name: </dt> <dd>{{ $child->parent_name }}</dd> <br></br>

                <dt style="text-align: left; white-space: normal;">Phone: </dt> <dd>{{ $child->phone }}</dd> <br><br>

                <dt style="text-align: left; white-space: normal;">Email: </dt> <dd>{{ $child->email }}</dd> <br></br>

                
              </dl>
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
    <script>
      $(document).ready(function(){
        $('#change-profile-pics').hide();
        $('.user-clicker-change').mousedown(function() {
          $('#change-profile-pics').show();
          $('.user-clicker-change').hide();
        })
      });
      
    </script>
  @endsection