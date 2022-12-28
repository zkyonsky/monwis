@extends('template.default')
  @section('content')
    @include('sweetalert::alert')
      <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Ubah Periode</h3>
                </div>
                <form action="{{ route('monitors.week')}}" method="GET">
                <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Periode</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="daterange" name="daterange">
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
                </form>
            </div>
        </div>
      </div>
    @if (!empty($period))
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="text-center">Kegiatan Widyaiswara</h3>
              <p class="text-center">{{ \Carbon\Carbon::parse($begin)->format('d M') }} s.d. {{ \Carbon\Carbon::parse($end)->format('d M Y') }} </p>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                @for ($i = 0; $i < $headLength; $i++)
                  <th>{{ $head[$i] }}</th>
                @endfor
              </tr>
                </thead>
                <tbody>
                 @for ($i = 0; $i < $rowLength; $i++)
                 <tr>
                  @for ($x = 0; $x < $dataLength; $x++)
                    <td>
                      @php
                         $items = $row[$i][$x];
                            if (is_array($items)) {
                              foreach ($items as $item) {
                                  echo implode(" <br> ", $item);
                                  echo "<hr>";
                              } 
                            } else {
                              echo $items;
                            } 
                      @endphp
                    </td>
                  @endfor
                 </tr>  
                 @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endif
    @php
        $title = "Kegiatan Widyaiswara - ". \Carbon\Carbon::parse($begin)->format('d M')." s.d. ". \Carbon\Carbon::parse($end)->format('d M Y');
    @endphp

    @push('styles')
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    @endpush

    @push('scripts')
      <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
      <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
      <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
      <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
      <script>
        $(function () {
          $('#daterange').daterangepicker({
              locale:{
                  format: 'YYYY-MM-DD'
              }
          })
      });
      </script>

      <script>
          $(function () {
            $("#example1").DataTable({
              "stateSave": true,
              "autoWidth": true,
              "paging": false,
              "ordering":  false,
              "searching": false,
              dom: 'Bfrtip',
              'buttons': [{
                    extend: 'print',
                    title: function() {
                                        return "<div style='font-size: 18px;'><center><b>{{ $title }}</b></center></div>";
                                      }, 
                    // title: '{{ $title }}',
                    text: 'Print current page',
                    exportOptions: {
                        stripHtml: false
                    }
                }, {
                    extend: 'pdf',
                    text: 'Save PDF',
                    exportOptions: {
                        stripNewlines: true
                    }
                }
                ],
            });
          });
        </script>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @endpush
  @endsection