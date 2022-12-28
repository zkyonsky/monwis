@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

    <!-- Main content -->
    @if(session('status'))
      <div class="alert alert-warning">
            {{session('status')}}
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">
            {{session('error')}}
      </div>
    @endif
   
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @hasanyrole('super admin|admin kegiatan')
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $countAvailableWI }}</h3>

                <p>WI Available Today</p>
              </div>
              <div class="icon">
                <i class="fas fa-house-user"></i>
              </div>
              <a href="{{ route('monitors.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $countActivities }}</h3>

                <p>Kegiatan Hari Ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
              </div>
              <a href="{{ route('activities.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $countWI }}</h3>

                <p>Jumlah WI</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="{{ route('profile.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $UnderPerformanceWI }}</h3>

                <p>WI Belum Memenuhi IKU</p>
              </div>
              <div class="icon">
                <i class="fas fa-tasks"></i>
              </div>
              <a href="{{ route('iku.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          @endhasanyrole
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">WI Available - Today</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    @foreach ($availableWI as $WI)
                      <div class="badge badge-success">{{ $WI->full_name }}</div>
                      <br>
                    @endforeach 
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id='loading'>loading...</div>
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
      <!-- fullCalendar -->
      <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/timegrid/main.css') }}" rel="stylesheet" />
      <link href="{{ asset('fullcalendar/packages/list/main.css') }}" rel="stylesheet" />
    @endpush

    @push('scripts')
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
           events: {
             url: "{{ route('dashboard.load') }}",
             failure: function() {
               document.getElementById('script-warning').style.display = 'block'
             }
           },
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
     
      </script>
    @endpush
  @endsection