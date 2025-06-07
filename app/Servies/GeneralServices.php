<?php

namespace App\Servies;

use App\Models\Courses;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use OpenAI;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
// use App\PDF;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class GeneralServices
{
    protected $fpdi;
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function upload($path = './uploads', $file = 'image'): ?string
    {
        File::ensureDirectoryExists($path);

        if (request()->hasFile($file)) {
            $fileWithExt = request()->file($file)->getClientOriginalName();
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
            $extension = request()->file($file)->getClientOriginalExtension();
            $fileNameToStore = $filename . '-' . time() . '.' . $extension;
            $path = request()->file($file)->storeAs($path, $fileNameToStore);
            return $path;
            // return asset($path);
        }
        return null;
    }

    public function generateCertificate($course_name)
    {
        $pdf = Pdf::loadView('certificates.view', ['course' => $course_name]);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function generateText($prompt)
    {
        return Http::withToken("")
            ->post(
                'https://api.openai.com/v1/chat/completions',
                [
                    "model" => "gpt-4o-mini",
                    "messages" => [
                        [
                            "role" => "system",
                            "content" => "Only use credible sources and provide citations. If user question is not hypertension related, tell them you can not assist them."
                        ],
                        [
                            "role" => "user",
                            "content" => $prompt
                        ]
                    ]
                ]
            )->json('choices.0.message.content');
    }

    public function __construct() {}
}
