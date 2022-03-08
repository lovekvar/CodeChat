<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>View Threads</title>
</head>

<body>
    <?php 
        include 'partials/_navbar.php';
        $thr_id = $_GET['thread_id'];
        $thr_user_name = $_GET['user_name'];
        $sql = "SELECT * FROM `thread` WHERE `thread id` ='$thr_id'; ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $thr_tit = $row["thread title"];
        $thr_desc = $row["thread description"];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_id = $_SESSION['user_id'];
            $comment = $_POST["comment"];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            date_default_timezone_set('Asia/Kolkata');
            $time = date("Y-m-d H:i:s");

            $sql = "INSERT INTO `comment` (`user_id`, `comment_thread_id`, `comment_description`, `timestamp`) VALUES ('$user_id', '$thr_id', '$comment', '$time';" ;
            $result = mysqli_query($conn, $sql);

            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Comment has been added successfully.
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
            <h1 class="display-4"> <?php echo $thr_tit; ?> </h1>
            <p class="lead" style= "text-align: justify;"> <?php echo $thr_desc; ?></p>
            <b>Posted By - <?php echo $thr_user_name; ?></b>
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

        <h4>Add a Comment</h4>
        <?php 
            if($loggedin){
                echo '<form class="mb-5" action= "'. $_SERVER['REQUEST_URI'] .'" method="post"> 
                    <div class="mb-3">
                        <label for="comment" class="form-label">Write your Comment</label>
                        <textarea class="form-control" id="comment" name="comment" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>';
            }
            else{
                echo '<div class="alert alert-warning" role="alert">
                    Please login to the website to post your comment.
                </div>';
            }
        ?>

        <h4>Discussion</h4>
        <?php
            $sql = "SELECT * FROM `comment` WHERE `comment_thread_id`='$thr_id'; ";
            $result = mysqli_query($conn, $sql);
            $start = true;
            while($row = mysqli_fetch_assoc($result)){
                $start = false;
                $user_id = $row["user_id"];
                $sql2 = "SELECT `user_mail` FROM `user` where `user_id` = '$user_id'; ";
                $res = mysqli_query($conn, $sql2);
                $name = mysqli_fetch_assoc($res)["user_mail"];
                echo '<div class="media my-2">
                    <img class="mr-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6xSz0eMW7GmpKukczOHvPWWGDqaBCqWA-Mw&usqp=CAU" alt="Generic placeholder image" style= "height: 2rem">
                    <div class="media-body">
                        <h5 class="mt-0">'. $name .' at '. $row["timestamp"] .'</h5>'. $row["comment_description"] .'
                    </div>
                </div>'; 
            }

            if($start){
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">No Comments Found</h1>
                        <p class="lead">Please wait for someone to respond or add your valuable comments if you have any.</p>
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
