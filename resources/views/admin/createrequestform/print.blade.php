<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Request Form</title>
   <style>
       .text-center{
           text-align: center;
       }

       @page {
        margin: 90px 0px 0px 20px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        table.pembelian {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table.invoice {
            padding-top:100px;
        }

        .attendance-cell{
            padding: 8px;
        }

        table.pembelian th.attendance-cell, td.attendance-cell {
            border: 1px solid #000;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        table.pengirim > tr > th {
            border: 1px solid black;
        }

        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            /* background-color: #60A7A6; */
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }

        table.pengirim,
        table.source {
            margin-right: 15px;
            border-collapse: collapse;
        }

        table.source td {
            border: 1px solid black;
            /* background-color: #0000ff66; */
        }
        .header {
            position: fixed;
            top:-70px;
            height: 150px;
        }

        .sign_container {
            position: absolute;
        }

        .sign {
            position: absolute;
            top: 0;
            left: 25px;
            width: 140px;
            height: 90px;
            z-index: 1;
        }

        .sign_name {
            top: 75;
            left: 0;
            width: 100%;
            height: 13px;
            position: absolute;
            z-index: 2;
        }
   </style>
</head>
<body>
    <div class=" header">
        <table class="pengirim" style="width:100%;">
            <tr>
                <td width="50%">
                    <img style="margin-top: 20px;" src="{{ public_path('assets/logo_transparant.png') }}" alt="Logo" width="150" class="logo"/>
                </td>
                <td width="50%">
                    <p style="position:relative;">No. {{ $forms->no_surat }}</p>
                    <h1 style="font-size:12px;margin-top: -8px;">PT. BANK TABUNGAN NEGARA (PERSERO) Tbk. <br/>
                </td>
            </tr>
        </table>
    </div>
    <div class="transaction">
        <table class="pengirim" style="width:100%;margin-left: 20px;border:0px;margin-bottom:15px;">
            <!-- <tr>
                <td width="15%">Connection Type</td>
                <td width="2%">:</td>
                <td>H2H/Public/Intranet/Others</td>
            </tr> -->
        </table>
        <table class="pengirim" style="width:100%;border:0;margin-bottom:0;">
            <tr>
                <td width="18%">Location Name</td>
                <td width="2%">:</td>
                <td width="30%">{{$forms->location->name}}</td>
                <td width="18%">Requester's Name</td>
                <td width="2%">:</td>
                <td width="30%">{{$forms->user->name}}</td>
            </tr>
        </table>
        <table class="pengirim" style="width:100%;border:0px;margin-bottom:15px;">
            <tr>
                <td width="18%">Purposes</td>
                <td width="2%">:</td>
                <td>{{$forms->purpose->name}}</td>
            </tr>
        </table>
        <table class="pengirim" style="width:100%;margin-left: 0;border:0px;margin-bottom:15px;">
            <tr>
                <td width="50%"></td>
                <td width="18%">Start Date</td>
                <td width="2%">:</td>
                <td width="30%">{{Carbon\Carbon::parse($forms->start_date)->isoFormat('D MMMM Y')}}</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td width="18%">End Date</td>
                <td width="2%">:</td>
                <td width="30%">{!! $forms->end_date == null ? '<img style="margin-top: 4px;" src="' . public_path('assets/infinite.png') . '" width="18" />' : Carbon\Carbon::parse($forms->end_date)->isoFormat('D MMMM Y') !!}</td>
            </tr>
        </table>
        @if($detail_requests->count() > 0)
            <table class="source" style="width:100%;border:1px solid black;margin-bottom:15px;">
                <tr>
                    <td width="21%" style="text-align: center" rowspan="2">No. </td>
                    <td width="20%" style="text-align: center" rowspan="2">Type Connection </td>
                    <td width="30%" style="text-align: center" colspan="2">Source </td>
                    <td width="30%" style="text-align: center" colspan="5">Destination</td>
                    {{-- <td width="35%" style="text-align: center">Others Comment</td> --}}
                </tr>
                <tr>
                    <td width="30%" style="text-align: center">Name </td>
                    <td width="30%" style="text-align: center">Ip Address</td>
                    <td width="30%" style="text-align: center">Name </td>
                    <td width="30%" style="text-align: center">Ip Address</td>
                    <td width="30%" style="text-align: center">TCP </td>
                    <td width="30%" style="text-align: center">UDP</td>
                    <td width="30%" style="text-align: center">Port(s)</td>
                    {{-- <td width="35%" style="text-align: center">Others Comment</td> --}}
                </tr>
                @php
                    $i = 1
                @endphp
                @foreach ($detail_requests as $detail_request)
                    <tr>
                        <td style="text-align:center;" width="21%">
                            {{$i++}}
                        </td>
                        <td style="text-align:center;" width="50%">
                            {{$detail_request->type_connection->name == 'OTHERS' ? $detail_request->other : $detail_request->type_connection->name}}
                        </td>
                        <td style="text-align:center;" width="50%">
                            {{$detail_request->source_name}}
                        </td>
                        <td style="text-align:center;" width="50%">
                            {{$detail_request->source_ip_address}}
                        </td>
                        <td style="text-align:center;" width="50%">{{$detail_request->destination_name}}</td>
                        <td style="text-align:center;" width="50%">{{$detail_request->destination_ip_address}}</td>
                        <td style="text-align:center;" width="50%">{{$detail_request->tcp}}</td>
                        <td style="text-align:center;" width="50%">{{$detail_request->udp}}</td>
                        <td style="text-align:center;" width="50%">{{$detail_request->port}}</td>
                        {{-- <td style="text-align:center;" width="50%">{{$detail_request->other}}</td> --}}
                    </tr>
                @endforeach
            </table>
            <p style="font-size: 12px;margin-left:2px;">Detail Request :</p>
            <table class="source" style="width:100%;border:1px solid black;margin-bottom:15px;">
                <tr>
                    <td width="100%" style="height: 80px; padding-left: 10px;">{{$forms->detail_request}}</td>
                </tr>
            </table>
        @endif
        @if($detail_accesses->count() > 0)
            <table class="source" style="width:100%;border:1px solid black;margin-bottom:15px;">
                <tr>
                    <td width="5%" style="text-align: center">No. </td>
                    <td width="20%" style="text-align:center;">Access Type</td>
                    <td width="20%" style="text-align:center;">Full Name</td>
                    <td width="20%" style="text-align:center;">Server Name</td>
                    <td width="20%" style="text-align:center;">DB Name</td>
                    <td width="15%" style="text-align:center;">Ip Address</td>
                    {{-- <td width="20%" style="text-align:center;">Others Comment</td> --}}
                </tr>
                @php
                    $i = 1;
                @endphp
                @foreach ($detail_accesses as $detail_access)
                    <tr>
                        <td style="text-align:center;" width="5%">{{$i++}}</th>
                        <td style="text-align:center;" width="20%">{{ (!empty($detail_access->type_access->name) ? ($detail_access->type_access->name == 'OTHERS' ? $detail_access->other : $detail_access->type_access->name) : '-') }}</td>
                        <td style="text-align:center;" width="20%"> {{$detail_access->fullname}}</td>
                        <td style="text-align:center;" width="20%"> {{$detail_access->server_name}}</td>
                        <td style="text-align:center;" width="20%"> {{$detail_access->db_name}}</td>
                        <td style="text-align:center;" width="15%"> {{$detail_access->ip_address}}</td>
                        {{-- <td style="text-align:center;" width="50%"> {{$detail_access->other}}</td> --}}
                    </tr>
                @endforeach
            </table>
            <p style="font-size: 12px;margin-left:2px;">Detail Access :</p>
            <table class="source" style="width:100%;border:1px solid black;margin-bottom:15px;">
                <tr>
                    <td width="100%" style="height: 80px; padding-left: 10px;">{{$forms->detail_access}}</td>
                </tr>
            </table>
        @endif

        <div style="/* position: absolute; bottom: 0; top: 80% */">
            <p style="font-size: 12px;margin-left:2px;">Attachment : <a style="color: black" href="{{asset('uploads/'.$forms->attachment)}}">Terlampir</a></p>
            <table class="source" border="1" style="width:100%;border:1px solid black; /* position: relative; */">
                <tr>
                    <td width="25%" style="text-align: center;">Requester </td>
                    <td width="25%" style="text-align: center;">Opr Change Management</td>
                    <td width="25%" style="text-align: center;">Verified by Quality Assurance & Risk Security Police Operation</td>
                    <td width="25%" style="text-align: center;">Executed IT Security</td>
                </tr>
                <tr>
                    <td width="25%" style="height: 90px;text-align:center;">
                        @if($forms->ttd_requester)
                        <div class="sign_container">
                            <img src="{{ public_path('uploads/' . $ttd_requester->attachment) }}" alt="Logo" class="logo sign"/>
                            {{-- <div class="sign_name">{{ $ttd_requester->user->name }}</div> --}}
                        </div>
                        @endif
                    </td>
                    <td width="25%" style="height: 90px;text-align:center;">
                        @if($forms->ttd_cmt)
                        <div class="sign_container">
                            <img src="{{ public_path('uploads/' . $ttd_cm->attachment) }}" alt="Logo" class="logo sign"/>
                            {{-- <div class="sign_name">{{ $ttd_cm->user->name }}</div> --}}
                        </div>
                        @endif
                    </td>
                    <td width="25%" style="height: 90px;text-align:center;">
                        @if($forms->ttd_qa)
                        <div class="sign_container">
                            <img src="{{ public_path('uploads/' . $ttd_qa->attachment) }}" alt="Logo" class="logo sign"/>
                            {{-- <div class="sign_name">{{ $ttd_qa->user->name }}</div> --}}
                        </div>
                        @endif
                    </td>
                    <td width="25%" style="height: 90px;text-align:center;">
                        @if($forms->ttd_it)
                        <div class="sign_container">
                            <img src="{{ public_path('uploads/' . $ttd_it->attachment) }}" alt="Logo" class="logo sign"/>
                            {{-- <div class="sign_name">{{ $ttd_it->user->name }}</div> --}}
                        </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="text-align: center; padding: 4px 0;">
                        @if($forms->ttd_requester)
                            {{ $ttd_requester->user->name }}
                        @endif
                    </td>
                    <td width="25%" style="text-align: center; padding: 4px 0;">
                        @if($forms->ttd_cmt)
                            {{ $ttd_cm->user->name }}
                        @endif
                    </td>
                    <td width="25%" style="text-align: center; padding: 4px 0;">
                        @if($forms->ttd_qa)
                            {{ $ttd_qa->user->name }}
                        @endif
                    </td>
                    <td width="25%" style="text-align: center; padding: 4px 0;">
                        @if($forms->ttd_it)
                            {{ $ttd_it->user->name }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
