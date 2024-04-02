<?php

class UserModel
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
     * @param $username
     * @param $password
     * @return true
     */
    public function registerUser($username, $password)
    {
        try {
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $statement = $this->connection->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $statement->execute(array(':username' => $username, ':password' => $hashedPassword));
            return true;
        } catch (PDOException $exception) {
            echo "User wasn't registered. Something went wrong";
            throw $exception;
        }
    }

    /**
     * @param $username
     * @param $password
     * @return false
     */
    public function loginUser($username, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $statement = $this->connection->prepare($query);
            $statement->execute(array(':username' => $username));
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}

