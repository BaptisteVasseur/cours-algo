# Plan de Cours - Algorithmique et Logique Applicative

## Informations générales
- **Public** : Étudiants 3ème année - Développement Web
- **Objectif principal** : Développer l'esprit logique et comprendre le fonctionnement des outils modernes
- **Durée estimée** : 30-35 heures de cours

---

## Partie 1 : Structures de données fondamentales

### 1.1 Introduction aux structures de données
- Pourquoi les structures de données sont importantes en développement web
- Notion de type abstrait de données

### 1.2 Les Piles (Stack)
- Principe LIFO (Last In, First Out)
- Opérations : push, pop, peek
- Implémentation en JavaScript
- **Cas d'usage** : historique de navigation, call stack, undo/redo

### 1.3 Les Files (Queue)
- Principe FIFO (First In, First Out)
- Opérations : enqueue, dequeue, peek
- Implémentation en JavaScript
- **Cas d'usage** : files d'attente de mails, gestion de requêtes asynchrones, job queues

### 1.4 Les Arbres Binaires
- Définition et terminologie (nœud, racine, feuille, parent, enfant)
- Parcours d'arbres : préfixe, infixe, postfixe
- Implémentation en JavaScript
- **Cas d'usage** : DOM virtuel de React, arbre de dépendances, parsing HTML

### 1.5 Introduction aux fonctions récursives
- Qu'est-ce qu'une fonction récursive ?
- Cas de base et cas récursif
- Stack trace et limitation
- Exemples : factorielle, Fibonacci, parcours d'arbre

---

## Partie 2 : Algorithmes de tri

### 2.1 Introduction au tri
- Pourquoi trier des données ?
- Notion de stabilité d'un tri

### 2.2 Algorithmes de tri simples
- **Tri à insertion** : principe, implémentation, analyse
- **Tri à bulles** : principe, implémentation, analyse
- Comparaison des deux approches

### 2.3 Algorithmes de tri avancés
- **Tri fusion (Merge Sort)** : 
  - Principe diviser pour régner
  - Implémentation récursive
  - Analyse de la complexité
  
- **Tri rapide (Quick Sort)** :
  - Choix du pivot
  - Partitionnement
  - Implémentation récursive
  - Analyse de la complexité (meilleur/moyen/pire cas)

### 2.4 Comparaison et choix d'algorithme
- Tableaux comparatifs
- Quand utiliser quel algorithme ?
- Tri natif JavaScript (Array.sort)

---

## Partie 3 : Algorithmes de recherche

### 3.1 Recherche linéaire
- Principe de la recherche séquentielle
- Implémentation avec boucle for
- Complexité temporelle
- Cas d'usage

### 3.2 Recherche binaire
- Principe diviser pour régner
- Prérequis : tableau trié
- Implémentation itérative et récursive
- Complexité logarithmique
- Lien avec le tri rapide

### 3.3 Applications pratiques
- Recherche dans les bases de données (index)
- Autocomplétion
- Recherche dans les API

---

## Partie 4 : Complexité algorithmique

### 4.1 Notation Big O
- Qu'est-ce que la complexité algorithmique ?
- Notation O (grand O)
- Complexité temporelle vs spatiale

### 4.2 Classes de complexité courantes
- O(1) - Constante
- O(log n) - Logarithmique
- O(n) - Linéaire
- O(n log n) - Quasi-linéaire
- O(n²) - Quadratique
- O(2ⁿ) - Exponentielle

### 4.3 Analyse d'algorithmes
- Meilleur cas, cas moyen, pire cas
- Analyser la complexité des algorithmes vus précédemment
- Optimisation : quand est-ce nécessaire ?

### 4.4 Application au développement web
- Performance des boucles imbriquées
- Complexité des opérations sur les tableaux JavaScript
- Débouncing et throttling

---

## Partie 5 : Comprendre React et le Virtual DOM

### 5.1 Architecture de React
- Pourquoi React a-t-il été créé ?
- Problème de manipulation directe du DOM
- Solution : Virtual DOM

### 5.2 Le Virtual DOM
- Qu'est-ce qu'un Virtual DOM ?
- Structure : objet JavaScript représentant un arbre
- Propriétés : type, props, children
- Lien avec les arbres binaires vus en partie 1

### 5.3 La fonction render
- Transformation arbre virtuel → DOM réel
- Implémentation d'une fonction récursive de rendu
- Exemple de code simplifié

### 5.4 La réconciliation (Reconciliation)
- Comparaison ancien arbre vs nouvel arbre
- Algorithme de diff
- Fonction patch : modification minimale du DOM
- Pourquoi c'est plus performant ?

### 5.5 Implémentation simplifiée
- Créer un mini-React from scratch
- Gestion du JSX/TSX (avec compilateur TypeScript)
- Rendu initial
- Mise à jour et re-rendu

