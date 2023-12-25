<div class="container">
		<h2 align="center" style="margin: 30px;">Menu Baru</h2>
		<?php
			// data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
            include "koneksi.php";

			$query = "SELECT * FROM table_baru";
	        $sekolah = $koneksi->prepare($query);
	        $sekolah->execute();
	        $res1 = $sekolah->get_result();
	        while ($row = $res1->fetch_assoc()) {
	        	$id = $row['id_sekolah'];
	            $kepala_sekolah = $row['kepala_sekolah'];
	            $wakil_kepala_sekolah = $row['wakil_kepala_sekolah'];
	        }
		?>
		<form method="POST" action="edit_sekolah_action.php">
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<div class="form-group">
						<label>Kepala Sekolah</label>
						<input type="hidden" name="id_sekolah" id="id_sekolah" value="<?php echo $id; ?>">
						<input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="<?php echo $kepala_sekolah; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Wakil Kepala Sekolah</label>
						<input type="text" name="no_npsn" id="no_npsn" class="form-control" value="<?php echo $wakil_kepala_sekolah; ?>" required="true">
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