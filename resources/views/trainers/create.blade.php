@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

     <!-- Main content -->
    <form action="{{ route('trainers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="content">
            <div class="row">
                <div class="col-md-12">     
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Widyaiswara/Pengajar</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Widyaiswara/Pengajar</label>
                            <input id="full_name" name="full_name" value="{{ old('full_name') }}" type="text" 
                            class="form-control @error('full_name') is-invalid @enderror" />

                            @error('full_name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input id="nip" name="nip" value="{{ old('nip') }}" type="text" 
                            class="form-control @error('nip') is-invalid @enderror" />

                            @error('nip')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PANGGOL</label>
                            <select id="panggol" name="panggol" class="form-control custom-select @error('panggol') is-invalid @enderror" >
                                <option value='' selected>PILIH PANGGOL</option>
                                <option value='Penata Muda / III.a'>Penata Muda / III.a</option>
                                <option value='Penata Muda Tk. I / III.b'>Penata Muda Tk. I / III.b</option>
                                <option value='Penata / III.c'>Penata / III.c</option>
                                <option value='Penata Tk. I / III.d'>Penata Tk. I / III.d</option>
                                <option value='Pembina / IV.a'>Pembina / IV.a</option>
                                <option value='Pembina Tk. I / IV.b'>Pembina Tk. I / IV.b</option>
                                <option value='Pembina Utama Muda / IV.c'>Pembina Utama Muda / IV.c</option>
                                <option value='Pembina Utama Madya / IV.d'>Pembina Utama Madya / IV.d</option>
                                <option value='Pembina Utama / IV.e'>Pembina Utama / IV.e</option>
                            </select>

                            @error('panggol')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>UNIT</label>
                            <select id="unit" name="unit" class="form-control custom-select @error('unit') is-invalid @enderror" >
                                <option value='Pusdiklat Pajak' selected>Pusdiklat Pajak</option>
                                <option value='Pusdiklat Anggaran dan Perbendaharaan'>Pusdiklat Anggaran dan Perbendaharaan</option>
                                <option value='Pusdiklat Kepemimpinan dan Manajerial'>Pusdiklat Kepemimpinan dan Manajerial</option>
                                <option value='BDK'>BDK</option>
                                <option value='Pensiun'>Pensiun</option>
                            </select>

                            @error('unit')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group clearfix">
                            <label>STATUS</label>
                            <div class="icheck-success">
                                <input type="radio" name="status" id="widyaiswara" value="Widyaiswara">
                                <label for="widyaiswara">
                                    Widyaiswara
                                </label>
                            </div>
                            <div class="icheck-success">
                                <input type="radio" name="status" id="pengajar_bppk" value="Pengajar BPPK">
                                <label for="pengajar_bppk">
                                    Pengajar BPPK
                                </label>
                            </div>
                            <div class="icheck-success">
                                <input type="radio" name="status" id="pengajar_non_bppk" value="Pengajar Non-BPPK">
                                <label for="pengajar_non_bppk">
                                    Pengajar Non-BPPK
                                </label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div id="jabatan_wi" class="collapse">
                            <label>JABATAN</label>
                            <select name="jabatan_wi" class="form-control custom-select @error('jabatan_wi') is-invalid @enderror">
                                <option value=''>-- PILIH JABATAN --</option>
                                <option value='Widyaiswara Ahli Pertama'>Widyaiswara Ahli Pertama</option>
                                <option value='Widyaiswara Ahli Muda'>Widyaiswara Ahli Muda</option>
                                <option value='Widyaiswara Ahli Madya'>Widyaiswara Ahli Madya</option>
                                <option value='Widyaiswara Ahli Utama'>Widyaiswara Ahli Utama</option>
                            </select>

                            @error('jabatan_wi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div id="jabatan_non_wi" class="collapse">
                            <label>JABATAN</label>
                            <input name="jabatan_non_wi" value="{{ old('jabatan_non_wi') }}" type="text" 
                            class="form-control @error('jabatan_non_wi') is-invalid @enderror" />

                            @error('jabatan_non_wi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="submit" value="Tambah Pengajar" class="btn btn-success">
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </form> 

  @push('styles')
      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  @endpush

  @push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // hide and show jabatan
            $("#widyaiswara").click(function(){
                $("#jabatan_wi").collapse('show');
                $("#jabatan_non_wi").collapse('hide');
            });
            $("#pengajar_bppk").click(function(){
                $("#jabatan_non_wi").collapse('show');
                $("#jabatan_wi").collapse('hide');
            });
            $("#pengajar_non_bppk").click(function(){
                $("#jabatan_non_wi").collapse('show');
                $("#jabatan_wi").collapse('hide');
            });
        });
    </script>
  @endpush

@endsection