# Les Fondamentaux de l'Algorithmie

## Introduction

L'algorithmie est l'art de résoudre des problèmes de manière systématique et efficace. Avant de plonger dans les structures de données complexes, il est essentiel de maîtriser les bases : comment les données sont stockées en mémoire, comment les manipuler efficacement, et comment mesurer la performance de nos solutions.

Ce cours couvre quatre piliers fondamentaux :
1. **Les concepts de base** : variables, mémoire, et manipulation de données
2. **Les références et pointeurs** : comment JavaScript gère la mémoire
3. **La complexité algorithmique** : mesurer et optimiser la performance
4. **Les structures de données** : Array, Object, Map, Set et leurs cas d'usage

---

## 1. Variables et stockage en mémoire

### Types primitifs vs types complexes

En JavaScript, il existe deux grandes catégories de données :

#### Types primitifs (stockés par valeur)
- **Number** : `42`, `3.14`
- **String** : `"Hello"`
- **Boolean** : `true`, `false`
- **Undefined** : `undefined`
- **Null** : `null`
- **Symbol** : `Symbol('unique')`
- **BigInt** : `123n`

Ces types sont stockés directement dans la **pile mémoire (stack)**. Quand vous copiez une variable primitive, vous créez une **copie indépendante** de la valeur.

#### Types complexes (stockés par référence)
- **Object** : `{ name: "Alice" }`
- **Array** : `[1, 2, 3]`
- **Function** : `function() {}`
- **Date**, **Map**, **Set**, etc.

Ces types sont stockés dans le **tas mémoire (heap)**. La variable ne contient pas l'objet lui-même, mais une **référence** (une adresse mémoire) vers l'objet.

---

## 2. Les références en JavaScript

### Qu'est-ce qu'une référence ?

Une **référence** est comme une adresse mémoire qui pointe vers un emplacement où les données sont stockées. En JavaScript, quand vous manipulez un objet ou un tableau, vous manipulez en réalité une référence vers cet objet.

### Copie par valeur vs copie par référence

#### Copie par valeur (primitifs)

```javascript
let a = 10;
let b = a;
b = 20;

console.log(a); // 10
console.log(b); // 20
```

Ici, `a` et `b` sont deux variables indépendantes. Modifier `b` n'affecte pas `a`.

#### Copie par référence (objets et tableaux)

```javascript
let arr1 = [1, 2, 3];
let arr2 = arr1;
arr2.push(4);

console.log(arr1); // [1, 2, 3, 4]
console.log(arr2); // [1, 2, 3, 4]
```

Ici, `arr1` et `arr2` pointent vers **le même tableau en mémoire**. Modifier `arr2` modifie aussi `arr1` car ils partagent la même référence.

### Pourquoi est-ce important ?

Quand vous passez un objet à une fonction, vous passez une référence. Si la fonction modifie cet objet, l'objet original est modifié. Cela peut causer des bugs difficiles à détecter si vous ne comprenez pas ce mécanisme.

### Cloner un objet ou un tableau

Pour créer une copie indépendante d'un objet ou d'un tableau, vous devez **cloner** l'objet :

**Shallow copy (copie superficielle)** :
```javascript
const original = [1, 2, 3];
const copy = [...original];
```

ou pour les objets :
```javascript
const original = { name: "Alice", age: 30 };
const copy = { ...original };
```

**Attention** : Si votre objet contient des objets imbriqués, seul le premier niveau est copié. Les objets imbriqués restent des références.

**Deep copy (copie profonde)** :
Pour une copie complète, y compris les objets imbriqués, vous pouvez utiliser :
```javascript
const copy = JSON.parse(JSON.stringify(original));
```

ou utiliser des bibliothèques comme `lodash.cloneDeep()`.

---

## 3. Pointeurs et références : concepts avancés

### Les "pointeurs" en JavaScript

En JavaScript, il n'y a pas de **pointeurs** au sens strict comme en C ou C++. Vous ne pouvez pas accéder directement à l'adresse mémoire d'une variable. Cependant, le concept de **référence** est très similaire.

### Passage par référence dans les fonctions

Quand vous passez un objet ou un tableau à une fonction, vous passez une **référence** :

