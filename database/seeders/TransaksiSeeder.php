<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//fungsi DB
use Illuminate\Support\Facades\DB;
//fungsi faker
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //bahasa faker
        $faker =Faker::create('id_ID');

        //Setting banyknya data fake dummy
        for ($i=1; $i <= 20; $i++) { 
            
            //data dummy
            $tgl_hari_ini = date('Y-m-d');
            $jenis = $faker->randomElement(["Pemasukan","Pengeluaran"]);
            //kategori berdasarkan data table kategori id
            $kategori =$faker->randomElement(["1","2","6"]);
            $nominal =$faker->randomElement([
                "100000",
                "200000",
                "300000",
                "400000",
                "500000",
                "750000",
                "1000000",
                "1500000"
            ]);
            $keterangan="";

            //inset data
        DB::table('transaksi')->insert([
            'tanggal'=>$tgl_hari_ini,
            'jenis'=>$jenis,
            'kategori_id'=>$kategori,
            'nominal'=>$nominal,
            'keterangan'=>$keterangan
        ]);
        }

    }
}
