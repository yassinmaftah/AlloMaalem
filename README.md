# Allo Maalem

**Allo Maalem** est une application web de type "Job Board" développée en Laravel. Elle permet de mettre en relation des Clients (ayant des travaux ou des réparations à effectuer) avec des Maalems (artisans qualifiés). La plateforme intègre un système d'abonnement Premium, une gestion avancée des statuts de candidature, et de multiples sécurités côté serveur pour garantir l'intégrité des mises en relation.

---

## 🛠 Technologies Utilisées

* **Back-end :** PHP 8, Laravel 11
* **Base de données :** MySQL
* **Front-end :** Blade (Composants réutilisables), Tailwind CSS, Alpine.js / JavaScript (Transitions et UI dynamique)
* **API Externe :** Stripe API (Gestion des paiements et abonnements Premium)
* **Outils de conception :** UML, Figma, Trello, Canva

---

## 👥 Rôles et Fonctionnalités

La plateforme propose une expérience adaptée selon le type d'utilisateur :

### 1. Visiteur (Non Authentifié)
* Consulter la page d'accueil et le fonctionnement de la plateforme.
* Parcourir la liste des annonces récentes (titres et descriptions partielles).
* Créer un compte en choisissant son rôle obligatoire (Client ou Maalem).

### 2. Client (Demandeur de service)
* **Gestion des Annonces :** Créer des offres de travaux avec détails (Titre, Description, Catégorie, Ville, Budget) et une option "Urgent".
* **Recrutement Sécurisé :** Consulter les candidatures des Maalems et accepter une offre. Le système gère automatiquement le rejet des autres candidatures.
* **Évaluation (Review) :** Une fois le travail terminé (`completed`), le client peut attribuer une note (1 à 5 étoiles) et un commentaire au Maalem.
* **Abonnement Premium :** Possibilité de payer 29$ via Stripe pour obtenir un badge "Vérifié".

### 3. Maalem (Artisan / Prestataire)
* **Recherche et Filtrage :** Explorer les offres disponibles (`open`) et les filtrer par catégorie et ville (les filtres sont persistants via `Query Strings`).
* **Postuler aux Annonces :** Soumettre une proposition tarifaire et un message de motivation. 
* **Limites d'utilisation :** Un compte standard est limité à 3 candidatures "en attente" simultanées et 10 candidatures maximum par mois.
* **Abonnement Premium :** Possibilité de payer 15$ via Stripe pour devenir "Vérifié" et faire sauter les limites de candidature.
* **Suivi :** Suivre le statut de ses candidatures (`pending`, `accepted`, `rejected`). Si accepté, les coordonnées du Client sont débloquées.

### 4. Administrateur
* **Tableau de Bord :** Vue d'ensemble de l'activité de la plateforme.
* **Rapports Financiers :** Suivi des revenus générés par les paiements Stripe (Historique complet avec Nom, Email, Montant et Date).
* **Modération :** Bannir des utilisateurs ou révoquer manuellement le statut Premium d'un compte.
* **Gestion des Référentiels :** Créer, modifier ou supprimer des Catégories de métiers et des Villes.

---

## 🔒 Sécurité et Robustesse Technique (Logique Métier)

Une attention particulière a été portée sur l'intégrité des données et la résolution des failles de concurrence (*Race Conditions*) :

* **Anti-Modification de Prix :** Vérification stricte en base de données lors de l'acceptation d'une offre. Si un Maalem tente de modifier son prix pendant que le client regarde la page, la transaction est bloquée.
* **Anti-Double Recrutement :** Verrouillage d'état. Le backend vérifie toujours que l'annonce est au statut `open` avant de valider un Maalem, empêchant ainsi l'assignation de deux artisans au même travail.
* **Anti-Ghost Application :** Vérification de l'existence et de l'état de l'annonce avant d'insérer une nouvelle candidature pour éviter les erreurs 404 et les candidatures sur des annonces supprimées.
* **UI/UX :** Utilisation de composants Blade (`<x-alert />`) avec "Flash Sessions" pour des retours visuels immédiats et propres après chaque action.

---

## 🚀 Installation en local

1. Cloner le repository :
```bash
git clone https://github.com/yassinmaftah/AlloMaalem.git
```
2. Installer les dépendances PHP et Node :
```bash
composer install
npm install && npm run build
```
3. Configurer l'environnement :
Copier le fichier `.env.example` en `.env` et configurer la base de données ainsi que les clés API Stripe.
```bash
cp .env.example .env
php artisan key:generate
```
4. Exécuter les migrations et les seeders :
```bash
php artisan migrate --seed
```
5. Lancer le serveur local :
```bash
php artisan serve
```
