# Plan de Cours - Algorithmique et Logique Applicative

## Informations générales
- **Public** : Étudiants 3ème année - Ingénierie du Web
- **Objectif principal** : Développer l'esprit logique et comprendre le fonctionnement des outils modernes
- **Durée estimée** : 24 heures de cours

---

## Modalités pédagogiques

### Méthode d'enseignement
- 10% théorie / 80% pratique
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

---

### Séance 1 : Fondamentaux + Piles et Files

**- Échauffement algorithmique (1h)**
- Introduction au cours et objectifs
- Présentation du cours `cours/00-fondamentaux-algo.md`
  - Variables et stockage en mémoire (primitifs vs complexes)
  - Références et pointeurs en JavaScript
  - Complexité algorithmique (notation Big O)
- Rappel des bases : boucles, conditions, tableaux
- Exercice d'échauffement : Recréer des fonctions natives JavaScript
  - Niveau facile : push, pop, indexOf, reverse
  - Niveau moyen : filter, map, reduce
  - Objectif : maîtriser les bases avant les structures complexes

**- Théorie des structures de données (1h)**
- Qu'est-ce qu'une structure de données ?
- Présentation du cours `cours/01-piles-et-files.md`
- Les Piles : principe LIFO, exemples concrets
- Les Files : principe FIFO, exemples concrets
- Quiz interactif : Pile ou File pour chaque cas d'usage ?

**- Pratique (1h)**
- Exercice 1 : Implémenter une pile complète
- Exercice 2 : Implémenter une file complète
- Début de l'exercice 3 : Validateur de parenthèses

**Exercices** : 00-fondamentaux-algo.md (échauffement), 01-pile.md, 01-file.md, 01-parentheses.md

---
