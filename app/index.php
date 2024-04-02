<?php

require_once 'config/config.php';
require_once 'connection/Connection.php';
require_once 'Router/Router.php';
require_once 'Controller/AuthController.php';
require_once 'Model/UserModel.php';
require_once 'Controller/MovieController.php';
require_once 'Model/MovieModel.php';

$connection = Connection::connect($config);
$router = new Router();
$authController = new AuthController($connection);
$movieController = new MovieController($connection);

$router->addRoute('/', [$authController, 'registerUser']);
$router->addRoute('/register', [$authController, 'registerUser']);
$router->addRoute('/login', [$authController, 'loginUser']);
$router->addRoute('/movies_list', [$movieController, 'getAllMovies']);
$router->addRoute('/add_movie_form', [$movieController, 'openAddMovieForm']);
$router->addRoute('/add_movie', [$movieController, 'addMovie']);
$router->addRoute('/delete_movie', [$movieController, 'deleteMovie']);
$router->addRoute('/show_movie', [$movieController, 'getMovieById']);
$router->addRoute('/sorted_movies', [$movieController, 'getMoviesSortedByTitle']);
$router->addRoute('/show_movies_by_title', [$movieController, 'searchMovieByTitle']);
$router->addRoute('/show_movies_by_actor', [$movieController, 'searchMovieByActor']);
$router->addRoute('/import_movies', [$movieController, 'importMoviesFromTextFile']);

$router->handleRequest();