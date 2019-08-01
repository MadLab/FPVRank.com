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
            'password' => Hash::make('Secret'),            
        ]);
        for ($i=0; $i < 100; $i++) { 
            DB::table('users')->insert([            
                'name' => Str::random(10),                
                'email' => 'andy'.$i.'@email.com',            
                'password' => Hash::make('secret'),
            ]);
        }
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
        }
    }
}
