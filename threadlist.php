<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>View Threads</title>
</head>

<body>
    <?php 
        include 'partials/_navbar.php';
        $cat_id = $_GET['cat_id'];
        $sql = "SELECT * FROM `category` WHERE `category_id` ='$cat_id'; ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $cat_tit = $row["category_title"];
        $cat_desc = $row["category_description"];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_id = $_SESSION['user_id'];
            $prob_title = $_POST["prob_title"];
            $prob_title = str_replace("<", "&lt;", $prob_title);
            $prob_title = str_replace(">", "&gt;", $prob_title);
            $prob_title = str_replace("'", "&apos;", $prob_title);
            $prob_title = str_replace('"', "&quot;", $prob_title);
            $prob_desc = $_POST["prob_desc"];
            $prob_desc = str_replace("<", "&lt;", $prob_desc);
            $prob_desc = str_replace(">", "&gt;", $prob_desc);
            $prob_desc = str_replace("'", "&apos;", $prob_desc);
            $prob_desc = str_replace('"', "&quot;", $prob_desc);
            date_default_timezone_set('Asia/Kolkata');
            $time = date("Y-m-d H:i:s");

            $sql = "INSERT INTO `thread` (`thread title`, `thread description`, `thread category id`, `thread user id`, `timestamp`) VALUES ('$prob_title', '$prob_desc', '$cat_id', '$user_id', '2021-12-28 21:13:24'); ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Question has been added successfully. Please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Due to some technical reasons, We are unable to process your request at this moment. We regret the inconvinience caused!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <div class="container mt-2">
        <div class="jumbotron py-3">
            <h1 class="display-4"> Welcome to <?php echo $cat_tit; ?> Forums</h1>
            <p class="lead" style="text-align: justify;">
                <?php echo $cat_desc; ?>
            </p>
            <hr class="my-4">
            <p>This is an free open discussion forum dedicated to the above mentioned topic. Each one of you is expected to follow the following guidelines.
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums. ...</li>
                <li>Do not post copyright-infringing material. ...</li>
                <li>Do not post “offensive” posts, links or images. ...</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            </p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>


        <h4>Start a Discussion</h4>
        <!-- to submit form on same page, 'PHP_SELF' is used generally. But we want to submit the form on exactly same address i.e. we want address consisting '?....' (last part of address too.) . So we use 'REQUEST_URI' .-->
        <?php 
            if($loggedin){
                echo '<form class="mb-5" action= "'. $_SERVER['REQUEST_URI'] .'" method="post">
                    <div class="mb-3">
                        <label for="prob_title" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" name="prob_title" id="prob_title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Keep your Title as short and crisp as possible.</div>
                    </div>
                    <div class="mb-3">
                        <label for="prob_desc" class="form-label">Express your Concern</label>
                        <input type="text" class="form-control" id="prob_desc" name="prob_desc">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>';
            }
            else{
                echo '<div class="alert alert-warning" role="alert">
                    Please login to the website to ask your question.
                </div>';
            }
        ?>

        <h4 class="mb-4">Browse Questions</h4>
        <?php
            $sql = "SELECT * FROM `thread` WHERE `thread category id`='$cat_id'; ";
            $result = mysqli_query($conn, $sql);
            $start = true;
            while($row = mysqli_fetch_assoc($result)){
                $start = false;
                $user_id = $row["thread user id"];
                $sql2 = "SELECT `user_mail` FROM `user` where `user_id` = '$user_id'; ";
                $res = mysqli_query($conn, $sql2);
                $name = mysqli_fetch_assoc($res)["user_mail"];
                echo '<div class="media my-2">
                    <img class="mr-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6xSz0eMW7GmpKukczOHvPWWGDqaBCqWA-Mw&usqp=CAU" alt="Generic placeholder image" style= "height: 2rem">
                    <div class="media-body">
                        <b>'. $name .' at '. $row["timestamp"] .'</b><br>
                        <h5 class="mt-0"><a href="thread.php?thread_id='. $row["thread id"] .'&user_name='. $name .'" class="text-dark" style= "text-decoration: none;">'. $row["thread title"] .'</a></h5>'. $row["thread description"] .'
                    </div>
                </div>'; 
            }
            
            if($start){
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">No Questions Found</h1>
                        <p class="lead">Start discussion for your as well as other\'s benefit. </p>
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
