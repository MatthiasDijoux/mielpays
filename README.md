

## À propos MielPays

MielPays est un marketplace destiné à la vente de miel à la Réunion.

## Mise en place de l'app

* docker-compose build
* docker-compose up
* docker-compose exec app composer install
* docker-compose run node npm install

/*Pour la base de donnée*/

* créer le fichier .env et y ajouter le contenu de .env.example
* docker-compose exec app php artisan migrate --seed
* docker-compose exec app php artisan passport:install

Utiliser Workbench et créer une connexion vers `localhost:8306`

## Info supplémentaire

Parametrer votre connexion mysql ainsi sur workbench :
* Hostname: localhost 
* Port: 8306
* Username: root
* Password: root

Votre site en local : http://distropic.localhost:8001/