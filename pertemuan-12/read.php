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

>?php
    echo"<p>Gagal membaca data tamu: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
}   elseif(mysqli_num_rows($q) === 0) {
    echo"<p>Belum ada data yang tersimpan.</p>";
    echo"<p>Data tamu masih kosong.</p>";
}   else {
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Pes
    </tr>
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
           <?php endwhile; ?>
</table>