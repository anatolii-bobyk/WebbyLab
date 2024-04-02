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
    <title>Sorted Movies list</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Sorted Movies list</h1>

    <a href="/add_movie_form" class="btn btn-primary mb-3">Add new movie</a>

    <form action="/show_movies_by_title" method="post" class="mb-3">
        <div class="form-group">
            <label for="title">Search by title:</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <form action="/show_movies_by_actor" method="post" class="mb-3">
        <div class="form-group">
            <label for="stars">Search by stars:</label>
            <input type="text" name="stars" id="stars" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <form action="/import_movies" method="post" enctype="multipart/form-data" class="mb-3">
        <label for="file">Import movies from file:</label>
        <div class="form-group">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input class="btn btn-primary" type="submit" value="Import" name="submit">
        </div>
        <a href="/movies_list" class="btn btn-primary">Back to movies list</a>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Release Year</th>
            <th>Format</th>
            <th>Stars</th>
            <th>Delete movie</th>
            <th>View movie</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?php echo $movie['title']; ?></td>
                <td><?php echo $movie['release_year']; ?></td>
                <td><?php echo $movie['format']; ?></td>
                <td><?php echo $movie['stars']; ?></td>
                <td>
                    <form action="/delete_movie" method="post">
                        <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                <td>
                    <form action="/show_movie" method="post">
                        <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                        <button type="submit" class="btn btn-primary">View information</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
