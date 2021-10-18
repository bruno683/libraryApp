# Déploiement en local

1 - ouvrir le dossier de l'application dans un IDE. </br>
2 - Créer la base de données avec php bin/console doctrine:database:create puis  php bin/console doctrine:migrations:migrate. </br>
3 - installer doctrineFixtureBundle avec : 'composer require orm-fixtures' </br>
4 - entrer la commande  php bin/console doctrine:fixtures:load afin de charger l'utilisateur employé

## Entrer dans l'application en tant qu' employé

## Lancer le serveur en local

lancer un serveur avec Xampp ou wampp suivant vos préférences et OS utilisés. Puis dans un terminal lancez la commande 'Symfony serve -d' pour lancer le serveur en arrière plan sur le port localhost:8000.
Vous pouvez ouvrir votre navigateur à l'adresse <http://localhost:8000/> . Connectez-vous à l'aide du bouttton de connexion en haut à droite de la barre de navigation. entrer l'adresse mail suivante : 'b.richard@test.com' et le mot de passe : Admin72'.
Vous avez maintenant tout pouvoir pour administrer le site tout en enregistrant de nouveaux utilisateurs, valdez leur compte, louer des livres et les rendres, validez les retours... en passant tour à tour d'employé à utilisateur.
