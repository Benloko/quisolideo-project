<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuisolideoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Admin users (2 roles)
        $admins = [
            [
                'email' => 'admin@quisolideo.com',
                'name' => 'Admin Entreprenariat',
                'role' => 'admin_entreprenariat',
                'default_password' => 'changeme',
            ],
            [
                'email' => 'boutique@quisolideo.com',
                'name' => 'Admin Boutique',
                'role' => 'admin_boutique',
                'default_password' => 'changeme',
            ],
        ];

        foreach ($admins as $admin) {
            $existing = DB::table('users')->where('email', $admin['email'])->first();

            if (!$existing) {
                DB::table('users')->insert([
                    'email' => $admin['email'],
                    'password' => app(\Illuminate\Hashing\BcryptHasher::class)->make($admin['default_password']),
                    'name' => $admin['name'],
                    'role' => $admin['role'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                continue;
            }

            // Ensure correct role for these admin accounts, without resetting password
            $updates = [];
            $updates['role'] = $admin['role'];
            if (empty($existing->name)) {
                $updates['name'] = $admin['name'];
            }
            if (!empty($updates)) {
                $updates['updated_at'] = $now;
                DB::table('users')->where('id', $existing->id)->update($updates);
            }
        }

        // Sample partners (insert if missing by name)
        $partners = [
            ['name' => 'Partenaire A', 'description' => 'Partenaire local A', 'website' => '', 'logo' => ''],
            ['name' => 'Partenaire B', 'description' => 'Partenaire B', 'website' => '', 'logo' => ''],
        ];

        foreach ($partners as $partner) {
            if (!DB::table('partners')->where('name', $partner['name'])->exists()) {
                DB::table('partners')->insert(array_merge($partner, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }

        // Sample trainings (insert if missing by slug)
        $trainings = [
            ['title' => 'Formation en artisanat', 'slug' => 'formation-artisanat', 'short_description' => "Apprenez l'artisanat local", 'content' => 'Contenu...', 'image' => '/assets/artisanat.jpg', 'seats' => 20, 'price' => 0.00],
            ['title' => 'Techniques agricoles', 'slug' => 'techniques-agricoles', 'short_description' => 'Méthodes modernes', 'content' => 'Contenu...', 'image' => '/assets/agriculture.jpg', 'seats' => 30, 'price' => 0.00],
            ['title' => 'Design graphique', 'slug' => 'design-graphique', 'short_description' => 'Initiation au design', 'content' => 'Contenu...', 'image' => '/assets/design.jpg', 'seats' => 15, 'price' => 0.00],
        ];

        foreach ($trainings as $training) {
            if (!DB::table('trainings')->where('slug', $training['slug'])->exists()) {
                DB::table('trainings')->insert(array_merge($training, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }

        // Sample products (boutique MVP) (insert if missing by slug)
        $products = [
            [
                'name' => 'Carnet Quisolideo (A5)',
                'slug' => 'carnet-quisolideo-a5',
                'short_description' => 'Carnet de notes pratique pour vos idées et projets.',
                'description' => "Un carnet simple et robuste pour accompagner vos formations, projets et idées.\n\nFormat: A5 · Couverture souple · Pages lignées.",
                'image' => null,
                'price' => 2500.00,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'T-shirt Quisolideo',
                'slug' => 'tshirt-quisolideo',
                'short_description' => 'T-shirt confortable, logo Quisolideo.',
                'description' => "T-shirt en coton, coupe unisexe.\nTailles disponibles: S · M · L · XL (précisez en note).",
                'image' => null,
                'price' => 6000.00,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Kit de démarrage — Artisanat',
                'slug' => 'kit-demarrage-artisanat',
                'short_description' => 'Kit pratique pour débuter (outils + supports).',
                'description' => "Un kit pensé pour débuter sereinement.\nContenu variable selon disponibilité.",
                'image' => null,
                'price' => 12000.00,
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Affiche Quisolideo',
                'slug' => 'affiche-quisolideo',
                'short_description' => 'Affiche décorative (A3).',
                'description' => "Affiche A3 — impression de qualité.\nIdéale pour décorer un atelier ou un espace de travail.",
                'image' => null,
                'price' => 3000.00,
                'stock' => 25,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            if (!DB::table('products')->where('slug', $product['slug'])->exists()) {
                DB::table('products')->insert(array_merge($product, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }
    }
}
