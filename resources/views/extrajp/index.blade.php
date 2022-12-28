@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title font-weight-bold">Jam Mengajar Widyaiswara Periode {{ $monthName." ".$year  }}</h3>
                </div>
                <div class="col-md-4">
                    <form action="{{route('extrajp.index')}}" method="GET">
                    <div class="form-group">   
                        <div class="input-group date" id="date" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <div class="input-group-text"  data-target="#date" data-toggle="datetimepicker">
                            <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <input type="text" name="date" class="form-control datetimepicker-input" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Ubah Periode</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
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
                                Jumlah Jam Mengajar
                            </th>
                            <th>
                                Jumlah Konversi
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th style="width: 10%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $item[1] }}
                            </td>
                            <td>
                               {{ $item[2] }}
                            </td>
                            <td>
                                {{ $item[3] + $item[4] + $item[5] + $item[6] }}
                            </td>
                            <td>
                                @if ($item[2] >= 27 && $item[2] + $item[3] + $item[4] + $item[5] + $item[6] >= 40)
                                <span class="badge badge-success">
                                   Kelebihan
                                </span>
                                @else 
                                <span class="badge badge-danger">
                                   Tidak Melebihi
                                </span>
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('extrajp.detail', [$item[0], $month, $year]) }}">
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
     
    @endpush

    @push('scripts')
    <script type="text/javascript">
        $(function () {
            $('#date').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        });
    </script>
    @endpush
  @endsection