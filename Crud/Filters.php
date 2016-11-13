<?php

// AJAX Requests checking Filter.
Route::filter('ajax', function($route, $request) {
    if (! $request->ajax()) {
        // When the HTML Request is not AJAX, respond with Error 400 (Bad Request)
        App::abort(400, 'Bad Request');
    }
});