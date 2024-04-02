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
    <title>Searched Movies</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Searched Movies</h1>

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

    <a href="/movies_list" class="btn btn-primary">Back to movies list</a>
</div>
</body>
</html>
