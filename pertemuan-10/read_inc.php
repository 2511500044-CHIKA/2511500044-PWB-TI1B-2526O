<?php
require 'koneksi.php';

$fieldconfig = [
    "nama"  => ["label" => "Nama:","suffix" => ""],
    "email" => ["label" => "Email:", "suffix" => ""],
    "pesan" => ["label" => "Pesan Anda:", "suffix" => ""]
];

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q   = mysqli_query($conn, $sql);
if (!$q) {
    echo"<p>Gagal membaca data tamu: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
}   elseif(mysqli_num_rows($q) === 0) {
    echo"<p>Belum ada data yang tersimpan.</p>";
    echo"<p>Data tamu masih kosong.</p>";
}   else {
    while ($row = mysqli_fetch_assoc($q)) {
        $arrContac = [
            "nama"  => $row["cnama"] ?? "",
            "email" => $row["cemail"] ?? "",
            "pesan" => $row["cpesan"] ?? "",
        ];
        echo tampilkanBiodata($fieldconfig, $arrContac);
    }
}
?>
