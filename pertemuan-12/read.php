<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q   = mysqli_query($conn, $sql);
if (!$q) {
    die("Query Error: " . mysqli_error($conn));
 }
?>

<?php
    $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
    $flash_eror  = $_SESSION['flash_error'] ?? ''; #jika query eror
    #bersihkan session ini 
    unset($_SESSION['flash_sukses'], $_SESSION['flash_error']);
?>

<?php if (!empty($flash_sukses)): ?>
    <div style="padding:10px; margin-bottom: 10px;
    background:#d4edda; color:#721c24; border-radius:6px; 
    <?= $flash_sukses; ?>
    </div>
<?php endif; ?>

<?php if (!empty($flash_eror)): ?>
    <div style="padding:10px; margin-bottom: 10px;
    baground:#f8d7da; color:#721c24; border-radius:6px; 
    <?= $flash_eror; ?>
    </div>
   
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Created At</th>
</th>

<?php $i = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($q)): ?>
        <tr>
           <td><?= $i++; ?></td>
           <td><a href="edit.php?cid=<?= (int)$row['cid']; ?>">Edit</a><  
           <td><?= $row['cid']; ?></td>
           <td><?= htmlspecialchars($row['cnama']); ?></td>
           <td><?= htmlspecialchars($row['cemail']); ?></td>
           <td><?= htmlspecialchars($row['cpesan']); ?></td>
           <td><?= formatTanggal(htmlspecialchars($row['created_at'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>