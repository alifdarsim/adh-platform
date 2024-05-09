<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;
use App\Models\AssessmentQuestions;
use Illuminate\Http\Request;

class AssessmentEditorController extends Controller
{
    public function show()
    {
        $questions = AssessmentQuestions::orderBy('order')->get();
        return view('admin.assessment.index', compact('questions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'order' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
        ]);

        $questions = AssessmentQuestions::where('order', $request->order)->first();
        // if question not exist then create new
        if (!$questions) {
            $questions = new AssessmentQuestions();
        }

        $questions->question = $request->question;
        $questions->order = $request->order;
        $questions->options = [
            $request->option1,
            $request->option2,
            $request->option3,
            $request->option4,
        ];
        $questions->save();
        return success('Question updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'order' => 'required',
        ]);
        $questions = AssessmentQuestions::where('order', $request->order)->first();
        $questions->delete();
        // re-ordering the questions
        $questions = AssessmentQuestions::orderBy('order')->get();
        foreach ($questions as $key => $question) {
            $question->order = $key + 1;
            $question->save();
        }
        return success('Question deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'order' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
        ]);
        $questions = new AssessmentQuestions();
        $questions->question = $request->question;
        $questions->order = $request->order;
        $questions->options = [
            $request->option1,
            $request->option2,
            $request->option3,
            $request->option4,
        ];
        $questions->save();
        // re-ordering the questions
        $questions = AssessmentQuestions::orderBy('order')->get();
        foreach ($questions as $key => $question) {
            $question->order = $key + 1;
            $question->save();
        }
        return success('Question added successfully');
    }
}
