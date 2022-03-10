<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Keuangan</title>
</head>
<body>
    <center>Laporan Transaksi Keuangan</center>
    <!-- Parameter -->
    @php
        $dari= $_GET['dari'];
        $sampai = $_GET['sampai'];
        $kat = $_GET['kategori'];
    @endphp

    <style type="text/css">
        table{
            border-collapse:collapse;
        }
        table th, table td{
            border: 1px solid black;
            text-align: center;
        }
        /** Set print mode lanscape */
        @media print{@page{size: landscape}}
    </style>

    <table>
        <thead>
            <tr>
                <th rowspan="2" width="11%">Tanggal</th>
                <th rowspan="2" width="5%">Jenis</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Kategori</th>
                <th colspan="2">Transaksi</th>
            </tr>
            <tr>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <!-- Parameter -->
            @php
                $total_pemasukan=0;
                $total_pengeluaran=0;
            @endphp
            @foreach ($laporan as $t)
            <tr>
                <td class="text-center">{{date('d-M-Y',strtotime($t->tanggal))}}</td>
                <td class="text-center">{{$t->jenis}}</td>
                <td class="text-center">{{$t->keterangan}}</td>
                <td class="text-center">{{$t->kategori->kategori}}</td>
                <td class="text-center">
                    @if ($t->jenis=="Pemasukan")
                        {{"Rp.".number_format($t->nominal).",-"}}
                    @else
                            -
                    @endif
                </td>
                <td class="text-center">
                    @if ($t->jenis=="Pengeluaran")
                        {{"Rp.".number_format($t->nominal).",-"}}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @php
                if($t->jenis == "Pemasukan"){
                    $total_pemasukan += $t->nominal;
                }else if($t->jenis =="Pengeluaran") {
                   $total_pengeluaran += $t->nominal;
                }
            @endphp
            @endforeach
           
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right font-weight-bold" colspan="4">TOTAL</td>
                <td class="text-center bg-success text-white font-weight-bold">{{"Rp.".number_format($total_pemasukan).",-"}}</td>
                <td class="text-center bg-danger text-white font-weight-bold">{{"Rp.".number_format($total_pengeluaran).",-"}}</td>
            </tr>
        </tfoot>
    </table>
    <!-- Perintah print -->
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>