```javascript
function addItem(arr, item) {
  arr.push(item);
}

const myArray = [1, 2, 3];
addItem(myArray, 4);
console.log(myArray); // [1, 2, 3, 4]
```

La fonction `addItem` a modifié le tableau original car elle a reçu une référence vers ce tableau.

**Bonne pratique** : Pour éviter les effets de bord (side effects), créez une copie dans la fonction :

```javascript
function addItem(arr, item) {
  return [...arr, item];
}

const myArray = [1, 2, 3];
const newArray = addItem(myArray, 4);
console.log(myArray); // [1, 2, 3]
console.log(newArray); // [1, 2, 3, 4]
```

### Comparaison d'objets et de tableaux

Quand vous comparez deux objets ou tableaux avec `===`, vous comparez leurs **références**, pas leurs contenus :

```javascript
const a = [1, 2, 3];
const b = [1, 2, 3];
console.log(a === b); // false

const c = a;
console.log(a === c); // true
```

Ici, `a` et `b` ont le même contenu, mais ils pointent vers deux emplacements mémoire différents. `a` et `c` pointent vers le même emplacement.

## 4. La complexité algorithmique

### Pourquoi mesurer la performance ?

Un algorithme peut être **correct** (il donne le bon résultat) mais **inefficace** (il prend trop de temps ou trop de mémoire). La complexité algorithmique permet de :
- Comparer plusieurs solutions à un même problème
- Prédire comment un algorithme se comportera avec de grandes quantités de données
- Identifier les goulots d'étranglement dans votre code

### La notation Big O

La notation **Big O** décrit la **performance dans le pire des cas** d'un algorithme en fonction de la taille de l'entrée (notée `n`).

Elle répond à la question : **"Comment le temps d'exécution augmente-t-il quand la taille des données augmente ?"**

### Les complexités courantes

#### O(1) - Temps constant

L'opération prend toujours le même temps, quelle que soit la taille des données.

**Exemples** :
- Accéder à un élément d'un tableau par son index : `arr[5]`
- Ajouter un élément en tête de liste chaînée
- Lire une propriété d'un objet : `obj.name`

**Analogie** : Ouvrir un livre à une page précise grâce au numéro de page. Peu importe que le livre fasse 10 ou 1000 pages, ça prend le même temps.

---

#### O(log n) - Temps logarithmique

Le temps augmente lentement même si les données augmentent beaucoup. À chaque étape, on divise le problème en deux.

**Exemples** :
- Recherche binaire dans un tableau trié
- Insertion dans un arbre binaire équilibré

**Analogie** : Chercher un mot dans le dictionnaire. Vous ouvrez au milieu, puis au milieu de la moitié, etc. Même avec 100 000 mots, vous ne faites qu'environ 17 étapes.

**En pratique** :
- 10 éléments → ~3 étapes
- 100 éléments → ~7 étapes
- 1 000 000 éléments → ~20 étapes

C'est **très efficace** pour les grandes quantités de données.

---

#### O(n) - Temps linéaire

Le temps est proportionnel à la taille des données. Si vous doublez les données, vous doublez le temps.

**Exemples** :
- Parcourir un tableau avec une boucle `for`
- Recherche linéaire : trouver un élément dans un tableau non trié
- Calculer la somme de tous les éléments

**Analogie** : Compter toutes les pièces dans un bocal. Si le bocal contient deux fois plus de pièces, ça prend deux fois plus de temps.

---

#### O(n log n) - Temps quasi-linéaire

C'est un bon compromis pour les algorithmes de tri efficaces.

**Exemples** :
- Tri fusion (merge sort)
- Tri rapide (quick sort) en moyenne
- Tri par tas (heap sort)

**Analogie** : Trier un paquet de cartes en les divisant en petits tas, en triant chaque tas, puis en les fusionnant.

**En pratique** :
- 10 éléments → ~33 opérations
- 100 éléments → ~664 opérations
- 1 000 000 éléments → ~20 millions d'opérations

C'est le meilleur qu'on puisse faire pour un tri général.

---

#### O(n²) - Temps quadratique

Le temps augmente très rapidement. Si vous doublez les données, le temps est multiplié par 4.

**Exemples** :
- Tri à bulles (bubble sort)
- Tri par insertion (insertion sort)
- Boucles imbriquées : parcourir tous les couples d'éléments

