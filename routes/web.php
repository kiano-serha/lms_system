<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LearningOutcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TargetAudienceController;
use App\Models\LearningOutcomes;
use App\Models\TargetAudience;
use App\Servies\GeneralServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('login');
    return view('index');
});

Route::get('/dashboard', function () {
    return redirect()->route('courses.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/view-course/{id}', [CoursesController::class, 'show'])->name('course.view.student');
Route::get('/user/courses', [CoursesController::class, 'userCourses'])->name('user.courses');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');

Route::post('/chatbot/prompt', [ChatBotController::class, 'getResponse'])->name('chatbot.send.prompt');
Route::get('/chatbot', [ChatBotController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');

    // Courses routes
    Route::get('/courses/create', [CoursesController::class, 'create'])->name('course.create');
    Route::post('/courses/store', [CoursesController::class, 'store'])->name('courses.store');

    Route::get('/courses-edit/{id}', [CoursesController::class, 'show'])->name('courses.edit');
    Route::post('/course-section/store', [CoursesController::class, 'storeSection'])->name('course.store.section');
    Route::post('/section-content/store', [CoursesController::class, 'storeContent'])->name('course.section.content.store');
    Route::post('/course/active-stat', [CoursesController::class, 'changeActivation'])->name('course.change.active.status');


    Route::post('/quiz/store', [CoursesController::class, 'storeQuiz'])->name('quiz.store');
    Route::post('/course-enroll', [CoursesController::class, 'enrollUser'])->name('course.enroll');

    //Quizes
    Route::get('/quiz-attempt/{id}', [QuizController::class, 'show'])->name('quiz.attempt');
    Route::post('/quiz/attempt', [QuizController::class, 'storeAttempt'])->name('quiz.attempt.store');
    Route::get('/create-questions/{id}', [QuizController::class, 'createQuestions']);
    Route::post('/store/questions', [QuizController::class, 'storeQuestions'])->name('store.questions');

    //Cerificate
    Route::get('/certificates', [QuizController::class, 'indexCertificates'])->name('certificates.index');
    Route::get('/certificates-print/{id}', [QuizController::class, 'printCertificate'])->name('certificates.print');

    //Target Audience
    Route::post('/target-audience/store', [TargetAudienceController::class, 'store'])->name('target.audience.store');
    Route::put('/target-audience/update', [TargetAudience::class, 'update'])->name('target.audience.update');

    //Learning Outcomes
    Route::post('/learning-outcomes/store', [LearningOutcomeController::class, 'store'])->name('learning.outcome.store');
    Route::post('/learning-outcomes/update', [LearningOutcomeController::class, 'update'])->name('learning.outcomes.update');
});

require __DIR__ . '/auth.php';
