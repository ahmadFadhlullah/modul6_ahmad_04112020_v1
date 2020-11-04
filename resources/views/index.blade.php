@extends('template')
@section('title')
Home Page
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
<div class="container">
        <form action="/tampil" method="POST">
            <p><b>Masukkan Nama dan NIP Anda</b></p>
            <input type="hidden" name="_token" value="<?= csrf_token()?>">
            <label for="nama">Nama </label>
            <input type="text" name="nama" id="nama"> <br>
            <label for="nip">NIP</label>
            <input type="number" name="nip" id="nip"> <br>
            <button name="submit">Tampilkan</button>
        </form>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection