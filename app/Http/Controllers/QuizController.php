<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\QuestionAnswers;
use App\Models\QuizAttempts;
use App\Models\QuizQuestions;
use App\Models\Quizzes;
use App\Models\User;
use App\Models\UserCertificates;
use App\Servies\GeneralServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexCertificates()
    {
        if (auth()->user()->role_id == 3) {
            $certificates = UserCertificates::where('user_id', auth()->user()->id)->get();
        } else {
            $certificates = UserCertificates::all();
        }

        return view('certificates.index', compact('certificates'));
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

    public function createQuestions(Request $request){
        $quiz_id = $request->id;
        return view('quizzes.admin.create', compact('quiz_id'));
    }

    public function storeQuestions(Request $request)
    {
        // dd($request->questions);
        try {
            DB::beginTransaction();
            $i = 0;
            foreach ($request->questions as $question) {
                $quiz_question = QuizQuestions::create([
                    'quiz_id' => $request->quiz_id,
                    'question' => $question,
                    'active'=>1
                ]);

                QuestionAnswers::create([
                    'question_id' => $quiz_question->id,
                    'answer' => $request->answers_1[$i],
                    'correct' => $request->correct_answers[$i] == '1' ? 1 : 0
                ]);

                QuestionAnswers::create([
                    'question_id' => $quiz_question->id,
                    'answer' => $request->answers_2[$i],
                    'correct' => $request->correct_answers[$i] == '2' ? 1 : 0
                ]);

                QuestionAnswers::create([
                    'question_id' => $quiz_question->id,
                    'answer' => $request->answers_3[$i],
                    'correct' => $request->correct_answers[$i] == '3' ? 1 : 0
                ]);

                QuestionAnswers::create([
                    'question_id' => $quiz_question->id,
                    'answer' => $request->answers_4[$i],
                    'correct' => $request->correct_answers[$i] == '4' ? 1 : 0
                ]);
                $i++;
            }
            DB::commit();
            return redirect()->route('courses.edit', ['id'=> Quizzes::find($request->quiz_id)->course_id])->with('success', "Quiz Questions have been added successfully");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            // return $e->getMessage();
        }
    }

    public function storeAttempt(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required',
        ]);

        try {
            $correct_answers = 0;
            $wrong_questions = [];
            $x = 0;
            foreach ($request->answer as $answer) {
                if (QuestionAnswers::find($answer)->correct == 1) {
                    $correct_answers++;
                } else {
                    $wrong_questions[$x] = QuestionAnswers::find($answer)->question_id;
                    $x++;
                }
            }

            $quiz_attempt = QuizAttempts::create([
                'quiz_id' => $request->quiz_id,
                'user_id' => auth()->user()->id,
                'grade' => (($correct_answers / count($request->answer)) * 100)
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // return "success";
        if ((($correct_answers / count($request->answer)) * 100) == 100) {
            if (!UserCertificates::where('user_id', auth()->user()->id)->where('course_id',  Quizzes::find($request->quiz_id)->course_id)->first()) {
                UserCertificates::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => Quizzes::find($request->quiz_id)->course_id,
                    'date_received' => date('Y-m-d'),
                    'quiz_attempt' => $quiz_attempt->id
                ]);

                return redirect()->route('certificates.index')->with(['success' => "Congratulations. You have answered all questions right and received a certificate!!"]);
            } else {
                return redirect()->route('certificates.index')->with(['success' => "Congratulations. You have answered all questions right but you already have a certificate"]);
            }
        } else {
            $quiz_title = Quizzes::find($request->quiz_id)->title;
            $course_id = Quizzes::find($request->quiz_id)->course_id;
            $questions = QuizQuestions::whereIn('id', $wrong_questions)->get();
            return view('quizzes.student.wrong_answers', compact('questions', 'quiz_title', 'course_id'))->with(['error' => 'Quiz Attempt Submitted successfully. Your mark was ' . $correct_answers . ' out of ' . count($request->answer) . ' questions. Please see corrected quizzes']);
            // return redirect()->route('course.view.student', ['id' => Quizzes::find($request->quiz_id)->course_id])->with(['error' => 'Quiz Attempt Submitted successfully. Your mark was only ' . $correct_answers . ' out of ' . count($request->answer) . ' questions. You need at least 80% to pass']);
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

    public function printCertificate($id)
    {
        $certificate = UserCertificates::find($id);
        $name = User::find($certificate->user_id)->first_name . ' ' . User::find($certificate->user_id)->last_name;
        $course = Courses::find($certificate->course_id)->title;
        $pdf = Pdf::loadView('certificates.view', ['course' => $course, 'name' => $name, 'date' => $certificate->date_received]);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
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
