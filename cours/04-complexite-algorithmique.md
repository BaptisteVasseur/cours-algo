# La Complexité Algorithmique - Mesurer l'efficacité du code

## Table des matières
1. [Introduction](#introduction)
2. [La notation Big O](#la-notation-big-o)
3. [Les classes de complexité](#les-classes-de-complexité)
4. [Complexité temporelle](#complexité-temporelle)
5. [Complexité spatiale](#complexité-spatiale)
6. [Règles de calcul](#règles-de-calcul)
7. [Analyser du code](#analyser-du-code)
8. [Optimisation](#optimisation)
9. [Complexité des opérations courantes](#complexité-des-opérations-courantes)

---

## Introduction

### Pourquoi mesurer l'efficacité ?

Deux algorithmes peuvent résoudre le même problème, mais avec des performances très différentes :

```
Tableau de 1 000 000 éléments :
- Algorithme O(n)   : ~1 ms
- Algorithme O(n²)  : ~1 000 000 ms (≈ 16 minutes)
```

### Ce que mesure la complexité

La complexité algorithmique mesure **comment les ressources utilisées évoluent** quand la taille des données augmente.

| Type | Ce qu'on mesure |
|------|-----------------|
| **Complexité temporelle** | Nombre d'opérations (temps) |
| **Complexité spatiale** | Mémoire utilisée (espace) |

### Un exemple concret

Chercher un nom dans un annuaire de 1000 pages :

- **Recherche linéaire** : Parcourir page par page → jusqu'à 1000 consultations
- **Recherche binaire** : Ouvrir au milieu, éliminer la moitié → ~10 consultations

La recherche binaire est **100× plus efficace** !

---

## La notation Big O

### Définition

**Big O** décrit le **comportement** d'un algorithme : comment il se comporte quand n → ∞ (très grand).

```
O(f(n)) signifie : "l'algorithme fait au maximum f(n) opérations"
```

### Pourquoi "Big O" ?

- **O** = "Order of" (ordre de grandeur)
- On s'intéresse à la **tendance générale**, pas aux valeurs exactes
- On cherche le **pire cas** (cas le plus défavorable)

### Les trois cas

| Cas | Description | Quand l'utiliser |
|-----|-------------|------------------|
| **Meilleur cas** (Ω) | Scénario optimal | Rarement pertinent |
| **Cas moyen** (Θ) | Performance typique | Analyse probabiliste |
| **Pire cas** (O) | Scénario le plus défavorable | **Le plus utilisé** |

### Exemple : recherche dans un tableau

```javascript
function recherche(arr, cible) {
  for (let i = 0; i < arr.length; i++) {
    if (arr[i] === cible) return i;
  }
  return -1;
}
```

- **Meilleur cas** : L'élément est au début → O(1)
- **Pire cas** : L'élément est à la fin ou absent → O(n)
- **Cas moyen** : En moyenne, on parcourt la moitié → O(n/2) = O(n)

---

## Les classes de complexité

### Tableau des complexités courantes

| Notation | Nom | Exemple | Performance |
|----------|-----|---------|-------------|
| O(1) | Constante | Accès par index | ⚡ Excellent |
| O(log n) | Logarithmique | Recherche binaire | ⚡ Très bon |
| O(n) | Linéaire | Parcours de tableau | ✅ Bon |
| O(n log n) | Quasi-linéaire | Tri fusion, tri rapide | ✅ Acceptable |
| O(n²) | Quadratique | Tri à bulles, boucles imbriquées | ⚠️ Lent |
| O(n³) | Cubique | Multiplication de matrices | ❌ Très lent |
| O(2ⁿ) | Exponentielle | Fibonacci récursif naïf | ❌ Catastrophique |
| O(n!) | Factorielle | Permutations | ❌ Inutilisable |

### Visualisation de la croissance

```
Opérations pour n éléments :

n        O(1)    O(log n)    O(n)    O(n log n)    O(n²)       O(2ⁿ)
──────────────────────────────────────────────────────────────────────
10       1       3           10      30            100         1024
100      1       7           100     700           10000       1.27×10³⁰
1000     1       10          1000    10000         1000000     ∞
10000    1       13          10000   130000        100000000   ∞
```

### Impact sur le temps réel

Si 1 opération = 1 microseconde (μs) :

| n | O(n) | O(n²) | O(2ⁿ) |
|---|------|-------|-------|
| 10 | 10 μs | 100 μs | 1 ms |
| 20 | 20 μs | 400 μs | 1 s |
| 30 | 30 μs | 900 μs | 18 min |
| 40 | 40 μs | 1.6 ms | 13 jours |
| 50 | 50 μs | 2.5 ms | 36 ans |

---

## Complexité temporelle

### O(1) - Complexité constante

Le temps d'exécution est **indépendant** de la taille des données.

```javascript
function getFirst(arr) {
  return arr[0];
}

function getByIndex(arr, index) {
  return arr[index];
}

function addToMap(map, key, value) {
  map.set(key, value);
}
```

### O(log n) - Complexité logarithmique

À chaque étape, on **divise le problème par 2** (ou plus).

```javascript
function binarySearch(arr, target) {
  let left = 0;
  let right = arr.length - 1;
  
  while (left <= right) {
    const mid = Math.floor((left + right) / 2);
    
    if (arr[mid] === target) return mid;
    if (arr[mid] < target) left = mid + 1;
    else right = mid - 1;
  }
  
  return -1;
}
```

**Pourquoi log n ?**
- n = 8 → 3 étapes (8 → 4 → 2 → 1)
- n = 1024 → 10 étapes
- log₂(n) = nombre de fois qu'on peut diviser par 2

### O(n) - Complexité linéaire

On parcourt chaque élément **une fois**.

```javascript
function sum(arr) {
  let total = 0;
  for (const num of arr) {
    total += num;
  }
  return total;
}

function findMax(arr) {
  let max = arr[0];
  for (const num of arr) {
    if (num > max) max = num;
  }
  return max;
}
```

### O(n log n) - Complexité quasi-linéaire

Typique des algorithmes "diviser pour régner" efficaces.

```javascript
function mergeSort(arr) {
  if (arr.length <= 1) return arr;
  
  const mid = Math.floor(arr.length / 2);
  const left = mergeSort(arr.slice(0, mid));
  const right = mergeSort(arr.slice(mid));
  
  return merge(left, right);
}
```

**Pourquoi n log n ?**
- On divise en log(n) niveaux
- À chaque niveau, on traite n éléments
- Total : n × log(n)

### O(n²) - Complexité quadratique

Deux boucles imbriquées sur n éléments.

```javascript
function bubbleSort(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < arr.length - i - 1; j++) {
      if (arr[j] > arr[j + 1]) {
        [arr[j], arr[j + 1]] = [arr[j + 1], arr[j]];
      }
    }
  }
}

function hasDuplicates(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = i + 1; j < arr.length; j++) {
      if (arr[i] === arr[j]) return true;
    }
  }
  return false;
}
```

### O(2ⁿ) - Complexité exponentielle

Chaque appel génère plusieurs sous-appels.

```javascript
function fibonacci(n) {
  if (n <= 1) return n;
  return fibonacci(n - 1) + fibonacci(n - 2);
}
```

**Arbre d'appels pour n=5** :
```
                    fib(5)
                  /        \
            fib(4)          fib(3)
           /     \          /     \
       fib(3)  fib(2)    fib(2)  fib(1)
       /   \     /  \      /  \
   fib(2) fib(1)...  ...  ...  ...
```

---

## Complexité spatiale

### Définition

La complexité spatiale mesure la **mémoire supplémentaire** utilisée par l'algorithme (sans compter l'entrée).

### O(1) - Espace constant

Pas de mémoire supplémentaire proportionnelle à n.

```javascript
function sum(arr) {
  let total = 0;  // Une seule variable
  for (const num of arr) {
    total += num;
  }
  return total;
}
```

### O(n) - Espace linéaire

On crée une structure de taille proportionnelle à n.

```javascript
function duplicate(arr) {
  const copy = [];  // Nouveau tableau de taille n
  for (const item of arr) {
    copy.push(item);
  }
  return copy;
}
```

### O(log n) - Espace logarithmique

Typique de la récursion avec division par 2 (pile d'appels).

```javascript
function binarySearchRecursive(arr, target, left, right) {
  if (left > right) return -1;
  
  const mid = Math.floor((left + right) / 2);
  
  if (arr[mid] === target) return mid;
  if (arr[mid] < target) {
    return binarySearchRecursive(arr, target, mid + 1, right);
  }
  return binarySearchRecursive(arr, target, left, mid - 1);
}
```

### Récursion et pile d'appels

Chaque appel récursif utilise de la mémoire sur la **pile d'appels**.

```javascript
function countdown(n) {
  if (n === 0) return;
  countdown(n - 1);
}
// Espace : O(n) - n frames sur la pile
```

---

## Règles de calcul

### Règle 1 : Ignorer les constantes

Les constantes multiplicatives sont ignorées car elles deviennent négligeables pour de grandes valeurs de n.

```
O(2n) → O(n)
O(n/2) → O(n)
O(5n² + 3n + 10) → O(n²)
O(100) → O(1)
```

### Règle 2 : Garder le terme dominant

Seul le terme qui croît le plus vite compte.

```
O(n² + n) → O(n²)
O(n³ + n² + n) → O(n³)
O(n log n + n) → O(n log n)
O(2ⁿ + n²) → O(2ⁿ)
```

**Ordre de dominance** :
```
O(1) < O(log n) < O(n) < O(n log n) < O(n²) < O(n³) < O(2ⁿ) < O(n!)
```

### Règle 3 : Boucles séquentielles → Addition

```javascript
for (let i = 0; i < n; i++) { ... }  // O(n)
for (let j = 0; j < n; j++) { ... }  // O(n)

// Total : O(n) + O(n) = O(2n) = O(n)
```

### Règle 4 : Boucles imbriquées → Multiplication

```javascript
for (let i = 0; i < n; i++) {         // O(n)
  for (let j = 0; j < n; j++) { ... } // O(n)
}

// Total : O(n) × O(n) = O(n²)
```

### Règle 5 : Boucles avec limites différentes

```javascript
for (let i = 0; i < n; i++) {         // O(n)
  for (let j = 0; j < m; j++) { ... } // O(m)
}

// Total : O(n × m)
```

---

## Analyser du code

### Méthode pas à pas

1. **Identifier les boucles** et leur nombre d'itérations
2. **Identifier les appels récursifs** et dessiner l'arbre
3. **Repérer les opérations coûteuses** (tri, recherche dans un tableau)
4. **Appliquer les règles** de simplification

### Exemple 1 : Boucle simple

```javascript
function exemple(arr) {
  let sum = 0;                    // O(1)
  for (let i = 0; i < arr.length; i++) {  // n itérations
    sum += arr[i];                // O(1)
  }
  return sum;                     // O(1)
}

// Total : O(1) + O(n) × O(1) + O(1) = O(n)
```

### Exemple 2 : Boucles imbriquées

```javascript
function exemple(arr) {
  for (let i = 0; i < arr.length; i++) {      // n itérations
    for (let j = 0; j < arr.length; j++) {    // n itérations
      console.log(arr[i], arr[j]);            // O(1)
    }
  }
}

// Total : O(n) × O(n) × O(1) = O(n²)
```

### Exemple 3 : Boucle triangulaire

```javascript
function exemple(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = i; j < arr.length; j++) {
      console.log(arr[i], arr[j]);
    }
  }
}

// i=0 : n itérations
// i=1 : n-1 itérations
// i=2 : n-2 itérations
// ...
// Total : n + (n-1) + (n-2) + ... + 1 = n(n+1)/2 ≈ n²/2 → O(n²)
```

### Exemple 4 : Logarithmique

```javascript
function exemple(n) {
  let i = 1;
  while (i < n) {
    console.log(i);
    i *= 2;  // i double à chaque itération
  }
}

// i : 1 → 2 → 4 → 8 → 16 → ... → n
// Nombre d'itérations : log₂(n)
// Total : O(log n)
```

### Exemple 5 : Fonction récursive

```javascript
function factorial(n) {
  if (n <= 1) return 1;
  return n * factorial(n - 1);
}

// Appels : factorial(5) → factorial(4) → factorial(3) → ...
// Nombre d'appels : n
// Total : O(n)
```

---

## Optimisation

### Principe général

Réduire la complexité en :
1. Utilisant des **structures de données appropriées**
2. Évitant les **opérations redondantes**
3. Appliquant des **techniques algorithmiques** (diviser pour régner, mémorisation)

### Technique 1 : Utiliser Set et Map

```javascript
// ❌ O(n²) - includes est O(n)
function hasDuplicates(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = i + 1; j < arr.length; j++) {
      if (arr[i] === arr[j]) return true;
    }
  }
  return false;
}

// ✅ O(n) - Set.has est O(1)
function hasDuplicates(arr) {
  const seen = new Set();
  for (const item of arr) {
    if (seen.has(item)) return true;
    seen.add(item);
  }
  return false;
}
```

### Technique 2 : Mémorisation

```javascript
// ❌ O(2ⁿ)
function fibonacci(n) {
  if (n <= 1) return n;
  return fibonacci(n - 1) + fibonacci(n - 2);
}

// ✅ O(n) - avec cache
function fibonacci(n, memo = {}) {
  if (n <= 1) return n;
  if (memo[n]) return memo[n];
  
  memo[n] = fibonacci(n - 1, memo) + fibonacci(n - 2, memo);
  return memo[n];
}
```

### Technique 3 : Éviter les opérations O(n) dans les boucles

```javascript
// ❌ O(n²) - indexOf est O(n)
function intersection(arr1, arr2) {
  return arr1.filter(item => arr2.indexOf(item) !== -1);
}

// ✅ O(n+m) - Set.has est O(1)
function intersection(arr1, arr2) {
  const set2 = new Set(arr2);
  return arr1.filter(item => set2.has(item));
}
```

### Technique 4 : Tri + Recherche binaire

```javascript
// ❌ O(n) par recherche
function findMultiple(arr, targets) {
  return targets.map(t => arr.includes(t));
}

// ✅ O(n log n) + O(log n) par recherche
function findMultiple(arr, targets) {
  arr.sort((a, b) => a - b);  // O(n log n)
  return targets.map(t => binarySearch(arr, t) !== -1);  // O(m log n)
}
// Total : O((n+m) log n) - avantageux si beaucoup de recherches
```

---

## Complexité des opérations courantes

### Array (Tableau)

| Opération | Complexité | Explication |
|-----------|------------|-------------|
| `arr[i]` | O(1) | Accès direct par index |
| `arr.push()` | O(1) | Ajout à la fin |
| `arr.pop()` | O(1) | Suppression à la fin |
| `arr.unshift()` | O(n) | Décale tous les éléments |
| `arr.shift()` | O(n) | Décale tous les éléments |
| `arr.includes()` | O(n) | Parcours linéaire |
| `arr.indexOf()` | O(n) | Parcours linéaire |
| `arr.find()` | O(n) | Parcours linéaire |
| `arr.filter()` | O(n) | Parcours complet |
| `arr.map()` | O(n) | Parcours complet |
| `arr.sort()` | O(n log n) | TimSort en JS |
| `arr.splice()` | O(n) | Peut décaler des éléments |
| `arr.slice()` | O(k) | k = taille de la copie |
| `arr.concat()` | O(n+m) | Copie les deux tableaux |

### Set (Ensemble)

| Opération | Complexité |
|-----------|------------|
| `set.add()` | O(1) |
| `set.has()` | O(1) |
| `set.delete()` | O(1) |
| `set.size` | O(1) |

### Map (Dictionnaire)

| Opération | Complexité |
|-----------|------------|
| `map.set()` | O(1) |
| `map.get()` | O(1) |
| `map.has()` | O(1) |
| `map.delete()` | O(1) |

### Object

| Opération | Complexité |
|-----------|------------|
| `obj.key` | O(1) |
| `obj[key]` | O(1) |
| `Object.keys()` | O(n) |
| `Object.values()` | O(n) |
| `for...in` | O(n) |

### String

| Opération | Complexité |
|-----------|------------|
| `str[i]` | O(1) |
| `str.length` | O(1) |
| `str.slice()` | O(k) |
| `str.split()` | O(n) |
| `str + str2` | O(n+m) |
| `str.includes()` | O(n×m) |
| `str.indexOf()` | O(n×m) |

---

## Résumé : Comment choisir ?

### Questions à se poser

1. **Quelle est la taille des données ?**
   - Petit (< 100) : O(n²) acceptable
   - Moyen (100-10000) : O(n log n) préférable
   - Grand (> 10000) : O(n) ou mieux nécessaire

2. **Combien de fois le code sera exécuté ?**
   - Une fois : optimisation moins critique
   - En boucle : chaque milliseconde compte

3. **Quel est le compromis temps/espace ?**
   - Plus de mémoire peut réduire le temps (cache, mémorisation)
   - Moins de mémoire peut augmenter le temps

### Priorités d'optimisation

1. **D'abord la complexité** : O(n) bat toujours O(n²) pour de grandes données
2. **Ensuite les constantes** : À même complexité, réduire les opérations
3. **Enfin les micro-optimisations** : Rarement significatives
