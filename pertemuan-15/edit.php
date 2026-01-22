<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/*
    Ambil nilai cid dari GET dan lakukan validasi untuk 
    mengecek cid harus angka dan lebih besar dari 0 (> 0).
    'options' => ['min_range' => 1] artinya cid harus ≥ 1 
    (bukan 0, bahkan bukan negatif, bukan huruf, bukan HTML).
  */
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);
/*
    Skrip di atas cara penulisan lamanya adalah:
    $cid = $_GET['cid'] ?? '';
    $cid = (int)$cid;

    Cara lama seperti di atas akan mengambil data mentah 
    kemudian validasi dilakukan secara terpisah, sehingga 
    rawan lupa validasi. Untuk input dari GET atau POST, 
    filter_input() lebih disarankan daripada $_GET atau $_POST.
  */

/*
    Cek apakah $cid bernilai valid:
    Kalau $cid tidak valid, maka jangan lanjutkan proses, 
    kembalikan pengguna ke halaman awal (read.php) sembari 
    mengirim penanda error.
  */
if (!$cid) {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

/*
    Ambil data lama dari DB menggunakan prepared statement, 
    jika ada kesalahan, tampilkan penanda error.
  */
$stmt = mysqli_prepare($conn, "SELECT cid, cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir, chobi, cpasangan, cpekerjaan, cnama_orang_tua, cnama_abang, cnama_adik 
                                    FROM tbl_mahasiswa WHERE cid = ? LIMIT 1");
if (!$stmt) {
  $_SESSION['flash_error_biodata'] = 'Query tidak benar.';
  redirect_ke('read.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_error_biodata'] = 'Record tidak ditemukan.';
  redirect_ke('read.php');
}

#Nilai awal (prefill form)
$nim  = $row['cnim'] ?? '';
$nama_lengkap = $row['cnama_lengkap'] ?? '';
$tempat_lahir = $row['ctempat_lahir'] ?? '';
$tanggal_lahir = $row['ctanggal_lahir'] ?? '';
$hobi = $row['chobi'] ?? '';
$pasangan = $row['cpasangan'] ?? '';
$pekerjaan = $row['cpekerjaan'] ?? '';
$nama_orang_tua = $row['cnama_orang_tua'] ?? '';
$nama_abang = $row['cnama_abang'] ?? '';
$nama_adik = $row['cnama_adik'] ?? '';

#Ambil error dan nilai old input kalau ada
$flash_error = $_SESSION['flash_error'] ?? '';
$old = $_SESSION['old'] ?? [];

unset($_SESSION['flash_error'], $_SESSION['old']);
if (!empty($old)) {
  $nim  = $row['cnim'] ?? '';
  $nama_lengkap = $row['cnama_lengkap'] ?? '';
  $tempat_lahir = $row['ctempat_lahir'] ?? '';
  $tanggal_lahir = $row['ctanggal_lahir'] ?? '';
  $hobi = $row['chobi'] ?? '';
  $pasangan = $row['cpasangan'] ?? '';
  $pekerjaan = $row['cpekerjaan'] ?? '';
  $nama_orang_tua = $row['cnama_orang_tua'] ?? '';
  $nama_abang = $row['cnama_abang'] ?? '';
  $nama_adik = $row['cnama_adik'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Judul Halaman</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Ini Header</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
      &#9776;
    </button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="biodata">
      <h2>Edit Biodata Mahasiswa</h2>
      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
            background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
      <?php endif; ?>
      <form action="proses_update.php" method="POST">
        <input type="hidden" name="cid" value="<?= (int)$cid; ?>">

        <label for="txtNim"><span>NIM:</span>
          <input type="text" id="txtNim" name="txtNim"
            value="<?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtNmLengkap"><span>Nama Lengkap:</span>
          <input type="text" id="txtNmLengkap" name="txtNmLengkap"
            value="<?= htmlspecialchars($nama_lengkap, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtT4Lhr"><span>Tempat Lahir:</span>
          <input type="text" id="txtT4Lhr" name="txtT4Lhr"
            value="<?= htmlspecialchars($tempat_lahir, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtTglLhr"><span>Tanggal Lahir:</span>
          <input type="date" id="txtTglLhr" name="txtTglLhr"
            value="<?= htmlspecialchars($tanggal_lahir, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtHobi"><span>Hobi:</span>
          <input type="text" id="txtHobi" name="txtHobi"
            value="<?= htmlspecialchars($hobi, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtPasangan"><span>Pasangan:</span>
          <input type="text" id="txtPasangan" name="txtPasangan"
            value="<?= htmlspecialchars($pasangan, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtKerja"><span>Pekerjaan:</span>
          <input type="text" id="txtKerja" name="txtKerja"
            value="<?= htmlspecialchars($pekerjaan, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtNmOrtu"><span>Nama Orang Tua:</span>
          <input type="text" id="txtNmOrtu" name="txtNmOrtu"
            value="<?= htmlspecialchars($nama_orang_tua, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtNmAbang"><span>Nama Abang:</span>
          <input type="text" id="txtNmAbang" name="txtNmAbang"
            value="<?= htmlspecialchars($nama_abang, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <label for="txtNmAdik"><span>Nama Adik:</span>
          <input type="text" id="txtNmAdik" name="txtNmAdik"
            value="<?= htmlspecialchars($nama_adik, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
        <a href="read.php" class="reset">Kembali</a>
      </form>
    </section>
  </main>
  
  <script src="script.js"></script>
</body>

</html>