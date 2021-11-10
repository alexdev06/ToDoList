# ToDoList - Application de gestion des tâches quotidiennes
*Projet 8 du parcours "Développeur d'applications PHP/Symfony", formation OpenClassrooms*<br />

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/8f0aa6a34d634c339fbf6403bf04e9e9)](https://www.codacy.com/manual/alexdev06/ToDoList?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alexdev06/ToDoList&amp;utm_campaign=Badge_Grade)<br>

Lien vers l'application <https://todolist.alexandremanteaux.fr>

## Description du besoin:
### Corrections d'anomalies
Une tâche doit être attachée à un utilisateur
Actuellement, lorsqu’une tâche est créée, elle n’est pas rattachée à un utilisateur. Il vous est demandé d’apporter les corrections nécessaires afin qu’automatiquement, à la sauvegarde de la tâche, l’utilisateur authentifié soit rattaché à la tâche nouvellement créée.

Lors de la modification de la tâche, l’auteur ne peut pas être modifié.

Pour les tâches déjà créées, il faut qu’elles soient rattachées à un utilisateur “anonyme”.

Choisir un rôle pour un utilisateur
Lors de la création d’un utilisateur, il doit être possible de choisir un rôle pour celui-ci. Les rôles listés sont les suivants :

rôle utilisateur (ROLE_USER) ;
rôle administrateur (ROLE_ADMIN).
Lors de la modification d’un utilisateur, il est également possible de changer le rôle d’un utilisateur.

### Implémentation de nouvelles fonctionnalités
Autorisation
Seuls les utilisateurs ayant le rôle administrateur (ROLE_ADMIN) doivent pouvoir accéder aux pages de gestion des utilisateurs.

Les tâches ne peuvent être supprimées que par les utilisateurs ayant créé les tâches en question.

Les tâches rattachées à l’utilisateur “anonyme” peuvent être supprimées uniquement par les utilisateurs ayant le rôle administrateur (ROLE_ADMIN).

Implémentation de tests automatisés
Il vous est demandé d’implémenter les tests automatisés (tests unitaires et fonctionnels) nécessaires pour assurer que le fonctionnement de l’application est bien en adéquation avec les demandes.

Ces tests doivent être implémentés avec PHPUnit ; vous pouvez aussi utiliser Behat pour la partie fonctionnelle.

Vous prévoirez des données de tests afin de pouvoir prouver le fonctionnement dans les cas explicités dans ce document.

Il vous est demandé de fournir un rapport de couverture de code au terme du projet. Il faut que le taux de couverture soit supérieur à 70 %.

### Documentation technique
Il vous est demandé de produire une documentation expliquant comment l’implémentation de l'authentification a été faite. Cette documentation se destine aux prochains développeurs juniors qui rejoindront l’équipe dans quelques semaines. Dans cette documentation, il doit être possible pour un débutant avec le framework Symfony de :

comprendre quel(s) fichier(s) il faut modifier et pourquoi ;
comment s’opère l’authentification ;
et où sont stockés les utilisateurs.
S’il vous semble important de mentionner d’autres informations , n’hésitez pas à le faire.

Par ailleurs, vous ouvrez la marche en matière de collaboration à plusieurs sur ce projet. Il vous est également demandé de produire un document expliquant comment devront procéder tous les développeurs souhaitant apporter des modifications au projet.

Ce document devra aussi détailler le processus de qualité à utiliser ainsi que les règles à respecter.

### Audit de qualité du code & performance de l'application
Les fondateurs souhaitent pérenniser le développement de l’application. Cela dit, ils souhaitent dans un premier temps faire un état des lieux de la dette technique de l’application.

Au terme de votre travail effectué sur l’application, il vous est demandé de produire un audit de code sur les deux axes suivants : la qualité de code et la performance.

Bien évidemment, il vous est fortement conseillé d’utiliser des outils vous permettant d’avoir des métriques pour appuyer vos propos.

Concernant l’audit de performance, l’usage de Blackfire est obligatoire. Ce dernier vous permettra de produire des analyses précises et adaptées aux évolutions futures du projet.

### Livrables
* Les instructions pour installer le projet (dans un fichier README à la racine du projet)
* Les issues sur le repository GitHub
* L’ensemble des fichiers HTML générés par PHPUnit indiquant le niveau de code coverage de l’application (un minimum de 70 %)
* Dans un dossier docs à la racine du projet:
  * Documentation technique concernant l’implémentation de l’authentification (fichier au format PDF)
  * Document expliquant comment contribuer au projet (fichier markdown “.md”)
  * Le rapport d’audit de qualité de code et de performance (fichier au format PDF)

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
