# Exercice 1 - Fonctions Récursives : Factorielle et Fibonacci

## Objectif
Comprendre le principe de la récursivité en implémentant deux fonctions classiques.

## Partie 1 : Factorielle

### Définition mathématique
- `n! = n × (n-1) × (n-2) × ... × 2 × 1`
- `0! = 1` (cas de base)
- Exemple : `5! = 5 × 4 × 3 × 2 × 1 = 120`

### Définition récursive
- `factorial(0) = 1` (cas de base)
- `factorial(n) = n × factorial(n-1)` (cas récursif)

### Consignes
Implémentez la fonction `factorial(n)` de manière récursive.

```javascript
function factorial(n) {
  // Votre code ici
    
    if (n === 0) {
        return 1;
    } else if (n === 1) {
        return 1;
    }
    
    return n * factorial(n - 1);
    
}

console.log(factorial(0));  // 1
console.log(factorial(1));  // 1
console.log(factorial(5));  // 120
console.log(factorial(10)); // 3628800
```

### Tests
```javascript
console.assert(factorial(0) === 1);
console.assert(factorial(1) === 1);
console.assert(factorial(5) === 120);
console.assert(factorial(10) === 3628800);
```

---

## Partie 2 : Suite de Fibonacci

### Définition mathématique
- `F(0) = 0`
- `F(1) = 1`
- `F(n) = F(n-1) + F(n-2)` pour n ≥ 2
- Suite : 0, 1, 1, 2, 3, 5, 8, 13, 21, 34...

### Consignes
Implémentez la fonction `fibonacci(n)` de manière récursive.

```javascript
function fibonacci(n) {
    // Votre code ici
}

console.log(fibonacci(0));  // 0
console.log(fibonacci(1));  // 1
console.log(fibonacci(6));  // 12
console.log(fibonacci(10)); // 88
```

### Tests
```javascript
console.assert(fibonacci(0) === 0);
console.assert(fibonacci(1) === 1);
console.assert(fibonacci(2) === 1);
console.assert(fibonacci(6) === 12);
console.assert(fibonacci(10) === 88);
```

---

## Partie 3 : Analyse et Optimisation

### Questions de réflexion

1. **Tracer l'exécution**
   - Dessinez l'arbre d'appels pour `factorial(4)`
   - Dessinez l'arbre d'appels pour `fibonacci(5)`
   - Combien d'appels récursifs sont effectués dans chaque cas ?

2. **Problème de performance**
   - Essayez `fibonacci(40)`. Que constatez-vous ?
   - Pourquoi est-ce si lent ?
   - Combien de fois `fibonacci(2)` est-il calculé pour `fibonacci(10)` ?

### Bonus : Fibonacci optimisé avec mémorisation

Implémentez une version optimisée qui garde en mémoire les résultats déjà calculés :

```javascript
function fibonacciMemo(n, memo = {}) {
  // Votre code ici
  // Indice : vérifier si memo[n] existe avant de calculer
}

console.log(fibonacciMemo(40)); // Devrait être rapide !
console.log(fibonacciMemo(100)); // 354224848179262000000
```

### Bonus 2 : Version itérative

Réécrivez `fibonacci` de manière itérative (avec une boucle) :

```javascript
function fibonacciIterative(n) {
  // Votre code ici
}
```

Comparez les performances avec la version récursive.

---

## Partie 4 : Autres exercices récursifs

### 4.1 Somme des éléments d'un tableau

```javascript
function sumArray(arr) {
  // Cas de base : tableau vide
  // Cas récursif : premier élément + somme du reste
}

console.log(sumArray([1, 2, 3, 4, 5])); // 15
console.log(sumArray([])); // 0
```

### 4.2 Puissance

```javascript
function power(base, exponent) {
  // power(2, 3) = 2 × 2 × 2 = 8
  // Cas de base : exponent = 0 → return 1
  // Cas récursif : base × power(base, exponent - 1)
}

console.log(power(2, 3));  // 8
console.log(power(5, 2));  // 25
console.log(power(10, 0)); // 1
```

### 4.3 Inverser une chaîne

```javascript
function reverseString(str) {
  // "hello" → "olleh"
  // Cas de base : chaîne vide ou 1 caractère
  // Cas récursif : dernier caractère + inverse du reste
}

console.log(reverseString("hello"));    // "olleh"
console.log(reverseString("bonjour")); // "ruojnob"
```

---

## Concepts clés à retenir

1. **Cas de base** : condition qui arrête la récursion
2. **Cas récursif** : appel de la fonction sur un problème plus petit
3. **Call stack** : chaque appel est empilé en mémoire
4. **Stack overflow** : trop d'appels récursifs peuvent saturer la mémoire
5. **Mémorisation** : technique pour éviter les calculs redondants

## Contraintes
- Durée estimée : 20 minutes

