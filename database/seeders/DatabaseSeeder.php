<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Job;
use App\Models\Application;
use App\Models\Review;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create cities
        $cities = [
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fes',
            'Tangier',
            'Agadir',
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }

        // Create categories
        $categories = [
            'Plomberie',
            'Électricité',
            'Peinture',
            'Menuiserie',
            'Jardinage',
            'Maçonnerie',
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@allomaalem.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345678',
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // Create client users
        $client1 = User::create([
            'name' => 'Ahmed Benali',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345679',
            'role' => 'client',
            'is_verified' => true,
        ]);

        $client2 = User::create([
            'name' => 'Fatima Zahra',
            'email' => 'fatima@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345680',
            'role' => 'client',
            'is_verified' => true,
        ]);

        // Create maalem users
        $maalem1 = User::create([
            'name' => 'Mohammed Karim',
            'email' => 'mohammed@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345681',
            'role' => 'maalem',
            'bio' => 'Plombier expérimenté avec 10 ans d\'expérience',
            'is_verified' => true,
        ]);

        $maalem2 = User::create([
            'name' => 'Hassan Alaoui',
            'email' => 'hassan@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345682',
            'role' => 'maalem',
            'bio' => 'Électricien professionnel',
            'is_verified' => true,
        ]);

        // Create jobs
        $job1 = Job::create([
            'title' => 'Réparation fuite d\'eau',
            'description' => 'Fuite d\'eau dans la cuisine',
            'budget' => 500,
            'status' => 'open',
            'is_urgent' => true,
            'user_id' => $client1->id,
            'category_id' => 1,
            'city_id' => 1,
        ]);

        $job2 = Job::create([
            'title' => 'Installation électrique',
            'description' => 'Installation de nouveaux circuits électriques',
            'budget' => 1500,
            'status' => 'open',
            'is_urgent' => false,
            'user_id' => $client2->id,
            'category_id' => 2,
            'city_id' => 2,
        ]);

        // Create applications
        Application::create([
            'proposed_price' => 450,
            'message' => 'Je peux faire ce travail rapidement',
            'status' => 'pending',
            'job_id' => $job1->id,
            'user_id' => $maalem1->id,
        ]);

        Application::create([
            'proposed_price' => 1400,
            'message' => 'Travail de qualité garanti',
            'status' => 'accepted',
            'job_id' => $job2->id,
            'user_id' => $maalem2->id,
        ]);

        // Create reviews
        Review::create([
            'rating' => 5,
            'comment' => 'Excellent travail, très professionnel',
            'job_id' => $job2->id,
            'reviewer_id' => $client2->id,
            'reviewed_id' => $maalem2->id,
        ]);
    }
}
