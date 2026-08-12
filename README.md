# 📚 Bibliothèque de mangas

Application web de gestion d'une bibliothèque de mangas développée avec Laravel.

L'application permet aux utilisateurs de consulter un catalogue de mangas, de rechercher et filtrer les ouvrages, puis de les emprunter et de les rendre.

Un espace administrateur permet de gérer le catalogue et de suivre les emprunts.

---

## ✨ Fonctionnalités

### 👤 Utilisateur

- Création d'un compte
- Connexion / déconnexion
- Consultation du catalogue
- Recherche par titre ou auteur
- Filtrage par genre
- Filtrage par disponibilité
- Consultation des détails d'un manga
- Emprunt d'un manga disponible
- Retour d'un manga
- Consultation de ses emprunts

### 👑 Administrateur

- Accès à un espace d'administration sécurisé
- Dashboard avec statistiques
- Ajout d'un manga
- Modification d'un manga
- Suppression d'un manga
- Gestion des images des mangas
- Consultation de tous les emprunts
- Filtrage des emprunts par statut
- Protection des fonctionnalités administrateur par middleware

---

## 🧪 Tests

Des tests automatisés ont été ajoutés afin de vérifier les principales fonctionnalités de l'application.

Les tests couvrent notamment :

- Accès à l'administration
- Protection des routes administrateur
- Accès au catalogue
- Consultation d'un manga
- Emprunt d'un manga disponible
- Blocage de l'emprunt d'un manga indisponible
- Retour d'un manga
- Protection contre le retour du manga d'un autre utilisateur

Pour lancer les tests :

```bash
php artisan test