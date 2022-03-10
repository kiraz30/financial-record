@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pemasukan_hari_ini).",-"}}</h4>
                    <b>Pemasukan hari ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pemasukan_bulan_ini).",-"}}</h4>
                    <b>Pemasukan Bulan ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pemasukan_tahun_ini).",-"}}</h4>
                    <b>Pemasukan Tahun ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card bg-success text-white py-2">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($seluruh_pemasukan).",-"}}</h4>
                    <b>Seluruh Pemasukan</b>
                </div>
            </div>
        </div>

        <!-- pengeluaran ---------------------------------------->
        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pengeluaran_hari_ini).",-"}}</h4>
                    <b>Pengeluaran hari ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pengeluaran_bulan_ini).",-"}}</h4>
                    <b>Pengeluaran Bulan ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($pengeluaran_tahun_ini).",-"}}</h4>
                    <b>Pengeluaran Tahun ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card bg-danger text-white py-2">
                <div class="card-body">
                   <h4>{{"Rp ".number_format($seluruh_pengeluaran).",-"}}</h4>
                    <b>Seluruh Pengeluaran</b>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
