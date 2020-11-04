<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Proses extends Controller
{
    // sebuah property yang berfungsi untuk menampung data untuk ditampilkan sebagai result
    public $informasi = [];

    // method yang menangani ketika tombol submit pada halaman index ditekan
    public function form(Request $request) {
        $nama = $request->input('nama');
        $nip = $request->input('nip');
        $jumlah_karakter = strlen($nip);

        if($jumlah_karakter > 18 || $jumlah_karakter < 18){
            // menjalankan method MessageError ketika karakter kurang atau lebih dari 18 karakter
            $this->MessageError("Jumlah karakter melebihi 18 karakter");
        } else {
            // memecah string NIP menjadi array yang kemudian setiap return akan menjadi argument bagi method lainnya sampai final
            $result = $this->PecahString($nip);
            $kelahiran = $this->FormatKelahiran($result["kelahiran"]);
            $pengangkatan = $this->FormatPengangkatan($result["pengangkatan"]);
            $kelamin = $this->FormatKelamin($result["kelamin"]);
            
            // membungkus semua return method kedalam sebuah array associative
            $keys = ["nama","kelahiran","pengangkatan","kelamin","nomor_urut"];
            $items = [$nama,$kelahiran,$pengangkatan,$kelamin,$result["nomor_urut"]];
            for($id = 0; $id < count($keys); $id++){
                $this->informasi[$keys[$id]] = $items[$id];
            }
            // membungkus masing masing isi array ke dalam variable untuk dimasukkan ke dalam array kembali
            // hal ini dilakukan untuk mempermudah pembacaan kode
            $nama = $this->informasi['nama'];
            $format_kelahiran = implode("-",$this->informasi["kelahiran"]);
            $format_pengangkatan = implode("-",$this->informasi["pengangkatan"]);
            $gender = $this->informasi["kelamin"];
            $no_urut = $this->informasi["nomor_urut"];
            //mereturn ke tampilan.php
            return view('tampil',['nama'=>$nama,'kelahiran'=>$format_kelahiran,'pengangkatan'=>$format_pengangkatan,'kelamin'=>$gender,'nomor_urut'=>$no_urut]);

        }
    }

    // Method untuk menampilkan error
    public function MessageError($error){
        // memberikan template htmnl untuk menampilkan error, sayangnya tidak dikembangkan lagi tampilannya
        $template = "<div class='error'><i>$error<i></div>";
        echo "$template";
    }

    // method untuk memecah string dari NIP menjadi beberapa bagian untuk setelah nya di lempar ke method lain
    public function PecahString($string){
        $kelahiran = substr($string,0,8);
        $pengangkatan = substr($string,8,6);
        $kelamin = substr($string,14,1);
        $no_urut = substr($string,15,3);
        // mengembalikan nilai dalam bentuk array associative
        return ["kelahiran"=>"$kelahiran", "pengangkatan"=>"$pengangkatan", "kelamin"=>"$kelamin", "nomor_urut"=>"$no_urut"];
    }

    // method FormatKelahiran untuk membalikkan format inputan dari yy-mm-dd menjadi dd-mm-yy
    public function FormatKelahiran($kelahiran){
        $tahun = substr($kelahiran,0,4);
        $bulan = substr($kelahiran,4,2);
        $tanggal = substr($kelahiran,6,2);
        return ["tanggal"=>"$tanggal","bulan"=>"$bulan","tahun"=>"$tahun"];
    }

    // method FormatPengangkatan untuk mengembalikan format inputan , persis yang dilakukan method FormatKelahiran
    public function FormatPengangkatan($pengangkatan){
        $tahun = substr($pengangkatan,0,4);
        $bulan = substr($pengangkatan,4,2);
        return ["bulan"=>"$bulan","tahun"=>"$tahun"];
    }
    
    // FormatKelamin untuk memberikan nilai string dari string angka yang diinput user pada input NIP
    public function FormatKelamin($kelamin){
        // jika string angka 1 maka dia laki - laki
        if($kelamin == "1"){
            return "Laki - Laki";
        } else if($kelamin == "2"){
            // sebaliknya jika angka 2 maka dia perempuan
            return "Perempuan";
        } else {
            // else digunakan agar ketika user salah menginput misal : 3 maka akan menampilkan pesan dibawah ini
            return "Tidak Terdefinisi";
        }
    }


}
