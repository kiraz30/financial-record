@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ganti Password</div>

                <div class="card-body">
                    <!-- Notiffication -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('sukses'))
                    <div class="alert alert-success">
                        {{ session('sukses') }}
                    </div>
                    @endif
                    <!-- Notiffication-->

                    <form action="{{url('ganti_password/aksi')}}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Masukan Password Sekarang</label>
                        <input type="password" placeholder="*********" name="current-password" class="form-control" required>

                        @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{$errors->first('current-password')}}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Masukan Password Baru</label>
                        <input type="password" placeholder="*********" name="new-password" class="form-control" required>

                        @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{$errors->first('new-password')}}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" placeholder="*********" name="new-password_confirmation" class="form-control" required>
                    </div>
                    <br>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </div>


                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
