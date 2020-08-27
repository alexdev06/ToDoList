# ToDoList - Application de gestion des tâches quotidiennes
*Projet 8 du parcours "Développeur d'applications PHP/Symfony", formation OpenClassrooms*<br />

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/8f0aa6a34d634c339fbf6403bf04e9e9)](https://www.codacy.com/manual/alexdev06/ToDoList?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alexdev06/ToDoList&amp;utm_campaign=Badge_Grade)<br>

Lien vers l'application <https://todolist.alexandremanteaux.fr>

## Bibliothèques notables utilisées :
- Symfony lts 4.4.10
- fzaninotto/faker 1.9.1
- doctrine/doctrine-fixtures-bundle 3.3.1
- liip/test-fixtures-bundle 1.9
- symfony/css-selector 4.4.10
- symfony/phpunit-bridge 4.4.10 
- symfony/apache-pack 1.0


## Procédure d'installation :
1. Importer le repository en téléchargeant le zip ou en le clonant
avec la commande :<br> `git clone https://github.com/alexdev06/ToDoList.git`

2. Installer les bibliothèques avec la commande `composer install`

3. Modifier les variables d'environnement dans le fichier .env: 
    * Configurer votre base de données avec son nom et les informations de connexion dans la section `doctrine/doctrine-bundle`:
      * Version du serveur
      * Login
      * Mot de passe
      * Nom de la base de données
    * Mettre en version de dev(développemnent) ou prod(production)dans la section`symfony/framework-bundle `
    
4. Pour créer la base de données: `php bin/console doctrine:database:create`

5. Pour installer les tables de données via le système de migrations: `php bin/console doctrine:migrations:migrate`

6. Installer un jeu de données: `php bin/console doctrine:fixtures:load`

7. Démarrer le serveur de Symfony: `symfony server:start`

8. En cas de bugs, vider les caches avec les commandes `php bin/console cache:clear` et `php bin/console cache:clear --env=prod`
