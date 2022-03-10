<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//fungsi DB
use Illuminate\Support\Facades\DB;
//mengkonekan models kategori
use App\Models\Kategori;
use App\Models\Transaksi;

//export to excel
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

//change password //mengkonekan model user
use App\Models\user;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
// NOTE: START home INDEX dibuat TERAKHIR setelah kategori dan transaksi-----!!
    public function index()
    {
        //format harus (Y-m-d)
        $tanggal_hari_ini= date('Y-m-d');
        $bulan_ini=date('m');
        $tahun_ini=date('Y');



    //jenis ->Pemasukan atau Pengeluaran dari field Transaksi
    // Start Pemasukan------------------------------------------------!
        //pemasukan hari ini
        $pemasukan_hari_ini=Transaksi::where('jenis','Pemasukan')
        ->whereDate('tanggal',$tanggal_hari_ini)
        ->sum('nominal');

        //pemasukan bulan ini
        $pemasukan_bulan_ini=Transaksi::where('jenis','Pemasukan')
        ->whereMonth('tanggal',$bulan_ini)
        ->sum('nominal');

        //pemasukan tahun ini
        $pemasukan_tahun_ini=Transaksi::where('jenis','Pemasukan')
        ->whereYear('tanggal',$tahun_ini)
        ->sum('nominal');

        //seluruh pemasukan
        $seluruh_pemasukan=Transaksi::where('jenis','Pemasukan')
        ->sum('nominal');

    // END Pemasukan------------------------------------------------!
    // Start Pengeluaran--------------------------------------------!

        //pengeluaran_hari ini
        $pengeluaran_hari_ini =Transaksi::where('jenis','Pengeluaran')
        ->whereDate('tanggal',$tanggal_hari_ini)
        ->sum('nominal');

        //pengeluaran bulan ini
        $pengeluaran_bulan_ini=Transaksi::where('jenis','Pengeluaran')
        ->whereMonth('tanggal',$bulan_ini)
        ->sum('nominal');

        //pengeluaran tahun ini
        $pengeluaran_tahun_ini=Transaksi::where('jenis','Pengeluaran')
        ->whereYear('tanggal',$tahun_ini)
        ->sum('nominal');

        //seluruh pengeluaran
        $seluruh_pengeluaran=Transaksi::where('jenis','Pengeluaran')
        ->sum('nominal');
    
        return view('home',[
            'pemasukan_hari_ini'=>$pemasukan_hari_ini,
            'pemasukan_bulan_ini'=>$pemasukan_bulan_ini,
            'pemasukan_tahun_ini'=>$pemasukan_tahun_ini,
            'seluruh_pemasukan'=>$seluruh_pemasukan,
            'pengeluaran_hari_ini'=>$pengeluaran_hari_ini,
            'pengeluaran_bulan_ini'=>$pengeluaran_bulan_ini,
            'pengeluaran_tahun_ini'=>$pengeluaran_tahun_ini,
            'seluruh_pengeluaran'=>$seluruh_pengeluaran
        ]);
    }
    // End Pengeluaran------------------------------------------------!
// NOTE: end home INDEX dibuat TERAKHIR setelah kategori dan transaksi-----!!
  
