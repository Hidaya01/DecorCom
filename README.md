# Decorkom - Plateforme de Vente d'Artisanat

## Description du Projet
Decorkom est une plateforme en ligne permettant aux artisans de vendre leurs produits artisanaux en toute simplicité. Elle vise à promouvoir l'artisanat local en offrant un espace de vente digitalisé et intuitif.
Ce projet est fait par stagaires ISMONTIC.


## Technologies Utilisées
- **Backend** : Laravel
- **Frontend** : Blade (option Vue.js/React)
- **Base de Données** : MySQL
- **Authentification** : Laravel Auth
- **Import/Export de Données** : Maatwebsite Excel
- **Génération de PDF** : DomPDF

## Fonctionnalités Principales
- Gestion des utilisateurs (artisans et clients)
- CRUD des produits (ajout, modification, suppression, affichage)
- Importation et exportation des produits via fichiers Excel (.xls, .csv)
- Génération de devis et factures en format PDF
- Ajout au panier et gestion des commandes
- Tableau de bord pour les artisans avec statistiques

## Installation
1. Cloner le dépôt :
   ```sh
   git clone https://github.com/votre-repo/decorkom.git
   ```
2. Installer les dépendances :
   ```sh
   composer install
   npm install
   ```
3. Configurer l'environnement :
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Configurer la base de données dans le fichier `.env`, puis exécuter :
   ```sh
   php artisan migrate --seed
   ```
5. Lancer le serveur :
   ```sh
   php artisan serve
   ```

## Routes Importantes
- `decors/index` : Afficher tous les décors
- `decors/create` : Ajouter un décor (artisan uniquement)
- `cart` : Afficher le panier
- `cart/pdf` : Télécharger un PDF du panier
- `decors/import` : Importer des produits depuis un fichier Excel
- `decors/export` : Exporter les produits en fichier Excel

## Contribution
Les contributions sont les bienvenues ! Merci de créer une pull request avec une description détaillée de vos modifications.

## Licence
Ce projet est sous licence MIT.

