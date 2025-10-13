# Exercice 2 - Tri Rapide (Quick Sort)

## Objectif
Implémenter l'algorithme de tri rapide, un des algorithmes les plus utilisés en pratique.

## Principe : Diviser pour régner avec pivot

Le tri rapide utilise aussi "diviser pour régner" mais différemment :
1. **Choisir un pivot** (un élément du tableau)
2. **Partitionner** : placer les éléments < pivot à gauche, > pivot à droite
3. **Récursion** : trier récursivement les deux partitions

### Différence avec Merge Sort
- **Merge Sort** : divise en 2 moitiés égales, complexité dans la fusion
- **Quick Sort** : divise selon un pivot, complexité dans le partitionnement

---

## Fonctionnement visuel

Pour trier `[5, 3, 7, 6, 2, 9]` avec le dernier élément comme pivot :

```
Étape 1: [5, 3, 7, 6, 2, 9]
         Pivot = 9
         [5, 3, 7, 6, 2] < 9, [] > 9
         → [5, 3, 7, 6, 2, 9]

Étape 2: Trier [5, 3, 7, 6, 2]
         Pivot = 2
         [] < 2, [5, 3, 7, 6] > 2
         → [2, 5, 3, 7, 6, 9]

Étape 3: Trier [5, 3, 7, 6]
         Pivot = 6
         [5, 3] < 6, [7] > 6
         → [2, 5, 3, 6, 7, 9]

Étape 4: Trier [5, 3]
         Pivot = 3
         [] < 3, [5] > 3
         → [2, 3, 5, 6, 7, 9]

✅ Tableau trié !
```

---

## Tests

```javascript
// Test 1 : Tableau simple
const arr1 = [5, 3, 7, 6, 2, 9];
console.log(quickSort(arr1)); // [2, 3, 5, 6, 7, 9]

// Test 2 : Tableau déjà trié
const arr2 = [1, 2, 3, 4, 5];
console.log(quickSort(arr2)); // [1, 2, 3, 4, 5]

// Test 3 : Tableau inversé
const arr3 = [5, 4, 3, 2, 1];
console.log(quickSort(arr3)); // [1, 2, 3, 4, 5]

// Test 4 : Avec doublons
const arr4 = [3, 1, 4, 1, 5, 9, 2, 6, 5];
console.log(quickSort(arr4)); // [1, 1, 2, 3, 4, 5, 5, 6, 9]

// Test 5 : Tous identiques
const arr5 = [5, 5, 5, 5, 5];
console.log(quickSort(arr5)); // [5, 5, 5, 5, 5]

// Test 6 : Tableau vide
const arr6 = [];
console.log(quickSort(arr6)); // []
```

---

## Analyse de complexité

### Complexité temporelle
- **Meilleur cas** : O(n log n) - partition équilibrée
- **Cas moyen** : O(n log n)
- **Pire cas** : O(n²) - tableau déjà trié avec mauvais choix de pivot

### Complexité spatiale
- Version avec tableaux auxiliaires : O(n)
- Version en place : O(log n) - stack de récursion

### Pourquoi O(n²) dans le pire cas ?

Avec un tableau trié `[1, 2, 3, 4, 5]` et pivot = dernier élément :
```
Niveau 1: [1, 2, 3, 4] pivot=5 → n opérations
Niveau 2: [1, 2, 3] pivot=4    → n-1 opérations
Niveau 3: [1, 2] pivot=3       → n-2 opérations
...
Total: n + (n-1) + (n-2) + ... + 1 = n(n+1)/2 = O(n²)
```

**Solution** : utiliser un pivot aléatoire ou médiane de trois.

---

## Comparaison des algorithmes de tri

| Algorithme | Meilleur | Moyen | Pire | Espace | Stable |
|------------|---------|-------|------|--------|--------|
| Tri à bulles | O(n) | O(n²) | O(n²) | O(1) | Oui |
| Tri insertion | O(n) | O(n²) | O(n²) | O(1) | Oui |
| Tri fusion | O(n log n) | O(n log n) | O(n log n) | O(n) | Oui |
| **Tri rapide** | O(n log n) | O(n log n) | O(n²) | O(log n) | Non* |

**Quick Sort est le plus utilisé en pratique car** :
- Très rapide en moyenne
- Faible consommation mémoire (en place)
- Bonnes constantes (cache-friendly)

---

## Questions de réflexion

1. Pourquoi Quick Sort est-il plus rapide que Merge Sort en pratique ?
2. Comment éviter le pire cas O(n²) ?
3. Pourquoi Quick Sort n'est-il pas stable ?
4. Quelle est la profondeur maximale de la récursion ?

## Contraintes
- Implémentez les deux versions (simple et en place)
- Ne pas utiliser `Array.sort()`
- Durée estimée : 40 minutes (pour la version simple)

