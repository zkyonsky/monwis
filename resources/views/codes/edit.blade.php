@extends('template.default')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Code</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Code</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('codes.update', $code->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>SECTION</label>
                            <select id="section" name="section" class="form-control custom-select @error('section') is-invalid @enderror" >
                                <option value='' selected>PILIH SECTION</option>
                                @foreach ($sections as $section)
                                @if ($code->section_id == $section->id)
                                    <option value='{{ $section->id }}' selected>{{ $section->name }}</option>
                                @else
                                    <option value='{{ $section->id }}'>{{ $section->name }}</option> 
                                @endif
                                @endforeach
                            </select>

                            @error('section')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAMA CODE</label>
                            <input type="text" name="name" value="{{ old('name', $code->name) }}" placeholder="Masukkan Nama Code"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>CODE</label>
                            <input type="number" name="code" value="{{ old('code', $code->code) }}" placeholder="Masukkan Nomor Code"
                                class="form-control @error('code') is-invalid @enderror">

                            @error('code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>CREDIT</label>
                            <input type="number" step="0.01" name="credit" value="{{ old('credit', $code->credit) }}" placeholder="Masukkan Credit"
                                class="form-control @error('credit') is-invalid @enderror">

                            @error('credit')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>UNIT</label>
                            <input type="text" name="unit" value="{{ old('unit', $code->unit) }}" placeholder="Masukkan Unit"
                                class="form-control @error('unit') is-invalid @enderror">

                            @error('unit')
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