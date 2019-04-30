<?php

header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';

//create folder upload
$upload_path = 'uploads/';

$upload_url = 'http://'.$server_ip.'/donasi_app/'.$upload_path;


if (!is_dir($upload_url)) {
  // code...
  mkdir('uploads',0775,true);
}

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // code...
  $iduser        = $_POST['id_user'];
  $juduldonasi   = $_POST['judul_donasi'];
  $descdonasi    = $_POST['desc_donasi'];
  $namauser      = $_POST['nama_user'];
  $inserttime    = $_POST['insert_time'];

  try {
    //Mengambil nama
    $temp  = explode(".", $_FILES['image']['name']);
    //Menggabungkan nama baru dengan extention
    $newfilename = round(microtime(true)) . '.' . end($temp);

    //memasukan file ke dalam folder
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_path . $newfilename);

    $query = "INSERT INTO tb_donasi (
              id_user,
              foto_donasi,
              judul_donasi,
              desc_donasi,
              nama_user,
              insert_time
              ) VALUES (
              '$iduser',
              '$newfilename',
              '$juduldonasi',
              '$descdonasi',
              '$namauser',
              '$inserttime'
            )";

  if (mysqli_query($connection, $query)) {
    // code...
    $response['result']  = 1;
    $response['message'] = 'Upload success !';
    //$response['url']     = $upload_url . $newfilename;
    $response['name']    = $juduldonasi;
  }else {
    $response['result']  = 0;
    $response['message'] = 'Upload failed';
  }


  } catch (Exception $e) {
    $response['result']  = 0;
    $response['message'] = $e -> getMessage();

  }

  echo json_encode($response);

  mysqli_close($connection);


}

?>
