<?php
include 'Helper/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Chosen Movie</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Chosen Movie</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Release Year</th>
            <th>Format</th>
            <th>Stars</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $movie['title']; ?></td>
            <td><?php echo $movie['release_year']; ?></td>
            <td><?php echo $movie['format']; ?></td>
            <td><?php echo $movie['stars']; ?></td>
        </tr>
        </tbody>
    </table>

    <a href="/movies_list" class="btn btn-primary">Back to movies list</a>
</div>
</body>
</html>
