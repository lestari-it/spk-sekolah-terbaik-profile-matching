<?php
    include 'koneksi.php';

    $querySekolah = "SELECT * from master_sekolah";
    $resultSekolah = mysqli_query($koneksi, $querySekolah);

    while ($row = mysqli_fetch_array($resultSekolah)){
        $idSekolah = $row['id_sekolah'];

        $queryFaktor = "SELECT * from pm_faktor order by id_faktor";
        $resultFaktor = mysqli_query($koneksi,$queryFaktor);

        while ($row = mysqli_fetch_array($resultFaktor)){
            $idFaktor = $row['id_faktor'];

            $querySubfaktor = "SELECT * from pm_subfaktor where id_faktor = $idFaktor order by id_faktor asc";
            $resultSubFaktor = mysqli_query($koneksi,$querySubfaktor);
            $jumlahSubkriteria = $resultSubFaktor->num_rows;

            $nilaiTertinggi = $jumlahSubkriteria * 5;
            $nilaiTerendah = $nilaiTertinggi / 5;
            $totalNilai = 0;
            $value = 0;

            while ($row = mysqli_fetch_array($resultSubFaktor)){
                $idSubfaktor =  $row['id'];
                
                $queryNilaiSubkriteria = "SELECT * from pm_subkriteria_answer where id_sekolah = $idSekolah and id_subfaktor = $idSubfaktor order by id_sekolah asc";
                $resultNilaiiSubKriteria = mysqli_query($koneksi, $queryNilaiSubkriteria);

                while ($row = mysqli_fetch_array($resultNilaiiSubKriteria)){
                    $totalNilai = $totalNilai + $row['answer'];

                }
            }

            if($totalNilai <= $nilaiTerendah * 1){
                    $value = 1;
                }

            if($totalNilai <= $nilaiTerendah * 2
                && $totalNilai > $nilaiTerendah * 1){
                $value = 2;
            }

            if($totalNilai <= $nilaiTerendah * 3 
                && $totalNilai > $nilaiTerendah * 2)
            {
                $value = 3;
            }

            if($totalNilai <= $nilaiTerendah * 4
                && $totalNilai > $nilaiTerendah * 3){
                $value = 4;
            }

            if($totalNilai <= $nilaiTerendah * 5
                && $totalNilai > $nilaiTerendah * 4){
                $value = 5;
            }

            $getBobot = "SELECT id_aspek,target FROM pm_faktor where id_faktor = $idFaktor limit 1";
            $bobot = mysqli_query($koneksi, $getBobot);
            $dataBobot = mysqli_fetch_assoc($bobot);
            $gap = $value - $dataBobot["target"];

            $query2 = "SELECT selisih,bobot from pm_bobot";
            $result2 = mysqli_query($koneksi, $query2);

            while ($row = mysqli_fetch_array($result2)) {
                if($row['selisih'] == $gap)
                {
                    $sql_truncate = mysqli_query($koneksi, "DELETE FROM perhitungan_aspek where id_faktor = $idFaktor and id_sekolah = $idSekolah");

                    $insertDataPerhitungan = mysqli_query($koneksi, "INSERT INTO perhitungan_aspek(id, id_sekolah, id_aspek,id_faktor, gap, nilai_gap)
                        VALUES('', '".$idSekolah."', '".$dataBobot["id_aspek"]."','".$idFaktor."', '". $gap ."', '". $row['bobot'] ."' )");

                    $insertData = mysqli_query($koneksi, "INSERT INTO pm_sample(id_sample, id_sekolah, id_faktor, value) VALUES('', '".$idSekolah."', '".$idFaktor."', '". $value ."')");
                }
            }

        }

    }

    echo "<script>alert('Berhasil hitung ulang');location='home.php?page=perhitungan';</script>";

?>