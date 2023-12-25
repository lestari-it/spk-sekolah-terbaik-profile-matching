<?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jumlahAspek = $_POST["jumlah_aspek"];
        $jumlahSekolah = $_POST["jumlah_sekolah"];
        $idAspek = $_POST["id_aspek"];

        $sql2 = "SELECT id_faktor FROM pm_faktor where id_aspek = $idAspek order by id_faktor asc";
        $result2 = mysqli_query($koneksi, $sql2);

        while ($row = mysqli_fetch_assoc($result2)) {
           $idFaktor = $row["id_faktor"];
           $sql_truncate = mysqli_query($koneksi, "DELETE FROM pm_sample where id_faktor = $idFaktor");
        }

        $sql = "SELECT id_sekolah FROM master_sekolah order by id_sekolah asc";
        $result = mysqli_query($koneksi, $sql);

        if($jumlahSekolah == $result->num_rows){
            while ($row = mysqli_fetch_array($result)) {
                foreach($result2 as $row2){
                    $value = $_POST[$row['id_sekolah']."_A".$row2["id_faktor"]];
                    $idFaktor = $row2["id_faktor"];
                    $getBobot = "SELECT target FROM pm_faktor where id_faktor = $idFaktor limit 1";
                    $bobot = mysqli_query($koneksi, $getBobot);
                    $dataBobot = mysqli_fetch_assoc($bobot);
                    $gap = $value - $dataBobot["target"];

                    if($gap == 0){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '5' )");
                    }
                    else if($gap == 1){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '4.5' )");
                    }
                    else if($gap == -1){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '4' )");
                    }
                    else if($gap == 2){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '3.5' )");
                    }
                    else if($gap == -2){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '3' )");
                    }
                    else if($gap == 3){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '2.5' )");
                    }
                    else if($gap == -3){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '2' )");
                    }
                    else if($gap == 4){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '1.5' )");
                    }
                    else if($gap == -4){
                        $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$row["id_sekolah"]."', '".$idAspek."','".$idFaktor."', '". $gap ."', '1' )");
                    }
                    
                    $insertData = mysqli_query($koneksi, "INSERT INTO pm_sample(id_sample, id_sekolah, id_faktor, value) VALUES('', '".$row["id_sekolah"]."', '".$idFaktor."', '". $value ."')");
                }
                echo "<script>alert('Proses Profile Matching Tersimpan');location='home.php?page=profile';</script>";
            }
        }

    } else {
        echo "Form not submitted.";
    }

?>