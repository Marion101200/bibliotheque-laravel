# 📚 MangaLib — Bibliothèque de mangas

Application web de gestion d'une bibliothèque de mangas développée avec **Laravel**.

Les utilisateurs peuvent consulter les mangas disponibles, rechercher et filtrer le catalogue, consulter les différents tomes et emprunter un tome. Un espace administrateur permet de gérer le catalogue et de suivre les emprunts.

## ✨ Fonctionnalités

### 👤 Utilisateur

* Création de compte et connexion
* Consultation du catalogue
* Recherche par titre ou auteur
* Filtrage par genre et disponibilité
* Consultation des détails d'un manga
* Consultation des différents tomes
* Emprunt d'un tome
* Retour d'un tome
* Consultation de ses emprunts

### 👑 Administrateur

* Accès sécurisé à l'espace administration
* Dashboard avec statistiques
* Ajout, modification et suppression de mangas
* Gestion des images
* Gestion des différents tomes
* Consultation de tous les emprunts
* Filtrage des emprunts par statut
* Protection des routes avec un middleware administrateur

## 🛠️ Technologies

* **Laravel 12**
* **PHP 8.2**
* **MySQL / MariaDB**
* **Blade**
* **Tailwind CSS**
* **Vite**
* **Laravel Breeze**
* **Git / GitHub**

## 🚀 Installation

### 1. Cloner le projet

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Configurer l'environnement

Copier le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Puis configurer la connexion à la base de données dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Générer la clé Laravel

```bash
php artisan key:generate
```

### 6. Créer les tables

```bash
php artisan migrate
```

### 7. Configurer le stockage des images

```bash
php artisan storage:link
```

### 8. Lancer Vite

Dans un terminal :

```bash
npm run dev
```

### 9. Lancer Laravel

Dans un deuxième terminal :

```bash
php artisan serve
```

L'application sera accessible sur :

```text
http://127.0.0.1:8000
```

## 🔐 Rôles

L'application possède deux types d'utilisateurs :

* **Utilisateur** : accès au catalogue et aux emprunts
* **Administrateur** : accès au catalogue, aux mangas, aux tomes et à la gestion des emprunts

L'accès aux fonctionnalités administrateur est protégé par un **middleware `admin`**.

## 🧪 Tests

Des tests automatisés permettent notamment de vérifier :

* l'accès à l'administration
* la protection des routes administrateur
* l'accès au catalogue
* la consultation d'un manga
* l'emprunt d'un tome disponible
* le blocage d'un tome déjà emprunté
* le retour d'un tome
* la protection contre le retour d'un emprunt appartenant à un autre utilisateur

Pour lancer les tests :

```bash
php artisan test
```

## 📌 Projet

Projet réalisé dans le cadre de la création d'un portfolio de projets web avec **Laravel**.

Objectif : mettre en pratique la création d'une application Laravel complète avec authentification, gestion des rôles, CRUD, relations entre modèles, gestion des images, emprunts et interface responsive avec Tailwind CSS.
