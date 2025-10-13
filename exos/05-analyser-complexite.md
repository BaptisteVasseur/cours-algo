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

---

### Exercice 1.8

```javascript
function exemple8(n) {
  if (n <= 1) return 1;
  return exemple8(n - 1) + exemple8(n - 1);
}
```

**Question** : Quelle est la complexité ?

---

### Exercice 1.9

```javascript
function exemple9(arr) {
  const sorted = mergeSort(arr); // O(n log n)
  return binarySearch(sorted, target); // O(log n)
}
```

**Question** : Quelle est la complexité ?

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
- Ligne 1 : ?
- Lignes 2-4 : ?
- Lignes 5-9 : ?
- **Total** : ?

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
- i=0 : j va de 0 à n-1 → ? itérations
- i=1 : j va de 1 à n-1 → ? itérations
- i=2 : j va de 2 à n-1 → ? itérations
- ...
- Total : ?

**Simplification** :
- ?
- **Réponse** : ?

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
**Complexité spatiale** : ?

### Exemple 2
```javascript
function exemple(arr) {
  for (let i = 0; i < arr.length; i++) {
    console.log(arr[i]);
  }
}
```
**Complexité spatiale** : ?

### Exemple 3
```javascript
function exemple(n) {
  if (n === 0) return;
  exemple(n - 1);
}
```
**Complexité spatiale** : ?

---

## Quiz final

1. Quelle est la complexité de `Array.push()` ?
2. Quelle est la complexité de `Array.unshift()` ?
3. Quelle est la complexité de `Array.sort()` ?
4. Quelle est la complexité de `Array.indexOf()` ?
5. Quelle est la complexité de rechercher dans un Set ?
6. Quelle est la complexité de rechercher dans un Map ?

## Contraintes
- Durée estimée : 30 minutes

