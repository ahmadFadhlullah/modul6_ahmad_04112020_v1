const input = document.getElementById("nip");
input.addEventListener("focusout", function(){
    const jumlah_karakter = this.value ;
    if(jumlah_karakter.length > 18 || jumlah_karakter.length < 18){
        alert("Batas maksimal NIP adalah 18 angka!");
    }
});