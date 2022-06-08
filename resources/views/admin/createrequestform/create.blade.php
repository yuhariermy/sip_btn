@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Create Request Form</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('create_request_form.index')}}">Daftar Create Request Form</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Tambah Create Request Form</a>
        </li>
    </ul>
@endsection
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Tambah Create Request Form</h3>
                </div>
            </div>
            <form action="{{ route('create_request_form.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Ada beberapa masalah dengan masukan Anda.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">No. PCR
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control no_pcr" placeholder="Masukkan No. PCR" value="{{ old('no_pcr') }}" name="no_pcr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Purpose
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select disabled class="form-control purpose_id" value="{{ old('purpose_id') }}" name="purpose_id">
                                <option value="">-- Pilih Purpose --</option>
                                @foreach ($purposes as $purpos)
                                    @if ($purpos->name == 'PERMANENT')
                                        @php continue @endphp
                                    @endif
                                    <option value="{{$purpos->id}}">{{$purpos->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Location
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select disabled class="form-control location_id" value="{{ old('location_id') }}" name="location_id">
                                <option value="">-- Pilih Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Start Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="input-group date">
                                <input type="text" disabled name="start_date" class="form-control datepicker start_date" value="{{ old('from_date') }}" id="kt_datepicker_2" readonly="readonly" placeholder="Pilih Start Date" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row wrappar_end_date">
                        <label class="col-form-label col-lg-3 col-sm-12">End Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12 ">
                            <div class="input-group date">
                                <input type="text" disabled name="end_date" class="form-control datepicker end_date" value="{{ old('end_date') }}" id="kt_datepicker_2" readonly="readonly" placeholder="Pilih End Date" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: -20px;">
                        <label class="col-form-label col-lg-3 col-sm-12">
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12 ">
                            <input type="checkbox" name="permanent" id="permanent" class="permanent mr-1 mt-1" />
                            <label for="permanent" class="permanent">Permanent</label>
                        </div>
                    </div>

                    <div class="form-group row wrappar_attachment">
                        <label class="col-lg-3 col-form-label">Attachment
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="file" disabled class="form-control attachment" placeholder="Masukkan Thumbnail" value="{{ old('thumbnail') }}" name="thumbnail">
                            <span class="form-text text-muted">Tipe File : Excel/Pdf/Word/Jpg/Png, Ukuran File Max : 2MB</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('create_request_form.index')}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Tambah</button>
            </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@push('css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!--end::Page Vendors Styles-->
@endpush
@push('js')

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--begin::Page Scripts(used by this page)-->

    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <!--begin::Page Scripts(used by this page)-->
    <script>
        var currentDate = new Date();
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: "dd-mm-yyyy",
            autoclose: true,

        });

        $(document).ready(function() {
            $('.permanent').click(function() {
                if($(this).prop("checked") == true) {
                    $('.end_date').hide();
                    $('.wrappar_end_date').hide();
                }
                else if($(this).prop("checked") == false) {
                    $('.end_date').show();
                    $('.wrappar_end_date').show();
                }
            });

            // $('.purpose_id').change(function(event) {
            //     event.preventDefault();

            //     let purpose = $(this).val();

            //     if(purpose == 5) {
            //         $('.end_date').hide();
            //         $('.wrappar_end_date').hide();
            //     } else {
            //         $('.end_date').show();
            //         $('.wrappar_end_date').show();
            //     }
            // });

            $('.no_pcr').change(function(event) {
                event.preventDefault();
                let pcr = $(this).val();

                if(pcr != '') {
                    $('.purpose_id').prop("disabled", false);
                    $('.location_id').prop("disabled", false);
                    $('.start_date').prop("disabled", false);
                    $('.end_date').prop("disabled", false);
                    $('.attachment').prop("disabled", false);
                } else if(pcr == '') {
                    $('.purpose_id').prop("disabled", true);
                    $('.location_id').prop("disabled", true);
                    $('.start_date').prop("disabled", true);
                    $('.end_date').prop("disabled", true);
                    $('.attachment').prop("disabled", true);
                }
            });

            $('.summernote').summernote({
                placeholder: 'Tulis Deskripsi',
                tabsize: 2,
                height: 350,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    <!--end::Page Scripts-->
    <!--end::Page Scripts-->
@endpush
