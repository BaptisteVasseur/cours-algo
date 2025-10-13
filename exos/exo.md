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
