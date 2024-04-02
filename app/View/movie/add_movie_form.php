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
    <title>Add new movie</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Add new movie</h1>
    <form action="/add_movie" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="release_year">Release Year:</label>
            <input type="number" name="release_year" id="release_year" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="format">Format:</label>
            <select name="format" id="format" class="form-control" required>
                <option value="VHS">VHS</option>
                <option value="DVD">DVD</option>
                <option value="Blu-ray">Blu-ray</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stars">Stars:</label>
            <textarea name="stars" id="stars" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add movie</button>
    </form>
</div>
</body>
</html>
