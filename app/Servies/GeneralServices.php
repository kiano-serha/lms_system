<?php

namespace App\Servies;

use App\Models\Courses;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use App\PDF;
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

    // public function generateCertificate($course_id)
    // {
    //     $public_dir = public_path("certificates/" . $uuid);

    //     // $row = [
    //     //     'class' => 'abc', // can you set your field on DB
    //     //     'course' => $course->name, // can you set your field on DB
    //     //     'formattedDate' => date('Y-m-d H:i:s')
    //     // ];

    //     $pdf = new PDF();
    //     //Replace with an actual path
    //     $pdf->setSourceFile(Storage::path(''));
    //     $pdf->AddPage();
    //     $pdf->SetFont("helvetica", "B", 17);
    //     $pdf->SetTextColor(0, 0, 0);
    //     $pdf->Text(13, 12, auth()->user()->name); // name awarded certificate
    //     $pdf->Text(135, 124.5, Courses::find($course_id)->title);
    //     $pdf->Text(150, 134, $row['class']);
    //     $pdf->SetFont("helvetica", "B", 12);
    //     $pdf->Text(120, $request->get('date-y'), $formattedDate);
    //     $certificatePath = public_path("certificates/" . $uuid . "/" . auth()->user()->name . ".pdf");

    //     $pdf->Output($certificatePath, 'F');


    //     $zip = new ZipArchive;
    //     if ($zip->open($public_dir . '/' . 'Certificates.zip', ZipArchive::CREATE) === TRUE) {
    //         // Add File in ZipArchive
    //         foreach (glob($public_dir . "/*") as $file) {
    //             $zip->addFile($file, basename($file));
    //         }
    //         $zip->close();
    //     }

    //     return response()->download($public_dir . '/Certificates.zip', 'Certificates.zip');
    // }

    public function __construct()
    {
        
    }
}
