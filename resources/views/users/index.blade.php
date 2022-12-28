@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Daftar User</h3> 
                @can('users.create')
                <a class="btn btn-success btn-sm float-right" href="{{ route('users.create')}}"><i class="fas fa-plus"></i> Tambah User</a>
                @endcan
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $no=0;
        
                    @endphp
                    @foreach ($users as $user)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $user->name }}</td>
                        <td> 
                          <span class="badge badge-success"> 
                            {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}
                          </span>
                        </td>
                        <td>{{ $user->status }}</td>
                        <td>
                          @can('users.changestatus')
                          <form
                              class="d-inline"
                              action="{{ route('users.changestatus') }}"
                              method="POST">
                              @csrf
                              <input type="hidden" 
                              name="id"
                              value="{{ $user->id }}">
                              
                              <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-toggle-on"></i></button>
                          </form>
                          @endcan
                          @can('users.edit')
                          <a href="{{route('users.edit', [$user->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                          @endcan
                          @can('users.delete')
                          <button id="delete" data-title="{{$user->name}}" href="{{route('users.destroy', [$user->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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