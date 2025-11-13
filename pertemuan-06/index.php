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
      <p>Ini Contoh Paragraf HTML.</p>
    </section>

    <?php
    $NIM = "2511500044";
    $Nama_lengkap = "Chika Zayin Salsabilla";
    $Tempat_lahir = "Koba";
    $Tanggal_lahir = "10 Mei 2007";
    $Hobby = "Memasak,Membaca Novel";
    $Pasangan = "Single";
    $Pekerjaan = "Belum Ada";
    $Nama_Orang_Tua = "Andri Suryadi Rahmawati";
    $Nama_Abang = "Abi Salam Isnandri";
    $Nama_Adek = "Kinan Arsyifa Salsabilla Airin Nursofia Salsabilla"
    ?>

    <?php
    $namaMatkul1 = "Algoritma dan Struktur Data";
    $sksMatkul1 = 4;
    $nilaiHadir1 = 85;
    $nilaiTugas1 = 70;
    $nilaiUTS1 = 75;
    $nilaiUAS1 = 70;

    $namaMatkul2 = "Agama";
    $sksMatkul2 = 2;
    $nilaiHadir2 = 80;
    $nilaiTugas2 = 75;
    $nilaiUTS2 = 65;
    $nilaiUAS2 = 70;

    $namaMatkul3 = "Aplikasi Perkantoran";
    $sksMatkul3 = 3;
    $nilaiHadir3 = 80;
    $nilaiTugas3 = 70;
    $nilaiUTS3 = 70;
    $nilaiUAS3 = 65;

    $namaMatkul4 = "Kalkulus";
    $sksMatkul4 = 4;
    $nilaiHadir4 = 90;
    $nilaiTugas4 = 75;
    $nilaiUTS4 = 70;
    $nilaiUAS4 = 70;

    $namaMatkul5 = "Pemrograman Web Dasar";
    $sksMatkul5 = 3;
    $nilaiHadir5 = 75;
    $nilaiTugas5 = 73;
    $nilaiUTS5 = 65;
    $nilaiUAS5 = 65;

    $namaMatkul6 = "Bahasa Inggris";
    $sksMatkul6 = 4;
    $nilaiHadir6 = 85;
    $nilaiTugas6 = 70;
    $nilaiUTS6 = 70;
    $nilaiUAS6 = 70;

    function hitungNilai($nama, $sks, $hadir, $tugas, $uts, $uas) {
        $nilaiAkhir = 0.0;
        $grade = "";
        $mutu = 0.00;
        $bobot = 0.00;
        $status = "";

        if ($hadir < 70) {
            $grade = "E";
            $mutu = 0.00;
            $bobot = 0.00;
            $status = "GAGAL";
        } else {
            $nilaiAkhir = (0.1 * $hadir) + (0.2 * $tugas) + (0.3 * $uts) + (0.4 * $uas);

            if ($nilaiAkhir >= 80) {
                $grade = "A";
                $mutu = 4.00;
            } elseif ($nilaiAkhir >= 77.5) {
                $grade = "A-";
                $mutu = 3.70;
            } elseif ($nilaiAkhir >= 75) {
                $grade = "B+";
                $mutu = 3.30;
            } elseif ($nilaiAkhir >= 72.5) {
                $grade = "B";
                $mutu = 3.00;
            } elseif ($nilaiAkhir >= 70) {
                $grade = "B-";
                $mutu = 2.70;
            } elseif ($nilaiAkhir >= 67.5) {
                $grade = "C+";
                $mutu = 2.30;
            } elseif ($nilaiAkhir >= 65) {
                $grade = "C";
                $mutu = 2.00;
            } elseif ($nilaiAkhir >= 62.5) {
                $grade = "C-";
                $mutu = 1.70;
            } elseif ($nilaiAkhir >= 60) {
                $grade = "D";
                $mutu = 1.00;
            } else {
                $grade = "E";
                $mutu = 0.00;
            }

            $bobot = $mutu * $sks;
            $status = ($grade == "D" || $grade == "E") ? "GAGAL" : "LULUS";
        }

        return [
            'nilaiAkhir_num' => $nilaiAkhir,
            'mutu_num' => $mutu,
            'bobot_num' => $bobot,
            // versi tampil
            'nilaiAkhir' => number_format($nilaiAkhir, 2),
            'grade' => $grade,
            'mutu' => number_format($mutu, 2),
            'bobot' => number_format($bobot, 2),
            'status' => $status
        ];
    }

    $hasil1 = hitungNilai($namaMatkul1, $sksMatkul1, $nilaiHadir1, $nilaiTugas1, $nilaiUTS1, $nilaiUAS1);
    $hasil2 = hitungNilai($namaMatkul2, $sksMatkul2, $nilaiHadir2, $nilaiTugas2, $nilaiUTS2, $nilaiUAS2);
    $hasil3 = hitungNilai($namaMatkul3, $sksMatkul3, $nilaiHadir3, $nilaiTugas3, $nilaiUTS3, $nilaiUAS3);
    $hasil4 = hitungNilai($namaMatkul4, $sksMatkul4, $nilaiHadir4, $nilaiTugas4, $nilaiUTS4, $nilaiUAS4);
    $hasil5 = hitungNilai($namaMatkul5, $sksMatkul5, $nilaiHadir5, $nilaiTugas5, $nilaiUTS5, $nilaiUAS5);
    $hasil6 = hitungNilai($namaMatkul6, $sksMatkul6, $nilaiHadir6, $nilaiTugas6, $nilaiUTS6, $nilaiUAS6);

    $totalBobot = $hasil1['bobot_num'] + $hasil2['bobot_num'] + $hasil3['bobot_num'] + $hasil4['bobot_num'] + $hasil5['bobot_num'] + $hasil6['bobot_num'];
    $totalSKS = $sksMatkul1 + $sksMatkul2 + $sksMatkul3 + $sksMatkul4 + $sksMatkul5 + $sksMatkul6;
    $IPK = $totalSKS > 0 ? number_format($totalBobot / $totalSKS, 2) : "0.00";
