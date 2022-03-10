<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
//tambahan
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    /**@return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //data kategori
        $kategori =Kategori::all();

        //data filter
        $dari= $_GET['dari'];
        $sampai =$_GET['sampai'];
        $id_kategori =$_GET['kategori'];

        //perikasa kategori yang dipilih
        if ($id_kategori=="semua") {
            //jika menampilkan semua data transaksi
            $laporan=Transaksi::whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();

        }else{
            //menampilkan berdasarkan kategori yang dipilh
            $laporan =Transaksi::where('kategori',$id_kategori)
            ->whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();
        }
        //passing darta ke laoran view
        return view('laporan_excel',['laporan'=>$laporan,'kategori'=>$kategori]);
    }
}
