<?php

header("Content-Type: application/json; charset=UTF-8");
//memasukkan koneksi database ke sign up
include './config/koneksi.php';

$upload_path = 'uploads/';

$server_ip = gethostbyname(gethostname());

$upload_url = 'http://'. $server_ip . '/'

//membuat penampung response
$response = array();

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
  // code...
  if (isset($_POST['nama_user']) &&
      isset($_POST['email'])     &&
      isset($_POST['jenkel'])    &&
      isset($_POST['no_telp'])   &&
      isset($_POST['username'])  &&
      isset($_POST['password'])  &&
      isset($_POST['foto_user'])) {
    // code...

    $nama_user = $_POST['nama_user'];
    $email     = $_POST['email'];
    $jenkel    = $_POST['jenkel'];
    $notelp    = $_POST['no_telp'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];

    try {
      //mengambil nama
      $temp = explode('.' , $_FILES['image']['name']);
      //menggabungkan nama baru dengan extensi
      $newfilename = round(microtime(true)) . '.' . end($temp);

      //memasukkan file ke dalam folder
      move_uploaded_file($_FILES['image']['tmp_name'], $upload_path . $newfilename);

      $query = "INSERT INTO tb_user(
                nama_user,
                email,
                jenkel,
                no_telp,
                username,
                password,
                foto_user
      )"

    } catch (\Exception $e) {

    }


  }
}

?>
