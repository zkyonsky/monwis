@extends('template.default')
  @section('content')
    @include('sweetalert::alert')
     <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">     
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail SPMK</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <strong><i class="fas fa-calendar-check"></i> Kegiatan / Judul KTI</strong>
                                <p class="text-muted">
                                    {{ $activity->event }}
                                    @if(isset($activity->batch))
                                        Angkatan {{ $activity->batch }}
                                    @endif
                                    @if(isset($activity->class))
                                        Kelas {{ $activity->class }}
                                    @endif
                                    <br>
                                    @if(isset($activity->subject))
                                    MP. {{ $activity->subject }} <br>
                                    {{ $activity->volume }} JP
                                    @endif
                                </p>
                                
                                <hr>

                                <strong><i class="fas fa-user-graduate"></i>  Pengajar</strong>
                                <p class="text-muted">
                                    @foreach ($activity->trainers as $trainer)
                                        {{$trainer->full_name}} 
                                    @endforeach
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt"></i> Tempat / Publikasi</strong>
                                <p class="text-muted">
                                    {{ $activity->place }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-calendar-alt"></i> Waktu</strong>
                                <p class="text-muted">
                                    {{ Carbon\Carbon::parse($activity->start)->format('d M Y - H:i') }} s.d.  
                                    {{ Carbon\Carbon::parse($activity->end)->format('d M Y - H:i') }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-info-circle"></i> Status</strong>
                                <p class="text-muted">
                                    {{ $activity->status }}
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-3">     
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Dokumen</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($activity->documents->count() > 0)
                                <strong>Uploaded STMK/SPMK</strong> <br>
                                    @foreach ($activity->documents as $item)
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