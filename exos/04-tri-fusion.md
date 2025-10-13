# Exercice 1 - Tri Fusion (Merge Sort)

## Objectif
Implémenter l'algorithme de tri fusion, un algorithme "diviser pour régner" performant.

## Principe : Diviser pour régner

Le tri fusion utilise la stratégie "diviser pour régner" :
1. **Diviser** : Couper le tableau en deux moitiés
2. **Régner** : Trier récursivement chaque moitié
3. **Combiner** : Fusionner les deux moitiés triées

### Analogie
Comme trier deux paquets de cartes déjà triés : on prend toujours la plus petite carte des deux paquets.

---

## Fonctionnement visuel

Pour trier `[38, 27, 43, 3, 9, 82, 10]` :

```
                [38, 27, 43, 3, 9, 82, 10]
                         |
              ─────────────────────────────
              |                           |
        [38, 27, 43, 3]            [9, 82, 10]
              |                           |
        ───────────────              ─────────────
        |             |              |           |
    [38, 27]       [43, 3]        [9, 82]      [10]
        |             |              |
    ─────────     ─────────      ─────────
    |       |     |       |      |       |
   [38]   [27]  [43]    [3]    [9]    [82]
    
    ↓ FUSION ↓
    
   [27, 38]     [3, 43]       [9, 82]    [10]
        |             |              |
        ─────────────────       ─────────────
              |                      |
        [3, 27, 38, 43]         [9, 10, 82]
              |                      |
              ────────────────────────
                      |
              [3, 9, 10, 27, 38, 43, 82]
```

---

## Tests

```javascript
// Test 1 : Tableau simple
const arr1 = [38, 27, 43, 3, 9, 82, 10];
console.log(mergeSort(arr1)); // [3, 9, 10, 27, 38, 43, 82]

// Test 2 : Tableau déjà trié
const arr2 = [1, 2, 3, 4, 5];
console.log(mergeSort(arr2)); // [1, 2, 3, 4, 5]

// Test 3 : Tableau inversé
const arr3 = [5, 4, 3, 2, 1];
console.log(mergeSort(arr3)); // [1, 2, 3, 4, 5]

// Test 4 : Avec doublons
const arr4 = [3, 1, 4, 1, 5, 9, 2, 6, 5];
console.log(mergeSort(arr4)); // [1, 1, 2, 3, 4, 5, 5, 6, 9]

// Test 5 : Tableau vide
const arr5 = [];
console.log(mergeSort(arr5)); // []

// Test 6 : Un seul élément
const arr6 = [42];
console.log(mergeSort(arr6)); // [42]

// Test 7 : Deux éléments
const arr7 = [2, 1];
console.log(mergeSort(arr7)); // [1, 2]
```

---

## Analyse de complexité

### Complexité temporelle
- **Tous les cas** : O(n log n)
  - Division : O(log n) niveaux
  - Fusion à chaque niveau : O(n)
  - Total : O(n) × O(log n) = O(n log n)

### Complexité spatiale
- O(n) - nécessite des tableaux temporaires

### Pourquoi O(n log n) ?

Pour un tableau de n éléments :
- Nombre de niveaux de récursion : log₂(n)
- À chaque niveau, on fusionne n éléments au total
- Exemple avec n=8 :
  ```
  Niveau 0: [8 éléments]          → 8 opérations
  Niveau 1: [4] + [4]             → 8 opérations
  Niveau 2: [2] + [2] + [2] + [2] → 8 opérations
  Niveau 3: 8 tableaux de [1]     → 8 opérations
  
  Total : 8 × 3 = 24 opérations
  (n × log₂(n) = 8 × 3 = 24)
  ```

---

## Comparaison avec les autres tris

| Algorithme | Meilleur cas | Cas moyen | Pire cas | Espace | Stable |
|------------|-------------|-----------|----------|--------|--------|
| Tri à bulles | O(n) | O(n²) | O(n²) | O(1) | Oui |
| Tri insertion | O(n) | O(n²) | O(n²) | O(1) | Oui |
| **Tri fusion** | O(n log n) | O(n log n) | O(n log n) | O(n) | Oui |

**Avantages** :
- Complexité garantie O(n log n)
- Stable (préserve l'ordre des éléments égaux)
- Prévisible (toujours la même performance)

**Inconvénients** :
- Utilise de l'espace supplémentaire O(n)
- Plus lent que Quick Sort en pratique (constantes plus élevées)

---

## Contraintes
- Utilisez la récursivité
- Ne pas utiliser `Array.sort()`
- Durée estimée : 40 minutes

