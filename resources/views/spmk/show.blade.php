@extends('template.default')
  @section('content')
    @include('sweetalert::alert')
     <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif     
                        @if(session('errors'))
                            <div class="alert alert-danger">
                                {{session('errors')}}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail STMK/SPMK</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <strong><i class="fas fa-info-circle"></i></i> Jenis Kegiatan</strong>
                                <p class="text-muted">
                                    {{ $spmk->name }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-calendar-check"></i> Kegiatan / Judul KTI</strong>
                                <p class="text-muted">
                                    {{ $spmk->event }}
                                    @if(isset($spmk->batch))
                                    Angkatan {{ $spmk->batch }}
                                    @endif
                                    @if(isset($spmk->class))
                                        Kelas {{ $spmk->class }}
                                    @endif
                                    <br>
                                    @if(isset($spmk->subject))
                                    MP. {{ $spmk->subject }} <br>
                                    {{ $spmk->volume }} JP
                                    @endif
                                </p>
                                
                                <hr>

                                <strong><i class="fas fa-user-graduate"></i>  Pengajar</strong>
                                <p class="text-muted">
                                    {{$spmk->full_name}} 
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt"></i> Tempat / Publikasi</strong>
                                <p class="text-muted">
                                    {{ $spmk->place }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-calendar-alt"></i> Waktu</strong>
                                <p class="text-muted">
                                    {{ Carbon\Carbon::parse($spmk->start)->format('d M Y - H:i') }} s.d.  
                                    {{ Carbon\Carbon::parse($spmk->end)->format('d M Y - H:i') }}
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-3">     
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Documents</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <strong>Generate STMK/SPMK</strong> <br>
                                <a href="{{ route('spmk.download', [$spmk->id, 'stmk']) }}" class="btn btn-sm btn-info"><i class="fas fa-file-word"></i> STMK</a>
                                <a href="{{ route('spmk.download', [$spmk->id, 'spmk']) }}" class="btn btn-sm btn-info"><i class="fas fa-file-word"></i> SPMK</a>
                                <hr>

                                <strong>Upload</strong> <br>
                                <form action="{{ route('spmk.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="activity_id" class="hidden" value="{{ $spmk->activity_id }}">
                                    <div class="form-group">
                                        <label class="text-muted">Jenis Dokumen</label>
                                        <select name="jenis" class="form-control custom-select">
                                            @foreach ($jenisDokumen as $dokumen)
                                                <option value="{{ $dokumen->id}}">{{ $dokumen->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                              <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                @if ($file->count() > 0)
                                <strong>Uploaded STMK/SPMK</strong> <br>
                                    @foreach ($file as $item)
                                        <a href="{{ Storage::disk('public')->url($item->pivot->file) }}" class="btn btn-sm btn-success"><i class="fas fa-file"></i> {{ $item->name }}</a>
                                    @endforeach
                                @endif
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

    @push('styles')
        
    @endpush

    @push('scripts')
        
    @endpush
  @endsection