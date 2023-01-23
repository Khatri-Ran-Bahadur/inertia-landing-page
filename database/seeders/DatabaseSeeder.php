<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $name = "Admin";
        $path = '/users/images/';
        $fontPath = public_path('fonts/Oliciy.ttf');
        $nf = strtoupper($name[0]);
        $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
        $createAvatar = makeAvatar($fontPath, $path, $newAvatarName, $nf);
        $picture = $createAvatar == true ? $newAvatarName : '';
        $picture = $path . $picture;


        \App\Models\User::create([
            'name' => $name,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'image' => $picture
        ]);
    }
}
