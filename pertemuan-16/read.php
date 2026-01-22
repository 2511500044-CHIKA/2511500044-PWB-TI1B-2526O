<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
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
    <th>Kode_Pengunjung</th>
    <th>Nama_Pengunjung</th>
    <th>Alamat_Rumah</th>
    <th>Tanggal_Kunjungan</th>
    <th>Hobi</th>
    <th>Asal_SLTA</th>
    <th>Pekerjaan</th>
    <th>Nama_Orang_Tua</th>
    <th>Nama_Pacar</th>
    <th>Nama_Mantan</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <?php
    $cid                          = $row['cid']                        ?? 0;
    $cidkode_pengunjung           = $row['ckode_pengunjung']           ?? '';
    $cidnama_pengunjung           = $row['cnama_pengunjung']           ?? '';
    $cidalamat_rumah              = $row['calamat_rumah']              ?? '';
    $cidtanggal_kunjungan         = $row['ctanggal_kunjungan']         ?? '';
    $cidhobi                      = $row['chobi']                      ?? '';
    $cidasal_slta                 = $row['casal_slta']                 ?? '';
    $cidpekerjaan                 = $row['cpekerjaan']                 ?? '';
    $cidnama_orang_tua            = $row['cnama_orang_tua']            ?? '';
    $cidnama_pacar                = $row['cnama_pacar']                ?? '';
    $cidnama_mantan               = $row['cnama_mantan']               ?? '';
    ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit.php?cid=<?= (int)$row['cid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['cnama']); ?>?')" href="proses_delete.php?cid=<?= (int)$row['cid']; ?>">Delete</a>
      </td>
      <td><?= $row['cid']; ?></td>
      <td><?= htmlspecialchars($row['ckode_pengunjung']); ?></td>
      <td><?= htmlspecialchars($row['cnama_prngunjung']); ?></td>
      <td><?= nl2br(htmlspecialchars($row['calamat_pengunjung'])); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['ctanggal_kunjungan'])); ?></td>
      <td><?= htmlspecialchars($row['chobi']); ?></td>
      <td><?= htmlspecialchars($row['casal_slta']); ?></td>
      <td><?= htmlspecialchars($row['cpekerjaan']); ?></td>
      <td><?= htmlspecialchars($row['cnama_orang_tua']); ?></td>
      <td><?= htmlspecialchars($row['cnama_pacar']); ?></td>
      <td><?= htmlspecialchars($row['cnama_mantan']); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['dcreated_at'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>