Déploiement local via Docker Compose

Prérequis:
- Docker et Docker Compose installés

Démarrer les services (nginx + php-fpm + mysql):

```bash
cd quisolideo-laravel
docker compose up -d --build
```

Accéder à l'app: http://localhost:8080

Configurer l'environnement (exemple `.env.docker` ou modifier `.env`):

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=quisolideo
DB_USERNAME=quisolideo_user
DB_PASSWORD=secretpassword
```

Puis exécuter les migrations/seeding depuis le conteneur `app`:

```bash
docker compose exec app php artisan migrate --seed
```

Notes:
- Remplacez mots de passe par des valeurs sécurisées pour la production.
- Pour déployer en production, adaptez la configuration (supervisor, cache, SSL, backups).
