<?php
require 'loginconect.php';
if(isset($_POST['button-login'])){
  
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(!empty($username) && !empty($password)){
        $password_hashed = md5($password);
        $query = "SELECT * FROM `user` WHERE `username` = ? AND `password` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password_hashed);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ../../../../Main/main.html");
            exit();
        } else {

            echo '<script>';
            echo 'alert("Sai thông tin");';
            echo 'setTimeout(function() { window.location.href = "../../../Login/login.html"; }, 100);'; // Redirect after 100 milliseconds
            echo '</script>';
        }
        $stmt->close();
        $conn->close();

    } else {

        echo '<script>';
        echo 'aler("Sai thong tin tai khoan")';
        echo '<script>';
        header("Location: ../../../Login/login.html");
    }
}
?>
