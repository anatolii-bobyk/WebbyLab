<?php

class MovieModel
{
    /**
     * @var
     */
    private $connection;

    /**
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getAllMovies()
    {
        $query = "SELECT * FROM movies";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $title
     * @param $release_year
     * @param $format
     * @param $stars
     * @return mixed
     */
    public function addMovie($title, $release_year, $format, $stars)
    {
        $query = "INSERT INTO movies (title, release_year, format, stars) VALUES (:title, :release_year, :format, :stars)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':release_year', $release_year);
        $statement->bindParam(':format', $format);
        $statement->bindParam(':stars', $stars);
        return $statement->execute();
    }

    /**
     * @param $movie_id
     * @return mixed
     */
    public function deleteMovie($movie_id)
    {
        $query = "DELETE FROM movies WHERE id = :movie_id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':movie_id', $movie_id);
        return $statement->execute();
    }

    /**
     * @param $movie_id
     * @return mixed
     */
    public function getMovieById($movie_id)
    {
        $query = "SELECT * FROM movies WHERE id = :movie_id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':movie_id', $movie_id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function getMoviesSortedByTitle()
    {
        $query = "SELECT * FROM movies ORDER BY title";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $title
     * @return mixed
     */
    public function searchMovieByTitle($title)
    {
        $query = "SELECT * FROM movies WHERE title LIKE :title";
        $statement = $this->connection->prepare($query);
        $title = "%$title%";
        $statement->bindParam(':title', $title);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $stars
     * @return mixed
     */
    public function searchMovieByActor($stars)
    {
        $query = "SELECT * FROM movies WHERE stars LIKE :stars";
        $statement = $this->connection->prepare($query);
        $stars = "%$stars%";
        $statement->bindParam(':stars', $stars);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $file_path
     * @return void
     */
    public function importMoviesFromTextFile($file_path)
    {
        $openedFile = fopen($file_path, 'r');
        if ($openedFile) {
            $movie_data = [];
            while (($line = fgets($openedFile)) !== false) {
                $line = trim($line);
                if (!empty($line)) {
                    list($key, $value) = explode(': ', $line, 2);
                    $movie_data[$key] = $value;
                } elseif (!empty($movie_data)) {
                    $this->addMovie(
                        $movie_data['Title'],
                        $movie_data['Release Year'],
                        $movie_data['Format'],
                        $movie_data['Stars']
                    );
                    $movie_data = [];
                }
            }
            fclose($openedFile);
        }
    }
}
