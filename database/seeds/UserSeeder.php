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
            'name' => 'drone grande',
            'description' => 'description',
        ]);
        DB::table('classes')->insert([
            'name' => 'drone pequeno',
            'description' => 'description',
        ]);
        DB::table('pilots')->insert([
            'name' => 'Andy Alfaro',
            'username' => 'username',
        ]);
        DB::table('pilots')->insert([
            'name' => 'Erick Alfaro',
            'username' => 'username',
        ]);
        DB::table('pilots')->insert([
            'name' => 'Henry Alfaro',
            'username' => 'username',
        ]);
        DB::table('pilots')->insert([
            'name' => 'Alison Alfaro',
            'username' => 'username',
        ]);
        /*
        for ($i=0; $i < 100; $i++) { 
            DB::table('classes')->insert([            
                'name' => Str::random(10),                
                'description' => Str::random(10),                            
            ]);
        }
        for ($i=0; $i < 100; $i++) { 
            DB::table('pilots')->insert([            
                'name' => Str::random(10),                
                'username' => Str::random(10),                            
            ]);
        }*/
    }
}
