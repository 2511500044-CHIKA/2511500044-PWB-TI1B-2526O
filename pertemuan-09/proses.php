<?php
session_start();
$arrKontak =[
"nama" => $_POST["txtNama"] ?? "",
"email" => $_POST["txtEmail"] ?? "",
"pesan" => $_POST["txtPesan"] ?? "",
];

$_SESSION["Kontak"] = $arrKontak;

$arrBiodata = [
"nim" => $_POST["txtNim"] ?? "",
"nama" => $_POST["txtNmLengkap"] ?? "",
"tempat" => $_POST["txtT4Lhr"] ?? "",
"tanggal" => $_POST["txtTglLhr"] ?? "",
"hobi" => $_POST["txtHobi"] ?? "",
"pasangan" => $_POST["txtPasangan"] ??"",
"kerja" => $_POST["txtKerja"] ?? "",
"ortu" => $_POST["txtNmOrtu"] ?? "",
"kakak" => $_POST["txtNmKakak"] ?? "",
"adik" => $_POST["txtNmAdik"] ?? "",
];

$_SESSION["biodata"] = $arrBiodata;
header("location: index.php");
?>
