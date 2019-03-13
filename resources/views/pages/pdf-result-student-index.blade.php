@extends('layouts.pdf')
@section('content')
  <div class="container-fluid">
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
          <div class="white-box">
            <div class="row">
              <div class="col-sm-3 col-xs-6">
                <img src="{{ URL::asset('uploads/images/'. $student->img_url)}}" class="img-responsive img-right img-circle" align="right">
              </div>
            </div>
            <h3 class="box-title m-b-0">{!! $season->sequenceNumber($season->term_no) !!} Term {{$season->session}} Report Sheet </h3>
            <h3 class="box-title m-b-0">{{ $student->student_name }}</h3>
            <h3 class="box-title m-b-0">Class: {{$class->name}}</h3>
            @if(isset($studentSummary))
              <h3 class="box-title m-b-0">Overall Score: {{$studentSummary->percentage}}</h3>
            @endif

            
            @if(Session::has('message'))

              <p class="{{session('style')}}">{{session('message')}}</p>

            @endif
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Assessment</th>
                  <th>Exam Score</th>
                  <th>Total</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                @if(count($results) < 1)
                  <td colspan="5">No student data has been uploaded so far. Please upload</td>
                @else
                  @foreach($results as $result)
                  <tr>
                    <td>{{$result->subject($result->subject_id)->name}}</td>
                    <td>{{$result->assessment}}</td>
                    <td>{{$result->exam_score}}</td>
                    <td>{{ $result->total }}</td>
                    <!-- <td> -->
                      <!-- <a href="{{url('super-admin/result/edit/'. $result->id)}}" class="text-info"><i class="icon icon-pencil"></i></a>   -->
                        <!-- <a href="{{url('teacher/result/view/'. $result->id )}}" class="text-info"><i class="ti-user"></i>View Result</a> -->
                    <!-- </td>  -->
                    
                  </tr>
                  @endforeach
                @endif
              </tbody>
              <tfoot>
                @if(isset($studentSummary))
                <tr>
                  <th>Worst Score: {{$studentSummary->worse_score}}</th>
                  <th>Best Score: {{$studentSummary->best_score}} </th>
                  <th>Overall Score: {{$studentSummary->percentage}} </th>
                  <th></th>
                </tr>
                @else 
                <tr>
                  <th>Worst Score: ?</th>
                  <th>Best Score:  ?</th>
                  <th>Overall Score: ? </th>
                  <th>Result not yet processed</th>
                </tr>
                @endif
              </tfoot>
            </table>
            </div>
          </div>
        </div>
    </div>
    <!-- /.row -->

    @if(trim($studentSummary->comments) != "")
    <!-- row -->
    <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <h3>Teacher's Comment</h3>
              <span class="text-default">{{$studentSummary->comments}}</span>
            </div>
          </div>
    </div>
  </div>
      @endif
@endsection

@section('other-styles')
  <link href="{{ URL::asset("plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.css") }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection