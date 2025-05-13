<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\QuestionAnswers;
use App\Models\QuizAttempts;
use App\Models\Quizzes;
use App\Servies\GeneralServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Exception;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storeAttempt(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required',
        ]);

        try {
            // $count = count($request->answers);
            // dd($request->answer);
            $correct_answers = 0;
            foreach ($request->answer as $answer) {
                if (QuestionAnswers::find($answer)->correct == 1) {
                    $correct_answers++;
                }
            }

            // dd($correct_answers/ count($request->answer));

            QuizAttempts::create([
                'quiz_id' => $request->quiz_id,
                'user_id' => auth()->user()->id,
                'grade' => (($correct_answers / count($request->answer)) * 100)
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // return "success";
        if ((($correct_answers / count($request->answer)) * 100) > 80) {
            $pdf = Pdf::loadView('certificates.view', ['course' => Courses::find(Quizzes::find($request->quiz_id)->course_id)->title]);
            $pdf->setPaper('A4', 'landscape');

            return $pdf->stream();
        } else {
            return redirect()->route('course.view.student', ['id' => Quizzes::find($request->quiz_id)->course_id])->with(['error' => 'Quiz Attempt Submitted successfully. Your mark was only ' . $correct_answers . ' out of ' . count($request->answer) . ' questions. You need at least 80% to pass']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quiz = Quizzes::find($id);

        return view('quizzes.student.view', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
