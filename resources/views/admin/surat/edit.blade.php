@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Nota Pengadaan</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('surat.index')}}">Daftar Nota Pengadaan</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('surat.create')}}" class="text-muted">Tambah Nota Pengadaan</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Ubah Nota Pengadaan</a>
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
                    <h3 class="card-label">Ubah Nota Pengadaan</h3>
                </div>
            </div>
            <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
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
                                <option {{old('kategori_id', $surat->kategori_id) == 1 ? 'selected' : '' }} value="1">Alker Salker</option>
                                <option {{old('kategori_id', $surat->kategori_id) == 2 ? 'selected' : '' }} value="2">Material</option>
                                <option {{old('kategori_id', $surat->kategori_id) == 3 ? 'selected' : '' }} value="3">NTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Pihak Pertama
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select class="form-control pihak_pertama" id="pihak_pertama" name="pihak_pertama">
                                <option {{old('pihak_pertama', $surat->pihak_pertama) == 1 ? 'selected' : '' }} value="1">M. Jati Naqosho - Mgr. WH Mgt. & Distribution</option>
                                <option {{old('pihak_pertama', $surat->pihak_pertama) == 2 ? 'selected' : '' }} value="2">Fachrudin - Mgr. Asset Mgt. & GA</option>
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
                                    <option value="{{$ekspedisi->id}}" {{ old('ekspedisi_id', $surat->ekspedisi_id) == $ekspedisi->id ? 'selected' : '' }}>{{$ekspedisi->ekspedisi_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nomor Surat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" name="nomor_surat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Surat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Surat" value="{{ old('tanggal_surat', $data['tanggal_surat']) }}" name="tanggal_surat">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nomor Kontrak
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Kontrak" value="{{ old('nomor_kontrak', $surat->nomor_kontrak) }}" name="nomor_kontrak">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Kontrak
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Kontrak" value="{{ old('tanggal_kontrak', $data['tanggal_kontrak']) }}" name="tanggal_kontrak">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('surat.index')}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Ubah</button>
            </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid pt-10">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Gudang</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('gudang.create', $surat->id)}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success_gudang'))
                    <div class="alert alert-success">
                        {{Session::get('success_gudang')}}
                    </div>
                @endif
                {{-- nomor_surat
                tanggal_surat
                para_pihak
                nomor_kontrak
                tanggal_kontrak --}}
                <!--begin: Datatable-->
                <div style="overflow-y: auto">
                    <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Gudang</th>
                            <th>Alamat Gudang</th>
                            <th>Nama Petugas</th>
                            <th>No. HP Petugas</th>
                            <th width="170px">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                        @foreach ($gudangs as $gudang)
                        <tr>
                            <td style="text-align: center">
                                {{$i++}}.
                            </td>
                            <td style="text-align: center">
                                {{$gudang->gudang_nama}}.
                            </td>
                            <td style="text-align: center">
                                {{$gudang->gudang_alamat}}.
                            </td>
                            <td style="text-align: center">
                                {{$gudang->gudang_nama_petugas}}.
                            </td>
                            <td style="text-align: center">
                                {{$gudang->gudang_no_hp_petugas}}.
                            </td>
                            <td style="text-align: center">
                                <div style="display: flex;align-items: center;justify-content: center;">
                                    <div class="mr-2">
                                    <a href="{{route('gudang.edit', $gudang->id)}}" class="btn btn-sm btn-primary"> Ubah</a>
                                    </div>
                                    <div>
                                    <form action="{{ route('gudang.destroy', $gudang->id) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <input type="hidden" name="gudang_id2" value="{{$gudang->id}}"/>
                                       <input type="hidden" name="surat_id" value="{{$gudang->surat_id}}"/>
                                       <button type="submit" onClick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                                   </form>
                                    </div>
                               </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid pt-10">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Barang</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('barang.create', $surat->id)}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success_barang'))
                    <div class="alert alert-success">
                        {{Session::get('success_barang')}}
                    </div>
                @endif
                {{-- nomor_surat
                tanggal_surat
                para_pihak
                nomor_kontrak
                tanggal_kontrak --}}
                <!--begin: Datatable-->
                <div style="overflow-y: auto">
                    <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Satuan</th>
                            <th>Tanggal Pengambilan Barang</th>
                            <th>Tanggal Barang Tiba</th>
                            <th>Lokasi Tujuan Pengiriman Barang</th>
                            <th>Moda Transport (Darat/Laut/Udara)</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                        @foreach ($barangs as $barang)
                        <tr>
                            <td style="text-align: center">
                                {{$i++}}.
                            </td>
                            <td style="text-align: center">
                                {{$barang->nama_barang}}
                            </td>
                            <td style="text-align: center">
                                {{$barang->jumlah_barang}}
                            </td>
                            <td style="text-align: center">
                                {{$barang->satuan}}
                            </td>
                            <td style="text-align: center">
                                {{\Carbon\Carbon::parse($barang->tanggal_pengambilan_barang)->format('d/m/Y')}}
                            </td>
                            <td style="text-align: center">
                                {{\Carbon\Carbon::parse($barang->tanggal_barang_tiba)->format('d/m/Y')}}
                            </td>
                            <td style="text-align: center">
                                {{$barang->lokasi_tujuan_pengiriman_barang}}
                            </td>
                            <td style="text-align: center">
                                {{$barang->moda_transportasi}}
                            </td>
                            <td style="text-align: center">
                                <div style="display: flex;align-items: center;justify-content: center;">
                                    <div class="mr-2">
                                    <a href="{{route('barang.edit', $barang->id)}}" class="btn btn-sm btn-primary"> Ubah</a>
                                    </div>
                                    <div>
                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <input type="hidden" name="barang_id2" value="{{$barang->id}}"/>
                                       <input type="hidden" name="surat_id" value="{{$barang->surat_id}}"/>
                                       <button type="submit" onClick="return confirm('Apakah Anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                                   </form>
                                    </div>
                               </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
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

        // startDate: new Date(),
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    </script>
@endpush
@section('scripts')
@include('admin.surat/js')
@endsection
