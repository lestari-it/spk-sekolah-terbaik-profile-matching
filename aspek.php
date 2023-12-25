<div class="container">
		<a href="home.php?page=tambah_aspek">
			<button style="margin-bottom: 20px;" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </button>
		</a>

		<table id="example" class="table table-striped table-bordered" style="width:100%">
	    	<thead>
	    		<tr>
	    			<td>No</td>
	    			<td>Aspek Penilaian</td>
	    			<td>Persentase</td>
	    			<td>Core Factor</td>
	    			<td>Secondary Factor</td>
	    			<td>Action</td>
	    		</tr>
	    	</thead>
	    	<tbody>
				<?php
			        $no = 1;
			        $query = "SELECT * FROM pm_aspek ORDER BY id_aspek ASC";
			        $aspek_penilaian = $koneksi->prepare($query);
			        $aspek_penilaian->execute();
			        $res1 = $aspek_penilaian->get_result();

			        if ($res1->num_rows > 0) {
				        while ($row = $res1->fetch_assoc()) {
				        	$id = $row['id_aspek'];
				            $aspek = $row['aspek'];
				            $prosentase = $row['persentase'];
				            $bobot_core = $row['bobot_core'];
				            $bobot_secondary = $row['bobot_secondary'];
				            
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $aspek; ?></td>
						<td><?php echo $prosentase; ?></td>
						<td><?php echo $bobot_core; ?></td>
						<td><?php echo $bobot_secondary; ?></td>
						<td>
							<!-- base64_encode berguna untuk enkripsi id jadi nanti akan mengubah urlnya menjadi tulisan acak -->
							<a href="home.php?page=edit_aspek&aa=<?php echo base64_encode($id) ?>">
								<button class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> Edit </button>
							</a>
							<a href="hapus_aspek.php?aa=<?php echo base64_encode($id) ?>" onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">
								<button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus </button>
							</a>
						</td>
					</tr>
			    <?php } } else { ?> 
				    <tr>
				    	<td colspan='7'>Tidak ada data ditemukan</td>
				    </tr>
			    <?php } ?>
	    	</tbody>
	    </table>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>