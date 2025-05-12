<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            [
                'submateris_id' => 1,
                'pertanyaan' => 'Apa ibu kota Indonesia?',
                'jawaban_benar' => 'Jakarta',
            ],
            [
                'submateris_id' => 1,
                'pertanyaan' => 'Berapa hasil dari 5 + 3?',
                'jawaban_benar' => '8',
            ],
            [
                'submateris_id' => 2,
                'pertanyaan' => 'Siapa penemu bola lampu?',
                'jawaban_benar' => 'Thomas Alva Edison',
            ],
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}

