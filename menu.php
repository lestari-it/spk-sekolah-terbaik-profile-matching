<?php
    if( !empty( $_SESSION['id_user'] ) ){
    include "koneksi.php";
?>
<style>
</style>
<!-- Fixed navbar -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <span class="fas fa-home" style="font-size:14px"></span>
              Home <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=sekolah">
              <span class="fas fa-user-friends" style="font-size:14px"></span>
              Data Sekolah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=aspek">
              <span class="fas fa-file" style="font-size:14px"></span>
              Aspek Penilaian
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="?page=kriteria">
              <span class="fas fa-copy" style="font-size:14px"></span>
              Kriteria Penilaian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=subkriteria">
              <span class="fas fa-copy" style="font-size:14px"></span>
              Sub Kriteria Penilaian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=subkriteriaanswer">
              <span class="fas fa-copy" style="font-size:14px"></span>
              Jawaban Sub Kriteria
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=profile">
              <span class="fas fa-sync-alt" style="font-size:14px"></span>
              Proses Profile Matching
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=perhitungan">
              <span class="fas fa-archive" style="font-size:14px"></span>
              Hasil Perhitungan
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="?page=gantipassword">
              <span class="fas fa-lock" style="font-size:14px "></span>
              Ganti Password
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=menubaru">
              <span class="fas fa-lock" style="font-size:14px "></span>
              menu baru
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
<?php
} else {
	header("Location: ./");
	die();
}
?>
