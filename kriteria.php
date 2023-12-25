<div class="container">
		<a href="home.php?page=tambah_kriteria">
			<button style="margin-bottom: 20px;" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </button>
		</a>

		<table id="example" class="table table-striped table-bordered" style="width:100%">
	    	<thead>
	    		<tr>
	    			<td>No</td>
	    			<td>Aspek</td>
	    			<td>Kriteria</td>
	    			<td>Target</td>
	    			<td>Type</td>
	    			<td>Action</td>
	    		</tr>
	    	</thead>
	    	<tbody>
				<?php
			        $no = 1;
			        $query = "SELECT * FROM pm_faktor a LEFT join pm_aspek b on a.id_aspek = b.id_aspek ORDER BY a.id_aspek ASC";
			        $pm_faktor = $koneksi->prepare($query);
			        $pm_faktor->execute();
			        $res1 = $pm_faktor->get_result();

			        if ($res1->num_rows > 0) {
				        while ($row = $res1->fetch_assoc()) {
				        	$id = $row['id_faktor'];
				        	$aspek = $row['aspek'];
				            $faktor = $row['faktor'];
				            $target = $row['target'];
				            $type = $row['type'];
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $aspek; ?></td>
						<td><?php echo $faktor; ?></td>
						<td><?php echo $target; ?></td>
						<td><?php echo $type; ?></td>
						<td>
							<!-- base64_encode berguna untuk enkripsi id jadi nanti akan mengubah urlnya menjadi tulisan acak -->
							<a href="home.php?page=edit_kriteria&aa=<?php echo base64_encode($id) ?>">
								<button class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> Edit </button>
							</a>
							<a href="hapus_kriteria.php?aa=<?php echo base64_encode($id) ?>" onclick="javascript: return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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