### 5.6 Liens avec les autres frameworks
- Vue.js et son Virtual DOM
- Angular et la détection de changements
- Svelte et la compilation

---

## Modalités pédagogiques

### Méthode d'enseignement
- 20% théorie / 80% pratique
- Live coding pour chaque algorithme
- Exercices progressifs

### Évaluation
- Exercices pratiques réguliers 
- QCM sur la complexité algorithmique 
- Projet final React from scratch

### Ressources
- Slides de cours avec visualisations d'algorithmes
- Repository GitHub avec tous les exemples

---

### Séance 1 : Introduction + Piles et Files
**- Théorie**
- Introduction au cours et objectifs
- Qu'est-ce qu'une structure de données ?
- Les Piles : théorie et implémentation
- Les Files : théorie et implémentation

**- Pratique**
- Exercice 1 : Implémenter une pile
- Exercice 2 : Implémenter une file
- Exercice 3 : Cas d'usage - Validateur de parenthèses

**Exercices** : 01-pile.md, 01-file.md, 01-parentheses.md

---

### Séance 2 : Arbres binaires + Récursivité
**- Théorie**
- Rappel sur les fonctions
- Qu'est-ce qu'une fonction récursive ?
- Les arbres binaires : structure et terminologie

**- Pratique**
- Exercice 1 : Factorielle et Fibonacci
- Exercice 2 : Créer un arbre binaire
- Exercice 3 : Parcours d'arbre (préfixe, infixe, postfixe)

**Exercices** : 02-recursivite.md, 02-arbre-creation.md, 02-parcours-arbre.md

---

### Séance 3 : Algorithmes de tri simples
**- Théorie**
- Introduction au tri : pourquoi trier ?
- Tri à bulles : principe et implémentation
- Tri par insertion : principe et implémentation
- Comparaison des deux algorithmes

**- Pratique**
- Exercice 1 : Implémenter le tri à bulles
- Exercice 2 : Implémenter le tri par insertion
- Exercice 3 : Tri d'objets

**Exercices** : 03-tri-bulles.md, 03-tri-insertion.md, 03-tri-objets.md

---

### Séance 4 : Algorithmes de tri avancés + Recherche
**- Théorie**
- Tri fusion : principe diviser pour régner
- Tri rapide : pivot et partitionnement

**- Pratique + Recherche**
- Exercice 1 : Implémenter le tri fusion
- Théorie : Recherche linéaire et binaire
- Exercice 2 : Implémenter la recherche binaire

**Exercices** : 04-tri-fusion.md, 04-tri-rapide.md, 04-recherche-binaire.md

---

### Séance 5 : Complexité algorithmique
**- Théorie**
- Introduction à la notation Big O
- Classes de complexité (O(1), O(log n), O(n), O(n²)...)
- Complexité temporelle vs spatiale

**- Pratique**
- Exercice 1 : Analyser la complexité d'algorithmes simples
- Exercice 2 : Comparer les tris vus en cours
- Exercice 3 : Optimiser du code

**Exercices** : 05-analyser-complexite.md, 05-comparer-tris.md, 05-optimisation.md

---

### Séance 6 : Virtual DOM et React - Partie théorique
**- Théorie**
- Problématique : manipulation du DOM classique
- Qu'est-ce que le Virtual DOM ?
- Lien avec les arbres binaires
- Architecture de React

**- Pratique**
- Exercice 1 : Créer une structure de Virtual DOM
- Exercice 2 : Parser du HTML vers un arbre
- Exercice 3 : Fonction render simple

**Exercices** : 06-vdom-structure.md, 06-html-vers-arbre.md, 06-render-simple.md

---

### Séance 7 : Implémentation mini-React
**2h - Live coding**
- Implémentation de createElement
- Implémentation de render
- Algorithme de diff
- Fonction patch

**- Pratique guidée**
- Suivre l'implémentation en parallèle
- Tester avec des exemples
- Questions/réponses

**Exercices** : 07-create-element.md, 07-render.md, 07-diff-patch.md

---

### Séance 8 : Projet final + Présentations
**- Travail sur le projet**
- Accompagnement individuel/groupe
- Déblocage technique
- Code review

**- Présentations**
- Démonstration des projets
- Explication des choix techniques
- Retours et évaluation

**Exercices** : 08-projet-final.md

---

## Notes importantes

### Pour les étudiants
Ce cours n'a pas pour but de faire de vous des experts en optimisation d'algorithmes, mais de vous donner :
- Un meilleur esprit logique
- Une compréhension des outils que vous utilisez quotidiennement
- La capacité de choisir la bonne approche face à un problème métier
- Les bases pour comprendre la documentation technique
