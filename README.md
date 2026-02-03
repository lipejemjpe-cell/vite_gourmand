# 🍽️ Vite Gourmand – Application de gestion de menus traiteur

## 📌 Présentation

Vite Gourmand est une application web développée dans le cadre du TP
**Développeur Web et Web Mobile**.

L’objectif du projet est de proposer une plateforme permettant à un traiteur de :

- présenter ses menus
- gérer les commandes clients
- administrer les menus et les stocks
- offrir une interface simple aux utilisateurs

---

## 🎯 Expression des besoins (Cahier des charges)

Le client (traiteur) souhaite :

- une vue globale des menus disponibles
- un système de commande en ligne
- une gestion des stocks
- un espace administrateur
- une gestion des utilisateurs
- une interface claire et responsive

Contraintes :

- application web en PHP
- base de données relationnelle
- séparation des rôles (utilisateur / administrateur)
- utilisation d’un système de versionnement (Git)

---

## 🧠 Compétences mises en œuvre

- Analyser un besoin client
- Concevoir une base de données (MCD – Merise)
- Maquetter des interfaces utilisateur (wireframes & mockups)
- Développer une application web dynamique en PHP
- Mettre en place une architecture MVC
- Gérer l’authentification et les rôles
- Utiliser Git et GitHub pour le versionnement
- Documenter un projet technique

---

## 🛠️ Technologies utilisées

- PHP (architecture MVC)
- MySQL
- HTML / CSS
- WAMP (Apache / MySQL / PHP)
- Git / GitHub
- Figma (wireframes, mockups, charte graphique)

---

## 🎨 Maquettes & Charte graphique

Les éléments graphiques ont été réalisés avec **Figma** :

- 3 wireframes desktop
- 3 wireframes mobile
- 3 mockups desktop
- 3 mockups mobile
- 1 charte graphique complète

Les fichiers PDF sont disponibles dans :
/documents/
├── wireframes/
├── mockups/
└── charte_graphique.pdf

---

## ⚙️ Installation du projet (en local avec WAMP)

1️⃣ Cloner le dépôt GitHub :

```bash
git clone https://github.com/lipejemjpe-cell/vite_gourmand.git

2️⃣ Placer le projet dans le dossier www de WAMP

3️⃣ Importer la base de données via phpMyAdmin

4️⃣ Configurer la connexion à la base de données :

src/config/db.php

5️⃣ Lancer Apache et MySQL depuis WAMP

6️⃣ Accéder au projet :

http://localhost/vite-gourmand/

*“Le projet est déployé en environnement local avec WAMP, ce qui est adapté au cadre pédagogique.”*
