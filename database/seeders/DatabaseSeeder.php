<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Model;
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
        // \App\Models\User::factory(1)->create();
        \App\Models\User::create([
            'username' => 'admin',
            'fullname' => 'ADMIN',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'phone' => '-',
            'address' => 'Kec Jati Agung Lampung Selatan',
            'user_images' => 'profile-img.jpg',
            'role' => true
        ]);
        // \App\Models\Post::factory(100)->create();

        \App\Models\Category::create([
            'slug' => 'aparatur-desa',
            'name' => 'Aparatur Desa'
        ]);
        \App\Models\Category::create([
            'slug' => 'umkm',
            'name' => 'UMKM'
        ]);
        \App\Models\Tag::create([
            'slug_tag' => 'dusun-3b',
            'name_tag' => 'Dusun 3B'
        ]);
        \App\Models\Tag::create([
            'slug_tag' => 'Kegiatan-Desa',
            'name_tag' => 'Kegiatan Desa'
        ]);
    }
}