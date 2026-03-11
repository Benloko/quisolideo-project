<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class QuisolideoSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'email' => 'admin@quisolideo.com',
            'password' => app(\Illuminate\Hashing\BcryptHasher::class)->make('changeme'),
            'name' => 'Admin Quisolideo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sample partners
        DB::table('partners')->insert([
            ['name'=>'Partenaire A','description'=>'Partenaire local A','website'=>'','logo'=>''],
            ['name'=>'Partenaire B','description'=>'Partenaire B','website'=>'','logo'=>''],
        ]);

        // Sample trainings
        DB::table('trainings')->insert([
            ['title'=>'Formation en artisanat','slug'=>'formation-artisanat','short_description'=>'Apprenez l\'artisanat local','content'=>'Contenu...','image'=>'/assets/artisanat.jpg','seats'=>20,'price'=>0.00,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Techniques agricoles','slug'=>'techniques-agricoles','short_description'=>'Méthodes modernes','content'=>'Contenu...','image'=>'/assets/agriculture.jpg','seats'=>30,'price'=>0.00,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Design graphique','slug'=>'design-graphique','short_description'=>'Initiation au design','content'=>'Contenu...','image'=>'/assets/design.jpg','seats'=>15,'price'=>0.00,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