//PART KATEGORI----------------------------------I
    public function kategori(){
        $kategori=Kategori::all();
        return view('kategori',['kategori'=>$kategori]);
    }

    public function kategori_tambah(){
        return view('kategori_tambah');
    }

    public function kategori_aksi(Request $data){

        //validasi field data kategori 
        $data->validate([
            'kategori'=>'required'
        ]);

        //case sensitiv $data->(nama_tabel)
        $kategori=$data->kategori;

        Kategori::insert([
            'kategori'=>$kategori
        ]);

        return redirect('kategori')->with("sukses","kategori berhasil disimpan");
    }

    public function kategori_edit($id){
        $kategori=Kategori::find($id);
        return view('kategori_edit',['kategori'=>$kategori]);
    }

    public function kategori_update($id, Request $data){
        //form validasi
        $data->validate([
            'kategori'=>'required'
        ]);
        $nama_kategori=$data->kategori;
        //update kategori
        $kategori=Kategori::find($id);
        $kategori->kategori=$nama_kategori;
        $kategori->save();

        //alhkan halaman ke halaman kategori
        return redirect('kategori')->with('sukses','Kategori berhasi diubah');
    }

    public function kategori_hapus($id){
        //get data 
        $kategori=Kategori::find($id);
        $kategori->delete();
        //menghapus data transaksi berdasrkan data id keategori yang dihapus
        $transaksi=Transaksi::where('kategori_id',$id);
        $transaksi->delete();

        return redirect('kategori')->with('sukses','kategori berhasil di hapus');

    }
    //END PART KATEGORI----------------------------------I

    //PART TRANSAKSI------------------------------------I

    public function transaksi(){
    //memanggil data transaksi
        //$transaksi=Transaksi::all();

    //menggunakan pagination
       $transaksi=Transaksi::orderBy('id','Desc')->simplePaginate(5);
        //passing data
        return view('/transaksi',['transaksi'=>$transaksi]);
    }
    public function transaksi_tambah(){
        //mengambil data kategori
        $kategori=Kategori::all();
        //parsing
        return view('transaksi_tambah',['kategori'=>$kategori]);
    }
    public function transaksi_aksi(Request $data){
        //validasi
        $data->validate([
            'tanggal'=>'required',
            'jenis'=>'required',
            'kategori'=>'required',
            'nominal'=>'required'
        ]);

        $transaksi=$data->transaksi;
        //insert data
        Transaksi::insert([
            'tanggal'=>$data->tanggal,
            'jenis'=>$data->jenis,
            'kategori_id'=>$data->kategori,
            'nominal'=>$data->nominal,
            'keterangan'=>$data->keterangan
        ]);
        //redirect with session message
        return redirect('transaksi')->with('sukses','Data transaksi sukses disimpan');
    }
    public function transaksi_edit($id){
        //mengambil data transaksi berdasarkan id
        $transaksi=Transaksi::find($id);
        //mengambil data kategori
        $kategori=Kategori::all();
        return view('transaksi_edit',['kategori'=>$kategori,'transaksi'=>$transaksi]);
    }
    public function transaksi_update($id, Request $data){
        //validasi
        $data->validate([
            'tanggal'=>'required',
            'jenis'=>'required',
            'kategori'=>'required',
            'nominal'=>'required'
        ]);
        //mengambil data transaksi berdasarkan id
        $transaksi=Transaksi::find($id);

        //ubah data transaksi
        $transaksi->tanggal=$data->tanggal;
        $transaksi->jenis=$data->jenis;
        $transaksi->kategori_id=$data->kategori;
        $transaksi->nominal=$data->nominal;
        $transaksi->keterangan=$data->keterangan;
        //simpan perubahan data
        $transaksi->save();

        return redirect('transaksi')->with("sukses", "Data berhasil dirubah");
    }

     public function transaksi_hapus($id){
        $transaksi=Transaksi::find($id);
        $transaksi->delete();
        //parsing data
        return redirect('transaksi')->with("sukses", "Data berhasil dihapus");
    }

    public function transaksi_cari(Request $data){
        //keyword pencarian
        $cari =$data->cari;

        //mengambil data transaksi

        $transaksi=Transaksi::orderBy('id','desc')
                    ->where('jenis','like',"%".$cari."%")
                    ->orWhere('tanggal','like',"%".$cari."%")
                    ->orWhere('keterangan','like',"%".$cari."%")
                    ->orWhere('nominal','like',"%".$cari."%")
                    ->paginate(6);
        //menambahkan keyword pencarian ke data transaksi
        $transaksi->appends($data->only('cari'));

        //passing data
        return view('transaksi',['transaksi'=>$transaksi]);
    }

    //END PART TRANSAKSI----------------------------------I

    //PART LAPORAN----------------------------------------I

    public function laporan(){

        //mengambil data kategoriS
        $kategori=Kategori::all();

        //passing data ke view lapporan
        return view('/laporan',['kategori'=>$kategori]);
    
    }

    public function laporan_hasil(Request $request){
        $request->validate([
            'dari'=>'required',
            'sampai'=>'required'
        ]);
        //data kategori
        $kategori=Kategori::all();

        //data filter
        $dari=$request->dari;
        $sampai=$request->sampai;
        $id_kategori=$request->kategori;

        //kategori yang dipilih
        if ($id_kategori =='semua') {
            //jika semua ditampilkan semua transaksi
            $laporan =Transaksi::whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();
        }else{
            //jika bukan semua
            //tampilan berdasarkan kategori yang diplih
            $laporan = Transaksi::where('kategori_id',$id_kategori)
            ->whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();
        }

        //passing data laporan ke view laporan
        return view('laporan_hasil',['laporan'=>$laporan,'kategori'=>$kategori]);
    }

    //print laporan
    public function laporan_print(Request $req){
        $req->validate([
            'dari'=>'required',
            'sampai'=>'required'
        ]);
         //data kategori
         $kategori=Kategori::all();
         //data filter
        $dari=$req->dari;
        $sampai=$req->sampai;
        $id_kategori=$req->kategori;

        //kategori yang dipilih
        if ($id_kategori =='semua') {
            //jika semua ditampilkan semua transaksi
            $laporan =Transaksi::whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();
        }else{
            //jika bukan semua
            //tampilan berdasarkan kategori yang diplih
            $laporan = Transaksi::where('kategori_id',$id_kategori)
            ->whereDate('tanggal','>=',$dari)
            ->whereDate('tanggal','<=',$sampai)
            ->orderBy('id','desc')->get();
        }

        //passing data laporan ke view laporan
        return view('laporan_print',['laporan'=>$laporan,'kategori'=>$kategori]);
    }

    //Export laporan ke excel
    Public function laporan_excel(){
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }


    //Ganti Password
    public function ganti_password(){
        return view('gantipassword');
    }
    //ganti password store
    public function ganti_password_aksi(Request $request){
        //cek current password
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            
            //jika tidak sesuai akan passing keform ganti password dan notif current password salah
            return redirect()->back()->with("error", "Password sekarang tidak sesuai");
        }
        //periksa password baru sama dengan password sekarang 
        if (strcmp($request->get('current-password'), $request->get('new-password'))==0) {
            
            //jika password baru sama password sekarang akan passing ke form ganti password dan notif
            return redirect()->back()->with("error","password baru tidak boleh sama");
        }
        //membuat form validasi
        #password wajib diisi| string min 6 karakter
        #harus sama form konfirmasi password
        $validatedData =$request->validate([
            'current-password'=>'required',
            'new-password'=>'required|string|min:6|confirmed',
        ]);

        //ganti password user yang sedang login dengan password baru
        $user =Auth::user();
        $user->password =bcrypt($request->get('new-password'));
        $user->save();
        //pasing dan notif
        return redirect()->back()->with('sukses',"Password Berhasil dirubah");
    }
}
