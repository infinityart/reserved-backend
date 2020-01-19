<?php

use Illuminate\Database\Seeder;

class HairdresserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = [];

        for ($i = 0; $i < 5; $i++) {
            $seed[] = [
                'Name' => \Illuminate\Support\Str::random(rand(5, 25)),
                'AvatarUrl' => $i . '.png',
            ];
        }

        \Illuminate\Support\Facades\DB::table('Hairdresser')->insert($seed);
    }
}
