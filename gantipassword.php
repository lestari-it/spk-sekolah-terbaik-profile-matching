
    <?php
    // session_start();
    include "koneksi.php";
    if (isset( $_SESSION['id_user'])) {
        $username =  $_SESSION['nama'];
        $id_user= $_SESSION['id_user'];
    }
    else {
    die ("Error. No ID Selected! ");    
    }
    //proses ganti password
    if (isset($_POST['Ganti'])) {
    $username        = $_POST['username'];
    $password_lama    = $_POST['password_lama'];
    $password_baru    = $_POST['password_baru'];
    $konf_password    = $_POST['konf_password'];
    //cek old password
    $query = "SELECT * FROM master_user WHERE id_user='$id_user' AND password=MD5('$password_lama')";
    $sql = mysqli_query($koneksi,$query);
    $hasil = mysqli_num_rows($sql);
    if (! $hasil >= 1) {
        ?>
            <script language="JavaScript">
            alert('Password lama tidak sesuai!, silahkan ulang kembali!');
            document.location='home.php?page=gantipassword';
            </script>
        <?php
            unset($_SESSION['id_user']);
            unset($_SESSION['nama']);
            session_destroy();
    }
    //validasi data data kosong
    else if (empty($_POST['password_baru']) || empty($_POST['konf_password'])) {
            echo "<h3><font color=red>Ganti Password Gagal! Data Tidak Boleh Kosong.</font></h3>";    
    }
    //validasi input konfirm password
    else if (($_POST['password_baru']) != ($_POST['konf_password'])) {
            echo "<h3><font color=red><center>Ganti Password Gagal! Password dan Konfirm Password Harus Sama.</center></font></h3>";    
    }
    else {
    //update data
    $query = "UPDATE master_user SET password=MD5('$password_baru') WHERE id_user='$id_user'";
    $sql = mysqli_query ($koneksi,$query);
    //setelah berhasil update
    if ($sql) {
        echo "<h3><font color=#8BB2D9><center>Ganti Password Berhasil!</center></font></h3>";    
    } else {
        echo "<h3><font color=red><center>Ganti Password Gagal!</center></font></h3>";    
    }
    }
    }
?>
<div class="container">

<form action="#" method="POST" name="form-ganti-password" enctype="multipart/form-data">
	<div class="row">
		<div class="col-sm-6 offset-sm-3">
		    
		            <div class="form-group">
		            <!-- <label>Username : <?=$username?></label> -->
		            
		            <input type="hidden" name="username" id="username" value="<?=$username?>">
		        	</div>
		        	<div class="form-group">
		        		<label>Password Lama</label>
		        		<input type="password" name="password_lama" id="password_lama" size="30" maxlength="20" class="form-control" required="true">
		        	</div>
		           	<div class="form-group">
		           		<label>Password Baru</label>
		           		<input type="password" name="password_baru" id="password_baru" size="30" maxlength="20" class="form-control" required="true">
		           	</div>
		           	<div class="form-group">
		           		<label>Konfirm Password Baru</label>
		           		<input type="password" name="konf_password" id="konf_password" size="30" maxlength="20" class="form-control" required="true">
		           	</div>
		      		<div class="form-group">
		      			<button type="submit" name="Ganti" id="Ganti" class="btn btn-primary">
							<i class="fa fa-save"></i> Update
						</button>
		      		</div>
</form>
</div>
<?php
    // mysqli_close($Open);
?>