<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('courses.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/view-course/{id}', [CoursesController::class, 'show'])->name('course.view.student');
Route::get('/user/courses', [CoursesController::class, 'userCourses'])->name('user.courses');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');

    // Courses routes
    Route::get('/courses/create', [CoursesController::class, 'create'])->name('course.create');
    Route::post('/courses/store', [CoursesController::class, 'store'])->name('courses.store');
    // Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/courses-edit/{id}', [CoursesController::class, 'show'])->name('courses.edit');
    Route::post('/course-section/store', [CoursesController::class, 'storeSection'])->name('course.store.section');
    Route::post('/section-content/store', [CoursesController::class, 'storeContent'])->name('course.section.content.store');
    Route::post('/quiz/store', [CoursesController::class, 'storeQuiz'])->name('quiz.store');
    Route::post('/course-enroll', [CoursesController::class, 'enrollUser'])->name('course.enroll');
    // Route::get('/view-course/{id}', [CoursesController::class, 'show'])->name('course.view.student');
    // Route::get('/user/courses', [CoursesController::class, 'userCourses'])->name('user.courses');
    //Quizes
    Route::get('/quiz-attempt/{id}', [QuizController::class, 'show'])->name('quiz.attempt');
    Route::post('/quiz/attempt', [QuizController::class, 'storeAttempt'])->name('quiz.attempt.store');
    // Route::get('/')

    //Cerificate
    Route::get('/certificates', [QuizController::class, 'indexCertificates'])->name('certificates.index');
    Route::get('/certificates-print/{id}', [QuizController::class, 'printCertificate'])->name('certificates.print');
    // Route::get('/generate/certificate', function () {
    //     // $course = "What is hypertension";
    //     $pdf = Pdf::loadView('certificates.view', ['course' => "What is Hypertension"]);
    //     $pdf->setPaper('A4', 'landscape');

    //     return $pdf->stream();
    //     // return view();
    // });
});

require __DIR__ . '/auth.php';
