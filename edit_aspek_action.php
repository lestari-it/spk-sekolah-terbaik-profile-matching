<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_aspek = stripslashes(strip_tags(htmlspecialchars($_POST['id_aspek'] ,ENT_QUOTES)));
	$aspek = stripslashes(strip_tags(htmlspecialchars($_POST['aspek'] ,ENT_QUOTES)));
	$prosentase = stripslashes(strip_tags(htmlspecialchars($_POST['prosentase'] ,ENT_QUOTES)));
	$bobot_core = stripslashes(strip_tags(htmlspecialchars($_POST['bobot_core'] ,ENT_QUOTES)));
    $bobot_secondary = stripslashes(strip_tags(htmlspecialchars($_POST['bobot_secondary'] ,ENT_QUOTES)));

	$query = "UPDATE pm_aspek SET aspek=?, prosentase=?, bobot_core=?, bobot_secondary=? WHERE id_aspek=?";
    $aspek_penilaian = $koneksi->prepare($query);
    $aspek_penilaian->bind_param("ssssi", $aspek, $prosentase, $bobot_core, $bobot_secondary, $id_aspek);
    
    if ($aspek_penilaian->execute()) {
    	echo "<script>alert('Data Berhasil Diubah');location='home.php?page=aspek';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$db1->close();
?>