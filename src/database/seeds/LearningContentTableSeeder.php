<?php

use Illuminate\Database\Seeder;
// DBファサード
use Illuminate\Support\Facades\DB;
class LearningContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('learning_contents')->truncate();
        
        $param =[
            [
                'name' => 'N予備校',
                'color' => '#1077a3'
            ],
            [
                'name' => 'ドットインストール',
                'color' => '#0b03fc'
            ],
            [
                'name' => 'POSSE課題',
                'color' => '#19b4c2'
            ]
        ];
        DB::table('learning_contents')->insert($param);
    }
    
}