?>

    <section id="ipk">
      <h2>Nilai Saya</h2>

      <div class="row">
        <div class="label">Nama Matakuliah ke-1 :</div>
        <div class="value"><?php echo $namaMatkul1; ?></div>
      </div>
      <div class="row">
        <div class="label">SKS :</div>
        <div class="value"><?php echo $sksMatkul1; ?></div>
      </div>
      <div class="row">
        <div class="label">Kehadiran :</div>
        <div class="value"><?php echo $nilaiHadir1; ?></div>
      </div>
      <div class="row">
        <div class="label">Tugas :</div>
        <div class="value"><?php echo $nilaiTugas1; ?></div>
      </div>
      <div class="row">
        <div class="label">UTS :</div>
        <div class="value"><?php echo $nilaiUTS1; ?></div>
      </div>
      <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS1; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil1['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value"><?php echo $hasil1['grade']; ?></div>
      </div>
      <div class="row">
        <div class="label">Angka Mutu :</div>
        <div class="value"><?php echo $hasil1['mutu']; ?></div>
      </div>
      <div class="row">
        <div class="label">Bobot :</div>
        <div class="value"><?php echo $hasil1['bobot']; ?></div>
      </div>
      <div class="row">
        <div class="label">Status :</div>
        <div class="value"><?php echo $hasil1['status']; ?></div>
      </div>
      <hr>

      <div class="row">
        <div class="label">Nama Matakuliah ke-2 :</div>
        <div class="value"><?php echo $namaMatkul2; ?></div>
      </div>
      <div class="row">
        <div class="label">SKS :</div>
        <div class="value"><?php echo $sksMatkul2; ?></div>
      </div>
      <div class="row">
        <div class="label">Kehadiran :</div>
        <div class="value"><?php echo $nilaiHadir2; ?></div>
      </div>
      <div class="row">
        <div class="label">Tugas :</div>
        <div class="value"><?php echo $nilaiTugas2; ?></div>
      </div>
      <div class="row">
        <div class="label">UTS :</div>
        <div class="value"><?php echo $nilaiUTS2; ?></div>
      </div>
      <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS2; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil2['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value"><?php echo $hasil2['grade']; ?></div>
      </div>
      <div class="row">
        <div class="label">Angka Mutu :</div>
        <div class="value"><?php echo $hasil2['mutu']; ?></div>
      </div>
      <div class="row">
        <div class="label">Bobot :</div>
        <div class="value"><?php echo $hasil2['bobot']; ?></div>
      </div>
      <div class="row">
        <div class="label">Status :</div>
        <div class="value"><?php echo $hasil2['status']; ?></div>
      </div>
      <hr>

      <div class="row">
        <div class="label">Nama Matakuliah ke-3 :</div>
        <div class="value"><?php echo $namaMatkul3; ?></div>
      </div>
      <div class="row">
        <div class="label">SKS :</div>
        <div class="value"><?php echo $sksMatkul3; ?></div>
      </div>
      <div class="row">
        <div class="label">Kehadiran :</div>
        <div class="value"><?php echo $nilaiHadir3; ?></div>
      </div>
      <div class="row">
        <div class="label">Tugas :</div>
        <div class="value"><?php echo $nilaiTugas3; ?></div>
      </div>
      <div class="row">
        <div class="label">UTS :</div>
        <div class="value"><?php echo $nilaiUTS3; ?></div>
      </div>
      <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS3; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil3['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value"><?php echo $hasil3['grade']; ?></div>
      </div>
      <div class="row">
        <div class="label">Angka Mutu :</div>
        <div class="value"><?php echo $hasil3['mutu']; ?></div>
      </div>
      <div class="row">
        <div class="label">Bobot :</div>
        <div class="value"><?php echo $hasil3['bobot']; ?></div>
      </div>
      <div class="row">
        <div class="label">Status :</div>
        <div class="value"><?php echo $hasil3['status']; ?></div>
      </div>
      <hr>

      <div class="row">
        <div class="label">Nama Matakuliah ke-4 :</div>
        <div class="value"><?php echo $namaMatkul4; ?></div>
      </div>
      <div class="row">
        <div class="label">SKS :</div>
        <div class="value"><?php echo $sksMatkul4; ?></div>
      </div>
      <div class="row">
        <div class="label">Kehadiran :</div>
        <div class="value"><?php echo $nilaiHadir4; ?></div>
      </div>
      <div class="row">
        <div class="label">Tugas :</div>
        <div class="value"><?php echo $nilaiTugas4; ?></div>
      </div>
      <div class="row">
        <div class="label">UTS :</div>
        <div class="value"><?php echo $nilaiUTS4; ?></div>
      </div>
      <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS4; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil4['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value"><?php echo $hasil4['grade']; ?></div>
      </div>
      <div class="row">
        <div class="label">Angka Mutu :</div>
        <div class="value"><?php echo $hasil4['mutu']; ?></div>
      </div>
      <div class="row">
        <div class="label">Bobot :</div>
        <div class="value"><?php echo $hasil4['bobot']; ?></div>
      </div>
      <div class="row">
        <div class="label">Status :</div>
        <div class="value"><?php echo $hasil4['status']; ?></div>
      </div>

      <div class="row">
        <div class="label">Nama Matakuliah ke-5 :</div>
        <div class="value"><?php echo $namaMatkul5; ?></div>
      </div>
      <div class="row">
        <div class="label">SKS :</div>
        <div class="value"><?php echo $sksMatkul5; ?></div>
      </div>
      <div class="row">
        <div class="label">Kehadiran :</div>
        <div class="value"><?php echo $nilaiHadir5; ?></div>
      </div>
      <div class="row">
        <div class="label">Tugas :</div>
        <div class="value"><?php echo $nilaiTugas5; ?></div>
      </div>
      <div class="row">
        <div class="label">UTS :</div>
        <div class="value"><?php echo $nilaiUTS5; ?></div>
      </div>
      <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS5; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil5['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value">
        <div class="row">
        <div class="label">UAS :</div>
        <div class="value"><?php echo $nilaiUAS5; ?></div>
      </div>
      <div class="row">
        <div class="label">Nilai Akhir :</div>
        <div class="value"><?php echo $hasil5['nilaiAkhir']; ?></div>
      </div>
      <div class="row">
        <div class="label">Grade :</div>
        <div class="value"><?php echo $hasil5['grade']; ?></div>
      </div>
      <div class="row">
        <div class="label">Angka Mutu :</div>
        <div class="value"><?php echo $hasil5['mutu']; ?></div>
      </div>
      <div class="row">
        <div class="label">Bobot :</div>
        <div class="value"><?php echo $hasil5['bobot']; ?></div>
      </div>
      <div class="row">
        <div class="label">Status :</div>
        <div class="value"><?php echo $hasil5['status']; ?></div>
      </div>
      <hr>

      <div class="row">
        <div class="label"><strong>Total SKS :</strong></div>
        <div class="value"><strong><?php echo $totalSKS; ?></strong></div>
      </div>
      <div class="row">
        <div class="label"><strong>Total Bobot :</strong></div>
        <div class="value"><strong><?php echo number_format($totalBobot, 2); ?></strong></div>
      </div>
      <div class="row">
        <div class="label"><strong>IPK :</strong></div>
        <div class="value"><strong><?php echo $IPK; ?></strong></div>
      </div>
    </section>

    <section id="about">
      <h2>Kontak Saya</h2>
      <p><strong>NIM:</strong> 2511500044</p>
      <p><strong>Nama Lengkap:</strong> Chika Zayin Salsabilla</p>
      <p><strong>Tempat Lahir:</strong> Koba</p>
      <p><strong>Tanggal Lahir:</strong> 10 Mei 2007</p>
      <p><strong>Hobby:</strong> Memasak,Membaca Novel</p>
      <p><strong>Pasangan:</strong> Single</p>
      <p><strong>Pekerjaan:</strong> Belum Ada</p>
      <p><strong>Nama Orang Tua:</strong> Andri Suryadi Rahmawati</p>
      <p><strong>Nama Abang:</strong> Abi Salam Isnandri</p>
      <p><strong>Nama Adik :</strong> Kinan Arsyifa Salsabilla Airin Nur Sofia Salsbilla</p>
    </section>



    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="" method="GET">
        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 Karakter</small>
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Chika Zayin Salsabilla [2511500044]</p>
  </footer>

  <script src="script.js"></script>
</body>
</html