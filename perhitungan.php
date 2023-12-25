
<link href="css/perhitungan.css" rel="stylesheet">

<div class="container">
<div class="panel panel-primary">
<div class="panel-heading"><strong>PERHITUNGAN</strong></div>
<div class="panel-body" style=" border: 1px solid #e7e7e7;">
<div class="panel panel-default">
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Sekolah</th>
                    <th>Aspek</th>
                    <th>Rata-Rata Kriteria Core</th>
                    <th>Rata-Rata Kriteria Secondary</th>
                    <th>Total Nilai Kriteria Core & Secondary</th>
                    <th>Total Nilai Aspek Berdasarkan Persentase</th>
                  </tr>
                  <?php
                    $query = "SELECT ms.nama_sekolah, pek.aspek, pa.id_aspek,ms.id_sekolah,
                    (SELECT AVG(pasq.nilai_gap) 
                    FROM perhitungan_aspek pasq 
                    LEFT JOIN pm_faktor pfrsq ON pfrsq.id_faktor = pasq.id_faktor 
                    WHERE pasq.id_sekolah = pa.id_sekolah 
                    and pasq.id_aspek = pa.id_aspek and pfrsq.type = 'secondary') as 'rata_rata_secondary', 
                    (SELECT AVG(pasq.nilai_gap) FROM perhitungan_aspek pasq 
                    LEFT JOIN pm_faktor pfrsq ON pfrsq.id_faktor = pasq.id_faktor 
                    WHERE pasq.id_sekolah = pa.id_sekolah 
                    and pasq.id_aspek = pa.id_aspek and pfrsq.type = 'core') as 'rata_rata_core',
                    ROUND(((0.4 * (SELECT AVG(pasq.nilai_gap) 
                    FROM perhitungan_aspek pasq 
                    LEFT JOIN pm_faktor pfrsq ON pfrsq.id_faktor = pasq.id_faktor 
                    WHERE pasq.id_sekolah = pa.id_sekolah and pasq.id_aspek = pa.id_aspek and pfrsq.type = 'secondary'))
                     + (0.6 * (SELECT AVG(pasq.nilai_gap) FROM perhitungan_aspek pasq LEFT JOIN pm_faktor pfrsq ON pfrsq.id_faktor = pasq.id_faktor 
                     WHERE pasq.id_sekolah = pa.id_sekolah and pasq.id_aspek = pa.id_aspek and pfrsq.type = 'core'))),1) as 'total_nilai'
                    FROM `perhitungan_aspek` pa 
                    LEFT JOIN master_sekolah ms on ms.id_sekolah = pa.id_sekolah 
                    LEFT JOIN pm_aspek pek on pek.id_aspek = pa.id_aspek 
                    LEFT JOIN pm_faktor pfr on pfr.id_faktor = pa.id_faktor 
                    GROUP BY pa.id_aspek,pa.id_sekolah 
                    ORDER BY pa.id_sekolah,pa.id_aspek ASC";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td><?php echo $row['nama_sekolah'];?></td>
                    <td>
                      <?php echo $row['aspek'];?>

                    </td>
                    <td>
                      <?php echo $row['rata_rata_core'];?>
                    </td>
                    <td>
                        <?php echo $row['rata_rata_secondary'];?>
                    </td>
                    <td>
                       <?php echo $row['total_nilai'];?>
                    </td>
                    <td>
                      <?php
                         $id_aspek = $row['id_aspek'];
                         $query_get_aspek = "SELECT id_aspek, aspek, persentase 
                         FROM pm_aspek where id_aspek = $id_aspek order by id_aspek asc";
                         $sql_get_aspek = mysqli_query($koneksi, $query_get_aspek);
                         $result_get_asepek = mysqli_fetch_assoc($sql_get_aspek);
             
                         echo $result_get_asepek['persentase'] / 100 * $row['total_nilai']; 
                      ?>
                    </td>
                  </tr>
                  <?php
                    }
                  } else {
                    echo "<td>Tidak ada data ditemukan</td>";
                  }
                  ?>
</table>
</div>
<div class='container'>
<a href="process_ranking.php">
			<button style="margin-bottom: 20px; margin-top: 20px;" class="btn btn-primary"> Hitung Ranking </button>
</a>
<a href="hitung_ulang.php">
			<button style="margin-bottom: 20px; margin-top: 20px;" class="btn btn-success"> Hitung Ulang </button>
</a>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
       $("#btnPrint").click(function() {

       //var doc = new jsPDF();
       var divContents = $("#cetak").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();

    });
    </script>