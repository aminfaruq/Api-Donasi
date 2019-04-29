<?php

header("Content-Type: application/json; charset=UTF-8");
// Memasukan koneksi untuk menggunakna connnection
include './config/koneksi.php';

if (isset($_POST['username'])) {
  // code...
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  //create query
  $query = " SELECT * FROM
             tb_user
             WHERE
             username = '$username'
             AND password = '$password'";

  $check = mysqli_query($connection, $query);

  if (!$check) {
    // code...
    echo "Tidak bisa menjalankan query " . mysqli_error($connection);
    exit;
  }

  $row = mysqli_fetch_row($check);

  $result_data = array(
    'id_user'    => $row[0],
    'nama_user'  => $row[1],
    'email'      => $row[2],
    'jenkel'     => $row[3],
    'no_telp'    => $row[4],
    'username'   => $row[5],
    'password'   => $row[6]
  );

  if (mysqli_num_rows($check) > 0) {
    // code...
    $response['result']  = 1;
    $response['message'] = " Login success !";
    $response['data']    = $result_data;
  }else {

    $response['result']  = 0;
    $response['message'] = " Login failed !";
  }

  echo json_encode($response);

}

 ?>
