<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:login.php?error1');
	
} else if (empty($username)) {
	header('location:login.php?error=2');
	
} else if (empty($password)) {
	header('location:login.php?error=3');

}

$q = mysqli_query($koneksi, "select * from karyawan where username='$username' and password='$password'");
$row = mysqli_fetch_array ($q);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['id'] = $row['id'];
	$_SESSION['nik'] = $row['nik'];
	$_SESSION['masuk_kerja'] = $row['masuk_kerja'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['jabatan'] = $row['jabatan'];
    $_SESSION['departemen'] = $row['departmene'];
    $_SESSION['alamat'] = $row['alamat'];
    $_SESSION['no_hp'] = $row['no_hp'];
    $_SESSION['sisa_cuti'] = $row['sisa_cuti'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['kuota_cuti'] = $row['kuota_cuti'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['atasan'] = $row['atasan'];		
    
    if ($_SESSION['level'] == "admin"){
        header('location:admin/index.php');
    } else if ($_SESSION['level'] == "spv"){
        header('location:supervisor/index.php');
    } else if ($_SESSION['level'] == "karyawan")
        header('location:karyawan/index.php');
} else {
	header('location:login.php?error=4');
}
?>