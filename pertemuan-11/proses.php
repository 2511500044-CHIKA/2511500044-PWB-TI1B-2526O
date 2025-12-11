<?php
session_start();
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#contact');
}
$arrContact = [
  "nama" => $_POST["txtNama"] ?? "",
  "email" => $_POST["txtEmail"] ?? "",
  "pesan" => $_POST["txtPesan"] ?? ""
];
$_SESSION["contact"] = $arrContact;

$nama = bersihkan($_POST['txtNama'] ?? '');
$email = bersihkan($_POST['txtEmail'] ?? '');
$pesan = bersihkan($_POST['txtPesan'] ?? '');

#Validasi sederhana 
$errors = []; #ini array untuk menampung semua eror yang ada

if ($nama ===  '') {
    $errors[] = 'Nama wajib diisi.';
}

if ($email === '') {
    $errors[] = 'Email wajib diisi.';
    
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

if ($pesan === '') {
    $errors[] = 'Pesan wajib diisi.';
}

/*
kondisi dibawah ini hanya dikerjakan jika ada eror, 
simpan nilai lama dan pesan eror, lalu redirect
(komsep PRG)
*/
if (!empty($errors)) {
    $_SESSION['old'] = [
      "nama" => $nama,
      "email" => $email,
      "pesan" => $pesan
    ];
    
    $_SESSION['flash_error'] = implode('<br>', $errors);  
    redirect_ke('index.php#contact');
}
 #menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_tamu (cnama, cemail, cpesan) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($stmt, "sss", $nama, $email, $pesan);

if (!$stmt) {
    #jika gagal prepare, kirim pesan eror ke pengguna (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('index.php#contact');
}
#bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);

if (!mysqli_stmt_execute($stmt)) { #Jika berhasil, kosongkan old value, beri pesan sukses
    unset($_SESSION['old']);
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah tersimpan.';
    redirect_ke('index.php#contact'); #pola PRG: kembali ke from / halaman home 
} else { # jika gagal, simpan kembali old value dan tempilkan eror umum 
    $_SESSION['old'] = [
        "nama" => $nama,
        "email" => $email,
        "pesan" => $pesan
        ];
    $_SESSION['flash_error'] = 'Data gagal disimpan. Silahkan coba lagi.';
    redirect_ke('index.php#contact');
}
#tutup statement
mysqli_stmt_close($stmt);    

$arrBiodata = [
  "nim" => $_POST["txtNim"] ?? "",
  "nama" => $_POST["txtNmLengkap"] ?? "",
  "tempat" => $_POST["txtT4Lhr"] ?? "",
  "tanggal" => $_POST["txtTglLhr"] ?? "",
  "hobi" => $_POST["txtHobi"] ?? "",
  "pasangan" => $_POST["txtPasangan"] ?? "",
  "pekerjaan" => $_POST["txtKerja"] ?? "",
  "ortu" => $_POST["txtNmOrtu"] ?? "",
  "kakak" => $_POST["txtNmKakak"] ?? "",
  "adik" => $_POST["txtNmAdik"] ?? ""
];

$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about");
