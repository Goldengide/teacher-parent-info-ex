@extends('layouts.super-admin')
@section('content')
  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">...</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <!-- <a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a> -->
          <ol class="breadcrumb">
            <?php 
            $seasonIsSet = DB::table('seasons')->where('current', 1)->count();
            ?>
            <li><a href="{{ url('super-admin/dashboard')}}">Dashboard</a></li>
            @if($seasonIsSet == 0)
              <li class="active">---</li>
              
            @else
              <?php $currentSeason = DB::table('seasons')->where('current', 1)->first(); ?>
              <li class="active">{{$currentSeason->session}} |{{$currentSeason->term_no}}|</li>
            @endif
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /row -->
      <div class="row">
        <div class="col-sm-12">
          <div class="white-box">
            <h3 class="box-title m-b-0">Students</h3>
            <div class="table-responsive">
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>Class </th>
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Score</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($bestStudents) < 1)
                    <td colspan="5">No student data has been uploaded so far. Please upload</td>
                  @else
                    @foreach($bestStudents as $bestStudent)
                    <tr>
                      <td>{{ $bestStudent->student($bestStudent->student_id)->classTable($bestStudent->student($bestStudent->student_id)->class_id)->name }}</td>
                      <td>{{$bestStudent->student($bestStudent->student_id)->student_name}}</td>
                      <td>{{$bestStudent->student($bestStudent->student_id)->parent_name}}</td>
                      <td>{{$bestStudent->percentage}}</td>
                      
                    </tr>
                    @endforeach
                  @endif
                </tbody>
                <thead>
                  <tr>
                    <th>Class </th>
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Score</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
@endsection
@section('other-scripts')
  <script src="{{ URL::asset("plugins/bower_components/datatables/jquery.dataTables.min.js") }}"></script>

  <!-- start - This is for export functionality only -->
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

  <script>
      $(document).ready(function(){


        $('#myTable').DataTable();
        $(document).ready(function() {
          var table = $('#example').DataTable({
            "columnDefs": [
            { "visible": false, "targets": 2 }
            ],
            "order": [[ 2, 'asc' ]],
            "displayLength": 25,
            "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;

              api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                  $(rows).eq( i ).before(
                    '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );

                  last = group;
                }
              } );
            }
          } );

          // Order by the grouping
          $('#example tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
              table.order( [ 2, 'desc' ] ).draw();
            }
            else {
              table.order( [ 2, 'asc' ] ).draw();
            }
          });
        });
      });
      $('#example23').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      });
    </script>

@endsection
@section('other-styles')
  <link href="{{ URL::asset("plugins/bower_components/datatables/jquery.dataTables.min.css") }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection