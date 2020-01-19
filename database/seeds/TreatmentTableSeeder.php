<?php

use Illuminate\Database\Seeder;

class TreatmentTableSeeder extends Seeder
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
            $minutes = rand(1, (60 * 3) / 15) * 15;
            $randTime = sprintf('%02d:%02d:00', floor($minutes / 60), $minutes % 60);

            $seed[] = [
                'Name' => \Illuminate\Support\Str::random(rand(5, 25)),
                'Duration' => $randTime,
            ];
        }

        \Illuminate\Support\Facades\DB::table('Treatment')->insert($seed);
    }
}
