<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tangier',
            'Agadir', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
            'Safi', 'Mohammedia', 'Khouribga', 'El Jadida', 'Beni Mellal',
        ];
        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }

        $categories = [
            'Plomberie', 'Électricité', 'Peinture', 'Menuiserie', 'Jardinage',
            'Maçonnerie', 'Carrelage', 'Serrurerie', 'Climatisation', 'Nettoyage',
        ];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        User::create(['name' => 'Admin One',   'email' => 'admin1@allomaalem.com', 'password' => Hash::make('password123'), 'phone' => '0600000001', 'role' => 'admin',  'is_verified' => true]);
        User::create(['name' => 'Admin Two',   'email' => 'admin2@allomaalem.com', 'password' => Hash::make('password123'), 'phone' => '0600000002', 'role' => 'admin',  'is_verified' => true]);
        User::create(['name' => 'Admin Three', 'email' => 'admin3@allomaalem.com', 'password' => Hash::make('password123'), 'phone' => '0600000003', 'role' => 'admin',  'is_verified' => true]);

        $clientData = [
            ['name' => 'Ahmed Benali',   'email' => 'ahmed@example.com',   'phone' => '0611000001'],
            ['name' => 'Fatima Zahra',   'email' => 'fatima@example.com',   'phone' => '0611000002'],
            ['name' => 'Mohammed Karim', 'email' => 'mohammed@example.com', 'phone' => '0611000003'],
        ];
        $clients = [];
        foreach ($clientData as $data) {
            $clients[] = User::create([
                'name'        => $data['name'],
                'email'       => $data['email'],
                'password'    => Hash::make('password123'),
                'phone'       => $data['phone'],
                'role'        => 'client',
                'is_verified' => true,
            ]);
        }

        $maalemData = [
            ['name' => 'Hassan Alaoui',   'email' => 'hassan@example.com',  'phone' => '0622000001', 'bio' => 'Électricien professionnel avec 15 ans d\'expérience'],
            ['name' => 'Youssef Bennani', 'email' => 'youssef@example.com', 'phone' => '0622000002', 'bio' => 'Plombier expert en installations sanitaires'],
            ['name' => 'Samir Tazi',      'email' => 'samir@example.com',   'phone' => '0622000003', 'bio' => 'Peintre spécialisé en décoration intérieure'],
        ];
        $maalems = [];
        foreach ($maalemData as $data) {
            $maalems[] = User::create([
                'name'        => $data['name'],
                'email'       => $data['email'],
                'password'    => Hash::make('password123'),
                'phone'       => $data['phone'],
                'role'        => 'maalem',
                'bio'         => $data['bio'],
                'is_verified' => true,
            ]);
        }

        $jobTitles = [
            'Réparation fuite d\'eau',
            'Installation électrique complète',
            'Peinture salon et chambre',
            'Pose de carrelage cuisine',
            'Réparation porte en bois',
            'Jardinage et taille de haies',
            'Installation climatiseur',
            'Travaux de maçonnerie',
            'Serrurerie porte principale',
            'Nettoyage après travaux',
        ];

        $jobs = [];
        foreach ($clients as $clientIndex => $client) {
            for ($j = 0; $j < 10; $j++) {
                $jobs[] = Job::create([
                    'title'       => $jobTitles[$j],
                    'description' => 'Description détaillée pour le travail : ' . $jobTitles[$j],
                    'budget'      => rand(300, 3000),
                    'status'      => 'open',
                    'is_urgent'   => ($j % 3 === 0),
                    'user_id'     => $client->id,
                    'category_id' => ($j % 10) + 1,
                    'city_id'     => ($clientIndex * 3 + $j % 3) + 1,
                ]);
            }
        }

        foreach ($maalems as $maalemIndex => $maalem) {
            $offset = $maalemIndex * 7;
            $selectedJobs = array_slice($jobs, $offset, 7);

            $statuses = ['accepted', 'accepted', 'pending', 'pending', 'pending', 'pending', 'rejected'];

            foreach ($selectedJobs as $i => $job) {
                Application::create([
                    'proposed_price' => rand(200, 2500),
                    'message'        => 'Je suis disponible et qualifié pour ce travail.',
                    'status'         => $statuses[$i],
                    'job_id'         => $job->id,
                    'user_id'        => $maalem->id,
                ]);

                if ($statuses[$i] === 'accepted') {
                    $job->update(['status' => 'in_progress']);

                    Review::create([
                        'rating'      => rand(3, 5),
                        'comment'     => 'Bon travail, professionnel et ponctuel.',
                        'job_id'      => $job->id,
                        'reviewer_id' => $job->user_id,
                        'reviewed_id' => $maalem->id,
                    ]);
                }
            }
        }
    }
}
