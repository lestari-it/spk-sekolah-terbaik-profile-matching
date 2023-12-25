<div class="container">
		<h2 align="center" style="margin: 30px;">Edit Data Kriteria</h2>
		<?php
			// data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
			$id = stripslashes(strip_tags(htmlspecialchars(base64_decode($_GET['aa']) ,ENT_QUOTES)));

			$query = "SELECT * FROM pm_subfaktor WHERE id=?";
	        $Kriteria = $koneksi->prepare($query);
	        $Kriteria->bind_param("i", $id);
	        $Kriteria->execute();
	        $res1 = $Kriteria->get_result();
	        while ($row = $res1->fetch_assoc()) {
	        	$id = $row['id'];
	            $id_faktor = $row['id_faktor'];
	            $nama = $row['nama'];
	        }
		?>
		<form method="POST" action="edit_subkriteria_action.php">
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<div class="form-group">
						<label>Kriteria</label>
						<input type="hidden" name="id_subkriteria" id="id_subkriteria" value="<?php echo $id; ?>">
						<select name="id_faktor" id="id_faktor" class="form-control" required="true">
						<?php
							include 'koneksi.php';

							$sql = "SELECT id_faktor, faktor FROM pm_faktor order by id_faktor asc";
            				$result = mysqli_query($koneksi, $sql);

							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row["id_faktor"] . '"';
									if ($id_faktor == $row["id_faktor"]) {
										echo ' selected="selected"';
									}
									echo '>' . $row["faktor"] . '</option>';
								}
							} else {
								echo "<option value=''>No options available</option>";
							}

							$koneksi->close();
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Sub Kriteria</label>
						<input type="text" name="subkriteria" id="subkriteria" class="form-control" value="<?php echo $nama; ?>" required="true">
					</div>
					<div class="form-group">
						<button type="submit" name="simpan" id="simpan" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<button type="button" name="simpan" id="simpan" class="btn btn-danger" >
							<a href="home.php?page=subkriteria" style="color:white;text-decoration: none; "></i>Batal</a>
						</button>
					</div>
				</div>
			</div>
		</form>
    </div>