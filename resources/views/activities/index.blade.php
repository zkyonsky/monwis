@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      @can('inputs.create')
      <div class="row">
        <div class="col-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Import Data Kegiatan
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Import data kegiatan harus menggunakan dan sesuai dengan format template ini -> <a href="{{ url('storage/template.xlsx') }}" class="btn btn-info btn-sm"><i class="fas fa-file-download"></i></a>
              </div> 
                            
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

              <form action="{{ route('activity.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                      {{-- <span class="input-group-text" id="">Upload</span> --}}
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      @endcan
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Monitoring Kegiatan Widyaiswara</h3> 
              @can('inputs.create')
              <a class="btn btn-success btn-sm float-right" href="{{ route('activities.create')}}"><i class="fas fa-plus"></i> Tambah Kegiatan</a>
              @endcan
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Kegiatan</th>
                  <th>Widyaiswara</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no=0;
                @endphp
                @foreach ($activities as $activity)
                  @php
                      $no++;
                  @endphp
                  <tr>
                      <td>{{ $no }}</td>
                      <td>
                          {{ $activity->event }}
                          @if(isset($activity->batch))
                            Angkatan {{ $activity->batch }}
                          @endif
                          @if(isset($activity->class))
                            Kelas {{ $activity->class }}
                          @endif
                          <br>
                          @if(isset($activity->subject))
                              MP. {{ $activity->subject }}
                          @endif
                  </td>
                      <td>
                            @foreach ($activity->trainers as $trainer)
                                  <span class="badge badge-info">
                                    {{$trainer->full_name}} 
                                  </span>
                            @endforeach
                      </td>
                      <td>
                        <span class="badge badge-info">
                            {{$activity->status}} 
                        </span>
                      </td>
                      <td>{{ Carbon\Carbon::parse($activity->start)->format('d M') }} s.d. {{ Carbon\Carbon::parse($activity->end)->format('d M Y') }}</td>
                      <td>
                          @can('inputs.show')
                          <a href="{{ route('activities.show', [$activity->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="show"><i class="fas fa-eye"></i></i></a>  
                          @endcan
                          @can('inputs.edit')
                          <a href="{{route('activities.edit', [$activity->id])}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-edit"></i></a>   
                          @endcan
                          @can('inputs.delete')
                          <button id="delete" data-title="{{$activity->event}}" href="{{route('activities.destroy', [$activity->id])}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-trash"></i></button>
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
      <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
      </script>
      
    @endpush
  @endsection