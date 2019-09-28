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
        DB::table('users')->insert([
            'name' => 'robert',
            'email' => 'robert@madlab.com',
            'password' => Hash::make('secret'),
        ]);
        //permissions
        $ctrl = [0 => 'UserController', 1 => 'ClassController', 2 => 'PilotController', 3 => 'EventController'];
        for ($i=1; $i < 3; $i++) {
            for ($a=0; $a < 4; $a++) {
                DB::table('permissions')->insert([
                    'userId' => $i,
                    'edit' => 1,
                    'create' => 1,
                    'controller' => $ctrl[$a]
                ]);
            }
        }
        DB::table('classes')->insert([
            'classId' => '1',
            'name' => 'class',
            'description' => 'description',
            'location' => 'global',
        ]);
    }
}
