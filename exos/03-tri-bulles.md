# Exercice 1 - Tri à Bulles (Bubble Sort)

## Objectif
Implémenter l'algorithme de tri à bulles et comprendre son fonctionnement.

## Principe

Le tri à bulles compare des paires d'éléments adjacents et les échange s'ils sont dans le mauvais ordre. On répète ce processus jusqu'à ce que le tableau soit trié.

### Analogie
Imaginez des bulles d'air dans l'eau : les plus grosses (grandes valeurs) remontent progressivement vers la surface (fin du tableau).

---

## Fonctionnement détaillé

Pour trier `[5, 3, 8, 4, 2]` :

**Passage 1 :**
- Compare 5 et 3 → échange → `[3, 5, 8, 4, 2]`
- Compare 5 et 8 → ne change pas → `[3, 5, 8, 4, 2]`
- Compare 8 et 4 → échange → `[3, 5, 4, 8, 2]`
- Compare 8 et 2 → échange → `[3, 5, 4, 2, 8]`
- ✓ Le plus grand (8) est à sa place

**Passage 2 :**
- Compare 3 et 5 → ne change pas → `[3, 5, 4, 2, 8]`
- Compare 5 et 4 → échange → `[3, 4, 5, 2, 8]`
- Compare 5 et 2 → échange → `[3, 4, 2, 5, 8]`
- ✓ Le 2ème plus grand (5) est à sa place

**Passage 3 :**
- Compare 3 et 4 → ne change pas → `[3, 4, 2, 5, 8]`
- Compare 4 et 2 → échange → `[3, 2, 4, 5, 8]`

**Passage 4 :**
- Compare 3 et 2 → échange → `[2, 3, 4, 5, 8]`

✅ Tableau trié !

---

## Tests

```javascript
// Test 1 : Tableau simple
const arr1 = [5, 3, 8, 4, 2];
bubbleSort(arr1);
console.log(arr1); // [2, 3, 4, 5, 8]

// Test 2 : Tableau déjà trié
const arr2 = [1, 2, 3, 4, 5];
bubbleSort(arr2);
console.log(arr2); // [1, 2, 3, 4, 5]

// Test 3 : Tableau inversé
const arr3 = [5, 4, 3, 2, 1];
bubbleSort(arr3);
console.log(arr3); // [1, 2, 3, 4, 5]

// Test 4 : Tableau avec doublons
const arr4 = [3, 1, 4, 1, 5, 9, 2, 6];
bubbleSort(arr4);
console.log(arr4); // [1, 1, 2, 3, 4, 5, 6, 9]

// Test 5 : Tableau vide
const arr5 = [];
bubbleSort(arr5);
console.log(arr5); // []

// Test 6 : Un seul élément
const arr6 = [42];
bubbleSort(arr6);
console.log(arr6); // [42]
```

---

## Analyse de complexité

### Complexité temporelle
- **Meilleur cas** : O(n) - tableau déjà trié (avec optimisation)
- **Cas moyen** : O(n²)
- **Pire cas** : O(n²) - tableau inversé

### Complexité spatiale
- O(1) - tri en place (pas de tableau supplémentaire)

### Nombre d'opérations
Pour un tableau de n éléments :
- Nombre de passages : n - 1
- Nombre de comparaisons : (n-1) + (n-2) + ... + 1 = n(n-1)/2
- Nombre d'échanges (pire cas) : n(n-1)/2

## Contraintes
- Ne pas utiliser `Array.sort()`
- Tri en place (modifier le tableau original)
- Durée estimée : 30 minutes

