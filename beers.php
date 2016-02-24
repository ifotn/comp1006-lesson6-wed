<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Beer Listings</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

</head>
<body>

<h1>Beer Listings</h1>

<a href="beer.php" title="Add Beer">Add a New Beer</a>

<?php
// connect
$conn = new PDO('mysql:host=127.0.0.1;dbname=gcrfreeman', 'root', '');

// prepare the query
$sql = "SELECT * FROM beers ORDER BY name";
$cmd = $conn -> prepare($sql);

// run the query and store the results
$cmd -> execute();
$beers = $cmd -> fetchAll();

// disconnect
$conn = null;

// start the grid with HTML
echo '<table class="table table-striped"><thead><th>Name</th><th>Alcohol Content</th>
    <th>Domestic</th><th>Light</th><th>Price</th><th>Edit</th><th>Delete</th></thead><tbody>';

/* loop through the data, displaying each value in a new column
and each beer in a new row */
foreach($beers as $beer) {
    echo '<tr><td>' . $beer['name'] . '</td>
        <td>' . $beer['alcohol_content'] . '</td>
        <td>' . $beer['domestic'] . '</td>
        <td>' . $beer['light'] . '</td>
        <td>' . $beer['price'] . '</td>
        <td><a href="beer.php?beer_id=' . $beer['beer_id'] . '" title="Edit">Edit</a></td>
        <td><a href="delete-beer.php?beer_id=' . $beer['beer_id'] . '"
            title="Delete" class="confirmation">Delete</a></td>
        </tr>';
}

// close the HTML grid
echo '</tbody></table>';

?>

<!-- js section -->

<script src="Scripts/lib/jquery-2.2.0.min.js"></script>
<script src="Scripts/app.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
