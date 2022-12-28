@extends('template.default')
  @section('breadcrumb')
    <button class="btn btn-sm btn-warning" onclick="goBack()">Go Back</button>
  @endsection
  @section('content')
    @include('sweetalert::alert')

      <div class="row">
        <div class="col-12">
          <div><button onclick="return printArea('area')">Print</button></div>
          <div class="card" id='area'>
          
            <div class="card-header">
                <h4 class="text-center font-weight-bold">KARTU KENDALI KEGIATAN WIDYAISAWARA</h3>
                <h4 class="text-center font-weight-bold">DI SATUAN KERJA {{ Str::upper($wi->unit) }}</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <th>Nama</th>
                      <th> : </th>
                      <th>{{ $wi->full_name }}</th>
                    </tr>
                    <tr>
                      <th>NIP</th>
                      <th> : </th>
                      <th>{{ $wi->nip }}</th>
                    </tr>
                    <tr>
                      <th>Jabatan</th>
                      <th> : </th>
                      <th>{{ $wi->jabatan }}</th>
                    </tr>
                    <tr>
                      <th>Bulan dan Tahun</th>
                      <th> : </th>
                      <th>{{ $month.' / '.$year }}</th>
                    </tr>
                  </table>
                </div>
              </div>
               
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-primary">
                          <th width="5%">No</th>
                          <th>Nama Kegiatan Tatap Muka</th>
                          <th>JP</th>
                          <th>Tanggal Penyelenggaraan</th>
                          <th>Tempat dan Penyelenggara</th>
                          <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr class="bg-info">
                            <td>(1)</td>
                            <td>TATAP MUKA</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        @php
                            $no=0;
                        @endphp
                        @foreach ($result as $item)
                          @php
                              $no++;
                          @endphp
                          @foreach ($item as $it)
                              
                          
                          <tr>
                              <td>{{ $no }}</td>
                              <td>
                                  {{ $it['event'] }}
                                  @if(isset($it['batch']))
                                    Angkatan {{ $it['batch'] }}
                                  @endif
                                  @if(isset($it['class']))
                                    Kelas {{ $it['class'] }}
                                  @endif
                                  <br>
                                  @if(isset($it['subject']))
                                      MP. {{ $it['subject'] }}
                                  @endif
                              </td>
                              
                              <td>
                                    {{$it['volume']}} 
                              </td>
                              <td>{{ Carbon\Carbon::parse($it['start'])->format('d M')." s.d ".Carbon\Carbon::parse($it['end'])->format('d M Y')}}</td>
                              <td>{{ $it['place'] }}</td>
                              <td>
                                @if ($it['paid'] == 0)
                                  -
                                @else
                                    dibayarkan  {{ $it['paid'] }} JP
                                @endif
                               
                              </td>
                          </tr>
                          @endforeach
                        @endforeach
                        <tr class="bg-primary">
                          <td></td>
                          <td><b>Total Jam Tatap Muka</b></td>
                          <td><b></b>{{ $sum_jp }}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr class="bg-info">
                          <td>(2)</td>
                          <td>KONVERSI</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @php
                            $no=0;
                        @endphp
                        @foreach ($result_conversion as $item)
                        @php
                              $no++;
                        @endphp
                          @foreach ($item as $it)
                              <tr>
                                <td>{{ $no }}</td>
                                <td>
                                  {{ $it['name'] }} 
                                  {{ $it['event'] }}
                                  @if(isset($it['batch']))
                                    Angkatan {{ $it['batch'] }}
                                  @endif
                                  @if(isset($it['class']))
                                    Kelas {{ $it['class'] }}
                                  @endif
                                  <br>
                                  @if(isset($it['subject']))
                                      MP. {{ $it['subject'] }}
                                  @endif
                                </td>
                                <td>
                                  {{$it['volume']}}
                                </td>
                                <td>
                                  {{ Carbon\Carbon::parse($it['start'])->format('d M')." s.d ".Carbon\Carbon::parse($it['end'])->format('d M Y')}}
                                </td>
                                <td>{{ $it['place'] }}</td>
                              <td>
                                @if ($it['paid'] == 0)
                                  -
                                @else
                                    dibayarkan  {{ $it['paid'] }} JP
                                @endif
                               
                              </td>
                              </tr>
                          @endforeach
                        @endforeach
                        <tr class="bg-primary">
                          <td></td>
                          <td><b>Total Konversi</b></td>
                          <td><b></b>{{ $sum_conversion }}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr class="bg-primary">
                          <td></td>
                          <td><b>Total Penjumlahan (1) + (2)</b></td>
                          <td><b></b>{{ $sum_jp + $sum_conversion }}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        </tbody>
                </table>
            </div>  
          </div>
        </div>
      </div>


    @push('styles')
    <style>
      table.table-bordered{
          border:1px solid blue;
          margin-top:20px;
          }
        table.table-bordered > thead > tr > th{
            border:1px solid blue;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid blue;
        }
    </style>
        
    @endpush
    <script type="text/javascript">
            function goBack() {
            window.history.back();
        }
    </script>
    <script>
      function printArea(area){
        var printPage = document.getElementById('area').innerHTML;
        var oriPage = document.body.innerHTML;
        document.body.innerHTML = printPage;
        window.print();
        document.body.innerHTML = oriPage;
      }
    </script>
    @push('scripts')

    @endpush
  @endsection