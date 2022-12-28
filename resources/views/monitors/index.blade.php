@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-md">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-8">
                      <h3 class="card-title font-weight-bold">Tidak Ada Penugasan {{ Carbon\Carbon::parse($date)->format('d M Y') }} </h3>
                    </div>
                    <div class="col-md-4">
                      <form action="{{route('monitors.index')}}" method="GET">
                        <div class="form-group">   
                          <div class="input-group date" id="date" data-target-input="nearest">
                            <div class="input-group-prepend">
                              <div class="input-group-text"  data-target="#date" data-toggle="datetimepicker">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                            <input type="text" name="date" class="form-control datetimepicker-input" />
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-secondary">Ubah Tanggal</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    @foreach ($availableWI as $WI)
                      <div class="external-event bg-success">{{ $WI->full_name }}</div>
                    @endforeach 
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    


    @push('styles')

    @endpush

    @push('scripts')
    <script type="text/javascript">
      $(function () {
          $('#date').datetimepicker({
            format: 'MM/DD/YYYY'
          });
      });
  </script>
    @endpush
  @endsection