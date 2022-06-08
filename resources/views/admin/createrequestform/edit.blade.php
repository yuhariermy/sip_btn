@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Create Request Form</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('create_request_form.index')}}">Daftar Create Request Form</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('create_request_form.create')}}">Tambah Create Request Form</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Ubah Create Request Form</a>
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
                    <h3 class="card-label">Ubah Create Request Form</h3>
                </div>
            </div>
            <form action="{{ route('create_request_form.update', $forms->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="detail_request" value="{{ old('detail_request', $forms->detail_request) }}">
                <input type="hidden" name="detail_access" value="{{ old('detail_access', $forms->detail_access) }}">
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
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
                            <input type="text" class="form-control no_pcr" placeholder="Masukkan No. PCR" value="{{ old('no_pcr', $forms->no_pcr) }}" name="no_pcr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Purpose
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control purpose_id" value="{{ old('purpose_id') }}" name="purpose_id">
                                <option value="">-- Pilih Purpose --</option>
                                @foreach ($purposes as $purpos)
                                    @if ($purpos->name == 'PERMANENT')
                                        @php continue @endphp
                                    @endif
                                    <option value="{{$purpos->id}}" {{old('purpose_id', $forms->purpose_id) == $purpos->id ? 'selected' : ''}}>{{$purpos->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Location
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control location_id" value="{{ old('location_id') }}" name="location_id">
                                <option value="">-- Pilih Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}" {{old('location_id', $forms->location_id) == $location->id ? 'selected' : ''}}>{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Attachment
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="file" class="form-control" placeholder="Masukkan Attachment" value="{{ old('thumbnail', $forms->attachment) }}" name="thumbnail">
                            <span class="form-text text-muted">Tipe File : Excel/Pdf/Word/Jpg/Png,, Ukuran File Max : 2MB</span>
                            @if($forms->attachment !== ' ')
                            <a href="{{asset('uploads/'.$forms->attachment)}}" download>
                                Lihat Attachment
                            </a>
                            @else
                                Tidak ada Attachment
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Start Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="input-group date">
                                <input type="text" name="start_date" class="form-control datepicker start_date" value="{{ old('start_date', $data['start_date']) }}" id="kt_datepicker_2" readonly="readonly" placeholder="Pilih Start Date" />
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
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="input-group date">
                                <input type="text" name="end_date" class="form-control datepicker end_date  " value="{{ old('end_date', $data['end_date']) }}" id="kt_datepicker_2" readonly="readonly" placeholder="Pilih End Date" />
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
                            <input type="checkbox" name="permanent" id="permanent" class="permanent mr-1 mt-1" {{ $forms->end_date == null ? 'checked' : '' }} />
                            <label for="permanent" class="permanent">Permanent</label>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Detail Connection
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <textarea class="form-control detail_request" placeholder="Masukkan Detail Connection" name="detail_request">{{ old('detail_request', $forms->detail_request) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Detail Access
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <textarea class="form-control detail_access" placeholder="Masukkan Detail Access" name="detail_access">{{ old('detail_access', $forms->detail_access) }}</textarea>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('create_request_form.index')}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Ubah</button>
            </div>
            </form>
        </div>
        <!--end::Card-->

        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom mt-5 p-2">
                    <ul class="nav nav-pills" id="dataTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="connection-tab" data-toggle="tab" href="#connection" role="tab" aria-controls="connection" aria-selected="true">Connection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="false">Access</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="dataTabContent">
                    <div class="tab-pane fade show active" id="connection" role="tabpanel" aria-labelledby="connection-tab">
                        <!--begin::Card-->
                        <div class="card card-custom mt-5 ">
                            <div class="card-header flex-wrap pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">Daftar Detail Connection</h3>
                                </div>
                                <div class="card-toolbar">

                                    <!--begin::Button-->
                                    <a href="javascript:;" data-toggle="modal" data-target="#tambahConnection" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <span class="fa fa-plus"></span>
                                    </span>Tambah</a>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success_connnection'))
                                    <div class="alert alert-success">
                                        {{Session::get('success_connnection')}}
                                    </div>
                                @endif
                                <div style="overflow-x: scroll">
                                    <!--begin: Datatable-->
                                    <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th width="170px">Aksi</th>
                                                <th>Connection Type</th>
                                                <th>Source Name</th>
                                                <th>Source Ip Address</th>
                                                <th>Destination Name</th>
                                                <th>Destination Ip Address</th>
                                                <th>TCP</th>
                                                <th>UDP</th>
                                                <th>Port</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($detail_requests as $detail_request)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>
                                                        <div style="display: flex;align-items: center;justify-content: center;">
                                                            <div class="mr-2">
                                                            <a href="javascript:;" data="{{json_encode($detail_request)}}"  class="btn btn-sm btn-primary editConnection"> Ubah</a>
                                                            </div>
                                                            <div>
                                                            <form action="{{ route('detailconnection.destroy', $detail_request->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="connection_id" value="{{$detail_request->id}}"/>
                                                                <input type="hidden" name="form_id" value="{{$detail_request->create_request_form_id}}"/>
                                                                <button type="submit" onClick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> {{$detail_request->type_connection->name}}</td>
                                                    <td>{{$detail_request->source_name}}</td>
                                                    <td>{{$detail_request->source_ip_address}}</td>
                                                    <td>{{$detail_request->destination_name}}</td>
                                                    <td>{{$detail_request->destination_ip_address}}</td>
                                                    <td>{{$detail_request->tcp}}</td>
                                                    <td>{{$detail_request->udp}}</td>
                                                    <td>{{$detail_request->port}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <label>Detail Connection</label>
                                        <textarea class="form-control detail_request" placeholder="Masukkan Detail Connection">{{ old('detail_request', $forms->detail_request) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>

                    <div class="tab-pane fade" id="access" role="tabpanel" aria-labelledby="access-tab">
                        <!--begin::Card-->
                        <div class="card card-custom mt-5 ">
                            <div class="card-header flex-wrap pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">Daftar Detail Access</h3>
                                </div>
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <a href="javascript:;" data-toggle="modal" data-target="#tambahAccess" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <span class="fa fa-plus"></span>
                                    </span>Tambah</a>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success_access'))
                                    <div class="alert alert-success">
                                        {{Session::get('success_access')}}
                                    </div>
                                @endif
                                <div style="overflow-x: scroll">
                                    <!--begin: Datatable-->
                                    <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th width="170px">Aksi</th>
                                                <th>Access Type</th>
                                                <th>Full Name</th>
                                                <th>Server Name</th>
                                                <th>DB Name</th>
                                                <th>Ip Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($detail_accesses as $detail_access)
                                            <tr>
                                                <td>{{$i++}}</th>
                                                <td width="170px">
                                                    <div style="display: flex;align-items: center;justify-content: center;">
                                                        <div class="mr-2">
                                                        <a href="javascript:;" data="{{json_encode($detail_access)}}"  class="btn btn-sm btn-primary editAccess"> Ubah</a>
                                                        </div>
                                                        <div>
                                                        <form action="{{ route('detailaccess.destroy', $detail_access->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="access_id" value="{{$detail_access->id}}"/>
                                                        <input type="hidden" name="form_id" value="{{$detail_access->create_request_form_id}}"/>
                                                        <button type="submit" onClick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                        </div>
                                                </div>
                                                </td>
                                                <td>
                                                    {{$detail_access->type_access->name}}
                                                </td>
                                                <td>
                                                    {{$detail_access->fullname}}
                                                </td>
                                                <td>
                                                    {{$detail_access->server_name}}
                                                </td>
                                                <td>
                                                    {{$detail_access->db_name}}
                                                </td>
                                                <td>
                                                    {{$detail_access->ip_address}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <label>Detail Access</label>
                                        <textarea class="form-control detail_access" placeholder="Masukkan Detail Access">{{ old('detail_access', $forms->detail_access) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
       </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@include('admin/createrequestform/modal/create_connection')
@include('admin/createrequestform/modal/create_access')
@include('admin/createrequestform/modal/edit_access')
@include('admin/createrequestform/modal/edit_connection')
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
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
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

        @if ($forms->end_date == null)
            $('.end_date').hide();
            $('.wrappar_end_date').hide();
        @endif

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

            $('.detail_request').change(function() {
                const value = $(this).val()
                $('input[name="detail_request"]').val(value)
            })
            $('.detail_access').change(function() {
                const value = $(this).val()
                $('input[name="detail_access"]').val(value)
            })

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

                console.log(pcr);

                if(pcr != '') {
                    $('.purpose_id').prop("disabled", false);
                    $('.location_id').prop("disabled", false);
                    $('.start_date').prop("disabled", false);
                    $('.end_date').prop("disabled", false);
                } else if(pcr == '') {
                    $('.purpose_id').prop("disabled", true);
                    $('.location_id').prop("disabled", true);
                    $('.start_date').prop("disabled", true);
                    $('.end_date').prop("disabled", true);
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
