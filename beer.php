<!DOCTYPE html>

<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Beer Information</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

<?php
// initialize an empty id variable
$beer_id = null;
$name = null;
$alcohol_content = null;
$domestic = null;
$light = null;
$price = null;

//check if we have an beer ID in the querystring
if (is_numeric($_GET['beer_id'])) {

    //if we do, store in a variable
    $beer_id = $_GET['beer_id'];

    //connect
    $conn = new PDO('mysql:host=127.0.0.1;dbname=gcrfreeman', 'root', '');

    //select all the data for the selected beer
    $sql = "SELECT * FROM beers WHERE beer_id = :beer_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
    $cmd->execute();
    $beers = $cmd->fetchAll();

    //disconnect
    $conn = null;

    //store each value from the database into a variable
    foreach ($beers as $beer) {
        $name = $beer['name'];
        $alcohol_content = $beer['alcohol_content'];

        if ($beer['domestic'] == true) {
         $domestic = "checked";
        }

        if ($beer['light'] == true) {
            $light = "checked";
        }

        $price = $beer['price'];
    }
}
?>

<h1>Beer Information</h1>

<a href="beers.php" title="View Beers">View Beer Listings</a>

<p>* indicates Required Fields</p>
<form method="post" action="save-beer.php">
    <fieldset>
        <label for="name" class="col-sm-2">Name: *</label>
        <input name="name" id="name" required placeholder="Beer Name" value="<?php echo $name; ?>" />
    </fieldset>
    <fieldset>
        <label for="alcohol_content" class="col-sm-2">Alcohol Content: *</label>
        <input name="alcohol_content" id="alcohol_content" required value="<?php echo $alcohol_content; ?>" />
    </fieldset>
    <fieldset>
        <label for="domestic" class="col-sm-2">Domestic:</label>
        <input name="domestic" id="domestic" type="checkbox" <?php echo $domestic; ?> />
    </fieldset>
    <fieldset>
        <label for="light" class="col-sm-2">Light:</label>
        <input name="light" id="light" type="checkbox" <?php echo $light; ?> />
    </fieldset>
    <fieldset>
        <label for="price" class="col-sm-2">Price: *</label>
        <input name="price" id="price" required value="<?php echo $price; ?>" />
    </fieldset>
    <input type="hidden" name="beer_id" id="beer_id" value="<?php echo $beer_id; ?>" />
    <button class="btn btn-primary col-sm-offset-2">Save</button>
</form>

</body>

</html>