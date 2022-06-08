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
                        <th>Nomor PCR</th>
                        <th>Request's Name</th>
                        <th>Purpose</th>
                        {{-- <th>Purpose Other</th> --}}
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>TTD Staff</th>
                        <th>TTD CMT</th>
                        <th>TTD QA</th>
                        <th>TTD IT</th>
                        <th>Attachment</th>
                        <th>Status Kirim</th>
                        <th>Kirim</th>
                        <th>Cetak</th>
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
                    // {
                    //     data: 'purpose_other',
                    //     name: 'purpose_other'
                    // },
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
                        data: 'ttd_requester',
                        name: 'ttd_requester'
                    },
                    {
                        data: 'ttd_cmt',
                        name: 'ttd_cmt'
                    },
                    {
                        data: 'ttd_qa',
                        name: 'ttd_qa'
                    },
                    {
                        data: 'ttd_it',
                        name: 'ttd_it'
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
                        data: 'status_kirim',
                        name: 'status_kirim'
                    },
                    {
                        data: 'kirim',
                        name: 'kirim',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'print',
                        name: 'print',
                        orderable: false,
                        searchable: false
                    },
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


            $("body").on("click", '.send', function(e){
                e.preventDefault();
                id = $(this).data("id");
                Swal.fire({
                    title: "Anda Yakin?",
                    text: "Apakah Anda Yakin Ingin Mengirim Form Request ini ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Kirim",
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    confirmButtonColor: '#d33',
                }).then(function (results) {
                    if (results.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('create_request_form.send') }}',
                            data: {'id': id, _token: '{{ csrf_token() }}'},
                            dataType: 'json',
                            success: function (result) {
                                if (result.status == 'error1') {
                                    toastr.error(e.message, 'Gagal! Detail Masih Kosong', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                    // tbl.ajax.reload();
                                } else if (result.status == 'error2') {
                                    toastr.error(e.message, 'Gagal! Detail Box Connection & Access Masih Kosong', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                    // tbl.ajax.reload();
                                } else if (result.status == 'error3') {
                                    toastr.error(e.message, 'Gagal! File tanda tangan anda belum ada!', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                    // tbl.ajax.reload();
                                } else if (result.status == 'error4') {
                                    toastr.error(e.message, 'Gagal! Surat sebelumnya belum terkirim!', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                    // tbl.ajax.reload();
                                } else if(result.status == 'success') {
                                    toastr.success(e.message, 'Sukses! Anda berhasil mengirim form request', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                    tbl.ajax.reload();
                                }
                            }
                        });
                    } else if (results.dismiss === "cancel") {

                    }
                });
            });

            // $("body").on("click", '.cancel-form', function(e){
            //     e.preventDefault();
            //     id = $(this).data("id");
            //     Swal.fire({
            //         title: "Anda Yakin?",
            //         text: "Apakah Anda Yakin Ingin Membatalkan Pengiriman Form Request ini ?",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonText: "Ubah",
            //         cancelButtonText: "Batal",
            //         reverseButtons: true,
            //         confirmButtonColor: '#d33',
            //     }).then(function (results) {
            //         if (results.isConfirmed) {
            //             $.ajax({
            //                 type: 'POST',
            //                 url: '{{ route('create_request_form.send_cancel') }}',
            //                 data: {'id': id, _token: '{{ csrf_token() }}'},
            //                 dataType: 'json',
            //                 success: function (result) {
            //                     if(result.status == 'success') {
            //                         toastr.success(e.message, 'Sukses! Anda berhasil membatalkan pengiriman form request', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
            //                         tbl.ajax.reload();
            //                     }
            //                 }
            //             });
            //         } else if (results.dismiss === "cancel") {

            //         }
            //     });
            // });
        })

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');
    </script>
    <!--end::Page Scripts-->
@endpush
