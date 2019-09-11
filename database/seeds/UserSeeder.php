<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'andy',
            'email' => 'andy@email.com',
            'password' => Hash::make('secret'),
        ]);
        DB::table('classes')->insert([
            'classId' => '1',
            'name' => 'class',
            'description' => 'descriprtion',
            'location' => 'global',
        ]);
        /*for ($i=0; $i < 1000; $i++) {
            DB::table('events')->insert([
                'name' => Str::random(20),
                'date' => date('Y/m/d H:i:s', strtotime(rand(2015,2019).'-'.rand(1,12).'-'.rand(1,31).
            ' '.rand(1,12).':'.rand(0,59).':'.rand(0,59))),
                'classId' => 1,
                'location' => Str::random(10),
            ]);
        } */
    }
}
