<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_subkriteria = stripslashes(strip_tags(htmlspecialchars($_POST['id_subkriteria'] ,ENT_QUOTES)));
	$id_faktor = stripslashes(strip_tags(htmlspecialchars($_POST['id_faktor'] ,ENT_QUOTES)));
	$subkriteria = stripslashes(strip_tags(htmlspecialchars($_POST['subkriteria'] ,ENT_QUOTES)));

	$query = "UPDATE pm_subfaktor SET id_faktor=?, nama=? WHERE id=?";
    $kriteria = $koneksi->prepare($query);
    $kriteria->bind_param("ssi", $id_faktor, $subkriteria, $id_subkriteria);
    
    if ($kriteria->execute()) {
    	echo "<script>alert('Data Berhasil Diubah');location='home.php?page=subkriteria';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$db1->close();
?>