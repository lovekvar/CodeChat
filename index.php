<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>CodeChat - Open Discussion Forum for Software related Technologies</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/Best-Programming-Languages-to-Start-Learning-Today.jpg" style= "height: 60vh" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/machine-learning-banner-web-icon-260nw-1110900704.jpg" style= "height: 60vh" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/7-Phases-of-web-development-life-cycle.jpg" style= "height: 60vh" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <h2 class="text-center my-3">CodeChat Categories</h2>
        <div class="row">
            <?php    
                $sql = "SELECT * FROM `category`;" ;
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                    // no. of cards in 1 row = 12/n where n is col-md-n.
                    $cat_tit = $row["category_title"];
                    $cat_desc = $row["category_description"];
                    $cat_id = $row["category_id"];
                    echo '<div class="col-md-4">
                        <div class="card my-2" style="width: 15rem;">
                            <img src="img/'. $row["category_title"] .'.jpg" style="width: 15rem; height: 12rem;" class="card-img-top" alt="Related image">
                            <div class="card-body">
                            <h5 class="card-title">'. $cat_tit .'</h5>
                            <p class="card-text">'. substr($cat_desc,0,100) .'...</p>
                            <a href="threadlist.php?cat_id='.$cat_id.'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>


    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>
