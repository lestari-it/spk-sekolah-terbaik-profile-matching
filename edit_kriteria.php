<div class="container">
		<h2 align="center" style="margin: 30px;">Edit Data Kriteria</h2>
		<?php
			// data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
			$id = stripslashes(strip_tags(htmlspecialchars(base64_decode($_GET['aa']) ,ENT_QUOTES)));

			$query = "SELECT * FROM pm_faktor WHERE id_faktor=?";
	        $Kriteria = $koneksi->prepare($query);
	        $Kriteria->bind_param("i", $id);
	        $Kriteria->execute();
	        $res1 = $Kriteria->get_result();
	        while ($row = $res1->fetch_assoc()) {
	        	$id = $row['id_faktor'];
	            $id_aspek = $row['id_aspek'];
	            $faktor = $row['faktor'];
	            $target = $row['target'];
	            $type = $row['type'];
	        }
		?>
		<form method="POST" action="edit_kriteria_action.php">
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<div class="form-group">
						<label>Aspek Penilaian</label>
						<input type="hidden" name="id_faktor" id="id_faktor" value="<?php echo $id; ?>">
						<select name="id_aspek" id="id_aspek" class="form-control" required="true">
						<?php
							include 'koneksi.php';

							$sql = "SELECT id_aspek, aspek FROM pm_aspek order by id_aspek asc";
            				$result = mysqli_query($koneksi, $sql);

							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row["id_aspek"] . '"';
									if ($id_aspek == $row["id_aspek"]) {
										echo ' selected="selected"';
									}
									echo '>' . $row["aspek"] . '</option>';
								}
							} else {
								echo "<option value=''>No options available</option>";
							}

							$koneksi->close();
							?>
						</select>
					</div>
					<div class="form-group">
						<label>faktor</label>
						<input type="text" name="faktor" id="faktor" class="form-control" value="<?php echo $faktor; ?>" required="true">
					</div>
					<div class="form-group">
						<label>Target</label>
						<select name="target" id="target" class="form-control" required="true">
							<option value="1" <?php if ($target == "1"){ echo "selected"; } ?>>Sangat Kurang</option>
							<option value="2" <?php if ($target == "2"){ echo "selected"; } ?>>Kurang</option>
							<option value="3" <?php if ($target == "3"){ echo "selected"; } ?>>Cukup</option>
							<option value="4" <?php if ($target == "4"){ echo "selected"; } ?>>Baik</option>
							<option value="5" <?php if ($target == "5"){ echo "selected"; } ?>>Sangat Baik</option>
						</select>
					</div>
					<div class="form-group">
						<label>Type</label>
						<select name="type" id="type" class="form-control" required="true">
							<option value="core" <?php if ($type == "core"){ echo "selected"; } ?>>Core Factor</option>
							<option value="secondary" <?php if ($type == "secondary"){ echo "selected"; } ?>>Secondary Factor</option>
							
						</select>
					</div>
					<div class="form-group">
						<button type="submit" name="simpan" id="simpan" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<button type="button" name="simpan" id="simpan" class="btn btn-danger" >
							<a href="home.php?page=kriteria" style="color:white;text-decoration: none; "></i>Batal</a>
						</button>
					</div>
				</div>
			</div>
		</form>
    </div>