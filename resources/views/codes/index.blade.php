@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Kode Kegiatan</h3> 
                @can('codes.create')
                <a class="btn btn-success btn-sm float-right" href="{{ route('codes.create')}}"><i class="fas fa-plus"></i> Tambah Kode</a>
                @endcan
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode</th>
                  <th>Kegiatan</th>
                  <th>Angka Kredit</th>
                  <th>Satuan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($codes as $code)
                  <tr>
                    <td>{{ $code->id }}</td>
                    <td>{{ $code->name }}</td>
                    <td>{{ $code->credit }}</td>
                    <td>{{ $code->unit }}</td>
                    <td>
                        @can('codes.edit')
                        <a href="{{route('codes.edit', [$code->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('codes.delete')
                        <button id="delete" data-title="{{$code->code}}" href="{{route('codes.destroy', [$code->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Trash" style="display:none">
                        </form>
                        @endcan
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
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

      <script>
          $(function () {
            $("#example1").DataTable({
              "stateSave": true,
              "autoWidth": false,
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