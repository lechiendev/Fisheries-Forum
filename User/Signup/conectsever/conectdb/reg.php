<?php 
require 'signupconect.php';

if(isset($_POST['button-reg'])){
  
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  
  if(!empty($username) && !empty($password) && !empty($confirmpassword)){

     if($password !== $confirmpassword) {
        echo "Mật khẩu xác nhận không khớp";
        exit;
     }
     $check_query = "SELECT * FROM `user` WHERE `username` = ?";
     $check_stmt = $conn->prepare($check_query);
     $check_stmt->bind_param("s", $username);
     $check_stmt->execute();
     $result = $check_stmt->get_result();

     if($result->num_rows > 0) {
        echo "Tên người dùng đã tồn tại";
        exit;
     }
      
     //prevent SQL injection
     $sql = "INSERT INTO `user` (`username`, `password`) VALUES (?, md5(?))";
     
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ss", $username, $password);
     
     if($stmt->execute()){
      header("Location:  ../../../Login/login.html");
      exit();
      
exit;
     }
     else{
        echo "Lỗi: " . $conn->error;
     }
     
     $stmt->close();
     $conn->close();
  }
  else{
    header("Location:  ../../../Signup/signup.html");
  }
}
?>
