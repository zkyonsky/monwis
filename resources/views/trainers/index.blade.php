@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Daftar Pengajar</h3> 
                @can('trainers.create')
                <a class="btn btn-success btn-sm float-right" href="{{ route('trainers.create')}}"><i class="fas fa-plus"></i> Tambah Pengajar</a>
                @endcan
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama</th>
                  <th>Unit</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no=0;
                @endphp
                @foreach ($trainers as $trainer)
                  @php
                      $no++;
                  @endphp
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $trainer->full_name }}</td>
                    <td>{{ $trainer->unit }}</td>
                    <td>{{ $trainer->jabatan }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{$trainer->status}} 
                        </span>
                    </td>
                    <td>
                      @can('trainers.edit')
                      <a href="{{route('trainers.edit', [$trainer->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                      @endcan

                      @can('trainers.delete')
                      <button id="delete" data-title="{{$trainer->full_name}}" href="{{route('trainers.destroy', [$trainer->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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