## Projet final : Recréer React from scratch

### Objectif
Implémenter une version simplifiée de React pour comprendre son fonctionnement interne.

### Contraintes
- JavaScript ou TypeScript uniquement
- Pas de librairies externes (sauf compilateur TSX pour la syntaxe JSX)
- Utiliser les concepts vus en cours

### Fonctionnalités à implémenter

#### Phase 1 : Virtual DOM de base
- Créer une structure d'arbre virtuel
- Implémenter la fonction `createElement(type, props, ...children)`
- Implémenter la fonction `render(vdom, container)` pour créer le DOM réel

#### Phase 2 : Mise à jour et réconciliation
- Implémenter une fonction de diff entre deux arbres virtuels
- Créer la fonction `patch(oldVdom, newVdom, container)` 
- Gérer les cas : ajout, suppression, modification de nœuds

#### Phase 3 : Composants et état
- Permettre la création de composants fonctions
- Implémenter un système de state simplifié (optionnel)
- Gérer le re-rendu lors d'un changement d'état

#### Phase 4 : Optimisations
- Éviter les re-rendus inutiles
- Gérer les clés (keys) pour les listes

### Livrables
- Code source commenté
- Application de démonstration (todo list, compteur, etc.)
- Documentation expliquant les choix d'implémentation
- Analyse de complexité des fonctions principales

### Évaluation
- Qualité du code et respect des bonnes pratiques
- Compréhension des algorithmes utilisés
- Fonctionnalités implémentées
- Capacité à expliquer le fonctionnement

---
