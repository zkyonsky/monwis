@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card card-header">
                <form action="{{route('monitors.agenda')}}" method="GET">
                  <div class="row">
                    <div class="col-md-6">
                      <h3 class="card-title font-weight-bold">Agenda : {{ $wi }}</h3>
                    </div>
                    @hasanyrole('admin kegiatan|super admin')
                    <div class="col-md-6">
                      <div class="form-group">   
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"  data-target="#date" data-toggle="datetimepicker">
                              <i class="fa fa-user-graduate"></i>
                            </div>
                          </div>
                          <select id="trainers" name="trainers" class="form-control select2" style="width: 70%;">
                            <option value='0'>-- Pilih WI --</option>
                          </select>
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Ubah WI</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endhasanyrole
                  </div>
                </form>
              </div>  
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    


    @push('styles')
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

      <!-- fullCalendar -->
      <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/timegrid/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/list/main.css') }}" rel="stylesheet" />

      <style type="text/css">
        .select2-container .select2-selection--single {
        height: 40px !important;
        }
      </style> 
    @endpush

    @push('scripts')
      <!-- Select2 -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <!-- fullCalendar 4.4.0 -->
      <script src="{{ asset('fullcalendar/packages/core/main.js') }}"></script>
      <script src="{{ asset('fullcalendar/packages/interaction/main.js') }}"></script>
      <script src="{{ asset('fullcalendar/packages/daygrid/main.js') }}"></script>
      <script src="{{ asset('fullcalendar/packages/timegrid/main.js') }}"></script>
      <script src="{{ asset('fullcalendar/packages/list/main.js') }}"></script>

      <script>

        document.addEventListener('DOMContentLoaded', function() {
         var calendarEl = document.getElementById('calendar');
     
         var calendar = new FullCalendar.Calendar(calendarEl, {
           plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
           header: {
             left: 'prev,next today',
             center: 'title',
             right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
           },
           defaultDate: moment().format("YYYY-MM-DD"),
           editable: true,
           navLinks: true, // can click day/week names to navigate views
           eventLimit: true, // allow "more" link when too many events
           events: 
           @json($calender)
                      // {
                      //   title  : 'event1',
                      //   start  : '2020-08-24'
                      // },
                      // {
                      //   title  : 'event2',
                      //   start  : '2020-08-21',
                      //   end    : '2020-08-23'
                      // },
                      // {
                      //   title  : 'event3',
                      //   start  : '2020-08-19T12:30:00',
                      //   allDay : false // will make the time show
                      // }
                    ,
           eventTimeFormat: { // like '14:30:00'
              hour: '2-digit',
              minute: '2-digit',
              hour12: false
           },
           loading: function(bool) {
             document.getElementById('loading').style.display =
               bool ? 'block' : 'none';
           }
         });
     
         calendar.render();
       });

       //Cari Pengajar
        //Initialize Select2 Elements
        $('#trainers').select2({
            minimumInputLength: 1,
            ajax: {
            url: "{{ route('trainers.search') }}",
            dataType: 'json',
            },
        });
     
      </script>
    @endpush
  @endsection