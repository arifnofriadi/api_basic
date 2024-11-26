<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: header");

include "koneksi.php";
include "response.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $response = array();
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $fullname = $_POST["fullname"];
    $email    = $_POST["email"];

    $cek = "SELECT * FROM users WHERE username = '$username' || email = '$email'";
    $result = mysqli_fetch_array(mysqli_query($koneksi, $cek));

    if (isset($result)) {
        // $response['value'] = 0;
        // $response['message'] = "Username atau Email telah digunakan";
        // echo json_encode($response);
        sendResponse(false, "Username atau Email telah digunakan");
    } else {
        $insert = "INSERT INTO users (id, username, password, fullname, email, tgl_daftar) VALUES (NULL, '$username', '$password', '$fullname', '$email', NOW())";

        if (mysqli_query($koneksi, $insert)) {
            // $response['value'] = 1;
            // $response['message'] = "Data berhasil didaftarkan";
            // echo json_encode($response);
            sendResponse(true, "Data berhasil didaftarkan");
        } else {
            // $response['value'] = 0;
            // $response['message'] = "Data gagal didaftarkan";
            // echo json_encode($response);
            sendResponse(false, "Data gagal didaftarkan");
        }
    }

}

?>