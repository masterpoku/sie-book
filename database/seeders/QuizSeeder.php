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
                'jawaban_a' => 'Bandung',
                'jawaban_b' => 'Jakarta',
                'jawaban_c' => 'Surabaya',
                'jawaban_d' => 'Medan',
                'jawaban_benar' => 'B',
            ],
            [
                'submateris_id' => 1,
                'pertanyaan' => 'Berapa hasil dari 5 + 3?',
                'jawaban_a' => '6',
                'jawaban_b' => '7',
                'jawaban_c' => '8',
                'jawaban_d' => '9',
                'jawaban_benar' => 'C',
            ],
            [
                'submateris_id' => 2,
                'pertanyaan' => 'Siapa penemu bola lampu?',
                'jawaban_a' => 'Alexander Graham Bell',
                'jawaban_b' => 'Isaac Newton',
                'jawaban_c' => 'Thomas Alva Edison',
                'jawaban_d' => 'Nikola Tesla',
                'jawaban_benar' => 'C',
            ],
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
