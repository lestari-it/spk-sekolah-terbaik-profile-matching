<div class="container">
		<h2 align="center" style="margin: 30px;">Edit Data Aspek</h2>
		<?php
			// data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
			$id = stripslashes(strip_tags(htmlspecialchars(base64_decode($_GET['aa']) ,ENT_QUOTES)));

			$query = "SELECT * FROM pm_aspek WHERE id_aspek=?";
	        $aspek_penilaian = $koneksi->prepare($query);
	        $aspek_penilaian->bind_param("i", $id);
	        $aspek_penilaian->execute();
	        $res1 = $aspek_penilaian->get_result();
	        while ($row = $res1->fetch_assoc()) {
	        	$id = $row['id_aspek'];
	            $aspek = $row['aspek'];
	            $prosentase = $row['persentase'];
	            $bobot_core = $row['bobot_core'];
	            $bobot_secondary = $row['bobot_secondary'];
	        }
		?>
		<form method="POST" action="edit_aspek_action.php">
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<div class="form-group">
						<label>Aspek</label>
						<input type="hidden" name="id_aspek" id="id_aspek" value="<?php echo $id; ?>">
						<input type="text" name="aspek" id="aspek" class="form-control" value="<?php echo $aspek; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Persentase</label>
						<input type="text" name="prosentase" id="prosentase" class="form-control" value="<?php echo $prosentase; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Core Factor</label>
						<input type="text" name="bobot_core" id="bobot_core" class="form-control" value="<?php echo $bobot_core; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Secondary Factor</label>
						<input type="text" name="bobot_secondary" id="bobot_secondary" class="form-control" value="<?php echo $bobot_secondary; ?>" required="true">
					</div>
					<div class="form-group">
						<button type="submit" name="simpan" id="simpan" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<button type="button" name="simpan" id="simpan" class="btn btn-danger" >
							<a href="home.php?page=aspek" style="color:white;text-decoration: none; "></i>Batal</a>
						</button>
					</div>
				</div>
			</div>
		</form>
    </div>