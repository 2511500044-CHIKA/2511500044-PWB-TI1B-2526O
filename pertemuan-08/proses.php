<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nim = $_POST["txtNim"];
  $_SESSION["nim"] = $nim;
  $_SESSION["nama"] = $_POST["txtNama"];
  $_SESSION["tempat"] = $_POST["txtTempat"];
  $_SESSION["tanggal"] = $_POST["txtTanggal"];
  $_SESSION["hobi"] = $_POST["txtHobi"];
  $_SESSION["pasangan"] = $_POST["txtPasangan"];
  $_SESSION["pekerjaan"] = $_POST["txtPekerjaan"];
  $_SESSION["ortu"] = $_POST["txtOrtu"];
  $_SESSION["kakak"] = $_POST["txtKakak"];
  $_SESSION["adik"] = $_POST["txtAdik"];
}

header("Location: index.php#about");
exit;
?>