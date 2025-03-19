<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\CourseController;



// Route::get('/', function () {
//     return view('Instructor.dashboard');
// });


//ruta que nos lleva a cursos

Route::redirect('/', '/instructor/courses')
    -> name('home');

/* Cursos
Rutas necesarias*/

Route::resource('courses', CourseController::class);

Route::get('courses/{course}/video', [CourseController::class, 'video'])
    -> name('courses.video');

Route::get('courses/{course}/goals', [CourseController::class, 'goals'])
    -> name('courses.goals');

Route::get('courses/{course}/requirements', [CourseController::class, 'requirements'])
    -> name('courses.requirements');