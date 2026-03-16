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
        // Create 15 cities
        $cities = [
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fes',
            'Tangier',
            'Agadir',
            'Meknes',
            'Oujda',
            'Kenitra',
            'Tetouan',
            'Safi',
            'Mohammedia',
            'Khouribga',
            'El Jadida',
            'Beni Mellal',
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }

        // Create 10 categories
        $categories = [
            'Plomberie',
            'Électricité',
            'Peinture',
            'Menuiserie',
            'Jardinage',
            'Maçonnerie',
            'Carrelage',
            'Serrurerie',
            'Climatisation',
            'Nettoyage',
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // Create 2 admin users
        User::create([
            'name' => 'Admin One',
            'email' => 'admin1@allomaalem.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345678',
            'role' => 'admin',
            'is_verified' => true,
        ]);

        User::create([
            'name' => 'Admin Two',
            'email' => 'admin2@allomaalem.com',
            'password' => Hash::make('password123'),
            'phone' => '0612345679',
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // Create 4 client users
        $clients = [];
        $clientNames = ['Ahmed Benali', 'Fatima Zahra', 'Mohammed Karim', 'Layla Hassan'];
        $clientEmails = ['ahmed@example.com', 'fatima@example.com', 'mohammed@example.com', 'layla@example.com'];
        $clientPhones = ['0612345680', '0612345681', '0612345682', '0612345683'];

        for ($i = 0; $i < 4; $i++) {
            $clients[] = User::create([
                'name' => $clientNames[$i],
                'email' => $clientEmails[$i],
                'password' => Hash::make('password123'),
                'phone' => $clientPhones[$i],
                'role' => 'client',
                'is_verified' => true,
            ]);
        }

        // Create 4 maalem users
        $maalems = [];
        $maalemNames = ['Hassan Alaoui', 'Youssef Bennani', 'Samir Tazi', 'Karim Mansouri'];
        $maalemEmails = ['hassan@example.com', 'youssef@example.com', 'samir@example.com', 'karim@example.com'];
        $maalemPhones = ['0612345684', '0612345685', '0612345686', '0612345687'];
        $maalemBios = [
            'Électricien professionnel avec 15 ans d\'expérience',
            'Plombier expert en installations sanitaires',
            'Peintre spécialisé en décoration intérieure',
            'Menuisier créatif et innovant',
        ];

        for ($i = 0; $i < 4; $i++) {
            $maalems[] = User::create([
                'name' => $maalemNames[$i],
                'email' => $maalemEmails[$i],
                'password' => Hash::make('password123'),
                'phone' => $maalemPhones[$i],
                'role' => 'maalem',
                'bio' => $maalemBios[$i],
                'is_verified' => true,
            ]);
        }

        // Create some jobs
        $job1 = Job::create([
            'title' => 'Réparation fuite d\'eau',
            'description' => 'Fuite d\'eau dans la cuisine',
            'budget' => 500,
            'status' => 'open',
            'is_urgent' => true,
            'user_id' => $clients[0]->id,
            'category_id' => 1,
            'city_id' => 1,
        ]);

        $job2 = Job::create([
            'title' => 'Installation électrique',
            'description' => 'Installation de nouveaux circuits électriques',
            'budget' => 1500,
            'status' => 'open',
            'is_urgent' => false,
            'user_id' => $clients[1]->id,
            'category_id' => 2,
            'city_id' => 2,
        ]);

        $job3 = Job::create([
            'title' => 'Peinture salon',
            'description' => 'Peinture complète du salon',
            'budget' => 800,
            'status' => 'in_progress',
            'is_urgent' => false,
            'user_id' => $clients[2]->id,
            'category_id' => 3,
            'city_id' => 3,
        ]);

        // Create applications
        Application::create([
            'proposed_price' => 450,
            'message' => 'Je peux faire ce travail rapidement',
            'status' => 'pending',
            'job_id' => $job1->id,
            'user_id' => $maalems[0]->id,
        ]);

        Application::create([
            'proposed_price' => 1400,
            'message' => 'Travail de qualité garanti',
            'status' => 'accepted',
            'job_id' => $job2->id,
            'user_id' => $maalems[1]->id,
        ]);

        Application::create([
            'proposed_price' => 750,
            'message' => 'Je suis disponible immédiatement',
            'status' => 'accepted',
            'job_id' => $job3->id,
            'user_id' => $maalems[2]->id,
        ]);

        // Create reviews
        Review::create([
            'rating' => 5,
            'comment' => 'Excellent travail, très professionnel',
            'job_id' => $job2->id,
            'reviewer_id' => $clients[1]->id,
            'reviewed_id' => $maalems[1]->id,
        ]);

        Review::create([
            'rating' => 4,
            'comment' => 'Bon travail, rapide et efficace',
            'job_id' => $job3->id,
            'reviewer_id' => $clients[2]->id,
            'reviewed_id' => $maalems[2]->id,
        ]);
    }
}
