<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

#validasi cid wajib angka dan > 0
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_eror_biodata'] = 'CID Tidak Valid.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}

#ambil dan bersihkan (sanitasi) nilai dari form
$Nim = bersihkan($_POST['txtNimEd'] ?? '');
$Nama_lengkap  = bersihkan($_POST['txtNamaLengkapEd']  ?? '');
$Tempat_lahir = bersihkan($_POST['txtTempatLahirEd'] ?? '');
$Tanggal_lahir = bersihkan($_POST['txtTanggalLahir'] ?? '');
$Hobi = bersihkan($_POST['txtHobiEd'] ?? '');
$pasangan = bersihkan($_POST['txPpasanganEd'] ?? '');
$Pekerjaan = bersihkan($_POST['txPekerjaanEd'] ?? '');
$Nama_Orang_Tua = bersihkan($_POST['txtNamaOrangTuaEd'] ?? '');
$Nama_Adek = bersihkan($_POST['txtNamaAdikEd'] ?? '');
$Nama_Abang = bersihkan($_POST['txtNamaAbangEd'] ?? '');

#Validasi sederhana
$errors = []; #ini array untuk menampung semua error yang ada

if ($nim === '') {
  $errors[] = 'Nim wajib diisi.';
}

if ($nama === '') {
  $errors[] = ' Nama wajib diisi.';
}

if ($Tempat_Lahir === '') {
  $errors[] = 'Tempat Lahir wajib diisi.';
}

if ($Hobi === '') {
  $errors[] = 'Hobi wajib diisi.';
}

if ($Pasangan === '') {
  $errors[] = 'Pasangan wajib diisi.';
}

if ($Pekerjaan === '') {
  $errors[] = 'Pekerjaan wajib diisi.';
}

if ($Nama_Orang_Tua === '') {
  $errors[] = 'Nama Orang Tua wajib diisi.';
}
if ($Nama_Abang === '') {
  $errors[] = 'Nama Abang wajib diisi.';
}

if ($Nama_Adik === '') {
  $errors[] = 'Nama Adik wajib diisi.';
}

/*
  kondisi di bawah ini hanya dikerjakan jika ada error, 
  simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
  */
if (!empty($errors)) {
  $_SESSION['old'] = [
    'nim' => $nim,
    'nama_lengkap' =>$nama_lengkap,
    'tempat_lahir' =>$tempat_lahir,
    'tanggal_lahir' =>$tanggal_lahir,
    'hobi' =>$hobi,
    'pasangan' =>$pasangan,
    'pekerjaan' =>$pekerjaan,
    'nama_orang_tua' =>$nama_orang_tua, 
    'Nama_Abang' =>$nama_abang,
    'Nama_Adik' =>$nama_adik,
  ];

  $_SESSION['flash_eror_biodata'] = implode('<br>', $errors);
  redirect_ke('edit.php?cid=' . (int)$cid);
}

/*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE cid = ?)
  */
$stmt = mysqli_prepare($conn, "UPDATE tbl_mahasiswa SET cnim = ?, cnama = ?, ctempat_lahir = ? , ctanggal_lahir = ?, chobi = ?, cpasangan = ?, cpekerjaan = ?, cnama_orang_tua = ?, cnama_abang = ?, cnama_adik = ? 
                                WHERE cid = ?");
if (!$stmt) {
  #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
  $_SESSION['flash_eror_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('edit.php?cid=' . (int)$cid);
}

#bind parameter dan eksekusi (s = string, i = integer)
mysqli_stmt_bind_param($stmt, "ssssssssssi",$nim, $nama, $tempat_lahir, $tanggal_lahir, $hobi, $pasangan, $pekerjaan, 
                                            $nama_orang_tua, $nama_abang, $nama_adik, $cid);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
  unset($_SESSION['old']);
  /*
      Redirect balik ke read.php dan tampilkan info sukses.
    */
  $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah diperbaharui.';
  redirect_ke('read.php'); #pola PRG: kembali ke data dan exit()
} else { #jika gagal, simpan kembali old value dan tampilkan error umum
  $_SESSION['old'] = [
    'nim' => $nim,
    'nama_lengkap' =>$nama_lengkap,
    'tempat_lahir' =>$tempat_lahir,
    'tanggal_lahir' =>$tanggal_lahir,
    'hobi' =>$hobi,
    'pasangan' =>$pasangan,
    'pekerjaan' =>$pekerjaan,
    'nama_orang_tua' =>$nama_orang_tua, 
    'Nama_Abang' =>$nama_abang,
    'Nama_Adik' =>$nama_adik,
  ];
  $_SESSION['flash_error_biodata'] = 'Data gagal diperbaharui. Silakan coba lagi.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}
#tutup statement
mysqli_stmt_close($stmt);

redirect_ke('edit.php?cid=' . (int)$cid);