<?php
//     $loggedin = false;
//     session_start();
//     if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])){
//         $loggedin = true;
//     }
    require '_dbconnect.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CodeChat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/php_tutorials/33/welcome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/php_tutorials/33/about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $sql = "SELECT `category_id`, `category_title` FROM `category` limit 6; ";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<li><a class="dropdown-item" href="/php_tutorials/33/threadlist.php?cat_id='. $row["category_id"] .'">'. $row["category_title"] .'</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/php_tutorials/33/contact.php">Contact</a>
                </li>
            </ul>
            <form class="d-flex" action="search.php" method="get">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success mx-1" type="submit">Search</button>
            </form>
            <?php
                if(!$loggedin){
                    echo '<button type="button" class="btn btn-outline-success mx-1 my-1" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                }
                else{
                    echo '<a href="/php_tutorials/33/partials/_logout.php" class="btn btn-outline-success mx-1 my-1">Logout</a>';
                }
            ?>
            <button type="button" class="btn btn-outline-success mx-1 my-1" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
        </div>
    </div>
</nav>

<!--  && (isset($is_success)) -->
<?php
//     if( isset($_GET['success']) ){
//         // echo var_dump($_GET['success']);
//         // echo var_dump($_GET['error']);
//         if($_GET['success']){
//             echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
//             <strong>Success!</strong> '. $_GET['error'] .'
//             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//             </div>';
//         }
//         else{
//             echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
//             <strong>Error!</strong> '. $_GET['error'] .'
//             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//             </div>';
//         }
//     }
//     include '_loginModal.php';
//     include '_signupModal.php';
?>
