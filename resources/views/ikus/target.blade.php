@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Target IKU Widyaiswara</h3>
              @can('ikus.create')
              <a class="btn btn-success btn-sm float-right" href="{{ route('iku.create')}}"><i class="fas fa-plus"></i> Tambah IKU</a>
              @endcan
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama</th>
                  <th>Tahun</th>
                  <th>Target</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no=0;
                @endphp
                @foreach ($ikus as $iku)
                  @php
                      $no++;
                  @endphp
                  <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $wi->getName($iku->trainer_id) }}</td>
                      <td>{{ $iku->tahun }}</td>
                      <td>{{ $iku->target }}</td>
                      
                      <td>
                        @can('ikus.edit')
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="edit-iku" data-toggle="modal" data-id="{{ $iku->id }}"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('ikus.delete')
                        <button id="delete" data-title="{{$wi->getName($iku->trainer_id)}}" href="{{route('iku.destroy', [$iku->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Trash" style="display:none">
                        </form>
                        @endcan
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit IKU -->
      <div class="modal fade" id="crud-modal" aria-hidden="true" style="overflow:hidden;" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="userCrudModal">EDIT TARGET IKU</h4>
            </div>
            <div class="modal-body">
              <form name="ikuForm" method="POST" id="ikuForm">
                @csrf
                @method('PUT')
                <div class="row">
                  <input type="hidden" name="id" id="iku-id">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Tahun</strong>
                      <input type="number" name="tahun" id="iku-tahun" class="form-control" placeholder="Tahun">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <strong>Target</strong>
                      <input type="number" step="0.01" name="target" id="iku-target" class="form-control" placeholder="Target">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" id="btn-update" name="btnupdate" class="btn btn-primary" 
                    @if (isset($iku))
                    formaction="{{ route('iku.update', [$iku->id]) }}"  
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
          $('body').on('click', '#edit-iku', function () {
            var id = $(this).data('id');
            $.get( id +'/edit', function (data) {
              $('#ikuForm').trigger("reset");
              $('#crud-modal').modal({backdrop: 'static', keyboard: false});    
              $('#crud-modal').modal('show');
              $('#iku-id').val(data.id);
              $('#iku-tahun').val(data.tahun);
              $('#iku-target').val(data.target);
            });
          });
        });
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('button#delete').on('click', function(){
            var href= $(this).attr('href');
            var title= $(this).data('title')

            swal({
                    title: "Apakah Kamu Yakin Akan Menghapus Kegiatan " +title+ "?",
                    text: "Data yang terhapus tidak bisa dikembalikan",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('deleteForm').action = href;
                        document.getElementById('deleteForm').submit();
                        swal("Data Berhasil Dihapus", {
                        icon: "success",
                        });
                    } 
                });
        });
    </script>
     
    @endpush
  @endsection