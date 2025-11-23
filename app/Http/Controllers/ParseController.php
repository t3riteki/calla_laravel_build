<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseRequest;
use App\Models\Glossary;
use App\Models\Lesson;
use App\Models\Module;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class ParseController extends Controller
{
    public function parse(ParseRequest $request){
        try{
            $user = Auth::user();

            $path = $request->file('attachment')->store('fileTemp');
            $preParse = $this->extractText($path);
            $parsedStructure = $this->parsePdfStructure($preParse);

            $currentModule = Module::create([
                'owner_id' => $user->id,
                'name' => $parsedStructure['module']['name'],
                'description' => $parsedStructure['module']['description'],
            ]);

            foreach($parsedStructure['lessons'] as $lesson){
                $currentLesson = $currentModule->lesson()->create([
                    'module_id'=>$currentModule->id,
                    'name'=>$lesson['name'],
                    'description'=>$lesson['description'],
                ]);

                foreach($lesson['glossaries'] as $glossary){
                    $currentLesson->glossary()->create([
                        'lesson_id'=>$currentLesson->id,
                        'term'=>$glossary['term'],
                        'meaning'=>$glossary['meaning'],
                    ]);
                }
            }
            return back()->with('success', 'Module Uplaoded Successfully');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function extractText(String $path){
        $text = Pdf::getText($path);
        return $text;
    }

    public function parsePdfStructure(string $text)
{
    $lines = preg_split('/\r\n|\r|\n/', $text);

    $data = [
        'module' => [
            'name' => null,
            'description' => null,
        ],
        'lessons' => []
    ];

    $currentLesson = null;
    $currentGlossary = null;
    $collectingGlossary = false;

    foreach ($lines as $line) {
        $line = trim($line);

        // skip empty
        if ($line === '') continue;

        // --- MODULE ---
        if (str_starts_with($line, 'Module:')) {
            $data['module']['name'] = trim(substr($line, strlen('Module:')));
            continue;
        }

        if (str_starts_with($line, 'Description:') && !$currentLesson) {
            $data['module']['description'] = trim(substr($line, strlen('Description:')));
            continue;
        }

        // --- LESSON ---
        if (str_starts_with($line, 'Lesson:')) {

            // Finish previous glossary item if still open
            if ($currentGlossary) {
                $currentLesson['glossaries'][] = $currentGlossary;
                $currentGlossary = null;
            }

            // Close glossary mode
            $collectingGlossary = false;

            // Push previous lesson
            if ($currentLesson) {
                $data['lessons'][] = $currentLesson;
            }

            $currentLesson = [
                'name' => trim(substr($line, strlen('Lesson:'))),
                'description' => null,
                'glossaries' => []
            ];
            continue;
        }

        // Lesson Description
        if (str_starts_with($line, 'Description:') && $currentLesson) {
            $currentLesson['description'] = trim(substr($line, strlen('Description:')));
            continue;
        }

        // --- GLOSSARY MODE ---
        if (str_starts_with($line, 'Glossary')) {
            $collectingGlossary = true;
            continue;
        }

        if ($collectingGlossary) {

            // Term
            if (str_starts_with($line, 'Term:')) {

                // push previous glossary entry
                if ($currentGlossary) {
                    $currentLesson['glossaries'][] = $currentGlossary;
                }

                $currentGlossary = [
                    'term' => trim(substr($line, strlen('Term:'))),
                    'meaning' => null
                ];
                continue;
            }

            // Meaning
            if (str_starts_with($line, 'Meaning:')) {
                if ($currentGlossary) {
                    $currentGlossary['meaning'] = trim(substr($line, strlen('Meaning:')));
                }
                continue;
            }
        }
    }

    // add last gloss or lesson
    if ($currentGlossary) {
        $currentLesson['glossaries'][] = $currentGlossary;
    }
    if ($currentLesson) {
        $data['lessons'][] = $currentLesson;
    }

    return $data;
}

}
