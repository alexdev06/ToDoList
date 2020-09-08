# TODO LIST : Contribution au projet

Lien du repository sur GitHub : [Repository ToDoList](https://github.com/alexdev06/ToDoList)

## Introduction

Pour participer au projet, que ce soit pour améliorer les fonctionnalités existantes, en ajouter ou encore corriger des bugs, veuillez procéder comme indiqué ci-dessous :

## Important 

***Le projet doit être exclusivement documenté en anglais!***

## Documentation

1. Avant d'entamer le développement, réaliser l'ensemble des diagrammes UML: 
   1. Diagramme de packages
   2. Diagramme de cas d'utilisation
   3. Diagramme de séquence
2. Si vos modifications impactent la base de données, modifier les diagrammes de classe et le modèle physique de données.
3. L'ensemble de ces diagramme devra être intégré à la pull request.

## Installation

1. Se rendre sur la page du projet [ici](https://github.com/alexdev06/ToDoList).
2. Cliquer sur le bouton "Fork" en haut à droite de la page et "forker" le projet. Cela permet de créer une copie du repository sur votre compte GitHub.
3. S’identifier sur son compte GitHub si ce n’est pas déjà fait.
4. Se rendre sur son compte Github et sur le repository nouvellement forké.
5. Cliquer sur le bouton "Code" et copier le lien du repository.
6. Cloner le projet dans un dossier local avec la commande `git clone liendurepository`.
7. Installer les bibliothèques avec la commande `composer install` à la racine du projet.
8. Modifier les variables d'environement dans le fichier .env
   * Configurer votre base de données avec son nom et les informations de connexion dans la section _doctrine/doctrine-bundle_:
      * Version du serveur
      * Login
      * Mot de passe
      * Nom de la base de données
    * Mettre en version de développement(dev) ou production(prod) dans la section _symfony/framework-bundle_
9. Pour créer la base de données: `php bin/console doctrine:database:create`
10. Pour installer les tables de données via le système de migrations: `php bin/console doctrine:migrations:migrate`
11. Installer un jeu de données: `php bin/console doctrine:fixtures:load`
12. Démarrer le serveur de Symfony: `symfony server:start`
13. En cas de bugs, vider les caches avec les commandes `php bin/console cache:clear` et `php bin/console cache:clear --env=prod`

## Développement

1. Quelle que soit la modification envisagée, créer une branche spécifique portant un nom explicite sur ce qu'elle contient. Pour Créer une branche, utiliser la commande: `git checkout -b nomdelabranche`.
2. L'entreprise travaille en Test Driven Development, il faut donc implémenter les tests avant d'entamer le développement des fonctionnalités.
3. Entamer le développement des modfications.
   * Utiliser les commentaires sur chaque classe, sur chaque méthode et éventuellement où celà semble approprié.
   * Respecter les coding standards de Symfony (documentation disponible [ici](https://symfony.com/doc/4.4/contributing/code/standards.html)).
4. Vérifier l’ensemble des tests et assurer une couverture de code d'au moins 70%.
5. Faire des commits pertinents:  `git commit -am "message de commit"`.
6. Pour chaque commit, vérifier la qualité du code et la performance:
   * Utiliser Codacy pour tester la qualité du code et obtenir une note de B au minimum pour votre branche. Modifier le code si besoin.
   * Utiliser Blackfire.io pour réaliser un test de performance.
     * Comparer la différenciel de performance par rapport à l'état de l'application initial.
     * Si la performance se trouve dégradée, trouver des solutions d'optimisation.
     * Si malgré les optimisations la performance est dégradée de 10%, les modifications ne pourront être intégrées en production.

## Envoi des modifications

1. Envoyer la branche sur Github avec la commande `git push -u origin nomdelabranche` .
2. Se rendre sur son compte Github sur la page du repository.
3. Une notification indique la réception de la branche, cliquer sur le bouton "Compare & pull request" pour créer une pull request.
4. Complètez le formulaire en expliquant succinctement les modifications effectuées.
5. Valider la pull request.
6. Répondre aux éventuelles questions.
7. En fonction de la pertinence des modifications, celles-ci seront intégrées on non au projet.
