<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $math = Subject::updateOrCreate(['name' => 'Math']);

        $question = $math->questions()->create([
            'question' => 'What is 3+3?'
        ]);

        $question->answers()->createMany([
            ['answer' => '1', 'is_correct' => false],
            ['answer' => '2', 'is_correct' => false],
            ['answer' => '3', 'is_correct' => false],
            ['answer' => '4', 'is_correct' => false],
            ['answer' => '5', 'is_correct' => false],
            ['answer' => '6', 'is_correct' => true]
        ]);
    }
}
