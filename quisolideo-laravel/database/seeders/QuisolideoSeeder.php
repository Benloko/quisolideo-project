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

                        // Programme LIME / EQD — parcours (from brochure)
                        [
                                'title' => 'Incubation en milieu économique',
                                'slug' => 'lime-eqd-incubation',
                                'short_description' => 'Programme LIME / EQD — de l’idée à la création : structurer, piloter et avancer avec une approche orientée résultats.',
                                'content' => <<<'HTML'
<h3>Programme LIME / EQD</h3>
<p>Un parcours d’incubation pensé pour passer de l’idée à une activité structurée, avec des outils simples et un accompagnement terrain.</p>

<h4>Pour qui ?</h4>
<ul>
    <li>Porteurs de projets et entrepreneurs potentiels (emplois indépendants).</li>
</ul>

<h4>Ce que vous allez travailler</h4>
<ul>
    <li>Initiation à l’entrepreneuriat (méthodologie GERME — BIT).</li>
    <li>De l’idée à la création : TRIE → CREE (trouver l’idée, valider, créer).</li>
    <li>Organisation de l’entreprise : rôles, processus, priorités.</li>
    <li>Gestion axée sur les résultats (GAR) : objectifs, indicateurs, suivi.</li>
    <li>Partage d’expériences avec des opérateurs économiques.</li>
    <li>Réseautage et insertion dans l’écosystème professionnel.</li>
    <li>Assistance et conseils personnalisés dans la gestion.</li>
</ul>

<h4>Résultat attendu</h4>
<p>Une vision claire, une organisation simple et un plan d’action concret pour avancer.</p>
HTML,
                                'image' => null,
                                'seats' => 0,
                                'price' => 0.00,
                        ],
                        [
                                'title' => 'Potentiels employés (employabilité)',
                                'slug' => 'lime-eqd-employabilite',
                                'short_description' => 'Programme LIME / EQD — immersion, posture professionnelle et insertion : préparer efficacement l’entrée en entreprise.',
                                'content' => <<<'HTML'
<h3>Programme LIME / EQD</h3>
<p>Un parcours orienté insertion : comprendre les attentes de l’entreprise, gagner en posture professionnelle et sécuriser une première expérience.</p>

<h4>Pour qui ?</h4>
<ul>
    <li>Diplômés, demandeurs d’emploi et candidats à un premier poste.</li>
</ul>

<h4>Au programme</h4>
<ul>
    <li>Passer de la vie de l’école à la vie de l’entreprise.</li>
    <li>Immersion sur un poste ciblé (mise en situation, gestes métiers).</li>
    <li>Retours d’expérience de professionnels (ce qui marche sur le terrain).</li>
    <li>Savoir-être en entreprise : communication, discipline, collaboration.</li>
    <li>Attestation de stage / aptitude en fin d’immersion (selon le dispositif).</li>
    <li>Appui à l’insertion professionnelle : orientation et réseau.</li>
</ul>
HTML,
                                'image' => null,
                                'seats' => 0,
                                'price' => 0.00,
                        ],
                        [
                                'title' => 'Renforcement de capacités',
                                'slug' => 'lime-eqd-renforcement-capacites',
                                'short_description' => 'Programme LIME / EQD — renforcer l’organisation, le pilotage et la performance (managers, cadres et opérationnels).',
                                'content' => <<<'HTML'
<h3>Programme LIME / EQD</h3>
<p>Renforcer les compétences managériales et opérationnelles pour améliorer l’organisation et la performance au poste.</p>

<h4>Volet 1 — Chefs et gestionnaires d’entreprise</h4>
<ul>
    <li>Organisation de l’entreprise (approche GERME — BIT).</li>
    <li>Gestion axée résultats (GAR) : pilotage, décisions et suivi.</li>
    <li>Partage d’expériences avec des opérateurs économiques du même secteur.</li>
    <li>Réseau professionnel : opportunités et mises en relation.</li>
    <li>Assistance et conseils sur des cas réels.</li>
</ul>

<h4>Volet 2 — Cadres, agents de maîtrise et opérationnels</h4>
<ul>
    <li>Amélioration de la performance au poste (qualité + productivité).</li>
    <li>Bonnes pratiques et retours d’expérience terrain.</li>
    <li>Assistance / coaching dans l’exercice de la fonction.</li>
    <li>Intégration dans un réseau professionnel de la même catégorie.</li>
</ul>
HTML,
                                'image' => null,
                                'seats' => 0,
                                'price' => 0.00,
                        ],
                        [
                                'title' => 'Réinsertion agro‑artisanale',
                                'slug' => 'lime-eqd-reinsertion-agro-artisanale',
                                'short_description' => 'Programme LIME / EQD — réinsertion et reconversion vers des filières porteuses : agriculture, artisanat, numérique et plus.',
                                'content' => <<<'HTML'
<h3>Programme LIME / EQD</h3>
<p>Un dispositif de réinsertion et de reconversion vers des filières porteuses, avec un accompagnement pratique.</p>

<h4>Domaines concernés</h4>
<ul>
    <li>Agriculture</li>
    <li>Élevage</li>
    <li>Pêche</li>
    <li>Arts culinaires</li>
    <li>Artisanat</li>
    <li>Numérique</li>
    <li>Arts graphiques (imprimerie, édition)</li>
</ul>

<h4>Population cible</h4>
<ul>
    <li>Porteurs de projets (emplois indépendants) et entrepreneurs potentiels.</li>
    <li>Diplômés et demandeurs d’emploi (emplois salariés).</li>
    <li>Chefs, gestionnaires, cadres et agents de maîtrise.</li>
    <li>Travailleurs du secteur privé moderne.</li>
    <li>Travailleurs du monde agricole et artisanal.</li>
    <li>Déscolarisés, déflatés et départs volontaires de la fonction publique.</li>
</ul>
HTML,
                                'image' => null,
                                'seats' => 0,
                                'price' => 0.00,
                        ],
        ];

        foreach ($trainings as $training) {
            if (!DB::table('trainings')->where('slug', $training['slug'])->exists()) {
                DB::table('trainings')->insert(array_merge($training, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }

        // Sample product categories (insert if missing by slug)
        $categoryRows = [
            [
                'name' => 'Papeterie',
                'slug' => 'papeterie',
                'description' => 'Carnets et supports utiles au quotidien.',
                'image' => '/assets/accueil.png',
            ],
            [
                'name' => 'Textile',
                'slug' => 'textile',
                'description' => 'T-shirts et articles à l\'identité Quisolideo.',
                'image' => '/assets/accueil.png',
            ],
            [
                'name' => 'Kits',
                'slug' => 'kits',
                'description' => 'Kits et packs pour démarrer plus vite.',
                'image' => '/assets/accueil.png',
            ],
            [
                'name' => 'Affiches',
                'slug' => 'affiches',
                'description' => 'Affiches et visuels pour votre espace.',
                'image' => '/assets/accueil.png',
            ],
        ];

        $categoryIds = [];
        foreach ($categoryRows as $row) {
            $existing = DB::table('product_categories')->where('slug', $row['slug'])->first();
            if (!$existing) {
                $categoryIds[$row['slug']] = DB::table('product_categories')->insertGetId(array_merge($row, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
                continue;
            }

            $categoryIds[$row['slug']] = $existing->id;
        }

        $catalogueId = DB::table('product_categories')->where('slug', 'catalogue')->value('id');
        if ($catalogueId) {
            $categoryIds['catalogue'] = $catalogueId;
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
                'product_category_id' => $categoryIds['papeterie'] ?? ($categoryIds['catalogue'] ?? null),
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
                'product_category_id' => $categoryIds['textile'] ?? ($categoryIds['catalogue'] ?? null),
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
                'product_category_id' => $categoryIds['kits'] ?? ($categoryIds['catalogue'] ?? null),
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
                'product_category_id' => $categoryIds['affiches'] ?? ($categoryIds['catalogue'] ?? null),
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
