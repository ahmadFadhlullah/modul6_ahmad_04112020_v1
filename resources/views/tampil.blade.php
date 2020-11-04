@extends('template')
@section('title')
tampil data 
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/tampil.css') }}">
@endsection
@section('content')

<div class="container">
        <div class="item">
            <h2 class="center">Result</h2>
              <span class="center bold"> Nama </span> <span class="left bold">: &nbsp; {{ $nama }}</span>
              <span class="center bold"> Kelahiran </span> <span class="left bold">: &nbsp;  {{ $kelahiran }}</span>
              <span class="center bold"> Pengangkatan </span> <span class="left bold">: &nbsp;  {{ $pengangkatan }}</span>
              <span class="center bold"> Jenis Kelamin </span> <span class="left bold">: &nbsp; {{ $kelamin }}</span>
              <span class="center bold"> Nomor Urut </span> <span class="left bold">: &nbsp; {{ $nomor_urut }}</span>
        </div>
    </div>

@endsection