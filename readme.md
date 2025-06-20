ParkEase – Site de Gestion de Parking

DISCLAIMER

Je prèfere être franc directement (dans tout les cas ca se verra lorsque vous analyserez le code) mais le code n'est pas clean dans le sens ou il y'a encore des console.log de test un peu partout et des parties de codes en annotations (evidemment cela n'impacte pas le bon fonctionnement du projet, le projet est entiermenet fonctionnel mais ce sont des consols.log experimentaux) et aussi surtout le css est entierement redigé par IA. Vous pouvez trouver dans les anciens commit des versions "fait maison" mais le css actuel n'est absolument pas rediger de main propre. De plus la coherence des dossiers et nom des dossier n'est pas correct c'est a dire que vous trouverez les dossiers css et js dans le dossier _partials alors qu'il devrait se trouver dans le dossier assets par exemple.

DESCRIPTION

ParkEase est une application web de gestion de parking.
Elle permet aux utilisateurs de créer un compte, d’enregistrer leur véhicule, de réserver une place, de consulter leur historique et de gérer leur profil.
Un espace administrateur permet la gestion des parkings, utilisateurs, véhicules et réservations.

------------------------------------------------------------

INSTALLATION

1. Cloner le projet

   git clone [url_du_dépôt]
   cd parkease

2. Installer les dépendances

   Le projet utilise Composer pour gérer les dépendances PHP.

   composer install

3. Configurer l’environnement

   Copier le fichier .env.example en .env

   cp .env.example .env

   Modifier les valeurs suivantes dans le fichier .env :

   DB_HOST=localhost
   DB_NAME=parkease
   DB_USER=root
   DB_PASSWORD=

   STRIPE_SECRET_KEY=sk_test_...
   STRIPE_PUBLIC_KEY=pk_test_...

4. Préparer la base de données

   - Créer une base de données MySQL nommée "parking"
   - Importer le fichier parking.sql fourni

   Un compte administrateur est déjà présent :

   Email : admin@admin.com
   Mot de passe : admin

------------------------------------------------------------

FONCTIONNALITÉS

- Authentification : inscription, connexion, déconnexion
- Gestion du profil utilisateur et des véhicules
- Réservation de places de parking et attribution d'une evaluation
- Historique des réservations
- Paiement en ligne avec Stripe
- Interface administrateur :
  - Gestion des parkings
  - Gestion des utilisateurs
  - Gestion des véhicules
  - Gestion des réservations

------------------------------------------------------------

TECHNOLOGIES UTILISÉES

- PHP (architecture MVC maison)
- JavaScript
- MySQL
- Composer
- Dotenv (vlucas/phpdotenv)
- Stripe (paiement en ligne)

------------------------------------------------------------

STRUCTURE DU PROJET

- /controllers : logique métier
- /models : entités (User, Vehicle, etc.)
- /views : pages affichées à l’utilisateur
- /public : point d’entrée (index.php, assets)
- .env : configuration d’environnement (non versionné)
- composer.json : configuration des dépendances PHP

------------------------------------------------------------

REMARQUES

- Aucun framework utilisé
- Paiement en mode test via Stripe