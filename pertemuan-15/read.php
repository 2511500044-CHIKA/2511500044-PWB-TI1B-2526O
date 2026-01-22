<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$sql = "SELECT * FROM tbl_mahasiswa ORDER BY cid DESC";
$q   = mysqli_query($conn, $sql);
if (!$q) {
  die("Query error: " . mysqli_error($conn));
}

$flash_sukses = $_SESSION['flash_sukses'] ?? '';
$flash_error  = $_SESSION['flash_error']  ?? '';
unset($_SESSION['flash_sukses'], $_SESSION['flash_error']);
?>

<?php if (!empty($flash_sukses)): ?>
  <div style="padding:10px; margin-bottom:10px;
         background:#d4edda; color:#155724; border-radius:6px;">
    <?= $flash_sukses; ?>
  </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
  <div style="padding:10px; margin-bottom:10px;
         background:#f8d7da; color:#721c24; border-radius:6px;">
    <?= $flash_error; ?>
  </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>NIM</th>
    <th>Nama Lengkap</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Hobi</th>
    <th>Pasangan</th>
    <th>Pekerjaan</th>
    <th>Nama Orang Tua</th>
    <th>Nama Abang</th>
    <th>Nama Adik</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <?php
    $cid            = $row['cid']             ?? 0;
    $nim            = $row['cnim']            ?? '';
    $nama_lengkap   = $row['cnama_lengkap']   ?? '';
    $tempat_lahir   = $row['ctempat_lahir']   ?? '';
    $tgl_lahir      = $row['ctanggal_lahir']  ?? '';
    $hobi           = $row['chobi']           ?? '';
    $pasangan       = $row['cpasangan']       ?? '';
    $pekerjaan      = $row['cpekerjaan']      ?? '';
    $nama_orang_tua = $row['cnama_orang_tua'] ?? '';
    $nama_abang     = $row['cnama_abang']     ?? '';
    $nama_adik      = $row['cnama_adik']      ?? '';
    $created_at     = $row['dcreated_at']     ?? '';
    ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit.php?cid=<?= (int)$cid; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($nama_lengkap, ENT_QUOTES, 'UTF-8'); ?>?')"
          href="proses_delete.php?cid=<?= (int)$cid; ?>">Delete</a>
      </td>
      <td><?= (int)$cid; ?></td>
      <td><?= htmlspecialchars($nama_lengkap, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($tempat_lahir, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars(formatTanggal($tgl_lahir), ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($hobi, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($pasangan, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($pekerjaan, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_orang_tua, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_abang, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_adik, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars(formatTanggal($created_at), ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
  <?php endwhile; ?>
</table>
<br><br>

<?php
$sql_tamu = "SELECT cid, cnama, cemail, cpesan, dcreated_at
             FROM tbl_tamu
             ORDER BY cid DESC";
$q_tamu = mysqli_query($conn, $sql_tamu);
if (!$q_tamu) {
  die("Query tamu error: " . mysqli_error($conn));
}
?>

<table border="1" cellpadding="8" cellspacing="4">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Created At</th>
  </tr>
  <?php $j = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q_tamu)): ?>
    <tr>
      <td><?= $j++ ?></td>
      <td>
        <a href="edit_tamu.php?id=<?= (int)$row['cid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['cnama'], ENT_QUOTES, 'UTF-8'); ?>?')"
          href="proses_delete_tamu.php?id=<?= (int)$row['cid']; ?>">Delete</a>
      </td>
      <td><?= (int)$row['cid']; ?></td>
      <td><?= htmlspecialchars($row['cnama'], ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($row['cemail'], ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($row['cpesan'], ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($row['dcreated_at'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
  <?php endwhile; ?>
</table>