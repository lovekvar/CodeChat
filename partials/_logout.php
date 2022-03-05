<?php
    session_start();

    session_unset();
    session_destroy();
    
    $message = 'You have successfully logged out of our website';
    header("location: ../welcome.php?success=true&error=$message");
?>