# Le Gato
[![forthebadge](https://forthebadge.com/images/badges/uses-html.svg)](https://forthebadge.com)
[![forthebadge](https://forthebadge.com/images/badges/uses-css.svg)](https://forthebadge.com)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PHPStorm](http://img.shields.io/badge/-PHPStorm-181717?style=for-the-badge&logo=phpstorm&logoColor=white)
![VSCode](https://img.shields.io/badge/VSCode-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white)

## Lien du site web : https://le-gato.ddns.net

## Consigne

Vous devez réaliser un site Web, gérer son hébergement, et livrer son URL avant la date de rendu.
Vous devez créer un site Web de recettes de pâtisserie.
Après avoir déterminé un nom pertinent et concurrentiel, ainsi que la charte graphique associée,
vous développerez le front office et back office du site Web respectant le modèle MVC.

### 1.Architecture Générale

Le front office sera notamment composé des pages, ou vues, Web, suivantes :
<ul>
  <li>accueil (index), qui affiche trois recettes aléatoires et la liste des catégories ;</li>
  <li>« recette », qui affiche les caractéristiques détaillées d’une recette donnée ;</li>
</ul>

Le back office, réservé aux comptes administrateurs, sera notamment composé des pages, ou vues,
Web, suivantes :
<ul>
  <li>« création de recette », qui permet d’ajouter ou de modifier une recette ;</li>
  <li>« administration », qui permet de désactiver et/ou supprimer :</li>
  <li>une appréciation ;</li>
  <li>un utilisateur.</li>
</ul>
En outre chaque page Web affiche un en-tête, un menu, un champ de recherche, un formulaire
d’inscription/connexion (et de mot de passe oublié), et un pied de page.

### 2.Catégories

Une catégorie peut être :
<ul>
  <li>un ingrédient ;</li>
  <li>un ustensile ;</li>
  <li>un temps de préparation ;</li>
  <li>un type de cuisson ;</li>
  <li>une difficulté (très facile, facile, moyen, difficile) ;</li>
  <li>un coût (bon marché, coût moyen, assez cher) ;</li>
  <li>une particularité (végétarien, végan, sans gluten, sans lactose) ;</li>
</ul>

### 3.Recette

Une recette est composée :
<ul>
<li>obligatoirement :</li>
<ul>
    <li>d’une note moyenne ;</li>
    <li>d’une photographie ;</li>
    <li>d'une liste d’ingrédient non vide ;</li>
    <li>d’une liste d’ustensiles non vide ;</li>
    <li>d’un temps de préparation ;</li>
    <li>d’une difficulté ;</li>
    <li>d’un coût ;</li>
    <li>d’une description textuelle de la préparation ;</li>
</ul>
<li>optionnellement :</li>
<ul>
  <li>d’un type de cuisson ;</li>
  <li>d’une liste de particularités ;</li>
  <li>d’une liste d’appréciations;</li>
</ul>
</ul>

### 4.Utilisateur

Un utilisateur est, a minima, caractérisée par :
<ul>
  <li>un identifiant (e-mail ou pseudonyme, au choix) ;</li>
  <li>un mot de passe ;</li>
  <li>une photographie/image (optionnellement) ;</li>
  <li>un nom (d’affichage) ;</li>
  <li>la date de sa première connexion ;</li>
  <li>la date de sa dernière connexion.</li>
</ul>

### 5.Appréciation

Une appréciation est caractérisée par :
<ul>
  <li>le nom de son auteur ;</li>
  <li>une note ;</li>
  <li>une date ;</li>
  <li>un commentaire.</li>
</ul>

Un utilisateur connecté a la possibilité de laisser, ou de modifier, une appréciation par recette en
saisissant :
<ul>
  <li>une note ;</li>
  <li>un commentaire.</li>
</ul>

### 6.Recherche
La recherche peut se faire par un nom (même partiel) d’une recette.

## Membres

- CECCARRELLI Luca <img align="left" src="https://avatars.githubusercontent.com/u/91269970?v=4" alt="profile" width="20" height="20"/>
- DOMAGE Hugo <img align="left" src="https://avatars.githubusercontent.com/u/91956673?v=4" alt="profile" width="20" height="20"/>
- EGENSCHEVILLER Frédéric <img align="left" src="https://avatars.githubusercontent.com/u/53983944?v=4" alt="profile" width="20" height="20"/>
- GANASSI Alexandre <img align="left" src="https://avatars2.githubusercontent.com/u/90609748" alt="profile" width="20" height="20"/>
- GONZALES Lenny <img align="left" src="https://avatars.githubusercontent.com/u/91269114?s=64&v=4" alt="profile" width="20" height="20"/>
- SAADI Nils <img align="left" src="https://avatars.githubusercontent.com/u/91779594?v=4" alt="profile" width="20" height="20"/>
- SAUVA Mathieu <img align="left" src="https://avatars.githubusercontent.com/u/91150750?s=64&v=4" alt="profile" width="20" height="20"/>
