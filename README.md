

## À propos Distropic

Distropic est un boilerplate mettant en place une architecture couplant le framework Laravel au framework Vuejs avec un système d'authentification.

## Processus de mise en marche 

Pour mettre en place le projet, vous devez disposer sur votre appareil de Docker qui permet la containerisation des outils tel que nodes, nginx, apache ou encore mysql.

## Installation de Distropic

Pour installer correctement distropic il vous faut entrer les lignes de commandes suivant dans le terminal du projet :

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

Felicitation !! Vous avez accès au boilerplate :).

Votre site en local : http://distropic.localhost:8001/