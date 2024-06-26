<?php

class MovieController
{
    /**
     * @var MovieModel
     */
    private $movieModel;

    /**
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->movieModel = new MovieModel($connection);
    }

    /**
     * @return mixed
     */
    public function getAllMovies()
    {
        $movies = $this->movieModel->getAllMovies();
        include('View/movie/movies_list.php');
        return $movies;
    }

    /**
     * @return void
     */
    public function openAddMovieForm()
    {
        include('View/movie/add_movie_form.php');
    }

    /**
     * @return string|void
     */
    public function addMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            include('View/movie/add_movie_form.php');
            return "Something went wrong";
        }

        $title = trim($_POST['title']);
        $release_year = $_POST['release_year'];
        $format = $_POST['format'];
        $stars = $_POST['stars'];
        $current_year = date("Y");
        $existing_movie = $this->movieModel->searchMovieByTitle($title);
        $error_message = '';

        if (empty($title)) {
            $error_message = "Title cannot be empty.";
        } elseif (!preg_match('/^[A-Za-z\s\-,]+$/', $stars)) {
            $error_message = "Invalid characters in stars field.";
        } elseif ($release_year < 1900 || $release_year > $current_year) {
            $error_message = "Invalid release year.";
        } elseif (!empty($existing_movie)) {
            $error_message = "Movie with the same title already exists.";
        }

        if (!empty($error_message)) {
            include('View/movie/add_movie_form.php');
            return;
        }

        $result = $this->movieModel->addMovie($title, $release_year, $format, $stars);
        if ($result) {
            header('Location: /movies_list');
        }
    }

    /**
     * @return string|void
     */
    public function deleteMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return "Error during deleting";
        }
        $movie_id = $_POST['movie_id'];
        $movie = $this->movieModel->getMovieById($movie_id);
        if (!$movie) {
            return "Movie with ID $movie_id not found.";
        }

        $result = $this->movieModel->deleteMovie($movie_id);
        if ($result) {
            header('Location: /movies_list');
        }
    }

    /**
     * @return string
     */
    public function getMovieById()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return "Something went wrong";
        }

        $movie_id = $_POST['movie_id'];
        $movie = $this->movieModel->getMovieById($movie_id);
        include('View/movie/show_movie.php');
        return $movie;
    }

    /**
     * @return mixed
     */
    public function getMoviesSortedByTitle()
    {
        $movies = $this->movieModel->getMoviesSortedByTitle();
        include('View/movie/sort_movies.php');
        return $movies;
    }

    /**
     * @return string
     */
    public function searchMovieByTitle()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return "Something went wrong";
        }

        $title = $_POST['title'];
        $movies = $this->movieModel->searchMovieByTitle($title);
        include('View/movie/show_movies_by_title_or_actor.php');
        return $movies;
    }

    /**
     * @return string
     */
    public function searchMovieByActor()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return "Something went wrong";
        }

        $stars = $_POST['stars'];
        $movies = $this->movieModel->searchMovieByActor($stars);
        include('View/movie/show_movies_by_title_or_actor.php');
        return $movies;
    }


    /**
     * @return mixed|void
     */
    public function importMoviesFromTextFile()
    {
        $movies = $this->movieModel->getAllMovies();
        if (isset($_POST["submit"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $file_extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);

            if ($file_extension !== 'txt' || $_FILES["fileToUpload"]["size"] == 0) {
                $error_message = ($file_extension !== 'txt') ? "Only txt files are allowed." : "Uploaded file is empty.";
                include('View/movie/movies_list.php');
                return $this->movieModel->getAllMovies();
            }

            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $this->movieModel->importMoviesFromTextFile($target_file);
            header('Location: /movies_list');
        }
    }
}
