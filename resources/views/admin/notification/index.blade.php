@extends('layouts.app')

@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Notification</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{ route('notification.index') }}" class="text-muted">Notification</a>
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
                    <h3 class="card-label">Daftar Notification</h3>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="notif_datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Message</th>
                        </tr>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" />
    <!--end::Page Vendors Styles-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/lightbox/css/lightbox.min.css') }}" />
@endpush

@push('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#notif_datatable').DataTable({
                responsive: true,
                ordering: false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: `{{ route('notification.index') }}`
                },
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'message',
                        name: 'message',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
    <!--end::Page Scripts-->
@endpush
