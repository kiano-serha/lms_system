<?php

namespace App\Http\Controllers;

use App\Models\TargetAudience;
use Illuminate\Http\Request;
use Exception;

class TargetAudienceController extends Controller
{
    public function store(Request $request)
    {
        try {
            TargetAudience::create([
                'course_id' => $request->data['course_id'],
                'description' => $request->data['description']
            ]);

            return [
                "success",
                "Target Audience has been added successfully"
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            TargetAudience::find($request->data['id'])
                ->update(['description' => $request->data['description']]);

            return [
                "success",
                "Target Audience has been updated successfully"
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
