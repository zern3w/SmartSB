<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('sbparent')->user();

    //dd($users);

    return view('sbparent.home');
})->name('home');

