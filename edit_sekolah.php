<div class="container">
		<h2 align="center" style="margin: 30px;">Edit Data Sekolah</h2>
		<?php
			// data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
			$id = stripslashes(strip_tags(htmlspecialchars(base64_decode($_GET['aa']) ,ENT_QUOTES)));

			$query = "SELECT * FROM master_sekolah WHERE id_sekolah=?";
	        $sekolah = $koneksi->prepare($query);
	        $sekolah->bind_param("i", $id);
	        $sekolah->execute();
	        $res1 = $sekolah->get_result();
	        while ($row = $res1->fetch_assoc()) {
	        	$id = $row['id_sekolah'];
	            $nama_sekolah = $row['nama_sekolah'];
	            $no_npsn = $row['no_npsn'];
	            $email = $row['email'];
				$alamat = $row['alamat'];
				$kepala_sekolah = $row['kepala_sekolah'];
	        }
		?>
		<form method="POST" action="edit_sekolah_action.php">
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<div class="form-group">
						<label>Nama Sekolah</label>
						<input type="hidden" name="id_sekolah" id="id_sekolah" value="<?php echo $id; ?>">
						<input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="<?php echo $nama_sekolah; ?>" required="true">
					</div>
					<div class="form-group">
						<label>No NPSN</label>
						<input type="text" name="no_npsn" id="no_npsn" class="form-control" value="<?php echo $no_npsn; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $alamat; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Kepala Sekolah</label>
						<input type="text" name="kepalasekolah" id="kepalasekolah" class="form-control" value="<?php echo $kepala_sekolah; ?>" required="true">
					</div>
					<div class="form-group">
						<button type="submit" name="simpan" id="simpan" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<button type="button" name="simpan" id="simpan" class="btn btn-danger" >
							<a href="home.php?page=sekolah" style="color:white;text-decoration: none; "></i>Batal</a>
						</button>
					</div>
				</div>
			</div>
		</form>
    </div>