<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan - Surat Informasi Persuratan</title>
   <style>
       .text-center{
           text-align: center;
       }
       @page { margin: 140px 0px 0px 0px; }

       /* @page {
            margin: 0px;
        } */
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
            position: fixed; 
            bottom: 40px; 
            display: block;
            background-color: #e21a25;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .header {
            position: fixed;
            top:-150px;
        }
   </style>
</head>
<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td align="center" style="width: 50%;padding-left:2px;">
                    <div style="margin-left:20px;margin-top:40px;border:1px solid #000;width:300px;">
                        <h1 style="font-size:14px">Lampiran IV B –  Format Nota Pengadaan
                    </div>
                </td>
                <td align="right" style="width:50%;position: relative;padding-right:120px;">
                    <div style="margin-left:40px">
                        <img style="padding-top: 20px;" src="{{public_path('assets/logo_transparant.png')}}" alt="Logo" width="300" class="logo"/>    
                    </div>
                    {{-- <span style="font-size: 14px">NOTA PENGADAAN </span> <br/> 
                    <span style="font-size: 14px">PEKERJAAN JASA EKSPEDISI – TRANSAKSI ANTAR GUDANG</span></h1> --}}
                </td>
            </tr>
        </table>
    </div>
    <div class="information" >
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }}  - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Telkom Akses
                </td>
            </tr>
        </table>
    </div>
    <div class="body" style="padding-left:60px;padding-right:60px;padding-top:0px;">
        <h4 style="text-align:center;">NOTA PENGADAAN <br/> 
            PEKERJAAN JASA EKSPEDISI – TRANSAKSI ANTAR GUDANG</h4>
        <div style="border: 1px solid #000;padding-bottom:5px;"></div>
        <table style="font-size: 14px;font-weight:bold;">
            <tr>
                <td align="left">
                    Nomor 
                </td>
                <td align="left">
                    :
                </td>
                <td align="left">
                    {{$surats->nomor_surat}}
                </td>
            </tr>
            <tr>
                <td align="left">
                    Tanggal 
                </td>
                <td align="left">
                    :
                </td>
                <td align="left">
                    {{Carbon\Carbon::parse($surats->tanggal_surat)->isoFormat('D MMMM Y')}}
                </td>
            </tr>
            <tr>
                <td align="left">
                    Pihak Pihak 
                </td>
                <td align="left">
                    :
                </td>
                <td align="left">
                    PT. Telkom Akses
                </td>
            </tr>
            <tr>
                <td align="left">
                    
                </td>
                <td align="left">
                    :
                </td>
                <td align="left">
                    {{$surats->ekspedisi->ekspedisi_nama}}
                </td>
            </tr>
        </table>
        <div style="font-size: 14px;">
            <h4 style="text-align:center;">I. KETENTUAN UMUM</h4>
            <ol type="1">
                <li>Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Jasa Ekspedisi, Nomor:  {{$surats->ekspedisi->nomor_kontrak}}, tanggal {{Carbon\Carbon::parse($surats->ekspedisi->tanggal_kontrak)->isoFormat('D MMMM Y')}}. </li>
                <li>Setiap perubahan terhadap ketentuan dalam Nota Pengadaan ini akan dibuat amandemen yang ditandatangani Para Pihak dan berlaku mengikat serta merupakan bagian yang tidak  terpisahkan dengan Nota Pengadaan ini. </li>
                <li> Lampiran-lampiran dalam Nota Pengadaan ini (bila ada) merupakan bagian yang tidak  terpisahkan dari Nota Pengadaan ini. </li>
            </ol>
        </div>
        <div style="font-size: 14px;">
            <h4 style="text-align:center;">II. LINGKUP PEKERJAAN</h4>
            <ol type="1">
                <li>Lingkup Pekerjaan berdasarkan Nota Pengadaan ini adalah Pekerjaan Jasa Ekspedisi.</li>
                <li>Rincian Lingkup Pekerjaan adalah sebagai berikut : </li>
            </ol>
            <table border="1" style="width: 100%;border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Satuan</th>
                        <th>Tanggal Pengambilan Barang</th>
                        <th>Tanggal Barang Tiba</th>
                        <th>Lokasi Tujuan Pengiriman Barang</th>
                        <th>Moda Transport (Dara/Laut/Udara)</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach ($surats->barang as $barangs)
                    <tr>
                        <td style="text-align: center">
                            {{$i++}}.
                        </td>
                        <td style="text-align: center">
                            {{$barangs->nama_barang}}
                        </td>
                        <td style="text-align: center">
                            {{$barangs->jumlah_barang}}
                        </td>
                        <td style="text-align: center">
                            {{$barangs->satuan}}
                        </td>
                        <td style="text-align: center">
                            {{\Carbon\Carbon::parse($barangs->tanggal_pengambilan_barang)->format('d/m/Y')}}
                        </td>
                        <td style="text-align: center">
                            {{\Carbon\Carbon::parse($barangs->tanggal_barang_tiba)->format('d/m/Y')}}
                        </td>
                        <td style="text-align: center">
                            {{$barangs->lokasi_tujuan_pengiriman_barang}}
                        </td>
                        <td style="text-align: center">
                            {{$barangs->moda_transportasi}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="padding-left: 20px;">3. Pengambilan Barang dapat dilakukan langsung ke:</p>
            @foreach ($surats->gudang as $gudang) 
            <table border="1" style="width: 100%;font-size:14px;font-weight:bold;border-collapse: collapse;padding-top:10px;">
                    <tr>
                        <td style="width: 150px;padding-left:7px;">Gudang Asal</td>
                        <td style="padding-left:7px;">{{$gudang->gudang_nama}}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;padding-left:7px;">PIC</td>
                        <td style="padding-left:7px;">{{$gudang->gudang_nama_petugas}}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;padding-left:7px;">Alamat</td>
                        <td style="padding-left:7px;">{{$gudang->gudang_alamat}} / {{$gudang->gudang_no_hp_petugas}}</td>
                    </tr>
               
            </table>
            @endforeach
            <p style="padding-left: 20px;">Nota Pengadaan ini dibuat dengan itikad baik untuk dipatuhi dan dilaksanakan oleh Para Pihak</p>
            <table style="width: 100%;font-weight:bold;font-size:14px;padding-top:30px;">
                <tr>
                    <td style="text-align:center;">PT. TELKOM AKSES </td>
                    <td style="text-align:center;">{{$surats->ekspedisi->ekspedisi_nama}}</td>
                </tr>
                <tr style="padding-top:40px;">
                    <td style="text-align:center;padding-top:70px;"></td>
                    <td style="text-align:center;padding-top:70px;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;"><u>{{$surats->pihak_pertama == 1 ? 'M. Jati Naqosho' : 'Fachrudin'}}</u> <br/> {{$surats->pihak_pertama == 1 ? 'Mgr. WH Mgt. & Distribution' : 'Mgr. Asset Mgt. & GA'}}</td>
                    <td style="text-align:center;"><u>{{$surats->ekspedisi->ekspedisi_nama_pic}}</u> <br/> {{$surats->ekspedisi->ekspedisi_jabatan_pic}}</td>
                </tr>
            </table>
        </div>
            
        </div>
    </div>
    
</body>
</html>