**Analogie** : Comparer chaque personne dans une salle avec toutes les autres personnes. Si la salle passe de 10 à 20 personnes, vous passez de 100 à 400 comparaisons.

**En pratique** :
- 10 éléments → 100 opérations
- 100 éléments → 10 000 opérations
- 1 000 éléments → 1 000 000 opérations

C'est **acceptable pour de petites données**, mais **catastrophique pour de grandes données**.

---

#### O(2ⁿ) - Temps exponentiel

Le temps **double** à chaque fois que vous ajoutez un élément. C'est **très inefficace**.

**Exemples** :
- Résoudre le problème du sac à dos par force brute
- Calculer la suite de Fibonacci de manière naïve et récursive
- Générer tous les sous-ensembles d'un ensemble

**Analogie** : Un virus qui double toutes les heures. Après 10 heures, vous avez 1024 virus. Après 30 heures, vous avez 1 milliard de virus.

**En pratique** :
- 10 éléments → 1024 opérations
- 20 éléments → 1 048 576 opérations
- 30 éléments → 1 073 741 824 opérations

À éviter absolument pour des données de taille moyenne ou grande.

---

#### O(n!) - Temps factoriel

Le pire cas imaginable. Le temps explose instantanément.

**Exemples** :
- Trouver toutes les permutations d'un ensemble
- Résoudre le problème du voyageur de commerce par force brute

**En pratique** :
- 5 éléments → 120 opérations
- 10 éléments → 3 628 800 opérations
- 15 éléments → 1 307 674 368 000 opérations

**Impraticable** au-delà de 10-15 éléments.

---

### Visualisation des complexités

Pour `n = 100` :

| Complexité | Opérations | Exemple |
|------------|------------|---------|
| O(1) | 1 | Accès à un index |
| O(log n) | ~7 | Recherche binaire |
| O(n) | 100 | Boucle simple |
| O(n log n) | ~664 | Tri fusion |
| O(n²) | 10 000 | Tri à bulles |
| O(2ⁿ) | 1.267 × 10³⁰ | Fibonacci naïf |
| O(n!) | 9.332 × 10¹⁵⁷ | Permutations |

---

### Complexité spatiale

La complexité spatiale mesure la **quantité de mémoire** utilisée par un algorithme.

**Exemples** :
- **O(1)** : Tri par insertion (trie en place)
- **O(n)** : Tri fusion (crée de nouveaux tableaux)
- **O(n)** : Stocker tous les éléments dans une pile

**Pourquoi c'est important ?** :
- Les applications web ont des contraintes de mémoire (surtout sur mobile)
- Un algorithme rapide mais qui consomme trop de mémoire peut planter le navigateur

---

## 5. Structures de données : Array, Object, Map et Set

### Introduction

Le choix de la bonne structure de données est crucial pour la performance de votre code. JavaScript offre plusieurs structures natives, chacune avec ses avantages et inconvénients. Comprendre leurs différences vous permettra d'écrire du code plus rapide et plus efficace.

### Array (Tableau) - La liste ordonnée

Un **Array** est une collection ordonnée d'éléments, accessible par index numérique.

```javascript
const fruits = ['pomme', 'banane', 'orange'];
console.log(fruits[0]);
console.log(fruits.length);
```

**Caractéristiques** :
- Ordre préservé
- Accès par index numérique (0, 1, 2, ...)
- Peut contenir des doublons
- Taille dynamique

**Complexité des opérations** :

| Opération | Complexité | Exemple |
|-----------|-----------|---------|
| Accès par index | O(1) | `arr[5]` |
| Recherche | O(n) | `arr.indexOf(value)` |
| Ajout en fin | O(1) | `arr.push(item)` |
| Ajout en début | O(n) | `arr.unshift(item)` |
| Suppression en fin | O(1) | `arr.pop()` |
| Suppression en début | O(n) | `arr.shift()` |
| Suppression au milieu | O(n) | `arr.splice(index, 1)` |

**Quand utiliser un Array** :
- Besoin de conserver l'ordre des éléments
- Accès fréquent par position (premier, dernier, nième élément)
- Itération séquentielle sur les éléments
- Utilisation de méthodes comme `map`, `filter`, `reduce`

---

### Object (Objet) - Le dictionnaire classique

