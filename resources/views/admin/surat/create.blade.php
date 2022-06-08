@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Nota Pengadaan</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('surat.index')}}">Daftar Nota Pengadaan</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Tambah Nota Pengadaan</a>
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
                    <h3 class="card-label">Tambah Nota Pengadaan</h3>
                </div>
            </div>
            <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="col-lg-3 col-form-label">Kategori
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control kategori_id" class="kategori_id" id="kategori_id" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="1">Alker Salker</option>
                                <option value="2">Material</option>
                                <option value="3">NTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Pihak Pertama
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control pihak_pertama" id="pihak_pertama" name="pihak_pertama">
                                <option value="">-- Pilih Pihak Pertama --</option>
                                {{-- <option value="3">Erwin Aziz – Mgr. NTE Management & Bussines Assurance</option>
                                <option value="2">Fachruddin – Mgr. Asset Mgt. & GA </option>
                                <option value="1">M. Jati Naqosho – Mgr. WH Mgt. & Distribution</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Pihak Kedua
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control select2 satuan" id="ekspedisi_id" name="ekspedisi_id">
                                <option value="">-- Silahkan Pilih Pihak Kedua --</option>
                                @foreach($ekspedisis as $ekspedisi)
                                    <option value="{{$ekspedisi->id}}" {{ old('ekspedisi_id ') == $ekspedisi->id ? 'selected' : '' }}>{{$ekspedisi->ekspedisi_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nomor Surat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Surat" value="{{ old('nomor_surat') }}" name="nomor_surat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Surat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Surat" value="{{ old('tanggal_surat') }}" name="tanggal_surat">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nomor Kontrak
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Kontrak" value="{{ old('nomor_kontrak') }}" name="nomor_kontrak">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Kontrak
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Kontrak" value="{{ old('tanggal_kontrak') }}" name="tanggal_kontrak">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('surat.index')}}" class="btn btn-default float-left">Cancel</a>
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

    <!--end::Page Scripts-->
    <script>
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    </script>
@endpush
@section('scripts')
@include('admin.surat/js')
@endsection