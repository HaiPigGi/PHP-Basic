<?php
$conn=mysqli_connect("localhost","root","","todo_db");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$error = "";
$message = "";
function Registrasi ($data) {
    global $conn;

    $username=strtolower(stripslashes($data["username"]));
    $password=mysqli_real_escape_string($conn,$data["password"]);
    
    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        $error = "Username dan password tidak boleh kosong";
        echo "<script> 
        alert ('$error') </script>";
        return false;
    }
    
    //cek username
    $result=mysqli_query($conn,"SELECT user_name FROM users WHERE user_name= '$username'");
    
    if (mysqli_fetch_assoc($result)) {
        $error = "Username sudah digunakan";
        echo "<script> 
        alert ('$error') </script>";
        return false;
    } 

    //enkripsi password
    $password=password_hash($password,PASSWORD_DEFAULT);
    mysqli_query($conn,"INSERT INTO users VALUES ('','$username','$password')");
    
    if (mysqli_affected_rows($conn) > 0) {
        $message = "Registrasi berhasil!";
        echo "<script> 
        alert ('$message') </script>";
        return true;
    } else {
        $error = "Registrasi gagal";
        echo "<script> 
        alert ('$error') </script>";
        return false;
    }
}

?>