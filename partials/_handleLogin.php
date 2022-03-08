<?php
    $is_success = false;
    $error = 'Invalid Credentials. Please login again carefully.';
    if( $_SERVER['REQUEST_METHOD'] == "POST"){
        require '_dbconnect.php';
        $user_mail = $_POST['email'];
        $pass = $_POST['password'];
        
        $sql = "SELECT * FROM `user` where `user_mail` = '$user_mail';" ;
        $check_user = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($check_user);
        if($num == 1){
            $row = mysqli_fetch_assoc($check_user);
            $hash = $row["user_hash"];
            if(password_verify($pass, $hash)){
                $is_success = true;
                $user_id = $row["user_id"];
                $error = 'You have successfully logged in to our Website.';
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_mail'] = $user_mail;
                $_SESSION['user_id'] = $user_id;
            }
        }
    }
    // echo $error;
    header("location: ../index.php?success=$is_success&error= $error");
    // Note: Do not leave spaces in 'address' while redirecting someone. Otherwise things will change.
    // e.g. : true ->1 will become ' 1 '. This will lead to misexecution.
?>
