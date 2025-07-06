<?php
//----------------------------------------------------------
//Routing starts here (Mapping between the request and the controller & method names)
//It's an key-value array where the value is an key-value array
//----------------------------------------------------------

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
    '/logout' => [
        'controller' => 'AuthController',
        'method' => 'logout'
    ],
    
    // Movies
    '/movies' => [
        'controller' => 'MovieController',
        'method' => 'getAllMovies'
    ],
    '/movie/{id}' => [
        'controller' => 'MovieController',
        'method' => 'getMovieById'
    ],
    '/movie/create' => [
        'controller' => 'MovieController',
        'method' => 'createMovie'
    ],
    '/movie/update/{id}' => [
        'controller' => 'MovieController',
        'method' => 'updateMovieById'
    ],
    '/movie/delete/{id}' => [
        'controller' => 'MovieController',
        'method' => 'deleteMovieById'
    ],
    '/movie/{id}/showtimes' => [
        'controller' => 'MovieController',
        'method' => 'getShowtimesByMovieId'
    ],
    '/movies/search' => [
        'controller' => 'MovieController',
        'method' => 'searchMovies'
    ],
    
    // Genres
    '/genres' => [
        'controller' => 'GenreController',
        'method' => 'getAllGenres'
    ],
    '/genre/{id}' => [
        'controller' => 'GenreController',
        'method' => 'getGenreById'
    ],
    '/genre/create' => [
        'controller' => 'GenreController',
        'method' => 'createGenre'
    ],
    '/genre/update/{id}' => [
        'controller' => 'GenreController',
        'method' => 'updateGenreById'
    ],
    '/genre/delete/{id}' => [
        'controller' => 'GenreController',
        'method' => 'deleteGenreById'
    ],
    '/genre/{id}/movies' => [
        'controller' => 'MovieController',
        'method' => 'getMoviesByGenreId'
    ],
    
    // Bookings
    '/bookings' => [
        'controller' => 'BookingController',
        'method' => 'getAllBookings'
    ],
    '/booking/{id}' => [
        'controller' => 'BookingController',
        'method' => 'getBookingById'
    ],
    '/booking/create' => [
        'controller' => 'BookingController',
        'method' => 'createBooking'
    ],
    '/booking/update/{id}' => [
        'controller' => 'BookingController',
        'method' => 'updateBookingById'
    ],
    '/booking/cancel/{id}' => [
        'controller' => 'BookingController',
        'method' => 'cancelBookingById'
    ],
    '/movie/{id}/available-seats' => [
        'controller' => 'BookingController',
        'method' => 'getAvailableSeats'
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
    '/user/delete/{id}' => [
        'controller' => 'UserController',
        'method' => 'deleteUserById'
    ],
    '/user/{id}/bookings' => [
        'controller' => 'BookingController',
        'method' => 'getBookingsByUserId'
    ],
    '/user/{id}/profile' => [
        'controller' => 'UserController',
        'method' => 'getUserProfile'
    ],
    '/user/{id}/favorite-genres' => [
        'controller' => 'UserController',
        'method' => 'getFavoriteGenres'
    ],
    '/user/{id}/favorite-genres/add' => [
        'controller' => 'UserController',
        'method' => 'addFavoriteGenre'
    ],
    '/user/{id}/favorite-genres/remove' => [
        'controller' => 'UserController',
        'method' => 'removeFavoriteGenre'
    ],
    
    // Payments
    '/payments' => [
        'controller' => 'PaymentController',
        'method' => 'getAllPayments'
    ],
    '/payment/create' => [
        'controller' => 'PaymentController',
        'method' => 'createPayment'
    ],
    '/payment/{id}' => [
        'controller' => 'PaymentController',
        'method' => 'getPaymentById'
    ],
    '/payment-methods' => [
        'controller' => 'PaymentController',
        'method' => 'getAllPaymentMethods'
    ],
    '/payment-method/create' => [
        'controller' => 'PaymentController',
        'method' => 'createPaymentMethod'
    ],
    
    // Wallet
    '/user/{id}/wallet' => [
        'controller' => 'WalletController',
        'method' => 'getUserWallet'
    ],
    '/user/{id}/wallet/add-funds' => [
        'controller' => 'WalletController',
        'method' => 'addFunds'
    ],
    '/user/{id}/wallet/transactions' => [
        'controller' => 'WalletController',
        'method' => 'getWalletTransactions'
    ],
    
    // Reserved Seats
    '/reserved-seats' => [
        'controller' => 'ReservedSeatController',
        'method' => 'getAllReservedSeats'
    ],
    '/reserved-seat/create' => [
        'controller' => 'ReservedSeatController',
        'method' => 'createReservedSeat'
    ],
    '/reserved-seat/release/{id}' => [
        'controller' => 'ReservedSeatController',
        'method' => 'releaseReservedSeat'
    ],
    
    // Ticketing
    '/tickets' => [
        'controller' => 'TicketController',
        'method' => 'getAllTickets'
    ],
    '/ticket/{id}' => [
        'controller' => 'TicketController',
        'method' => 'getTicketById'
    ],
    '/ticket/generate' => [
        'controller' => 'TicketController',
        'method' => 'generateTicket'
    ],
    '/user/{id}/tickets' => [
        'controller' => 'TicketController',
        'method' => 'getUserTickets'
    ],
];