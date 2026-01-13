<?php
require 'koneksi.php';

$fieldContact = [
  "nim" => ["label" => "Nim:", "suffix" => ""],
  "nama_lengkap" => ["label" => "Nama_Lengkap:", "suffix" => ""],
  "tempat_lahir" => ["label" => "Tempat_Lahir:", "suffix" => ""],
  "hobi" => ["label" => "Hobi:","suffix" => ""],
  "pasangan" => ["label" => "Pasangan:", "suffix" => ""],
  "pekerjaan" => ["label" => "Pekerjaan:", "suffix" => ""],
  "nama_orang_tua" => ["label" => "Nama_Orang_Tua:", "suffix" => ""],
  "nama_abang" => ["label" => "Nama_Abang:", "suffix" => ""],
  "nama_adik" => ["label" => "Nama_Adik:", "suffix" => ""],
];

$sql = "SELECT * FROM tbl_mahasiswa ORDER BY cid DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
  echo "<p>Gagal membaca data mahasiswa: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
} elseif (mysqli_num_rows($q) === 0) {
  echo "<p>Belum ada data tamu yang tersimpan.</p>";
} else {
  while ($row = mysqli_fetch_assoc($q)) {
    $arrContact = [
      "nim"  => $row["cnim"]  ?? "",
      "nama_lengkap"  => $row["cnama_lengkap"]  ?? "",
      "tempat_lahir" => $row["ctempat_lahir"] ?? "",
      "tanggal_lahir" => $row["ctanggal_lahir"] ?? "",
      "hobi" => $row["chobi"] ?? "",
      "pasangan" => $row["cpasangan"] ?? "",
      "pekerjaan" => $row["cpekerjaan"] ?? "",
      "nama_orang_tua" => $row["cnama_orang_tua"] ?? "",
      "nama_abang" => $row["cnama_abang"] ?? "",
      "nama_adik" => $row["cnama_adik"] ?? "",
    ];
    echo tampilkanBiodata($fieldContact, $arrContact);
  }
}
?>
