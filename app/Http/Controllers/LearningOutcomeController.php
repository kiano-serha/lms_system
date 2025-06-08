<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcomes;
use Illuminate\Http\Request;
use Exception;

class LearningOutcomeController extends Controller
{
    public function store(Request $request)
    {
        try {
            LearningOutcomes::create([
                'course_id' => $request->course_id,
                'description' => $request->description
            ]);

            return redirect()->route('courses.edit', ['id' => $request->course_id])->with(["success" => "Learning Outcome for this course has been added successfully"]);
        } catch (Exception $e) {
            return redirect()->back()->with(["error" => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            LearningOutcomes::find($request->id)
                ->update(['description' => $request->description]);

            return [
                "success",
                "Learning Outcome has been updated successfully"
            ];
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
