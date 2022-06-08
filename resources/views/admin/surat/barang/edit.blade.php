@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Nota Pengadaan</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('surat.index')}}">Daftar Barang</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('barang.create', $barang->surat_id)}}" >Tambah Barang</a>
        </li>
        <li class="breadcrumb-item">
            <a  class="text-muted">Ubah Barang</a>
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
                    <h3 class="card-label">Ubah Barang | Nota Pengadaan</h3>
                </div>
            </div>
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <input type="hidden" name="surat_id" value="{{$barang->surat_id}}"/>
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
                        <label class="col-lg-3 col-form-label">ID Barang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan ID Barang" value="{{ old('id_barang', $barang->id_barang) }}" name="id_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Barang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Barang" value="{{ old('nama_barang', $barang->nama_barang) }}" name="nama_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Jumlah Barang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Masukkan Jumlah Barang" value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" name="jumlah_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Satuan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Satuan" value="{{ old('satuan', $barang->satuan) }}" name="satuan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Pengambilan Barang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Pengambilan Barang" value="{{ old('tanggal_pengambilan_barang', $barang->tanggal_pengambilan_barang) }}" name="tanggal_pengambilan_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Barang Tiba
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Barang Tiba" value="{{ old('tanggal_barang_tiba', $barang->tanggal_barang_tiba) }}" name="tanggal_barang_tiba">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Lokasi Tujuan Pengiriman Barang
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Lokasi Tujuan Pengiriman Barang" value="{{ old('lokasi_tujuan_pengiriman_barang', $barang->lokasi_tujuan_pengiriman_barang) }}" name="lokasi_tujuan_pengiriman_barang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Moda Transportasi
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Moda Transportasi" value="{{ old('moda_transportasi', $barang->moda_transportasi) }}" name="moda_transportasi">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('surat.edit', $barang->surat_id)}}" class="btn btn-default float-left">Cancel</a>
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