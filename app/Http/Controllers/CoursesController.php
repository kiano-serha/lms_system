<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursesRequest;
use App\Models\Categories;
use App\Models\Courses;
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
        //
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

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    protected function generateURLTitle($course_title)
    {
        $slug = Str::slug($course_title);
        $course = Courses::where('url_title', 'like', $slug . '%')->count();

        return  $course > 0 ? $slug . '-' . ($course + 1) : $slug;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $courses)
    {
        //
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
