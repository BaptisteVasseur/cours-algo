# Exercice 3 - Recherche Binaire

## Objectif
Implémenter l'algorithme de recherche binaire et comprendre pourquoi il est si efficace.

## Principe : Diviser pour régner

La recherche binaire est un algorithme de recherche dans un **tableau trié** qui divise l'espace de recherche en deux à chaque étape.

### Analogie
Comme deviner un nombre entre 1 et 100 :
- Vous proposez 50
- "C'est plus grand" → vous cherchez entre 51 et 100
- Vous proposez 75
- "C'est plus petit" → vous cherchez entre 51 et 74
- etc.

**Prérequis important** : Le tableau DOIT être trié !

---

## Fonctionnement visuel

Rechercher `7` dans `[1, 3, 5, 7, 9, 11, 13, 15]` :

```
Étape 1: [1, 3, 5, 7, 9, 11, 13, 15]
                    ↑
                  mid=7
         7 === 7 → Trouvé ! Index = 3
```

Rechercher `11` dans le même tableau :

```
Étape 1: [1, 3, 5, 7, 9, 11, 13, 15]
                    ↑
                  mid=7
         11 > 7 → chercher à droite

Étape 2: [9, 11, 13, 15]
            ↑
          mid=11
         11 === 11 → Trouvé ! Index = 5
```

Rechercher `6` (n'existe pas) :

```
Étape 1: [1, 3, 5, 7, 9, 11, 13, 15]
                    ↑
                  mid=7
         6 < 7 → chercher à gauche

Étape 2: [1, 3, 5, 7]
              ↑
            mid=5
         6 > 5 → chercher à droite

Étape 3: [7]
          ↑
        mid=7
         6 < 7 → chercher à gauche

Étape 4: [] (vide) → Non trouvé ! Return -1
```

---

## Tests

```javascript
const arr = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19];

// Tests de recherche d'éléments existants
console.assert(binarySearch(arr, 1) === 0);
console.assert(binarySearch(arr, 7) === 3);
console.assert(binarySearch(arr, 11) === 5);
console.assert(binarySearch(arr, 19) === 9);

// Tests de recherche d'éléments inexistants
console.assert(binarySearch(arr, 0) === -1);
console.assert(binarySearch(arr, 6) === -1);
console.assert(binarySearch(arr, 20) === -1);

// Tests avec tableaux spéciaux
console.assert(binarySearch([5], 5) === 0);
console.assert(binarySearch([5], 3) === -1);
console.assert(binarySearch([], 5) === -1);

// Tests avec deux éléments
console.assert(binarySearch([1, 3], 1) === 0);
console.assert(binarySearch([1, 3], 3) === 1);
console.assert(binarySearch([1, 3], 2) === -1);
```

---

## Analyse de complexité

### Complexité temporelle
- **Tous les cas** : O(log n)
  - À chaque étape, on divise l'espace de recherche par 2
  - Pour n éléments : log₂(n) étapes maximum

### Exemples
- 10 éléments → 4 étapes max (log₂(10) ≈ 3.32)
- 100 éléments → 7 étapes max (log₂(100) ≈ 6.64)
- 1 000 000 éléments → 20 étapes max (log₂(1000000) ≈ 19.93)

### Complexité spatiale
- Version itérative : O(1)
- Version récursive : O(log n) - stack de récursion

### Comparaison avec la recherche linéaire

| Taille | Linéaire (pire cas) | Binaire (pire cas) |
|--------|---------------------|-------------------|
| 10 | 10 | 4 |
| 100 | 100 | 7 |
| 1 000 | 1 000 | 10 |
| 1 000 000 | 1 000 000 | 20 |

**Gain énorme pour les grands tableaux !**

## Contraintes
- Le tableau doit être trié
- Ne pas utiliser `Array.indexOf()` ou `Array.includes()`
- Durée estimée : 20 minutes

