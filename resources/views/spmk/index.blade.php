@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">STMK/SPMK Widyaiswara</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>No STMK</th>
                  <th>Tanggal STMK</th>
                  <th>No SPMK</th>
                  <th>Tanggal SPMK</th>
                  <th>Widyaiswara</th>
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no=0;
                @endphp
                @foreach ($trainers as $spmk)
                  @php
                      $no++;
                  @endphp
                  <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $spmk->no_stmk }}</td>
                      <td>{{ $spmk->tgl_stmk }}</td>
                      <td>{{ $spmk->no_spmk }}</td>
                      <td>{{ $spmk->tgl_spmk }}</td>
                      <td>{{ $spmk->full_name }}</td>
                      <td>
                          
                            {{ $spmk->event }}
                            @if(isset($spmk->batch))
                                Angkatan {{ $spmk->batch }}
                            @endif
                            @if(isset($spmk->class))
                                Kelas {{ $spmk->class }}
                            @endif
                            <br>
                            @if(isset($spmk->subject))
                                MP. {{ $spmk->subject }}
                            @endif
              
                      </td>
                      
                      <td>{{ Carbon\Carbon::parse($spmk->start)->format('d M') }} 
                        s.d. {{ Carbon\Carbon::parse($spmk->end)->format('d M Y') }}
                      </td>
                      
                      <td>
                        @can('spmks.show')
                        <a href="{{ route('spmk.show',[$spmk->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="show"><i class="fas fa-eye"></i></i></a>
                        @endcan
                        @can('spmks.edit')
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="edit-spmk" data-toggle="modal" data-id="{{ $spmk->id }}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="right" title="edit"></i></a>
                        @endcan
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit SPMK -->
      <div class="modal fade" id="crud-modal" aria-hidden="true" style="overflow:hidden;" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="userCrudModal">EDIT STMK/SPMK</h4>
            </div>
            <div class="modal-body">
              <form name="spmkForm" method="POST" id="spmkForm">
                @csrf
                @method('PUT')
                <div class="row">
                  <input type="hidden" name="id" id="spmk_id">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Nomor STMK:</strong>
                      <input type="text" name="no_stmk" id="no_stmk" class="form-control" placeholder="Nomor">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Tanggal STMK:</strong>
                      <input type="date" name="tgl_stmk" id="tgl_stmk" class="form-control" placeholder="Tanggal">
                    </div>
                  </div>
                  <hr>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Nomor SPMK:</strong>
                      <input type="text" name="no_spmk" id="no_spmk" class="form-control" placeholder="Nomor">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Tanggal SPMK:</strong>
                      <input type="date" name="tgl_spmk" id="tgl_spmk" class="form-control" placeholder="Tanggal">
                    </div>
                  </div>
     
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" id="btn-update" name="btnupdate" class="btn btn-primary" 
                    @if (isset($spmk))
                    formaction="{{ route('spmk.update', [$spmk->id]) }}" 
                    @endif
                    >Update</button>
                    <button type="button" id="btn-close" class="btn btn-default" data-dismiss="modal" >Close</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


    @push('styles')
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    @endpush

    @push('scripts')
      <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
      <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(function () {
          $("#example1").DataTable({
            "stateSave": true,
            "autoWidth": false,
          });
        });
    
        $(document).ready(function () {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $('body').on('click', '#edit-spmk', function () {
            var id = $(this).data('id');
            $.get('spmk/' + id +'/edit', function (data) {
              $('#spmkForm').trigger("reset");
              $('#crud-modal').modal({backdrop: 'static', keyboard: false});    
              $('#crud-modal').modal('show');
              $('#spmk_id').val(data.id);
              $('#no_stmk').val(data.no_stmk);
              $('#tgl_stmk').val(data.tgl_stmk);
              $('#no_spmk').val(data.no_spmk);
              $('#tgl_spmk').val(data.tgl_spmk);
            });
          });
        });
    </script>
    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
     
    @endpush
  @endsection