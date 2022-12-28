@extends('template.default')
  @section('breadcrumb')
    <button class="btn btn-sm btn-warning" onclick="goBack()">Go Back</button>
  @endsection
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Detail IKU {{ $wis->full_name }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Total Angka Kredit</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($activities as $key => $value)
                <tr>
                    @if ($value > 0)
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                    @endif
                    
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
    <script type="text/javascript">
            function goBack() {
            window.history.back();
        }
    </script>
    @push('scripts')

    @endpush
  @endsection