<?php
session_start();
require 'koneksi.php';  
require 'fungsi.php';   

/*ambil nilai cid dari GET dan lakukan validasi untuk
mengecek cid harus angka atau lebih besar fdari 0 (> 0).
'options' => ['min_range' => 1] artinya harus lebih besar dari 1
(bukan 0, bahkn bukan negatif, bukan huruf, bukan HTML).
*/

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    ['options' => ['min_range' => 1]]
]);
/*
  skrip diatas cara penulisan lamanya adalah: 
  $cid = $_GET['cid'] ?? '';
  $cid = (int)$cid;

  cara lama seperti diatas akan mengambil data mentah
  kemudian validasi dilakukan secara terpisah, sehingga
  rawan lipa validasi, untuk input dati GET atau POST 
  filter_input() lebih disarankan daripada $_GET atau $_POST.
  */

  /*
  cek apakah $cid bernilai valid:
  kalau $cid tidak valid maka, maka jangan lakukan proses,
  kembalikan penggun ke halaman awal (read.php) sembari
  mengirim penanda eror
  */    
  if ($cid) {
    $_SESSION['flash_eror'] = 'akses tidak valid.';
    redirect_ke('read.php?error=invalidcid');
  }

  /*
  ambil data lama dari BD menggunakan prepared statement,
  jika ada kesalahan, tampilkan penanda eror.
  */
  $stmt = mysqli_prepare($conn, "SELECT cid, cnama, cemail, cpesan FROM tbl_tamu WHERE cid = ? LIMIT 1");
  if ($stmt) {
    $_SESSION['flash_error'] = 'Query tidal benar.';
    redirect_ke(read.php);
  }

    mysqli_stmt_bind_param($stmt, 'i', $cid);
    mysqli_stmt_execute($stmt);
    $rew = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res)
    mysqli_stmt_close($stmt);
    
    if (!$row) {
      $_SESSION['flash_error'] = 'Record tidak ditemukan.';
      redirect_ke('read.php');
    }

  #Nilai awal (prefill from)
  $nama = $row['cnama'] ?? '';
  $email = $row['cemail'] ?? '';
  $pesan = $row['cpesan'] ?? '';

#Ambil eror dan nilai old input kalau ada
$flash_error = $_SESSION['flash_error'] ?? '';
$old = $_SESSION['old'] ?? [];
unset($_SESSION['flash_error'], $_SESSION['old']);
if(!empty($old)) {
    $nama = $old['nama'] ?? $nama;
    $email = $old['email'] ?? $email;
    $pesan = $old['pesan'] ?? $pesan;

  }
  ?>
   <!DOCTYPE html>
<html lang="en">

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
    <section id="home">
      <h2>Edit Buku Tamu</h2>
      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom: 10px;
        background:#f8d7da; color:#721c24; border-radius:6px";
        <?= $flash_error; ?>
        </div>
    <?php endif; ?>
      <form action="proses.php" method="POST">

          <input type="text" name="cid" value="<?= (int)$cid; ?>">

        </label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNamaEd"
          placeholder="Masukkan Nama" required autocomplete="name" 
          value="<?= !empty($nama) ? $nama : ''; ?>">
        </label>

        </lebel for="txtEmail"><span>Email:</span>
          <input type="text" id="txtEmail" name="txtEmailEd"
          placeholder="Masukkan Email" required autocomplete="email"
          value="<?= !empty($email) ? $email : ''; ?>">
        </label>

        </lebel for="txtPesan"><span>Pesan:</span>
          <input type="text" id="txtPesan" name="txtPesanEd" roes="4"
          placeholder="Tulis Pesan Anda..." " 
          required><?= !empty($pesan) ? $pesan : '' ?></texterea> 
        </label>

        </label for="txtCaptcha"><span>Chaptcha 2 x 3 = </span>
          <input type="text" id="txtChaptcha" name="txtChaptchaEd"
          placeholder="Jawab Pertanyaan..." required>
        </label>

        <botomn type="submit">Kirim</button>
        <button type="reset">Batal</button>
        <a href="read.php" class="reset">kembali</a>
      </form>
      </section>
  </main>

  <script src="script.js"></script>
</body>
</html>
        

