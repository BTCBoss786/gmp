<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            ['name' => 'Admission Issues'],
            ['name' => 'Examination Issues'],
            ['name' => 'Certificate Issues'],
            ['name' => 'Hostel Issues'],
            ['name' => 'Scholarship Issues'],
            ['name' => 'Unlawful Activity Issues'],
            ['name' => 'Other Issues']
        ]);
    }
}
