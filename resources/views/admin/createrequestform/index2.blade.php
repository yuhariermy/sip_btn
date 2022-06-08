@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Create Request Form</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('create_request_form.index')}}" class="text-muted">Daftar Create Request Form</a>
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
                    <h3 class="card-label">Daftar Create Request Form</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('create_request_form.create')}}" class="btn btn-primary font-weight-bolder">
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
                        <th>Nomor Surat</th>
                        <th>Attachment</th>
                        <th>Nomor PCR</th>
                        <th>Request's Name</th>
                        <th>Purpose</th>
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status Kirim</th>
                        <th>Tanda Tangan</th>
                        <th>Send At</th>
                        <th>Cetak</th>
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
            flex: 1 1 auto;
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
            tbl = $('#lks_datatable').DataTable({
                responsive: true,
                "ordering": false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{{ route('create_request_form.index') }}'
                },
                 columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'no_surat',
                        name: 'no_surat'
                    },
                    {
                        data: 'attachment',
                        name: 'attachment',
                        render: function( data, type, full, meta ) {
                            if(data != ' ') {
                                return "<a download data-fancybox-group='gallery'  href={{ asset('uploads/') }}/" + data + " >Lihat Attachment</a>";
                            } else {
                                return 'Tidak ada Attachment';
                            }
                        }
                    },
                    {
                        data: 'no_pcr',
                        name: 'no_pcr'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'purpose.name',
                        name: 'purpose.name'
                    },
                    {
                        data: 'location.name',
                        name: 'location.name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status_kirim',
                        name: 'status_kirim'
                    },
                    {
                        data: 'ttd',
                        name: 'ttd'
                    },
                    {
                        data: 'send_at',
                        name: 'send_at'
                    },
                    {
                        data: 'print',
                        name: 'print',
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
                    text: "Ingin hapus data Create Request Form ?",
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

            $('body').on("click", ".switch", function(){
                id = $(this).data("id");
                console.log(id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('create_request_form.ttd') }}',
                    data: {'id': id, _token: '{{ csrf_token() }}'},
                    success: function (e) {
                        if(e.status == 'success') {
                            toastr.success(e.message, 'Success', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                            tbl.ajax.reload();
                        } else {
                            toastr.error(e.message, 'Gagal', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                            tbl.ajax.reload();
                        }
                    },
                    error: function (e) {
                        toastr.error('Kesalahan server!', 'Gagal', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 10000});
                    }
                });
            });
        })

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');
    </script>
    <!--end::Page Scripts-->
@endpush
