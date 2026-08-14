# SAV Manager - Gestion du Service Après-Vente

Une application web complète pour gérer le service après-vente (SAV) d'une entreprise, développée avec **Laravel 12**, **PHP 8.2**, **SQLite**, et **Bootstrap 5**.

## Caractéristiques

### Modules principaux
- **Clients** : Gestion des clients et de leurs informations de contact
- **Appareils** : Suivi des appareils clients et de leur statut de garantie
- **Tickets SAV** : Création et suivi des demandes de service avec statut et priorité
- **Interventions** : Enregistrement des réparations avec diagnostic et coûts
- **Techniciens** : Gestion du personnel technique et historique de réparations
- **Pièces de rechange** : Inventaire des pièces avec suivi de stock

### Fonctionnalités
- **Authentification** : Système d'authentification sécurisé avec rôles utilisateur
- **Rôles et permissions** : Admin, Réception, Technicien avec accès différenciés
- **Tableau de bord** : Vue d'ensemble avec statistiques en temps réel
- **Alerte de stock** : Notification automatique pour pièces en dessous du minimum
- **Historique technicien** : Suivi des réparations et statistiques par technicien
- **Recherche avancée** : Filtrage et recherche sur tous les modules
- **Interface 100% française** : Tous les labels et messages en français

## Stack Technique

- **Framework** : Laravel 12
- **PHP** : 8.2+
- **Base de données** : SQLite (intégrée)
- **Frontend** : Blade + Bootstrap 5
- **Authentification** : Laravel Auth
- **Validation** : Form Request Validation
- **Tests** : PHPUnit avec Laravel Testing

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- SQLite (inclus avec PHP par défaut)
- Un serveur web (Apache/Nginx ou le serveur intégré)

## Installation

### 1. Cloner et configurer
```bash
git clone <repo-url>
cd savmanager
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Préparer la base de données
```bash
php artisan migrate
php artisan db:seed
```

### 3. Lancer le serveur
```bash
php artisan serve
```

L'application est accessible sur `http://localhost:8000`

## Comptes de Démonstration

Après le seedage, les comptes suivants sont créés :

| Email | Mot de passe | Rôle |
|-------|--------------|------|
| admin@savmanager.test | password | Administrateur |
| reception@savmanager.test | password | Réception |
| tech@savmanager.test | password | Technicien |

### Permissions par rôle

- **Admin** : Accès complet, gestion des techniciens
- **Réception** : Clients, Appareils, Tickets, Pièces de rechange
- **Technicien** : Interventions, Historique de réparations

## Structure du Projet

```
app/
├── Http/
│   ├── Controllers/  # Contrôleurs pour chaque module
│   └── Requests/     # Validation FormRequest
├── Models/           # Modèles Eloquent
└── Providers/        # Service providers (avec portes d'accès)

database/
├── migrations/       # Migrations de schéma
├── factories/        # Factories pour données de test
└── seeders/          # Seeders (données de démonstration)

resources/
├── views/
│   ├── layouts/      # Layouts principaux
│   ├── dashboard/    # Tableau de bord
│   └── [modules]/    # Vues pour chaque module
└── css/              # Styles personnalisés

routes/
└── web.php           # Routes web avec groupes d'authentification

tests/
└── Feature/          # Tests fonctionnels
```

## Tests

Exécuter tous les tests :
```bash
php artisan test
```

Exécuter un test spécifique :
```bash
php artisan test --filter=DemoDataSeederTest
```

Tests inclus :
- `DemoDataSeederTest` : Validation des données de démonstration
- `RoleAccessTest` : Vérification des permissions par rôle
- `AuthenticationTest` : Tests d'authentification

## Modèles de Données

### Clients
- Nom, prénom, email, téléphone, adresse
- Relation avec les appareils et tickets

### Appareils
- Type (smartphone, tablet, laptop, etc.)
- Marque, modèle, numéro de série
- Statut de garantie et date d'achat
- Lié à un client

### Tickets
- Numéro unique de ticket
- Description du problème et diagnostic
- Statuts : reçu, diagnostic, attente pièces, réparation, complété, livré
- Priorités : faible, moyen, élevé, urgent
- Dates : réception, complété, livré

### Interventions (Réparations)
- Lien vers un ticket et un technicien
- Diagnostic détaillé et description de réparation
- Coûts : main-d'œuvre, pièces, total
- Statuts : en attente, en cours, complété, attente pièces, annulé

### Techniciens
- Nom, email, téléphone
- Historique des réparations assignées
- Statistiques : nombre de réparations, coût moyen

### Pièces de Rechange
- Nom et description
- Code de référence unique
- Prix unitaire et quantité en stock
- Stock minimum avec alerte automatique
- Fournisseur et notes

## Sécurité

- Authentification Laravel intégrée
- CSRF protection sur tous les formulaires
- Password hashing avec bcrypt
- Routes protégées par middleware d'authentification
- Accès granulaire par rôle via Gates

## Fonctionnalités Avancées

### Tableau de bord
- Comptes en temps réel (clients, appareils, tickets, interventions)
- Alertes : pièces faibles, tickets urgents
- Listes récentes : derniers tickets et interventions

### Gestion des techniciens
- Profil détaillé avec statistiques
- Historique complet des réparations
- Calcul automatique du coût moyen et total

### Pièces de rechange
- Alerte visuelle de stock faible
- Barre de progression du stock
- Liaison avec les réparations

## Localisation

L'application est entièrement en français :
- Interface utilisateur complète
- Messages de validation
- Notifications et alertes
- Formats de date et devise (€)

## Notes de Développement

- Base de données SQLite stockée dans `database/database.sqlite`
- Pas de dépendances externes inutiles (approche minimaliste)
- Blade templating pour simplifier la maintenance
- Bootstrap 5 CDN pour les styles sans build complexe
- Factories pour la génération de données de test

## Support

Pour toute question ou problème, veuillez consulter la documentation de [Laravel](https://laravel.com/docs).

## Licence

Ce projet est fourni à titre d'exemple éducatif.
