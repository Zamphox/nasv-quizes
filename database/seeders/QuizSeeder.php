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

        $questions = $math->questions()->createMany([
            ['question' => '3+3?'],
            ['question' => '2+2?'],
        ]);

        $questions[0]->answers()->createMany([
            ['answer' => '6', 'is_correct' => true],
            ['answer' => '6+0', 'is_correct' => true],
            ['answer' => '2', 'is_correct' => false],
            ['answer' => '3', 'is_correct' => false],
            ['answer' => '4', 'is_correct' => false],
            ['answer' => '5', 'is_correct' => false],
        ]);

        $questions[1]->answers()->createMany([
            ['answer' => '4', 'is_correct' => true],
            ['answer' => '5', 'is_correct' => false],
            ['answer' => '6', 'is_correct' => false],
            ['answer' => '7', 'is_correct' => false],
        ]);
    }
}
