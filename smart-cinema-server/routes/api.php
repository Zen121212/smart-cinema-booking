<?php

$apis = [
    // Authentication
    '/login' => [
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    '/register' => [
        'controller' => 'AuthController',
        'method' => 'register'
    ],

    // Users
    '/users' => [
        'controller' => 'UserController',
        'method' => 'getAllUsers'
    ],
    '/user/{id}' => [
        'controller' => 'UserController',
        'method' => 'getUserById'
    ],
    '/user/update/{id}' => [
        'controller' => 'UserController',
        'method' => 'updateUserById'
    ],
    '/user/profile/{id}' => [
        'controller' => 'UserController',
        'method' => 'getUserProfile'
    ],
    
    // Movies
    '/movies' => [
        'controller' => 'MovieController',
        'method' => 'getAllMovies'
    ],
    '/movie/create' => [
        'controller' => 'MovieController',
        'method' => 'createMovie'
    ],
    '/movie/delete/{id}' => [
        'controller' => 'MovieController',
        'method' => 'deleteMovieById'
    ],
    '/movie/{id}/showtimes' => [
        'controller' => 'MovieController',
        'method' => 'getShowtimesByMovieId'
    ],
];