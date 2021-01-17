# INSTALLATION APACHE, PHP, NODE et MYSQL avec DOCKER

/* Installer docker */
* sudo apt install docker.io

/* Administrer les droits */
* sudo usermod -aG docker $USER

/* création d'un répertoire pour les contenus que l'ont souhaite modifier et conserver (fichiers du site et les bases de donnés) */
* mkdir -p ~/.docker/www ~/.docker/mysql

/* rendre lisible et modifiable le répertoire */
* chmod 777 ~/.docker/www ~/.docker/mysql

# Configurer le projet laravel
/* configurer le fichier .env */
* DB_HOST = db

/* Créer un fichier Dockerfile-php et y ajouter le contenu suivant */
            FROM php:7.4-fpm

            # Arguments defined in docker-compose.yml
            ARG user
            ARG uid

            # Install system dependencies
            RUN apt-get update && apt-get install -y \
                git \
                curl \
                libpng-dev \
                libonig-dev \
                libxml2-dev \
                zip \
                unzip

            # Clear cache
            RUN apt-get clean && rm -rf /var/lib/apt/lists/*

            # Install PHP extensions
            RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

            # Get latest Composer
            COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

            # Create system user to run Composer and Artisan Commands
            RUN useradd -G www-data,root -u $uid -d /home/$user $user
            RUN mkdir -p /home/$user/.composer && \
                chown -R $user:$user /home/$user

            # Set working directory
            WORKDIR /var/www

            USER $user

/* Créer un fichier Dockerfile-node et y ajouter le contenu suivant */
FROM node:10.21.0-alpine

                RUN apk update && apk upgrade && \
                    echo @edge http://nl.alpinelinux.org/alpine/edge/community >> /etc/apk/repositories && \
                    echo @edge http://nl.alpinelinux.org/alpine/edge/main >> /etc/apk/repositories && \
                    apk add --no-cache bash chromium@edge nss@edge

                USER node

                RUN mkdir /home/node/.npm-global
                ENV PATH=/home/node/.npm-global/bin:$PATH
                ENV NPM_CONFIG_PREFIX=/home/node/.npm-global

                ENV HOME=/home/node

                WORKDIR $HOME/app

                RUN npm i -g npm

                WORKDIR $HOME/app/frontend

                EXPOSE 4200

/* créer un dossier docker-compose et un sous dossier : /nginx */
* mkdir -p docker-compose/nginx

/* dans le sous dossier /nginx, créer un fichier travellist.conf et y ajouter le contenu suivant */
            server {
                listen 80;
                index index.php index.html;
                error_log  /var/log/nginx/error.log;
                access_log /var/log/nginx/access.log;
                root /var/www/public;
                location ~ \.php$ {
                    try_files $uri =404;
                    fastcgi_split_path_info ^(.+\.php)(/.+)$;
                    fastcgi_pass app:9000;
                    fastcgi_index index.php;
                    include fastcgi_params;
                    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                    fastcgi_param PATH_INFO $fastcgi_path_info;
                }
                location / {
                    try_files $uri $uri/ /index.php?$query_string;
                    gzip_static on;
                }
            }


/* à la racine du projet, créer un fichier docker-compose.yml et y ajouter le contenu suivant */

version: "3.5"
services:
  app:
    build:
      args:
        user: benj
        uid: 1000
      context: ./
      dockerfile: Dockerfile
    image: travellist
    container_name: distropic-app
    restart: unless-stopped
    working_dir: /var/www/
    volumes:
      - ./:/var/www
    networks:
      - default

  db:
    image: mysql:5.7
    container_name: distropic-db
    restart: unless-stopped
    environment:
      
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_USER: ${DB_USERNAME}
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql

    networks:
      - default
  
      

  nginx:
    image: nginx:alpine
    container_name: distropic-nginx
    restart: unless-stopped
    ports:
      - 8000:80
    volumes:
      - ./:/var/www
      - ./.docker/nginx:/etc/nginx/conf.d/
    networks:
      - default

  node:
    build:
      context: .
      dockerfile: Dockerfile-node
    volumes: 
      - .:/home/node/app/frontend

networks:
  default:
    driver: bridge


# Exécutez l'application avec Docker Compose 

/* Construisez l'image de l'application */
* docker-compose build app

/* Lorsque la construction est terminée, vous pouvez exécuter l'environnement en mode arrière-plan */
* docker-compose up -d

/* afficher des informations sur l'état de vos services actifs */
* docker-compose ps

/*  exécuter composer install */ 
* docker-compose exec app composer install

/* lancer les différentes commandes php en débutant par la commande suivante */
* docker-compose exec app

/* exemple */
* docker-compose exec app php artisan key:generate
* docker-compose exec app php artisan migrate:refresh --seed
/* etc */ 

/* lancer la compilation npm */
* docker-compose run node npm <cmd>

/* accédez au nom de domaine ou à l'adresse IP de votre serveur sur le port 8000 */
* http://distropic.localhost:8001/

# Information supplémentaire 

- trouver l'adresse ip qu'utilise mysql pour se connecter

/* voir les 'containerID' */
* docker ps

/* voir l'adresse ip du 'containerID' */
* docker inspect <containerID> | grep "IPAdress"


# Plus d'information : 
https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-20-04-fr