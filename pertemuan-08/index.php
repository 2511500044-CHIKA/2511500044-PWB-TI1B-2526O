<?php
session_start();

$$sesnama  = $_SESSION["sesnama"]  ?? "";
$sesemail = $_SESSION["sesemail"] ?? "";
$sespesan = $_SESSION["sespesan"] ?? "";
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
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nim            = $_POST["nim"];
      $nama_lengkap   = $_POST["nama"];
      $tempat_lahir   = $_POST["tempat_lahir"];
      $tanggal_lahir  = $_POST["tanggal_lahir"];
      $hobi           = $_POST["hobi"];
      $pasangan       = $_POST["pasangan"];
      $pekerjaan      = $_POST["pekerjaan"];
      $nama_ortu      = $_POST["nama_ortu"];
      $nama_kakak     = $_POST["nama_kakak"];
      $nama_adik      = $_POST["nama_adik"];

      $_SESSION["nim"]           = $nim;
      $_SESSION["nama_lengkap"]  = $nama_lengkap;
      $_SESSION["tempat_lahir"]  = $tempat_lahir;
      $_SESSION["tanggal_lahir"] = $tanggal_lahir;
      $_SESSION["hobi"]          = $hobi;
      $_SESSION["pasangan"]      = $pasangan;
      $_SESSION["pekerjaan"]     = $pekerjaan;
      $_SESSION["nama_ortu"]     = $nama_ortu;
      $_SESSION["nama_kakak"]    = $nama_kakak;
      $_SESSION["nama_adik"]     = $nama_adik;

      header("Location: index.php#about");
      exit;
    }
    ?>
    <section id="Data mahasiswa">
      <h2>Entry Data Mahasiswa</h2>
      <form action="proses_entry.php" method="POST">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>

        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>

        <label for="tempat_lahir">Tempat Lahir:</label>
        <input type="text" id="tempat_lahir" name="tempat_lahir" required>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

        <label for="hobi">Hobi:</label>
        <input type="text" id="hobi" name="hobi">

        <label for="pasangan">Pasangan:</label>
        <input type="text" id="pasangan" name="pasangan">

        <label for="pekerjaan">Pekerjaan:</label>
        <input type="text" id="pekerjaan" name="pekerjaan">

        <label for="nama_ortu">Nama Orang Tua:</label>
        <input type="text" id="nama_ortu" name="nama_ortu">

        <label for="nama_kakak">Nama Kakak:</label>
        <input type="text" id="nama_kakak" name="nama_kakak">

        <label for="nama_adik">Nama Adik:</label>
        <input type="text" id="nama_adik" name="nama_adik">

        <div class="button-group">
          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </div>
      </form>
    </section>

    <section id="about">
      <?php
      $NIM = "2511500044";
      $Nama_lengkap = "Chika Zayin Salsabilla";
      $Tempat_lahir = "Koba";
      $Tanggal_lahir = "10 Mei 2007";
      $Hobby = "Memasak,Membaca Novel";
      $Pasangan = " Alhamdulillah Masi Jomblo";
      $Pekerjaan = "Belum Ada";
      $Nama_Orang_Tua = "Andri Suryadi Dan RahmaWati";
      $Nama_Abang = "Abi Salam Isnandri";
      $Nama_Adek = "Kinan Arsyifa Salsabilla Dan Airin Nursofia Salsabilla";
      ?>

      <section id="about">
        <h2>Tentang Saya</h2>
        <p><strong>NIM:</strong> <?php echo $NIM; ?></p>
        <p><strong>Nama Lengkap:</strong> <?php echo $Nama_lengkap; ?></p>
        <p><strong>Tempat Lahir:</strong> <?php echo $Tempat_lahir; ?></p>
        <p><strong>Tanggal Lahir:</strong> <?php echo $Tanggal_lahir; ?></p>
        <p><strong>Hobi:</strong> <?php echo $Hobby; ?></p>
        <p><strong>Pasangan:</strong> <?php echo $Pasangan; ?></p>
        <p><strong>Pekerjaan:</strong> <?php echo $Pekerjaan; ?></p>
        <p><strong>Nama Orang Tua:</strong> <?php echo $Nama_Orang_Tua; ?></p>
        <p><strong>Nama Abang:</strong> <?php echo $Nama_Abang; ?></p>
        <p><strong>Nama Adek:</strong> <?php echo $Nama_Adek; ?></p>
      </section>

      <section id="contact">
        <h2>Kontak Kami</h2>
        <form action="proses.php" method="POST">

          <label for="txtNama"><span>Nama:</span>
            <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
          </label>

          <label for="txtEmail"><span>Email:</span>
            <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
          </label>

          <label for="txtPesan"><span>Pesan Anda:</span>
            <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
            <small id="charCount">0/200 karakter</small>
          </label>


          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </form>

        <?php if (!empty($sesnama)): ?>
          <br>
          <hr>
          <h2>Yang menghubungi kami</h2>
          <p><strong>Nama :</strong> <?php echo $sesnama ?></p>
          <p><strong>Email :</strong> <?php echo $sesemail ?></p>
          <p><strong>Pesan :</strong> <?php echo $sespesan ?></p>
        <?php endif; ?>



      </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>