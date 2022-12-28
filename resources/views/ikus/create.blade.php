@extends('template.default')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah IKU</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Tambah Iku</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('iku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>WIDYAISWARA</label>
                            <select id="trainer_id" name="trainer_id" class="form-control custom-select @error('section') is-invalid @enderror" >
                                <option value='' selected>PILIH WIDYAISWARA</option>
                                @foreach ($wis as $wi)
                                <option value='{{ $wi->id }}'>{{ $wi->full_name }}</option>
                                @endforeach
                            </select>

                            @error('section')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TAHUN</label>
                            <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="Masukkan Tahun"
                                class="form-control @error('tahun') is-invalid @enderror">

                            @error('tahun')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TARGET</label>
                            <input type="number" step="0.01" name="target" value="{{ old('target') }}" placeholder="Masukkan Target"
                                class="form-control @error('target') is-invalid @enderror">

                            @error('target')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop