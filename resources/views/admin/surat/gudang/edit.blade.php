@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Gudang</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('gudang.index')}}">Daftar Gudang</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('gudang.create', $gudang->surat_id)}}" class="text-muted">Tambah Gudang</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Ubah Gudang</a>
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
                    <h3 class="card-label">Ubah Gudang</h3>
                </div>
            </div>
            <form action="{{ route('gudang.update', $gudang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card-body">
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
                        <label class="col-lg-3 col-form-label">Nama Gudang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Gudang" value="{{ old('gudang_nama', $gudang->gudang_nama) }}" name="gudang_nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Alamat Gudang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Masukkan Alamat Gudang" value="{{ old('gudang_alamat', $gudang->gudang_alamat) }}" name="gudang_alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Nama Petugas
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Petugas" value="{{ old('gudang_nama_petugas', $gudang->gudang_nama_petugas) }}" name="gudang_nama_petugas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">No. Hp Petugas
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Masukkan No. Hp Petugas" value="{{ old('gudang_no_hp_petugas', $gudang->gudang_no_hp_petugas) }}" name="gudang_no_hp_petugas">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('surat.edit', $gudang->surat_id)}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Ubah</button>
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
    <link href="{{asset('assets/js/lightbox/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
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
    <script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
    <script>
        var currentDate = new Date();  
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: "dd-mm-yyyy",
            autoclose: true,
            
        });

        
    </script>
    <!--end::Page Scripts-->
    <!--end::Page Scripts-->
@endpush