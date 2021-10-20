# Déploiement

## en local

1 - ouvrir le dossier de l'application dans un IDE. </br>
2 - Créer la base de données avec php bin/console doctrine:database:create puis  php bin/console doctrine:migrations:migrate. </br>
3 - installer doctrineFixtureBundle avec : 'composer require orm-fixtures' </br>
4 - entrer la commande  php bin/console doctrine:fixtures:load afin de charger l'utilisateur employé

## Entrer dans l'application en tant qu' employé

## Lancer le serveur en local

lancer un serveur avec Xampp ou wampp suivant vos préférences et OS utilisés. Puis dans un terminal lancez la commande 'Symfony serve -d' pour lancer le serveur en arrière plan sur le port localhost:8000.
Vous pouvez ouvrir votre navigateur à l'adresse <http://localhost:8000/> . Connectez-vous à l'aide du bouttton de connexion en haut à droite de la barre de navigation. entrer l'adresse mail suivante : 'b.richard@test.com' et le mot de passe : Admin72.
Vous avez maintenant tout pouvoir pour administrer le site tout en enregistrant de nouveaux utilisateurs, valdez leur compte, louer des livres et les rendres, validez les retours... en passant tour à tour d'employé à utilisateur.

## Déploiement  Heroku

Si ce n'est pas déjà fait, installer le client heroku
`-$ npm install -g heroku`

Connectez vous sur votre compte heroku
`-$ heroku login`

depuis le répertoire racine, lancez la commande pour créer l'application
`-$ heroku create`

avant tout déploiement il faut créer un fichier procfile qui défini le point d'entrée du programme: le répertoire public/
`-$ echo 'web: heroku-php-apache2 public/' > Procfile`

Attention! Sous windows ce fichier ne fonctionnera pas ainsi formaté. vous devrez le passer dans un editeur de texte, comme notepad, et le sauvegarder dans le repertoire racine de l'application sans l'extension de fichier.

Pour definir l'environement du projet en production tapez la commande suivante

`-$ heroku config:set APP_ENV=prod`

Définissez la base de données :
`-$ heroku config:set DATABASE_URL= URL de la database`

Suivant si vous êtes en postGreSQL vous pouvez définir l'adresse de votre BDD sur l'interface du dashboard de heroku
Si vous êtes en MySQL il vous faudra un add-on, je conseille ClearDB qui offre un plan gratuit. Lors de son installation il Crée une base de donné. C'est celle ci que vous devrait indiquer.

Pour la redirection des pages il faudra installer un package apache symfony
`-$ composer req symfony/apache-pack`

Un fichier .htaccess sera créer automatiquement dans /public.

Il ne reste plus qu' à push sur github:
`-$ git add .`
`-$ git commit -m 'Deployement heroku'`
`-$ git push`
puis sur heroku:
`-$ git push heroku main`

Et voilà, l'application est déployé au bout de quelques instants.