Un **Object** est une collection de paires clé-valeur, où les clés sont des chaînes de caractères (ou Symbol).

```javascript
const user = {
  name: 'Alice',
  age: 30,
  email: 'alice@example.com'
};
console.log(user.name);
console.log(user['age']);
```

**Caractéristiques** :
- Accès par clé (nom de propriété)
- Les clés sont converties en chaînes de caractères
- Pas d'ordre garanti (bien que les moteurs modernes préservent souvent l'ordre d'insertion)
- Pas de doublons de clés

**Complexité des opérations** :

| Opération | Complexité | Exemple |
|-----------|-----------|---------|
| Accès | O(1) | `obj.key` ou `obj['key']` |
| Ajout | O(1) | `obj.newKey = value` |
| Suppression | O(1) | `delete obj.key` |
| Recherche de clé | O(1) | `'key' in obj` |
| Recherche de valeur | O(n) | `Object.values(obj).includes(value)` |

**Quand utiliser un Object** :
- Stocker des propriétés nommées (configuration, données structurées)
- Accès rapide par nom de propriété
- Représenter des entités (utilisateur, produit, etc.)
- Clés simples (chaînes de caractères)

**Limitations** :
- Les clés sont toujours des chaînes (ou Symbol)
- Pas de méthodes intégrées pour itérer facilement
- Pas de propriété `size` native
- Peut hériter de propriétés du prototype

---

### Map - Le dictionnaire moderne

Un **Map** est une structure de données moderne qui associe des clés à des valeurs, avec plus de flexibilité qu'un Object.

```javascript
const map = new Map();
map.set('name', 'Alice');
map.set(42, 'quarante-deux');
map.set({ id: 1 }, 'objet comme clé');

console.log(map.get('name'));
console.log(map.size);
console.log(map.has('name'));
```

**Caractéristiques** :
- Les clés peuvent être de **n'importe quel type** (objets, fonctions, nombres, etc.)
- Ordre d'insertion préservé
- Propriété `size` native
- Méthodes d'itération intégrées

**Complexité des opérations** :

| Opération | Complexité | Exemple |
|-----------|-----------|---------|
| Accès | O(1) | `map.get(key)` |
| Ajout | O(1) | `map.set(key, value)` |
| Suppression | O(1) | `map.delete(key)` |
| Vérifier existence | O(1) | `map.has(key)` |
| Taille | O(1) | `map.size` |

**Avantages par rapport à Object** :
- Clés de n'importe quel type
- Ordre garanti
- Méthodes pratiques : `forEach`, `keys()`, `values()`, `entries()`
- Propriété `size` directe
- Meilleure performance pour ajouts/suppressions fréquents

```javascript
const map = new Map([
  ['nom', 'Alice'],
  ['age', 30]
]);

for (const [key, value] of map) {
  console.log(`${key}: ${value}`);
}

map.forEach((value, key) => {
  console.log(`${key}: ${value}`);
});
```

**Quand utiliser Map** :
- Besoin de clés qui ne sont pas des chaînes (objets, nombres, etc.)
- Ajouts/suppressions fréquents
- Besoin de connaître facilement le nombre d'éléments
- Itération fréquente sur les paires clé-valeur
- Ordre d'insertion important

---

### Set - L'ensemble unique

Un **Set** est une collection de valeurs **uniques**. Chaque valeur ne peut apparaître qu'une seule fois.

```javascript
const set = new Set();
set.add(1);
set.add(2);
set.add(2);
console.log(set.size);
console.log(set.has(1));
```

**Caractéristiques** :
- Valeurs uniques (pas de doublons)
- Ordre d'insertion préservé
- Peut contenir n'importe quel type de valeur
- Propriété `size` native

**Complexité des opérations** :

| Opération | Complexité | Exemple |
|-----------|-----------|---------|
| Ajout | O(1) | `set.add(value)` |
| Suppression | O(1) | `set.delete(value)` |
| Vérifier existence | O(1) | `set.has(value)` |
| Taille | O(1) | `set.size` |

**Cas d'usage typiques** :

1. **Éliminer les doublons d'un tableau** :
```javascript
const arr = [1, 2, 2, 3, 3, 4];
const unique = [...new Set(arr)];
```

