# Exercice 1 - Analyser la Complexité d'Algorithmes

## Objectif
Apprendre à identifier et calculer la complexité temporelle (Big O) d'algorithmes.

## Rappel : Notation Big O

Big O décrit le **comportement asymptotique** d'un algorithme quand n → ∞.

### Classes de complexité courantes

| Notation | Nom | Exemple |
|----------|-----|---------|
| O(1) | Constante | Accès à un index de tableau |
| O(log n) | Logarithmique | Recherche binaire |
| O(n) | Linéaire | Parcours de tableau |
| O(n log n) | Quasi-linéaire | Tri fusion, tri rapide |
| O(n²) | Quadratique | Tri à bulles, tri insertion |
| O(n³) | Cubique | Multiplication de matrices |
| O(2ⁿ) | Exponentielle | Fibonacci récursif naïf |
| O(n!) | Factorielle | Permutations |

---

## Partie 1 : Identifier la complexité

Pour chaque fonction, déterminez sa complexité temporelle :

### Exercice 1.1

```javascript
function exemple1(arr) {
  return arr[0];
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(1) - Constante : une seule opération, indépendante de la taille du tableau
</details>

---

### Exercice 1.2

```javascript
function exemple2(arr) {
  let sum = 0;
  for (let i = 0; i < arr.length; i++) {
    sum += arr[i];
  }
  return sum;
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n) - Linéaire : on parcourt le tableau une fois (n itérations)
</details>

---

### Exercice 1.3

```javascript
function exemple3(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < arr.length; j++) {
      console.log(arr[i], arr[j]);
    }
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n²) - Quadratique : deux boucles imbriquées, n × n = n² itérations
</details>

---

### Exercice 1.4

```javascript
function exemple4(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = i + 1; j < arr.length; j++) {
      console.log(arr[i], arr[j]);
    }
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n²) - Quadratique : même si on fait moins d'itérations (n×(n-1)/2), Big O ignore les constantes
Nombre d'opérations : n + (n-1) + (n-2) + ... + 1 = n(n+1)/2 ≈ n²/2 → O(n²)
</details>

---

### Exercice 1.5

