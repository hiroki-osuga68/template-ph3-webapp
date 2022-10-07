<?php

use Illuminate\Database\Seeder;
// DBファサード
use Illuminate\Support\Facades\DB;
class LearningLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('learning_languages')->truncate();

        $params = [
            [
                'name' => 'JavaScript',
                'color' => '#0b03fc'
            ],
            [
                'name' => 'CSS',
                'color' => '#1077a3'
            ],
            [
                'name' => 'PHP',
                'color' => '#19b4c2'
            ],
            [
                'name' => 'HTML',
                'color' => '#86c2db'
            ],
            [
                'name' => 'Laravel',
                'color' => '#b6a3d1'
            ],
            [
                'name' => 'SQL',
                'color' => '#7250ab'
            ],
            [
                'name' => 'SHELL',
                'color' => '#4d0fb8'
            ],
            [
                'name' => '情報システム基礎知識(その他)',
                'color' => '#2f0b6e'
            ]
        ];
        DB::table('learning_languages')->insert($params);
    }
}
