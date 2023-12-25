<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_faktor = stripslashes(strip_tags(htmlspecialchars($_POST['id_faktor'] ,ENT_QUOTES)));
	$id_aspek = stripslashes(strip_tags(htmlspecialchars($_POST['id_aspek'] ,ENT_QUOTES)));
	$faktor = stripslashes(strip_tags(htmlspecialchars($_POST['faktor'] ,ENT_QUOTES)));
	$target = stripslashes(strip_tags(htmlspecialchars($_POST['target'] ,ENT_QUOTES)));
    $type = stripslashes(strip_tags(htmlspecialchars($_POST['type'] ,ENT_QUOTES)));

	$query = "UPDATE pm_faktor SET id_aspek=?, faktor=?, target=?, type=? WHERE id_faktor=?";
    $kriteria = $koneksi->prepare($query);
    $kriteria->bind_param("ssssi", $id_aspek, $faktor, $target, $type, $id_faktor);
    
    if ($kriteria->execute()) {
    	echo "<script>alert('Data Berhasil Diubah');location='home.php?page=kriteria';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$db1->close();
?>