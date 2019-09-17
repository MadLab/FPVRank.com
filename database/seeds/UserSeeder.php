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
            'email' => 'andy.cr.002@gmail.com',
            'password' => Hash::make('secret'),
        ]);
        DB::table('classes')->insert([
            'classId' => '1',
            'name' => 'class',
            'description' => 'descriprtion',
            'location' => 'global',
        ]);
    }
}
