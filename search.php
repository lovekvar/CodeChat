<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Search - CodeChat</title>
</head>

<body>
    <?php 
        include 'partials/_navbar.php'; 
        $query = $_GET['search'];
    ?>

    <div class="container" style="min-height: 82vh">
        <h1>Search Results for <?php echo $query; ?></h1>
            <!-- alter table thread add FULLTEXT(`thread title`, `thread description`);
            above query was executed on localhost/php_myadmin server before starting match{search query}  -->
        <?php
            $sql = "SELECT * FROM thread WHERE MATCH(`thread title`, `thread description`) AGAINST ('$query'); ";  
            $result = mysqli_query($conn, $sql);
            $no_row = true;
            while($row = mysqli_fetch_assoc($result)){
                $no_row = false;
                $user_id = $row["thread user id"];
                $sql2 = "SELECT `user_mail` FROM `user` where `user_id` = '$user_id'; ";
                $res = mysqli_query($conn, $sql2);
                $name = mysqli_fetch_assoc($res)["user_mail"];
                echo '<div class="media my-2" style= "display: flex;">
                    <img class="mr-3 mt-2 mx-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6xSz0eMW7GmpKukczOHvPWWGDqaBCqWA-Mw&usqp=CAU" alt="Generic placeholder image" style= "height: 2rem">    
                    <div class="media-body">
                        <b>'. $name .' at '. $row["timestamp"] .'</b><br>
                        <h5 class="mt-0"><a href="thread.php?thread_id='. $row["thread id"] .'&user_name='. $name .'" class="text-dark" style= "text-decoration: none;">'. $row["thread title"] .'</a></h5>'. $row["thread description"] .'
                    </div>
                </div>'; 
            } 
            if($no_row){
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">No Results Found</h1>
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                            <li>Try fewer keywords.</li>
                        </ul>
                    </div>
                </div>';
            }
        ?>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>