@extends('layouts.app')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Total Surat</div>
                            <svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="20px"
                                    viewBox="0 0 64 40" enable-background="new 0 0 64 40" xml:space="preserve">
                                <g id="Page-1" sketch:type="MSPage">
                                    <g id="Mail" transform="translate(1.000000, 1.000000)" sketch:type="MSLayerGroup">
                                        <path id="Shape" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M0,36c0,1.104,0.896,2,2,2h58
                                            c1.104,0,2-0.896,2-2V2c0-1.104-0.896-2-2-2H2C0.896,0,0,0.896,0,2V36L0,36z"/>
                                        <path id="Shape_4_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M62,2
                                            c0-1.104-31,22.032-31,22.032S0,1.144,0,2"/>
                                        <path id="Shape_2_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M61,37L37,20"/>
                                        <path id="Shape_3_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M1,37l24-17"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="font-weight-bold" style="font-size: 36px" id="_total">0</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Surat Bulan Ini</div>
                            <svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="20px"
                                    viewBox="0 0 64 40" enable-background="new 0 0 64 40" xml:space="preserve">
                                <g id="Page-1" sketch:type="MSPage">
                                    <g id="Mail" transform="translate(1.000000, 1.000000)" sketch:type="MSLayerGroup">
                                        <path id="Shape" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M0,36c0,1.104,0.896,2,2,2h58
                                            c1.104,0,2-0.896,2-2V2c0-1.104-0.896-2-2-2H2C0.896,0,0,0.896,0,2V36L0,36z"/>
                                        <path id="Shape_4_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M62,2
                                            c0-1.104-31,22.032-31,22.032S0,1.144,0,2"/>
                                        <path id="Shape_2_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M61,37L37,20"/>
                                        <path id="Shape_3_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M1,37l24-17"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="font-weight-bold" style="font-size: 36px" id="_total_month">0</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Surat selesai</div>
                            <svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="20px"
                                    viewBox="0 0 64 40" enable-background="new 0 0 64 40" xml:space="preserve">
                                <g id="Page-1" sketch:type="MSPage">
                                    <g id="Mail" transform="translate(1.000000, 1.000000)" sketch:type="MSLayerGroup">
                                        <path id="Shape" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M0,36c0,1.104,0.896,2,2,2h58
                                            c1.104,0,2-0.896,2-2V2c0-1.104-0.896-2-2-2H2C0.896,0,0,0.896,0,2V36L0,36z"/>
                                        <path id="Shape_4_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M62,2
                                            c0-1.104-31,22.032-31,22.032S0,1.144,0,2"/>
                                        <path id="Shape_2_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M61,37L37,20"/>
                                        <path id="Shape_3_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M1,37l24-17"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="font-weight-bold" style="font-size: 36px" id="_total_done">0</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Surat diproses</div>
                            <svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="20px"
                                    viewBox="0 0 64 40" enable-background="new 0 0 64 40" xml:space="preserve">
                                <g id="Page-1" sketch:type="MSPage">
                                    <g id="Mail" transform="translate(1.000000, 1.000000)" sketch:type="MSLayerGroup">
                                        <path id="Shape" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M0,36c0,1.104,0.896,2,2,2h58
                                            c1.104,0,2-0.896,2-2V2c0-1.104-0.896-2-2-2H2C0.896,0,0,0.896,0,2V36L0,36z"/>
                                        <path id="Shape_4_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M62,2
                                            c0-1.104-31,22.032-31,22.032S0,1.144,0,2"/>
                                        <path id="Shape_2_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M61,37L37,20"/>
                                        <path id="Shape_3_" sketch:type="MSShapeGroup" fill="none" stroke="#58595B" stroke-width="2" d="M1,37l24-17"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="font-weight-bold" style="font-size: 36px" id="_total_process">0</div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


<!--begin::Entry-->
<div class="d-flex mt-5">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card">
            <div class="card-header pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Highlight Request Form</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                        @if (Auth::User()->is_role == 1 || Auth::User()->is_role == 2)
                        <tr>
                            <th>No.</th>
                            <th>Nomor Surat</th>
                            <th>Nomor PCR</th>
                            <th>Request's Name</th>
                            <th>Purpose</th>
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
                            <th>Aksi</th>
                        </tr>
                        @else
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
                        @endif
                    </thead>
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
 <!--begin::Page Scripts(used by this page)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"></script>
<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Scripts-->

<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->

<script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
<script>
    async function getAjax(url, callback) {
        await $.ajax({
            method: 'GET',
            url: url,
            success: function(res) {
                $(callback).html(res)
            },
            error: function() {
                console.log('Failed');
            }
        })
    }

    function loadDashboardData() {
        getAjax(`{{ route('dashboard', 'all') }}`, '#_total')
        getAjax(`{{ route('dashboard', 'month') }}`, '#_total_month')
        getAjax(`{{ route('dashboard', 'done') }}`, '#_total_done')
        getAjax(`{{ route('dashboard', 'process') }}`, '#_total_process')
    }

    function convertDateDBtoIndo($string) {
        $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
        return $bulanIndo[$string];
    }

    $(document).ready(function () {
        loadDashboardData()
        var value;
        var tbl;
        var tblDetail;
        tbl = $('#lks_datatable').DataTable({
            responsive: true,
            ordering: false,
            deferRender: true,
            serverSide: true,
            processing: true,
            orderMulti: true,
            stateSave: true,
            ajax: {
                url: '{{ route('dashboard.highlight') }}'
            },
            @if (Auth::User()->is_role == 1 || Auth::User()->is_role == 2)
                columns:[
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
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
                ],
            @else
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
                ],
            @endif
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
                            } else if(result.status == 'success') {
                                toastr.success(e.message, 'Sukses! Anda berhasil mengirim form request', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                                tbl.ajax.reload();
                                loadDashboardData()
                            }
                        }
                    });
                } else if (results.dismiss === "cancel") {

                }
            });
        });

        $('body').on("click", ".switch", function(){
            id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '{{ route('create_request_form.ttd') }}',
                data: {'id': id, _token: '{{ csrf_token() }}'},
                success: function (e) {
                    if(e.status == 'success') {
                        toastr.success(e.message, 'Success', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                        tbl.ajax.reload();
                        loadDashboardData()
                    } else {
                        toastr.error(e.message, 'Gagal', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 40000});
                        // tbl.ajax.reload();
                    }
                },
                error: function (e) {
                    toastr.error('Kesalahan server!', 'Gagal', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 10000});
                }
            });
        });

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');
    });
</script>
@endpush
