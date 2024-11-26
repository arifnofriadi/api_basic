<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: header");

include "koneksi.php";
include "response.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM users";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        sendResponse(true, "Berhasil menampilkan seluruh data users", $data);
    } else {
        sendResponse(false, "Data users tidak tersedia");
    }

} else if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $id = $_POST['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        sendResponse(true, "Berhasil menampilkan data users", $data);
    } else {
        sendResponse(false, "Data users tidak tersedia");
    }

 } else {
    sendResponse(false, "Method tidak diizinkan");
 }

?>