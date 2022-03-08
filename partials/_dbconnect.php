<?php
    // Connecting to the Database
    $servername = "sql6.freemysqlhosting.net";
    $username = "sql6477370";
    $password = "I5MVayTvbF";
    $database = "I5MVayTvbF";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Die if connection was not successful
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
    // else{
    //     echo "Connection was successful<br>";
    // }
?>
