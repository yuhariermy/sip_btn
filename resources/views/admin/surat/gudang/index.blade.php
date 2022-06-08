@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Gudang</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('gudang.index')}}" class="text-muted">Daftar Gudang</a>
        </li>
        {{-- <li class="breadcrumb-item">
            <a href="" class="text-muted">Semua Dataset</a>
        </li> --}}
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
                    <h3 class="card-label">Daftar Gudang</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('gudang.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Ekspedisi</th>
                        <th>Nama Gudang</th>
                        {{-- <th>Witel</th> --}}
                        {{-- <th>Regional</th> --}}
                        <th>Alamat Gudang</th>
                        {{-- <th>Kota Gudang</th> --}}
                        <th>Nama Petugas</th>
                        <th>No. HP Petugas</th>
                        {{-- <th>Posisi Petugas</th> --}}
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
    <!--end::Page Vendors Styles-->
    <link href="{{asset('assets/js/lightbox/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
   

    <style>
        #filter_card .card-body {
            flex: 1 0.5 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .select2 {
            width: 100% !important; /* overrides computed width, 100px in your demo */
        }
    </style>
@endpush
@push('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
   
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
   
    <script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var value;
            var tbl;
            var tblDetail;
            $(document).ready(function () {
                tbl = $('#lks_datatable').DataTable({
                    responsive: true,
                    "ordering": false,
                    deferRender: true,
                    serverSide: true,
                    processing: true,
                    orderMulti: true,
                    stateSave: true,
                    ajax: {
                        url: '{{ route('gudang.index') }}'
                    },
                     columns:[
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        {
                            data: 'ekspedisi.ekspedisi_nama',
                            name: 'ekspedisi.ekspedisi_nama'
                        },
                        {
                            data: 'gudang_nama',
                            name: 'gudang_nama'
                        },
                        // {
                        //     data: 'gudang_witel',
                        //     name: 'gudang_witel'
                        // },
                        // {
                        //     data: 'gudang_regional',
                        //     name: 'gudang_regional'
                        // },
                        {
                            data: 'gudang_alamat',
                            name: 'gudang_alamat'
                        },
                        // {
                        //     data: 'gudang_kota_parent',
                        //     name: 'gudang_kota_parent'
                        // },
                        {
                            data: 'gudang_nama_petugas',
                            name: 'gudang_nama_petugas'
                        },
                        {
                            data: 'gudang_no_hp_petugas',
                            name: 'gudang_no_hp_petugas'
                        },
                        // {
                        //     data: 'gudang_posisi_petugas',
                        //     name: 'gudang_posisi_petugas'
                        // },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('body').on('click', '.btnDelete', function (e) {
                    e.preventDefault();
                    var form = $(this).parent();
                    Swal.fire({
                        title: "Anda Yakin?",
                        text: "Ingin hapus data Gudang ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                        reverseButtons: true,
                        confirmButtonColor: '#d33',
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (result.dismiss === "cancel") {

                        }
                    });
                });
            });
        })

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');

        
    </script>
    <!--end::Page Scripts-->
@endpush