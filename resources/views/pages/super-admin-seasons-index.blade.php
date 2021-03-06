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
            <h3 class="box-title m-b-0">Seasons </h3>
            @if(!isset($results))
              <p class="text-muted m-b-30">Current Session: {{$activeSession}}</p>
              <p class="text-muted m-b-30">Current Term: {!! $activeTerm  !!}</p>
            @endif
            <!-- <p class="text-muted m-b-30"><a href="{{ url('/super-admin/seasons/add')}}">Add New Session</a></p> -->
            @if(Session::has('message'))

              <p class="{{session('style')}}">{{session('message')}}</p>

            @endif
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Session</th>
                  <th>Term</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Session</th>
                  <th>Term</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(count($seasons) < 1)
                  <!-- <td colspan="4">No Seasons <a href="{{url('/super-admin/seasons/generator')}}">Generate Seasons</a></td> -->
                  @if(!isset($results))
                    <td colspan="4">No Seasons <a href="{{url('/super-admin/seasons/generate/2019/2019')}}">Generate Seasons</a></td>
                  @endif
                @else
                  @foreach($seasons as $season)
                  <tr>
                    <td>{{$season->session}}</td>
                    <td>{{$season->term_no}}</td>
                    <td>
                      @if ($season->status == true)
                        @if(!isset($results))
                          Active Season
                        @else
                          @if($season->ended == 1)
                            <a href="{{ url('/super-admin/result/season/'. $season->id)}}"><span class="icon icon-unlock">Enter</span></a>
                          @elseif($season->current == 1)
                            <a href="{{ url('/super-admin/result/season/'. $season->id)}}"><span class="icon icon-unlock">Enter</span></a>
                          @else
                          <span class="icon icon-unlock">---</span>
                          @endif
                        
                        @endif
                      
                      @elseif($season->ended == true)
                        @if(!isset($results))
                          <a href="javascript::void()" class="text-primary">Ended</a>
                        @endif
                      
                      @else
                        @if(!isset($results))
                          @if($noOfSubject == 0 || $noOfClass == 0 || $noOfStudent == 0)
                            <a href="javascript::void()" class="text-warning swal-alert" title="You have to upload the Subjects, Students and Class details before you can activate this season"><i class="icon icon-unlock"></i>Activate</a>
                          @else 
                            <a href="{{url('super-admin/season/activate/'. $season->id)}}" class="text-primary" title=""><i class="icon icon-unlock"></i>Activate</a>
                          @endif
                        @else
                          @if($season->ended == 1)
                            <a href="{{ url('/super-admin/result/season/'. $season->id)}}"><span class="icon icon-unlock">Enter</span></a>
                          @elseif($season->current == 1)
                            <a href="{{ url('/super-admin/result/season/'. $season->id)}}"><span class="icon icon-unlock">Enter</span></a>
                          @else
                          <span class="icon icon-unlock">---</span>
                          @endif
                        @endif
                      @endif
                      @if(!isset($results))
                        @if($season->status) 

                          @if ($season->current == true)
                             || Ongoing
                          @elseif($season->ended == true)
                             || <a href="javascript::void()" class="text-primary">Ended</a>
                          @else
                            || <a href="{{url('super-admin/season/launch/'. $season->id)}}" class="text-primary"><i class="icon icon-date"></i>Launch</a>
                          @endif
                          
                        @endif
                      @endif
                    
                    </td> 

                  </tr>
                  @endforeach
                @endif
              </tbody>
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

  <script src="{{ URL::asset("plugins/bower_components/sweetalert/sweetalert.min.js") }}"></script>
  <script src="{{ URL::asset("plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js") }}"></script>

  <script type="text/javascript">
  // $.ajaxSetup();
  $(document).ready(function() {
      

    var nameErrorMessage = $('.swal-alert').attr('title');
    console.log(nameErrorMessage);

    var helpTipMessage = {
              title:'Required',
              text: nameErrorMessage,
              animation: true,
              confirmButtonText: 'Got it!',
              allowOutsideClick: true,
              showConfirmButton: true,
    };

    $('.swal-alert').mousedown(function() {

      swal(helpTipMessage);
      
    });


  });

</script>
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
  <link href="{{ URL::asset("plugins/bower_components/sweetalert/sweetalert.css")}}" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
