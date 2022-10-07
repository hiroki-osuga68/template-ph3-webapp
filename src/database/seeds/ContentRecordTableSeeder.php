<?php

use Illuminate\Database\Seeder;
// DBファサード
use Illuminate\Support\Facades\DB;
class ContentRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('content_records')->truncate();

        $params = [
            [
                'date' => '2022-10-07',
                'study_hour' => 2,
                'user_id' => 1,
                'learning_content_id' => 1,
            ],
            [
                'date' => '2022-10-08',
                'study_hour' => 5,
                'user_id' => 1,
                'learning_content_id' => 2,
            ],
            [
                'date' => '2022-10-09',
                'study_hour' => 8,
                'user_id' => 1,
                'learning_content_id' => 3,
            ]
        ];

        DB::table('content_records')->insert($params);
    }
}