2. **Vérifier l'existence rapidement** :
```javascript
const allowedIds = new Set([1, 5, 10, 15]);
if (allowedIds.has(userId)) {
  console.log('Utilisateur autorisé');
}
```

3. **Opérations sur des ensembles** :
```javascript
const setA = new Set([1, 2, 3]);
const setB = new Set([3, 4, 5]);

const union = new Set([...setA, ...setB]);

const intersection = new Set(
  [...setA].filter(x => setB.has(x))
);

const difference = new Set(
  [...setA].filter(x => !setB.has(x))
);
```

**Quand utiliser Set** :
- Besoin de garantir l'unicité des valeurs
- Vérifications fréquentes d'existence (`has()`)
- Éliminer les doublons
- Opérations ensemblistes (union, intersection, différence)

---

### WeakMap et WeakSet - Les versions "faibles"

#### WeakMap

Un **WeakMap** est similaire à Map, mais avec des références **faibles** aux clés.

```javascript
const weakMap = new WeakMap();
let obj = { id: 1 };
weakMap.set(obj, 'valeur associée');
obj = null;
```

**Différences avec Map** :
- Les clés doivent être des **objets** (pas de primitifs)
- Les clés sont des références faibles (peuvent être garbage-collectées)
- Pas d'itération possible
- Pas de propriété `size`

**Quand utiliser WeakMap** :
- Associer des données à des objets sans empêcher leur garbage collection
- Stocker des métadonnées privées sur des objets
- Éviter les fuites mémoire

#### WeakSet

Un **WeakSet** est similaire à Set, mais avec des références faibles.

```javascript
const weakSet = new WeakSet();
let obj = { id: 1 };
weakSet.add(obj);
obj = null;
```

**Quand utiliser WeakSet** :
- Marquer des objets sans empêcher leur garbage collection
- Suivre quels objets ont été traités

---

### Tableau comparatif : Quelle structure choisir ?

| Besoin | Structure recommandée | Raison |
|--------|----------------------|---------|
| Liste ordonnée d'éléments | `Array` | Ordre + méthodes utiles |
| Chercher rapidement une valeur | `Set` | O(1) pour `has()` |
| Associer clés → valeurs (clés chaînes) | `Object` | Syntaxe simple |
| Associer clés → valeurs (clés variées) | `Map` | Clés de tout type |
| Éliminer les doublons | `Set` | Unicité garantie |
| Données structurées (JSON) | `Object` | Compatible JSON |
| Compteur / fréquences | `Map` ou `Object` | Accès O(1) |
| Cache avec nettoyage auto | `WeakMap` | Garbage collection |

---

## 6. Optimisation : règles pratiques

### Règle 1 : Éviter les boucles imbriquées inutiles

**Mauvais** :
```javascript
for (let i = 0; i < arr.length; i++) {
  for (let j = 0; j < arr.length; j++) {
    // O(n²)
  }
}
```

**Mieux** : Utiliser un objet (dictionnaire) pour stocker les données :
```javascript
const map = {};
for (let i = 0; i < arr.length; i++) {
  map[arr[i]] = true;
}
```

---

### Règle 2 : Choisir la bonne structure de données

- **Recherche fréquente** : Objet ou Map (O(1)) plutôt que tableau (O(n))
- **Ajout/suppression en début** : Liste chaînée (O(1)) plutôt que tableau (O(n))
- **Ajout/suppression en fin** : Tableau (O(1))
- **Ordre important** : File (FIFO) ou Pile (LIFO)

---

### Règle 3 : Éviter les opérations coûteuses dans les boucles

**Mauvais** :
```javascript
for (let i = 0; i < arr.length; i++) {
  const result = expensiveFunction();
}
```

**Mieux** :
```javascript
const result = expensiveFunction();
for (let i = 0; i < arr.length; i++) {
  // Utiliser result
}
```

## 7. Exercices de réflexion

### Quiz : Quelle est la complexité ?

Pour chaque code ci-dessous, déterminez la complexité temporelle :

1. Trouver le maximum d'un tableau
2. Vérifier si deux tableaux ont un élément en commun (version naïve)
3. Vérifier si deux tableaux ont un élément en commun (version optimisée avec Set)
4. Inverser une chaîne de caractères
5. Trouver tous les couples d'éléments qui somment à une valeur cible
6. Calculer la suite de Fibonacci avec mémorisation

---
