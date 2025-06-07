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
                'course_id' => $request->data['course_id'],
                'description' => $request->data['description']
            ]);

            return [
                "success",
                "Learning Outcome has been added successfully"
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            LearningOutcomes::find($request->data['id'])
                ->update(['description' => $request->data['description']]);

            return [
                "success",
                "Learning Outcome has been updated successfully"
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
