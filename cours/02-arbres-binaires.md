# Les Arbres Binaires - Structures de données hiérarchiques

## Table des matières
1. [Introduction aux arbres](#introduction-aux-arbres)
2. [Structure d'un arbre binaire](#structure-dun-arbre-binaire)
3. [Arbre binaire de recherche (BSR)](#arbre-binaire-de-recherche-bsr)
4. [Opérations de base](#opérations-de-base)
5. [Parcours d'arbres](#parcours-darbres)
6. [Complexité et performance](#complexité-et-performance)
7. [Applications pratiques](#applications-pratiques)

---

## Introduction aux arbres

### Qu'est-ce qu'un arbre ?

Un **arbre** est une structure de données hiérarchique composée de **nœuds** reliés par des **arêtes**. Contrairement aux structures linéaires (tableaux, listes), un arbre permet de représenter des relations parent-enfant.

### Analogie avec la nature

Comme un arbre réel :
- Il a une **racine** (le point de départ)
- Des **branches** (les connexions)
- Des **feuilles** (les nœuds sans enfants)
- Une **hauteur** (la profondeur maximale)

### Exemples dans la vie courante

- **Organigramme d'entreprise** : PDG → Directeurs → Managers → Employés
- **Arbre généalogique** : Grands-parents → Parents → Enfants
- **Structure de fichiers** : Dossier racine → Sous-dossiers → Fichiers
- **Menu de navigation** : Page d'accueil → Catégories → Sous-catégories

### Pourquoi utiliser des arbres ?

**Avantages** :
- **Recherche rapide** : O(log n) dans un arbre équilibré (vs O(n) dans un tableau)
- **Insertion/Suppression efficaces** : O(log n) en moyenne
- **Structure naturelle** : Représente bien les hiérarchies
- **Tri automatique** : Un parcours infixe d'un BSR donne un ordre trié

**Inconvénients** :
- **Complexité** : Plus complexe à implémenter qu'un tableau
- **Équilibrage** : Un arbre déséquilibré peut dégrader les performances
- **Mémoire** : Chaque nœud nécessite des pointeurs vers les enfants

---

## Structure d'un arbre binaire

### Définition

Un **arbre binaire** est un arbre où chaque nœud a **au maximum 2 enfants** :
- Un enfant **gauche** (left)
- Un enfant **droit** (right)

### Terminologie

```
        10          ← Racine (root)
       /  \
      5    15       ← Nœuds internes
     / \   / \
    3   7 12  20    ← Feuilles (leaves)
```

- **Racine (root)** : Le nœud au sommet, point d'entrée de l'arbre
- **Nœud interne** : Un nœud qui a au moins un enfant
- **Feuille (leaf)** : Un nœud sans enfants
- **Parent** : Le nœud qui a des enfants
- **Enfant** : Un nœud directement connecté à un parent
- **Sous-arbre** : Un arbre formé par un nœud et tous ses descendants
- **Hauteur** : Nombre de niveaux depuis la racine jusqu'à la feuille la plus profonde
- **Profondeur** : Distance d'un nœud depuis la racine

### Représentation en code

```javascript
class TreeNode {
  constructor(value) {
    this.value = value;
    this.left = null;   // Enfant gauche
    this.right = null;  // Enfant droit
  }
}

class BinaryTree {
  constructor() {
    this.root = null;   // Racine de l'arbre
  }
}
```

### Exemple de création manuelle

```javascript
const root = new TreeNode(10);
root.left = new TreeNode(5);
root.right = new TreeNode(15);
root.left.left = new TreeNode(3);
root.left.right = new TreeNode(7);

// Arbre créé :
//        10
//       /  \
//      5    15
//     / \
//    3   7
```

---

## Arbre binaire de recherche (BSR)

### Définition

Un **arbre binaire de recherche (Binary Search Tree - BST)** est un arbre binaire avec une propriété spéciale :

**Propriété BSR** :
- Tous les nœuds du **sous-arbre gauche** ont une valeur **inférieure** au nœud parent
- Tous les nœuds du **sous-arbre droit** ont une valeur **supérieure** au nœud parent

### Exemple

```
        10
       /  \
      5    15
     / \   / \
    3   7 12  20
```

- Tous les nœuds à gauche de 10 sont < 10 (5, 3, 7)
- Tous les nœuds à droite de 10 sont > 10 (15, 12, 20)
- Tous les nœuds à gauche de 5 sont < 5 (3)
- Tous les nœuds à droite de 5 sont > 5 (7)

### Pourquoi cette propriété est importante

Cette propriété permet de **rechercher efficacement** une valeur :
- Si la valeur cherchée < nœud courant → aller à gauche
- Si la valeur cherchée > nœud courant → aller à droite
- Si la valeur cherchée = nœud courant → trouvé !

**Complexité** : O(log n) en moyenne (vs O(n) pour un tableau non trié)

---

## Opérations de base

### 1. Insertion (insert)

Insérer une valeur dans un BSR en respectant la propriété BSR.

**Algorithme** :
1. Si l'arbre est vide → créer la racine
2. Sinon, comparer avec la racine :
   - Si valeur < racine → insérer dans le sous-arbre gauche
   - Si valeur > racine → insérer dans le sous-arbre droit
3. Répéter récursivement jusqu'à trouver une place vide

**Complexité** : O(log n) en moyenne, O(n) dans le pire cas (arbre déséquilibré)

### 2. Recherche (contains)

Vérifier si une valeur existe dans l'arbre.

**Algorithme** :
1. Si le nœud est null → valeur non trouvée
2. Si valeur = nœud courant → trouvé !
3. Si valeur < nœud courant → chercher à gauche
4. Si valeur > nœud courant → chercher à droite

**Complexité** : O(log n) en moyenne, O(n) dans le pire cas

### 3. Taille (size)

Compter le nombre total de nœuds dans l'arbre.

**Algorithme récursif** :
- Taille d'un arbre = 1 (nœud courant) + taille(gauche) + taille(droite)
- Cas de base : arbre vide = 0

**Complexité** : O(n) - on doit visiter tous les nœuds

### 4. Hauteur (height)

Calculer la hauteur de l'arbre (profondeur maximale).

**Algorithme récursif** :
- Hauteur = 1 + max(hauteur(gauche), hauteur(droite))
- Cas de base : arbre vide = 0

**Complexité** : O(n) - on doit visiter tous les nœuds

---

## Parcours d'arbres

Parcourir un arbre signifie **visiter tous ses nœuds** dans un ordre spécifique. Il existe plusieurs stratégies de parcours.

### Parcours en profondeur (DFS - Depth-First Search)

On explore un chemin jusqu'au bout avant de revenir en arrière.

#### 1. Parcours Préfixe (Pre-order)

**Ordre** : Racine → Gauche → Droite

**Algorithme** :
1. Visiter le nœud courant
2. Parcourir le sous-arbre gauche
3. Parcourir le sous-arbre droit

**Résultat pour l'arbre** `[10, 5, 3, 7, 15, 12, 20]`

**Utilité** : Copier un arbre, créer une expression préfixe

#### 2. Parcours Infixe (In-order)

**Ordre** : Gauche → Racine → Droite

**Algorithme** :
1. Parcourir le sous-arbre gauche
2. Visiter le nœud courant
3. Parcourir le sous-arbre droit

**Résultat pour l'arbre** : `[3, 5, 7, 10, 12, 15, 20]`

**Utilité** : Pour un BSR, donne les valeurs **triées** ! Parfait pour obtenir une liste ordonnée.

#### 3. Parcours Postfixe (Post-order)

**Ordre** : Gauche → Droite → Racine

**Algorithme** :
1. Parcourir le sous-arbre gauche
2. Parcourir le sous-arbre droit
3. Visiter le nœud courant

**Résultat pour l'arbre** : `[3, 7, 5, 12, 20, 15, 10]`

**Utilité** : Supprimer un arbre (on supprime les enfants avant les parents), évaluer des expressions postfixes

### Parcours en largeur (BFS - Breadth-First Search)

On visite les nœuds **niveau par niveau**, de gauche à droite.

**Ordre** : Niveau 0 → Niveau 1 → Niveau 2 → ...

```
Niveau 0: 10
Niveau 1: 5, 15
Niveau 2: 3, 7, 12, 20
```

**Algorithme** (utilise une file) :
1. Enfiler la racine
2. Tant que la file n'est pas vide :
   - Défiler un nœud
   - Le visiter
   - Enfiler ses enfants (gauche puis droite)

**Résultat pour l'arbre** : `[10, 5, 15, 3, 7, 12, 20]`

**Utilité** : Trouver le plus court chemin, afficher un arbre niveau par niveau

## Applications pratiques

### 1. Système de fichiers

Les dossiers et fichiers sont organisés en arbre :
```
/
├── home/
│   ├── user/
│   │   ├── documents/
│   │   └── photos/
│   └── admin/
└── var/
    └── log/
```

### 2. Bases de données

Les **index** dans les bases de données utilisent souvent des B-Trees (variante d'arbres binaires) pour accélérer les recherches.

### 3. DOM (Document Object Model)

Le HTML est représenté comme un arbre :
```html
<html>
  <body>
    <div>
      <p>Texte</p>
    </div>
  </body>
</html>
```

### 4. Expressions mathématiques

Les expressions peuvent être représentées comme des arbres :
```
Expression : (2 + 3) * 4

        *
       / \
      +   4
     / \
    2   3
```

### 5. Compression de données

Les algorithmes de compression (Huffman) utilisent des arbres pour encoder les données efficacement.

### 6. Intelligence artificielle

Les **arbres de décision** et les **minimax trees** (pour les jeux) utilisent des structures arborescentes.

### 7. Autocomplétion

Les **tries** (arbres de préfixes) permettent une autocomplétion rapide dans les moteurs de recherche.

---

## Quand utiliser un arbre ?

### Pourquoi utiliser un arbre (en général) ?

- **Représenter des hiérarchies naturelles** : Organigrammes, arbres généalogiques, structures de fichiers
- **Relations parent-enfant** : Commentaires imbriqués, catégories et sous-catégories, menus de navigation
- **Parcours structuré** : Explorer des données de manière organisée (préfixe, infixe, postfixe)
- **Recherche hiérarchique** : Trouver des éléments en naviguant dans une structure logique
- **Systèmes de permissions** : Vérifier des droits en remontant la hiérarchie
- **DOM et XML** : Représenter des documents structurés
- **Arbres de décision** : Intelligence artificielle, systèmes experts
- **Compression de données** : Algorithmes comme Huffman utilisent des arbres
- **Systèmes de versioning** : Historique de commits avec branches (Git)
- **Expressions mathématiques** : Évaluer des expressions complexes

### Features qui utilisent des arbres binaires

- **Barre de recherche avec autocomplétion** : Google, Amazon, YouTube utilisent des tries (arbres de préfixes) pour suggérer des résultats
- **Affichage de résultats triés par pertinence** : Moteurs de recherche qui maintiennent un index trié automatiquement
- **Système de notifications par priorité** : Applications qui affichent les notifications les plus importantes en premier
- **Filtre "Trier par" dans un e-commerce** : Trier les produits par prix, note, date sans recalculer à chaque fois
- **Historique de navigation avec recherche** : Navigateurs qui permettent de chercher dans l'historique rapidement
- **Système de cache intelligent** : Applications qui gardent en cache les données les plus récentes ou fréquentes
- **Recommandations de produits** : Amazon, Netflix qui suggèrent des items similaires basés sur un score
- **Timeline d'événements triée** : Réseaux sociaux qui affichent les posts par ordre chronologique ou de pertinence
- **Système de logs avec recherche** : Outils de monitoring qui permettent de filtrer les logs par date ou niveau
- **Index de base de données** : MySQL, PostgreSQL utilisent des B-Trees pour accélérer les requêtes SQL

### Suppression d'un nœud

La suppression est plus complexe car il faut gérer 3 cas :
1. **Nœud feuille** : Supprimer directement
2. **Nœud avec 1 enfant** : Remplacer par son enfant
3. **Nœud avec 2 enfants** : Trouver le successeur (plus petit à droite) et le remplacer

## Conclusion

Les arbres binaires sont des structures de données fondamentales qui permettent de :
- Organiser des données hiérarchiquement
- Rechercher efficacement (O(log n))
- Maintenir un ordre automatiquement
- Représenter des structures naturelles (fichiers, DOM, etc.)

Maîtriser les arbres binaires est essentiel pour comprendre des structures plus avancées comme les graphes, les bases de données, et de nombreux algorithmes d'intelligence artificielle.

