@extends('template.default')
  @section('content')
    @include('sweetalert::alert')

     <!-- Main content -->
    <form action="{{ route('activities.update', $activity->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section class="content">
            <div class="row">
                <div class="col-md-12">     
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Info Kegiatan</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            
                            
                            <!-- radio -->
                            <div class="form-group clearfix">
                                <label>Jenis Kegiatan</label>
                                <div class="icheck-success">
                                    <input type="radio" name="jenis_kegiatan" id="tamuk" value="tamuk"
                                        @if ($activity->code_id == '118') checked @endif
                                    >
                                    <label for="tamuk">
                                        Tamuk
                                    </label>
                                </div>
                                <div class="icheck-success">
                                    <input type="radio" name="jenis_kegiatan" id="non-tamuk" value="non-tamuk"
                                        @if ($activity->code_id != '118') checked @endif
                                    >
                                    <label for="non-tamuk">
                                        Non-Tamuk
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <select id="code" name="code" class="form-control select2" style="width: 100%;">
                                    <option value="{{ $code->id }}" selected>{{ $code->name }}</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Widyaiswara yang ditugaskan</label>
                                        <select id="trainers" name="trainers[]" class="select2bs4" multiple="multiple" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" selected="selected">{{ $trainer->full_name }}</option> 
                                            @endforeach
                                                                                           
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Kegiatan/Pelatihan</label>
                                <input id="event" name="event" type="text" class="form-control" value="{{ old('event', $activity->event) }}" />
                            </div>

                           
                            
                        </div>
                        <div class="col-md-6">  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select id="batch" name="batch" class="form-control custom-select">

                                            <option value="" disabled hidden>-</option>
                                            <option selected>{{ $activity->batch }}</option>
                                            <option>I</option>
                                            <option>II</option>
                                            <option>III</option>
                                            <option>IV</option>
                                            <option>V</option>
                                            <option>VI</option>
                                            <option>VII</option>
                                            <option>VIII</option>
                                            <option>IX</option>
                                            <option>X</option>
                                            <option>XI</option>
                                            <option>XII</option>
                                            <option>XIII</option>
                                            <option>XIV</option>
                                            <option>XV</option>
                                            <option>XVI</option>
                                            <option>XVII</option>
                                            <option>XVIII</option>
                                            <option>XXI</option>
                                            <option>XX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select id="class" name="class" class="form-control custom-select">
                                            <option value="" disabled hidden>-</option>
                                            <option selected>{{ $activity->class }}</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                            <option>F</option>
                                            <option>G</option>
                                            <option>H</option>
                                            <option>I</option>
                                            <option>J</option>
                                            <option>K</option>
                                            <option>L</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelatihan</label>
                                <input id="subject" name="subject" type="text" class="form-control" value="{{ old('subject', $activity->subject) }}"/>
                            </div>      
                            
                            <div id="detail" class="collapse">
                                
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <label>Termasuk : </label>
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="bahan-ajar" name="bahan_ajar" >
                                        <label for="bahan-ajar">
                                            Bahan Ajar
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="bahan-tayang" name="bahan_tayang" >
                                        <label for="bahan-tayang">
                                            Bahan Tayang
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="sap-gbpp" name="sap_gbpp" >
                                        <label for="sap-gbpp">
                                            SAP/GBPP
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>JP/Vol</label>
                                        <input id="volume" name="volume" type="number" class="form-control" value="{{ old('volume', $activity->volume) }}"/>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input id="place" name="place" type="text" class="form-control" value="{{ old('place', $activity->place) }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Mulai</label>
                                        <div class="input-group date" id="start" data-target-input="nearest">
                                            <input type="text" name="start" value="{{ $start }}" class="form-control datetimepicker-input" data-target="#start"/>
                                            <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Selesai</label>
                                        <div class="input-group date" id="end" data-target-input="nearest">
                                            <input type="text" name="end" value="{{ $end }}" class="form-control datetimepicker-input" data-target="#end"/>
                                            <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control custom-select" >
                                            <option selected>{{ $activity->status }}</option>
                                            <option>Terjadwal</option>
                                            <option>Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="submit" value="Edit Kegiatan" class="btn btn-success">
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </form> 
    
    @push('styles')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

        <style type="text/css">
            .select2-container .select2-selection--single {
            height: 40px !important;
            }
        </style>    
        
    @endpush

    @push('scripts')
        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                //Cari Pengajar
                //Initialize Select2 Elements
                $('#trainers').select2({
                    theme: 'bootstrap4',
                    minimumInputLength: 1,
                    ajax: {
                    url: "{{ route('trainers.search') }}",
                    dataType: 'json',
			        },
                });

                $('#code').select2({
                    minimumInputLength: 1,
                    ajax: {
                    url: "{{ route('codes.search') }}",
                    dataType: 'json',
			        },
                }); 

                //Timepicker
                $('#start').datetimepicker({
                useCurrent: false,
                use24hours: true,
                format: 'DD-MMMM-YYYY HH:mm',
                sideBySide: true,
                });

                $('#end').datetimepicker({
                    useCurrent: false,
                    use24hours: true,
                    format: 'DD-MMMM-YYYY HH:mm',
                    sideBySide: true,
                });

                $("#start").on("change.datetimepicker", function (e) {
                    $('#end').datetimepicker('minDate', moment(e.date).startOf('day'));
                });

                $("#end").on("change.datetimepicker", function (e) {
                    $('#start').datetimepicker('maxDate', e.date);
                });


                // hide and show detail pelatihan
                $("#tamuk").click(function(){
                    $("#detail").collapse('show');
                    $("#code").prop('disabled', true);
                    $("#bahan-ajar").prop('checked', true);
                    $("#bahan-tayang").prop('checked', true);
                    $("#sap-gbpp").prop('checked', true);
                });
                $("#non-tamuk").click(function(){
                    $("#detail").collapse('hide');
                    $("#code").prop('disabled', false);
                    $("#bahan-ajar").prop('checked', false);
                    $("#bahan-tayang").prop('checked', false);
                    $("#sap-gbpp").prop('checked', false);
                });

            });

        </script>
    @endpush
  @endsection