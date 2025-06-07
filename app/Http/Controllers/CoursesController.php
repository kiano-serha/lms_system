<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursesRequest;
use App\Models\Categories;
use App\Models\ContentLinks;
use App\Models\Courses;
use App\Models\CourseSectionContents;
use App\Models\CourseSections;
use App\Models\CourseUsers;
use App\Models\QuizPrerequisites;
use App\Models\Quizzes;
use App\Servies\GeneralServices;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Courses::with('category')->get();
        if (auth()->check() && auth()->user()->role_id == 1) {
            // auth()->user()->role_id == 1
            return view('courses.admin.index', compact('courses'));
        } else {
            return view('courses.student.index', compact('courses'));
        }
    }

    public function userCourses()
    {
        $courses = Courses::with('courseUsers')
            ->whereRelation('courseUsers', 'user_id', auth()->user()->id)
            ->get();

        return view('courses.student.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('courses.admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursesRequest $request)
    {
        $request->validated();

        try {
            Courses::create([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'tagline' => $request->tagline,
                'url_title' => $this->generateURLTitle($request->title),
                'issue_certificate' => $request->issue_certificate,
                'image' => (new GeneralServices)->upload('./uploads/courses'),
                'active' => $request->active,
                'price' => $request->price,
                'description' => $request->description
            ]);

            return redirect()->route('course.create')->with(['success' => "Course has been created successfully"]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function storeSection(Request $request)
    {
        try {
            if (CourseSections::create([
                'course_id' => $request->data['course_id'],
                'title' => $request->data['title'],
                'description' => $request->data['description'],
                'viewable' => $request->data['viewable'],
                'url_title' => $this->generateSectionURLTitle($request->data['title'])
            ])) {
                return ['success', 'Course Section has been added successfully.'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function storeQuiz(Request $request)
    {
        try {
            $quiz = Quizzes::create([
                'course_id' => $request->data['course_id'],
                'title' => $request->data['title'],
                'viewable' => $request->data['viewable'],
            ]);

            foreach ($request->data['prereq_sections'] as $req) {
                QuizPrerequisites::create([
                    'quiz_id' => $quiz->id,
                    'section_id' => $req
                ]);
            }

            return ["success", "Quiz has been added successfully."];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function enrollUser(Request $request)
    {
        try {
            CourseUsers::create([
                'user_id' => auth()->user()->id,
                'course_id' => $request->data['course_id']
            ]);

            return [
                'success',
                'You have been enrolled successfully.'
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function generateSectionURLTitle($course_section_title)
    {
        $slug = Str::slug($course_section_title);
        $course_section = CourseSections::where('url_title', 'like', $slug . '%')->count();

        return  $course_section > 0 ? $slug . '-' . ($course_section + 1) : $slug;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $course = Courses::with('courseSections')->find($request->route('id'));
        $categories = Categories::all();
        // $sections = CourseSections::where('course_id', $request->route('id'))->get();
        if (auth()->check() && auth()->user()->role_id == 1) {
            return view('courses.admin.edit', compact('course', 'categories'));
        } else {
            return view('courses.student.view', compact('course', 'categories'));
        }
    }

    protected function generateURLTitle($course_title)
    {
        $slug = Str::slug($course_title);
        $course = Courses::where('url_title', 'like', $slug . '%')->count();

        return  $course > 0 ? $slug . '-' . ($course + 1) : $slug;
    }

    public function changeActivation(Request $request)
    {
        try {
            if ($course = Courses::find($request->data['id'])) {
                if ($course->active == 0) {
                    $course->update(['active' => 1]);
                } else {
                    $course->update(['active' => 0]);
                }
            }
            return [
                "success",
                "Course active status has been updated successfully"
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $courses)
    {
        //
    }

    public function storeContent(Request $request)
    {
        try {
            $section_content = CourseSectionContents::create([
                'course_id' => $request->data['course_id'],
                'course_section_id' => $request->data['section_id'],
                'title' => $request->data['title'],
                'description' => $request->data['description']
            ]);

            $i = 0;
            foreach ($request->data['link_titles'] as $title) {
                if ($title != "") {
                    ContentLinks::create([
                        'course_section_content_id' => $section_content->id,
                        'title' => $title,
                        'type' => $request->data['link_types'][$i]
                    ]);
                    $i++;
                }
            }
            return ['success', 'Content has been added to this section successfully.'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $courses)
    {
        //
    }
}
