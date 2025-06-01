<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function next(Request $request)
    {
        $request->validate(['subject_id' => 'nullable|exists:subjects,id']);

        return Question::with('answers')
            ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
            ->inRandomOrder()
            ->firstOrFail();
    }

    public function checkAnswer(Request $request, Question $question)
    {
        $request->validate(['answer_id' => 'required|exists:answers,id']);

        return [
            'correct' => $question->answers()
                ->where('id', $request->answer_id)
                ->where('is_correct', true)
                ->exists()
        ];
    }
}
