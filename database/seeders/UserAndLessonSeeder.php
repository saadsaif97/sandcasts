<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'saad saif',
            'username' => 'saad-saif',
            'email' => 'saadgfx97@gmail.com',
            'password' => Hash::make('dingdong'),
        ]);

        Lesson::factory()->count(5)->create();
    }
}
