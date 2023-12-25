<?php
include 'koneksi.php';

if (isset($_GET['aa'])) {
    // data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
	$id = stripslashes(strip_tags(htmlspecialchars( base64_decode($_GET['aa']) ,ENT_QUOTES)));

	$query = "DELETE FROM pm_aspek WHERE id_aspek=?";
    $aspek_penilaian = $koneksi->prepare($query);
    $aspek_penilaian->bind_param("i", $id);
    
    if ($aspek_penilaian->execute()) {
    	echo "<script>alert('Data Berhasil Dihapus');location='home.php?page=aspek';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$koneksi->close();
?>