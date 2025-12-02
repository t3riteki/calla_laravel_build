<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseRequest;
use App\Models\Module;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class ParseController extends Controller{
    public function parse(ParseRequest $request){
        try{
            $auth = Auth::user();

            $validated = $request->validated();

            // Check if file exists
            if (!$request->hasFile('attachment')) {
                Log::error('No file in request');
                return back()->with('error', 'No file uploaded');
            }

            Log::info('File received', [
                'original_name' => $request->file('attachment')->getClientOriginalName(),
                'size' => $request->file('attachment')->getSize(),
                'mime' => $request->file('attachment')->getMimeType()
            ]);

            $path = $request->file('attachment')->store('fileTemp');
            Log::info('Stored at: ' . $path);

            // Convert to full path
            $fullPath = Storage::path($path);
            Log::info('Full path: ' . $fullPath);

            if (!file_exists($fullPath)) {
                Log::error('File does not exist at: ' . $fullPath);
                return back()->with('error', 'File not found after upload');
            }

            Log::info('File exists, size: ' . filesize($fullPath) . ' bytes');

            // ------------------------------------------
            // 📌 Extract text using Spatie pdf-to-text
            // ------------------------------------------
            $preParse = Pdf::getText($fullPath);
            Log::info('Extracted Text: ', [$preParse]);
            // echo $preParse; // remove this in production

            // Parse the structure
            $parsedStructure = $this->parsePdfStructure($preParse);
            Log::info('Parsing complete', $parsedStructure);

            // Validate parsed data
            if (empty($parsedStructure['module']['name'])) {
                Log::error('Module name is empty after parsing');
                return back()->with('error', 'Could not parse module name from PDF');
            }

            $currentModule = Module::create([
                'owner_id' => $auth->id,
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

            // Clean up
            Storage::delete($path);

            $sysMsg = 'Successfully uploaded module ' . $validated['attachment']->getClientOriginalName();
            Log::create([
                'user_id' => $auth->id,
                'action' => $sysMsg
            ]);
            return back()->with('success',$sysMsg);
        }
        catch(Exception $e){
            Log::error('Parse controller error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', $e->getMessage());
        }
    }

    private function normalizeExtractedText(string $text): array
    {
        // Insert line breaks BEFORE each label
        $keywords = [
            'Module:',
            'Lesson:',
            'Description:',
            'Glossary:',
            'Term:',
            'Meaning:',
        ];

        foreach ($keywords as $key) {
            $text = preg_replace('/\s*' . preg_quote($key, '/') . '\s*/', "\n{$key} ", $text);
        }

        // Convert to array of trimmed lines
        $lines = preg_split('/\r\n|\r|\n/', $text);
        return array_map('trim', array_filter($lines, fn($l) => $l !== ''));
    }

    public function parsePdfStructure(string $text)
    {
        $lines = $this->normalizeExtractedText($text);

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
                // push previous lesson
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
                // term
                if (str_starts_with($line, 'Term:')) {
                    // if a previous glossary entry exists, push it
                    if ($currentGlossary) {
                        $currentLesson['glossaries'][] = $currentGlossary;
                    }

                    $currentGlossary = [
                        'term' => trim(substr($line, strlen('Term:'))),
                        'meaning' => null
                    ];
                    continue;
                }

                // meaning
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
