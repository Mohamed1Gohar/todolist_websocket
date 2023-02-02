<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TodoList;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create();

         TodoList::factory()->create();


//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@user.com',
//         ]);
//        \App\Models\User::factory()->create([
////            'phone' => '01099371188',
//            'name' => 'Mohamed Gohar',
//            'email' => 'Mohamed@user.com',
//        ]);
    }
}
