@extends('layouts.super-admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">  </h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <?php $currentSeason = DB::table('seasons')->where('current', 1)->first(); ?>
            <!-- <li><a href="{{ url('super-admin/dashboard')}}">Dashboard</a></li> -->
            <li class="active">{{$currentSeason->session}} |{{$currentSeason->term_no}}|</li>
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('super-admin/teachers')}}">{{$noOfTeachers}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Teachers</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/super-admin/students/all')}}">{{$noOfStudents}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Students in School</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/super-admin/result/session')}}">Go</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Check Results</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/students/grad')}}">{{$noOfStudents}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Graduating Students</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/students/new')}}">{{$noOfStudents}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">New Students</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        
      </div>
      <!--row -->

      <!-- /.row -->
      <div class="row">

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    @if($studentSummariesCount > 0)
                      <h5 class="counter text-center m-t-15 text-primary"><a href="{{url('super-admin/result/summary/'. $currentSeason->id)}}">Click to see</a></h5>
                    @else
                      <h5 class="counter text-center m-t-15 text-primary"><a href="javascript::void()">Result's not Ready</a></h5>
                    @endif
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Best Students</h4>
                    <h5 class="counter text-center m-t-15 text-default">{{$currentSeason->session}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    @if($bestOverallStudent == "")
                      <h3 class="counter text-center m-t-15 text-default">??</h3>
                    @else
                      <h5 class="counter text-center m-t-15 text-primary">
                        <a href="{{ url('super-admin/student/profile/'. $bestOverallStudent->student_id)}}">
                          {{$bestOverallStudent->student($bestOverallStudent->student_id)->student_name}}
                        </a>
                      </h5>
                    @endif
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Overall Best Student</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    @if($mostEffectiveTeacher == "")
                      <h3 class="counter text-center m-t-15 text-default">??</h3>
                    @else
                      <h5 class="counter text-center m-t-15 text-primary">
                        <a href="{{ url('super-admin/teacher/profile/'.$mostEffectiveTeacher->id)}}">{{ $mostEffectiveTeacher->fullname}}</a>
                      </h5>
                      @endif
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Most Effective Teacher</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        
      </div>
      <!--row -->

      <!-- /.row -->
      <!-- <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/super-admin/upload/')}}">?</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Upload Result</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary">??</h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">Graduating Students</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="{{url('/teacher/students')}}">{{$noOfTeachers}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb"></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-6">
          <div class="white-box">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-in row">
                  <div class="col-xs-12">
                    <h3 class="counter text-center m-t-15 text-primary"><a href="">{{$noOfStudents}}</a></h3>
                  </div>
                  <div class="col-xs-12">
                    <h4 class="text-muted text-center text-info vb">All Students</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <!--row -->
      
@endsection