@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <h3 class="card-title font-weight-bold">Capaian IKU Widyaiswara</h3> 
              </div>
            </div>
            <div class="card-body">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 20%">
                                Nama
                            </th>
                            <th>
                                Capaian
                            </th>
                            <th style="width: 10%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tot as $item)
                        <tr>
                            <td>
                                {{ $item['wi'] }}
                            </td>
                            <td>
                               
                                <div class="progress-group">
                                    {{$item['capaian'] }}%
                                    <span class="float-right"><b>{{ $item['total'] }}</b>/ {{ $item['target'] }}</span>
                                    <div class="progress progress-sm">
                                      @if ($item['capaian'] >= 100)
                                        <div class="progress-bar bg-success" style="width: {{$item['capaian'] }}%"></div>
                                      @elseif ($item['capaian'] >= 80)
                                        <div class="progress-bar bg-warning" style="width: {{ $item['capaian'] }}%"></div>
                                      @else 
                                      <div class="progress-bar bg-danger" style="width: {{ $item['capaian'] }}%"></div>
                                      @endif
                                      
                                    </div>
                                  </div> 
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('iku.detail', $item['id']) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
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