# Cahier des charges — Quisolideo

## Contexte
Quisolideo est une entreprise promouvant l’entrepreneuriat local (artisanat, agriculture, pêche, art graphique). Le projet comporte deux parties distinctes :

1. Un site vitrine professionnel en français présentant l’identité, les formations, les partenaires et les contacts de Quisolideo.
2. Une application e‑commerce dédiée à la vente des produits, accessible depuis le site vitrine via un lien/CTA, hébergée séparément ou sur un sous‑domaine.

## Objectifs
- Présenter l’identité et les formations/partenaires de Quisolideo.
- Proposer une application e‑commerce accessible depuis le site vitrine (bouton/CTA) avec catalogue, panier et paiement.
- Offrir une expérience professionnelle, animée et responsive (mobile + desktop).
- Fournir un admin simple pour gérer contenus, produits et commandes.

## Périmètre MVP (livrables)
- Site vitrine (HTML/CSS/Bootstrap/JS ou PHP) : pages Accueil, À propos, Nos formations, Nos partenaires, Contact.
- Application e‑commerce : catalogue, fiche produit, panier, checkout, tableau de bord admin.
- Intégration lien/site : CTA "Accéder à la boutique" sur le site vitrine.
- Authentification admin (gestion produits/commandes).
- Paiement initial : Stripe (cartes) + option paiement à la livraison (COD).
- Documentation minimale + instructions de déploiement.

## Public cible
Jeunes entrepreneurs, artisans et clients finaux intéressés par les produits locaux (marché Bénin / international francophone).

## Contraintes & règles
- Langue : Français uniquement.
- Base de données : MySQL.
- Sécurité : HTTPS obligatoire, conformité Stripe (paiements sécurisés), protection des données (RGPD minimal).
- Contenu : images de qualité pour arrière‑plans et galeries produit.

## Choix technologiques proposés
Option choisie par le client : PHP + MySQL.
Recommandation technique :
- Backend : PHP 8.x (Laravel recommandé pour projet professionnel) ou PHP natif pour plus de légèreté.
- Frontend : HTML5, Bootstrap 5, JavaScript (Alpine.js ou Vanilla JS), animations via GSAP / Lottie.
- BDD : MySQL / MariaDB.
- Paiement : Stripe (API) + option COD.
- Hébergement : PaaS (Render / Cloudways / Platform) ou VPS selon budget.

## Fonctionnalités détaillées (MVP)
### Vitrine
- Header / Footer globaux avec CTA vers la boutique.
- Pages : Accueil (hero image animée), À propos, Nos formations (liste), Nos partenaires (logos), Contact (formulaire + map).
- Responsive + animations (transitions, hover, parallax léger).

### E‑commerce
- Catalogue : recherche, filtres, catégories.
- Fiche produit : galerie d'images, description, prix, stock.
- Panier : ajout / suppression / modification quantités.
- Checkout : adresse de livraison, choix de paiement (Stripe / COD), récapitulatif.
- Admin : CRUD produits, gestion commandes (statuts), export CSV.
- Notifications : emails de confirmation client + alerte admin.

## API & intégration
- API REST simple (JSON) pour échanges front ↔ back : endpoints pour listes et détails des formations/produits.
- Webhook Stripe pour confirmation paiement.

## Modèle de données (simplifié)
- `users` (admin) : id, email, password_hash, name, role, created_at
- `partners` : id, name, description, website, logo, created_at
- `trainings` : id, title, slug, short_description, content, image, seats, price, created_at
- `training_partner` : training_id, partner_id
- `sessions` : id, training_id, start_date, end_date, location, seats_available
- `media` : id, type, path, alt
- `contact_messages` : id, name, email, message, read_flag, created_at

## Sécurité & exploitation
- Validation côté serveur et client, protection CSRF, hachage des mots de passe.
- Sauvegarde régulière de la base de données.
- Contrôle des uploads (types et tailles), optimisation des images (webp).

## Déploiement & workflow
- `composer` pour dépendances PHP (si Laravel), `.env` pour configurations.
- Migrations SQL stockées dans `migrations/`.
- CI (GitHub Actions) : lint, tests, déploiement sur PaaS/VPS.

## Planning indicatif (pour MVP)
- Semaine 0 : Validation du cahier des charges.
- Semaine 1–2 : Scaffolding + pages vitrine + design UI.
- Semaine 3–5 : Catalogue, fiches et admin CRUD.
- Semaine 6 : Panier & checkout + intégration Stripe.
- Semaine 7 : Tests, corrections, documentation, déploiement.

## Livrables
- Code source dans un repo Git.
- Fichier PDF du cahier des charges.
- README d'installation.
- Documentation admin minimale.

## Questions ouvertes
- Souhaitez‑vous Laravel (framework complet) ou PHP natif ?
- Souhaitez‑vous inclure Mobile Money dès le MVP ?
- Les images et contenus (formations, partenaires) sont‑ils fournis ?

---

*Rédigé pour Quisolideo — version initiale du cahier des charges.*
