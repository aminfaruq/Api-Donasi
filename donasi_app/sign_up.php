<?php

header("Content-Type: application/json; charset=UTF-8");
//memasukkan koneksi database ke sign up
include './config/koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // code...
  if (isset($_POST['nama_user'])  &&
      isset($_POST['email'])      &&
      isset($_POST['jenkel'])     &&
      isset($_POST['no_telp'])    &&
      isset($_POST['username'])   &&
      isset($_POST['password'])) {

   $namauser = $_POST['nama_user'];
   $email    = $_POST['email'];
   $jenkel   = $_POST['jenkel'];
   $notelp   = $_POST['no_telp'];
   $username = $_POST['username'];
   $password = md5($_POST['password']);

   $query = " SELECT * FROM tb_user WHERE username = '$username' ";

   $check = mysqli_fetch_array(mysqli_query($connection, $query));

   if (isset($check)) {
     // code...
     $response['result']  = 0;
     $response['message'] = " username sudah terpakai ";

   }else {

     $query = " INSERT INTO tb_user(
                nama_user,
                email,
                jenkel,
                no_telp,
                username,
                password
                )VALUES (
                '$namauser',
                '$email',
                '$jenkel',
                '$notelp',
                '$username',
                '$password'
              )";

      if (mysqli_query($connection, $query)) {
        // code...
        $response['result']   = 1;
        $response['message']  = " Sign up success";
      }else {
        $response['result']   = 0;
        $response['message']  = " Sign failed ";
      }
   }

   echo json_encode($response);

  }

}else {
  echo "Parameter kurang";
}

?>
