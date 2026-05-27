<?php

use Illuminate\Support\Facades\Route;
use App\Data\Lessons;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lessons', function () {
    return view('lessons', ['lessons' => Lessons::all()]);
});

Route::get('/lessons/{slug}', function (string $slug) {
    $lesson  = Lessons::find($slug);
    $all     = Lessons::all();
    $total   = count($all) - 1; // lessons 0–22, so 23 items, last number is 22

    if (!$lesson) abort(404);

    $prev = $lesson['number'] > 0  ? Lessons::findByNumber($lesson['number'] - 1) : null;
    $next = $lesson['number'] < 22 ? Lessons::findByNumber($lesson['number'] + 1) : null;

    $buildsOn = array_map(fn($n) => Lessons::findByNumber($n), $lesson['builds_on']);

    return view('lesson-detail', compact('lesson', 'prev', 'next', 'buildsOn', 'all', 'total'));
});
