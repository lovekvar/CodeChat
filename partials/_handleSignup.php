<?php
    $is_success = false;
    if( $_SERVER['REQUEST_METHOD'] == "POST"){
        require '_dbconnect.php';
        $user_mail = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        
        $sql = "SELECT * FROM `user` where `user_mail` = '$user_mail';" ;
        $check_user = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($check_user);
        if($num == 1){
            $error = 'This mail id already exist.';
        }
        else{
            if($pass != $cpass){
                $error = 'Passwords do not match. Please try to signup again using same passwords.';
            }
            else{
                $user_hash = password_hash($pass,  PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (`user_mail`, `user_hash`) VALUES ('$user_mail', '$user_hash');" ;
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    $error = 'Due to some technical reasons, We are unable to process your request at this moment. We regret the inconvinience caused! ';
                }
                else{
                    $is_success = true;
                    $error = 'You have successfully signed up in our website. Now, please login to our website.';
                }
            }
        }
    }
    // echo $error;
    header("location: ../index.php?success=$is_success&error= $error");
    // Note: Do not leave spaces in 'address' while redirecting someone. Otherwise things will change.
    // e.g. : true ->1 will become ' 1 '. This will lead to misexecution.
?>
