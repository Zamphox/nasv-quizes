<?php

namespace App\Livewire;

use App\Models\Answer;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Question;
use Jenssegers\Agent\Agent;

class Quiz extends Component
{
    public ?Question $question = null;
    public ?Collection $selectedAnswers = null;
    public bool $showResults = false;
    public bool $showQuestion = true;
    public ?Collection $shuffledAnswers = null;
    public bool $isMobile = false;
    public int $correctAnswersCount = 1;

    public function mount(): void
    {
        $agent = new Agent;
        $this->isMobile = $agent->isMobile();
        $this->selectedAnswers = collect();
        $this->nextQuestion();
    }

    /**
     * @param int $answerId
     * @return void
     */
    public function toggleAnswer(int $answerId): void
    {
        $answer = Answer::find($answerId);

        if (is_null($this->selectedAnswers)) {
            $this->selectedAnswers = collect();
        }

        if ($this->selectedAnswers->contains('id', $answer->id)) {
            $this->selectedAnswers = $this->selectedAnswers->reject(function ($a) use ($answer) {
                return $a->id === $answer->id;
            });
        } else {
            if ($this->selectedAnswers->count() < $this->correctAnswersCount) {
                $this->selectedAnswers->push($answer);
            }
        }

    }

    /**
     * @return void
     */
    public function nextQuestion(): void
    {
        $this->question = Question::with('answers')->when(!blank($this->question?->id), function ($query) {
            $query->whereNot('id', $this->question->id);
        })->inRandomOrder()->first();
        $this->correctAnswersCount = $this->question->answers->where('is_correct', true)->count();

        $this->shuffledAnswers = $this->question->answers->shuffle();

        $this->selectedAnswers = collect();
        $this->showResults = false;
        $this->showQuestion = false;

        $this->dispatch('questionUpdated');
    }

    /**
     * @return void
     */
    public function checkAnswers(): void
    {
        $this->showResults = true;
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
