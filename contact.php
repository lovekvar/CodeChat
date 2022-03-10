<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Contact Us - CodeChat</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
    <section id="contact">
        <h1 class="primary-h">Contact Us</h1>
        <form action="noaction.php" id="formfill" class="flex-center">
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="myname" id="name" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="mymail" id="email" placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <label for="number">Phone Number: </label>
                <input type="number" name="mynumber" id="number" placeholder="Enter Your Phone Number">
            </div>
            <div class="form-group">
                <label for="address">Address: </label>
                <input type="text" name="myaddress" id="address" placeholder="Enter Your Address">
            </div>
            <div class="form-group">
                <label for="message"> Any Message or Suggestion: </label><br>
                <textarea name="mymessage" id="message" cols="60" rows="10" placeholder="Any suggestion to improve our facilities, customer experience or feedback.(Optional)"></textarea>
            </div>
        </form>
    </section>
    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>
