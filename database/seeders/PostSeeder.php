<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('posts')->insert([
                'artist_name' => 'アーティスト名',
                'theday'=>'2023/10/04',
                'venue' => '会場名',
                'seat' => '座席位置',
                'stage_distance' => '近さ',
                'others' => 'その他',
                'fan_service' => 'ファンサ',
                'falling_objects' => '落下物',
                'visible' => '肉眼',
                'comment' => '感想',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);
    }
}
