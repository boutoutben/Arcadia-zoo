# Arcadia-zoo

## Description 

Site du zoo arcadia pour les visités et le personnel du zoo. Les visiteurs peuvent avoir un apperçu du zoo pour les persuadé d'y aller. Le personnel peut actualé des services du zoo et s'occuper des animaux. 

## Prérequis

Avant de déployer l'application en local, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- **Git** : pour cloner le dépôt.
- **PHP 7.4+** : pour exécuter l'application.
- **Composer** : pour gérer les dépendances PHP.
- **Yarn** : pour gérer les dépendances front-end.
- **Mysql** : pour la base de donnée.
- **Heroku** : pour déployer

## Installation 

- git clone https://github.com/boutoutben/Arcaria-zoo/
- composer install
- heroku login
- cd Arcaria-zoo
- git init
- heroku create arcadia-zoo
- heroku git:remote -a arcadia-zoo
- heroku buildpacks:add heroku/php
- heroku addons:create jawsdb:kitefin 
- git add .
- git commit -a "commit-name"
- git push heroku main
- heroku open