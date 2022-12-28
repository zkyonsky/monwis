@extends('template.default')

@section('content')
@include('sweetalert::alert')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Roles</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Roles</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('roles.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                {{-- @can('roles.create') --}}
                                    <div class="input-group-prepend">
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                {{-- @endcan --}}
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama role">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col" style="width: 15%">NAMA ROLE</th>
                                <th scope="col">PERMISSIONS</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $no => $role)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($roles->currentPage()-1) * $roles->perPage() }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->getPermissionNames() as $permission)
                                            <button class="btn btn-sm btn-success mb-1 mt-1 mr-1">{{ $permission }}</button>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        {{-- @can('roles.edit') --}}
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        {{-- @endcan --}}
                                        
                                        {{-- @can('roles.delete') --}}
                                            <button id="delete" data-title="{{$role->name}}" href="{{route('roles.destroy', [$role->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <form action="" method="POST" id="deleteForm">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" value="Trash" style="display:none">
                                            </form>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$roles->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@push('scripts')
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