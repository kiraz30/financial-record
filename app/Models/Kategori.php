<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['kategori'];
   //1 kategori bisa memiliki banyak transaksi
   //jadi menggunakan Relasi One to Many
    public function transaksi(){
        return $this->hasMany('App\Mpdels\Transaksi');
    }
}