```javascript
function exemple5(arr) {
  let left = 0;
  let right = arr.length - 1;
  
  while (left < right) {
    const mid = Math.floor((left + right) / 2);
    if (arr[mid] === target) return mid;
    if (arr[mid] < target) left = mid + 1;
    else right = mid - 1;
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(log n) - Logarithmique : recherche binaire, on divise par 2 à chaque itération
</details>

---

### Exercice 1.6

```javascript
function exemple6(arr) {
  for (let i = 0; i < arr.length; i++) {
    console.log(arr[i]);
  }
  for (let i = 0; i < arr.length; i++) {
    console.log(arr[i]);
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n) - Linéaire : deux boucles séquentielles (non imbriquées)
2n opérations → O(2n) → O(n) (on ignore les constantes)
</details>

---

### Exercice 1.7

```javascript
function exemple7(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < 100; j++) {
      console.log(arr[i]);
    }
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n) - Linéaire : n × 100 = 100n opérations → O(100n) → O(n)
La boucle interne est constante (100), donc on l'ignore
</details>

---

### Exercice 1.8

```javascript
function exemple8(n) {
  if (n <= 1) return 1;
  return exemple8(n - 1) + exemple8(n - 1);
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(2ⁿ) - Exponentielle : chaque appel génère 2 appels récursifs
Arbre binaire complet de profondeur n → 2ⁿ nœuds
</details>

---

### Exercice 1.9

```javascript
function exemple9(arr) {
  const sorted = mergeSort(arr); // O(n log n)
  return binarySearch(sorted, target); // O(log n)
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(n log n) - On prend la complexité dominante
O(n log n) + O(log n) = O(n log n) car n log n >> log n quand n est grand
</details>

---

### Exercice 1.10

```javascript
function exemple10(arr) {
  for (let i = 1; i < arr.length; i *= 2) {
    console.log(arr[i]);
  }
}
```

**Question** : Quelle est la complexité ?
<details>
<summary>Réponse</summary>
O(log n) - Logarithmique : i double à chaque itération (1, 2, 4, 8, 16...)
Nombre d'itérations = log₂(n)
</details>

---

## Partie 2 : Calculer la complexité pas à pas

### Exercice 2.1

```javascript
function complexe1(arr) {
  // Ligne 1
  let count = 0;
  
  // Ligne 2-4
  for (let i = 0; i < arr.length; i++) {
    count++;
  }
  
  // Ligne 5-9
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < arr.length; j++) {
      count++;
    }
  }
  
  return count;
}
```

**Analysez ligne par ligne** :
- Ligne 1 : O(1)
- Lignes 2-4 : O(n)
- Lignes 5-9 : O(n²)
- **Total** : O(1) + O(n) + O(n²) = O(n²) (on garde le terme dominant)

---

### Exercice 2.2

```javascript
function complexe2(arr) {
  // Boucle externe
  for (let i = 0; i < arr.length; i++) {
    // Boucle interne
    for (let j = i; j < arr.length; j++) {
      console.log(arr[i], arr[j]);
    }
  }
}
```

**Calculez le nombre d'itérations** :
- i=0 : j va de 0 à n-1 → n itérations
- i=1 : j va de 1 à n-1 → n-1 itérations
- i=2 : j va de 2 à n-1 → n-2 itérations
- ...
- Total : n + (n-1) + (n-2) + ... + 1 = n(n+1)/2 = (n² + n)/2

**Simplification** :
- (n² + n)/2 = 0.5n² + 0.5n
- On ignore les constantes : n² + n
- On garde le terme dominant : n²
- **Réponse** : O(n²)

---

### Exercice 2.3

```javascript
function complexe3(arr) {
  for (let i = 0; i < arr.length; i++) {
    for (let j = 0; j < i; j++) {
      console.log(arr[j]);
    }
  }
}
```

**À vous de jouer !**
- Nombre d'itérations : ?
- Complexité : ?

<details>
<summary>Réponse</summary>
- i=0 : 0 itérations
- i=1 : 1 itération
- i=2 : 2 itérations
- ...
- Total : 0 + 1 + 2 + ... + (n-1) = n(n-1)/2 ≈ n²/2
- **Complexité** : O(n²)
</details>

---

## Partie 3 : Règles de simplification

### Règle 1 : Ignorer les constantes

```javascript
O(2n) → O(n)
O(n/2) → O(n)
O(100) → O(1)
O(5n² + 3n + 10) → O(n²)
```

### Règle 2 : Garder le terme dominant

```javascript
O(n² + n) → O(n²)
O(n³ + n² + n) → O(n³)
O(n log n + n) → O(n log n)
O(2ⁿ + n²) → O(2ⁿ)
```

### Règle 3 : Boucles

- **Séquentielles** : addition
  ```javascript
  for (...) { } // O(n)
  for (...) { } // O(n)
  // Total : O(n) + O(n) = O(n)
  ```

- **Imbriquées** : multiplication
  ```javascript
  for (...) {      // O(n)
    for (...) { }  // O(n)
  }
  // Total : O(n) × O(n) = O(n²)
  ```

---

## Partie 4 : Exercices de synthèse

Déterminez la complexité de ces fonctions :

### Fonction A
```javascript
function fonctionA(n) {
  let sum = 0;
  for (let i = 0; i < n; i++) {
    sum += i;
  }
  for (let i = 0; i < n; i++) {
    for (let j = 0; j < n; j++) {
      sum += i * j;
    }
  }
  return sum;
}
```

### Fonction B
```javascript
function fonctionB(arr, target) {
  arr.sort((a, b) => a - b); // O(n log n)
  
  for (let i = 0; i < arr.length; i++) {
    const complement = target - arr[i];
    const index = binarySearch(arr, complement); // O(log n)
    if (index !== -1) return [i, index];
  }
}
```

### Fonction C
```javascript
function fonctionC(n) {
  if (n <= 1) return n;
  return fonctionC(n - 1) + fonctionC(n - 2);
}
```

<details>
<summary>Réponses</summary>

**Fonction A** : O(n²)
- Première boucle : O(n)
- Deuxième boucle : O(n²)
- Total : O(n) + O(n²) = O(n²)

**Fonction B** : O(n log n)
- Tri : O(n log n)
- Boucle : O(n) × O(log n) = O(n log n)
- Total : O(n log n) + O(n log n) = O(n log n)

**Fonction C** : O(2ⁿ)
- Fibonacci récursif classique
- Arbre d'appels exponentiel

</details>

---

## Partie 5 : Complexité spatiale

Analysez l'espace mémoire utilisé :

### Exemple 1
```javascript
function exemple(n) {
  const arr = new Array(n);
  return arr;
}
```
**Complexité spatiale** : O(n) - crée un tableau de taille n

### Exemple 2
```javascript
function exemple(arr) {
  for (let i = 0; i < arr.length; i++) {
    console.log(arr[i]);
  }
}
```
**Complexité spatiale** : O(1) - pas de mémoire supplémentaire

### Exemple 3
```javascript
function exemple(n) {
  if (n === 0) return;
  exemple(n - 1);
}
```
**Complexité spatiale** : O(n) - call stack de profondeur n

---

## Quiz final

1. Quelle est la complexité de `Array.push()` ? **O(1)**
2. Quelle est la complexité de `Array.unshift()` ? **O(n)**
3. Quelle est la complexité de `Array.sort()` ? **O(n log n)**
4. Quelle est la complexité de `Array.indexOf()` ? **O(n)**
5. Quelle est la complexité de rechercher dans un Set ? **O(1)**
6. Quelle est la complexité de rechercher dans un Map ? **O(1)**

## Contraintes
- Durée estimée : 30 minutes

