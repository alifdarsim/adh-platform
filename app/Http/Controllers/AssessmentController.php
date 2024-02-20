<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentQuestions;
use Illuminate\Http\Request;
use Response;
use Route;
use Session;
use Str;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessment = Assessment::where('user_id', auth()->user()->id)->whereIn('status', ['complete', 'failed'])->first();
        if ($assessment) {
            return view('expert.assessment.complete', compact('assessment'));
        }

        $assessment = Assessment::where('user_id', auth()->user()->id)->where('status', 'active')->first();
        $active = 'false';
        if ($assessment) $active = 'true';
        $latest_question = 0;
        if ($assessment) {
            if ($assessment->answered != "[]") {
                $latest_question = $assessment->answered;
                $latest_question = json_decode($latest_question);
                $latest_question = end($latest_question);
                $latest_question = $latest_question->q;
            }
        }
        $questions = AssessmentQuestions::count();

        return view('expert.assessment.index', [
            'active' => $active,
            'latest_question' => $latest_question + 1,
            'assessment' => $assessment,
            'questions' => $questions,
        ]);
    }

    public function retake()
    {
        $assessment = Assessment::where('user_id', auth()->user()->id)->first();
        $assessment->delete();
        success('Assessment delete successfully');
    }

    public function getQuestion()
    {
        $user_created = Assessment::where('user_id', auth()->user()->id)->first();
        if (!$user_created) {
            $assessment = new Assessment();
            $assessment->user_id = auth()->user()->id;
            $assessment->answered = "[]";
            $assessment->save();
        }

        $active = Assessment::select('id')->where('status', 'active')->first();
        // if no active assessment, create one
        if (!$active) {
            $assessment = Assessment::where('user_id', auth()->user()->id)->first();
            $assessment->start_at = now();
            $assessment->answered = "[]";
            $assessment->user_id = auth()->user()->id;
            $assessment->status = 'active';
            $assessment->save();
        }

        $id = request('question');
        $question = AssessmentQuestions::select('id', 'question', 'options')->where('id', $id)->first();
        $question->options = collect($question->options)->shuffle();
        return $question;
    }


    public function checkAnswer()
    {
        $id = request('question');
        $answer = request('answer');
        $question = AssessmentQuestions::select('id', 'options')->where('id', $id)->first();
        $correct = $question->options[0];
        $next = AssessmentQuestions::select('id')->where('id', '>', $id)->first();
        if ($next == null) {
            $next = 'complete';
        } else $next = $next->id;
        if ($answer == $correct) {
            // set assessment answered
            $answer = [
                'q' => $id,
                'c' => 1,
            ];
            $assessment = Assessment::where('user_id', auth()->user()->id)->where('status', 'active')->first();
            $answered = json_decode($assessment->answered);
            array_push($answered, $answer);
            $assessment->answered = json_encode($answered);
            $assessment->save();
            if ($next == 'complete') {
                $assessment = Assessment::where('user_id', auth()->user()->id)->where('status', 'active')->first();
                $answered = json_decode($assessment->answered);
                $score = 0;
                foreach ($answered as $answer) {
                    if ($answer->c == 1) $score++;
                }
                $assessment->score = $score;
                $assessment->total = AssessmentQuestions::count();
                // if score is 80% or more, set status to complete else set status to failed
                if ($score >= (count($answered) * 0.8)) $assessment->status = 'complete';
                else $assessment->status = 'failed';
                $assessment->save();
            }
            return Response::json([
                'success' => true,
                'next' => $next,
            ]);
        } else {
            // set assessment answered
            $answer = [
                'q' => $id,
                'c' => 0,
            ];
            $assessment = Assessment::where('user_id', auth()->user()->id)->where('status', 'active')->first();
            $answered = json_decode($assessment->answered);
            array_push($answered, $answer);
            $assessment->answered = json_encode($answered);
            $assessment->save();
            if ($next == 'complete') {
                $assessment = Assessment::where('user_id', auth()->user()->id)->where('status', 'active')->first();
                $answered = json_decode($assessment->answered);
                $score = 0;
                foreach ($answered as $answer) {
                    if ($answer->c == 1) $score++;
                }
                $assessment->score = $score;
                $assessment->total = AssessmentQuestions::count();
                // if score is 80% or more, set status to complete else set status to failed
                if ($score >= (AssessmentQuestions::count() * 0)) $assessment->status = 'complete';
                else $assessment->status = 'failed';
                $assessment->save();
            }
            return Response::json([
                'success' => false,
                'message' => $correct,
                'next' => $next,
            ], 400);
        }
    }
}
