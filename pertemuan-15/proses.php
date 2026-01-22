<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# Cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
    redirect_ke('index.php#biodata');
}

# Ambil dan bersihkan nilai dari form
$nim            = bersihkan($_POST['txtNim']        ?? '');
$nama_lengkap   = bersihkan($_POST['txtNmLengkap']  ?? '');
$tempat_lahir   = bersihkan($_POST['txtT4Lhr']      ?? '');
$tanggal_lahir  = bersihkan($_POST['txtTglLhr']     ?? '');
$hobi           = bersihkan($_POST['txtHobi']       ?? '');
$pasangan       = bersihkan($_POST['txtPasangan']   ?? '');
$pekerjaan      = bersihkan($_POST['txtKerja']      ?? '');
$nama_orang_tua = bersihkan($_POST['txtNmOrtu']     ?? '');
$nama_abang     = bersihkan($_POST['txtNmAbang']    ?? '');
$nama_adik      = bersihkan($_POST['txtNmAdik']     ?? '');

# Validasi sederhana
$errors = [];

if ($nim === '') {
    $errors[] = 'NIM wajib diisi.';
}
if ($nama_lengkap === '') {
    $errors[] = 'Nama wajib diisi.';
}
if ($tempat_lahir === '') {
    $errors[] = 'Tempat lahir wajib diisi.';
}
if ($tanggal_lahir === '') {
    $errors[] = 'Tanggal lahir wajib diisi.';
}
if ($hobi === '') {
    $errors[] = 'Hobi wajib diisi.';
}
if ($pasangan === '') {
    $errors[] = 'Pasangan wajib diisi.';
}
if ($pekerjaan === '') {
    $errors[] = 'Pekerjaan wajib diisi.';
}
if ($nama_orang_tua === '') {
    $errors[] = 'Nama orang tua wajib diisi.';
}
if ($nama_abang === '') {
    $errors[] = 'Nama abang wajib diisi.';
}
if ($nama_adik === '') {
    $errors[] = 'Nama adik wajib diisi.';
}

# Jika ada error, simpan nilai lama & pesan error lalu redirect
if (!empty($errors)) {
    $_SESSION['old'] = [
        'nim'            => $nim,
        'nama_lengkap'   => $nama_lengkap,
        'tempat_lahir'   => $tempat_lahir,
        'tanggal_lahir'  => $tanggal_lahir,
        'hobi'           => $hobi,
        'pasangan'       => $pasangan,
        'pekerjaan'      => $pekerjaan,
        'nama_orang_tua' => $nama_orang_tua,
        'nama_abang'     => $nama_abang,
        'nama_adik'      => $nama_adik,
    ];

    $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
    redirect_ke('index.php#biodata');
}

# Menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_mahasiswa
        (cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir, chobi,
         cpasangan, cpekerjaan, cnama_orang_tua, cnama_abang, cnama_adik)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

# Ganti $conn dengan nama variabel koneksi yang benar dari koneksi.php
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('index.php#biodata');
}

# Bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param( $stmt,"ssssssssss",$nim,$nama_lengkap,$tempat_lahir,$tanggal_lahir,$hobi,$pasangan,$pekerjaan,$nama_orang_tua,$nama_abang,$nama_adik
);

if (mysqli_stmt_execute($stmt)) {
    # Simpan biodata ke session untuk ditampilkan di index.php
    $_SESSION['biodata'] = [
        "nim"     => $nim,
        "nama"    => $nama_lengkap,
        "tempat"  => $tempat_lahir,
        "tanggal" => $tanggal_lahir,
        "hobi"    => $hobi,
        "pasangan" => $pasangan,
        "pekerjaan" => $pekerjaan,
        "ortu"    => $nama_orang_tua,
        "abang"   => $nama_abang,
        "adik"    => $nama_adik,
    ];

    unset($_SESSION['old']);
    $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah tersimpan.';
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['old'] = [
        'nim'            => $nim,
        'nama_lengkap'   => $nama_lengkap,
        'tempat_lahir'   => $tempat_lahir,
        'tanggal_lahir'  => $tanggal_lahir,
        'hobi'           => $hobi,
        'pasangan'       => $pasangan,
        'pekerjaan'      => $pekerjaan,
        'nama_orang_tua' => $nama_orang_tua,
        'nama_abang'     => $nama_abang,
        'nama_adik'      => $nama_adik,
    ];

    $_SESSION['flash_error_biodata'] = 'Data gagal disimpan. Silakan coba lagi.';
    redirect_ke('index.php#biodata');
}

#tutup statement
mysqli_stmt_close($stmt);

$biodata = [
    "nim" => $_POST["txtNim"] ?? "",
    "nama" => $_POST["txtNmLengkap"] ?? "",
    "tempat" => $_POST["txtT4Lhr"] ?? "",
    "tanggal" => $_POST["txtTglLhr"] ?? "",
    "hobi" => $_POST["txtHobi"] ?? "",
    "pasangan" => $_POST["txtPasangan"] ?? "",
    "pekerjaan" => $_POST["txtKerja"] ?? "",
    "ortu" => $_POST["txtNmOrtu"] ?? "",
    "abang" => $_POST["txtNmAbang"] ?? "",
    "adik" => $_POST["txtNmAdik"] ?? ""
];
$_SESSION["biodata"] = $biodata;

header("location: index.php#about");
