Repository Github: https://github.com/alexdev06/ToDoList
Lien vers l'application en ligne: https://todolist.alexandremanteaux.fr

Procédure d'installation :
1. Importer le repository en téléchargeant le zip ou en le clonant avec la commande :
git clone https://github.com/alexdev06/ToDoList.git

2. Installer les bibliothèques avec la commande composer install

3. Dans le fichier .env:

	- Configurer votre base de données avec son nom et les informations de connexion dans la section doctrine/doctrine-bundle:
		- Version du serveur
		- Login
		- Mot de passe
		- Nom de la base de données
		- Mettre en version de dev(développemnent) ou prod(production)dans la section symfony/framework-bundle

4. Pour créer la base de données: php bin/console doctrine:database:create (ou installer la base de donnée grâche au fichier todolist.sql fourni)

5. Pour installer les tables de données via le système de migrations: php bin/console doctrine:migrations:migrate

6. Installer un jeu de données: php bin/console doctrine:fixtures:load

7. Démarrer le serveur de Symfony: symfony server:start

8. En cas de bugs, vider les caches avec les commandes php bin/console cache:clear et php bin/console cache:clear --env=prod

9. Pour tester l'application vous pouvez utiliser les comptes suivant:

Compte administrateur:
login: "alex06" et le mot de passe: "password"
Compte utilisateur:
login: "ludo06" mot de passe "password"