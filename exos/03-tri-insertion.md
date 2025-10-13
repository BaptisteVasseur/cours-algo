# Exercice 2 - Tri par Insertion (Insertion Sort)

## Objectif
Implémenter l'algorithme de tri par insertion et comprendre son fonctionnement.

## Principe

Le tri par insertion construit progressivement un tableau trié en insérant chaque élément à sa place correcte.

### Analogie
Comme trier des cartes dans votre main :
- Vous prenez une carte
- Vous la placez à sa position correcte parmi les cartes déjà triées
- Vous répétez pour toutes les cartes

---

## Fonctionnement détaillé

Pour trier `[5, 3, 8, 4, 2]` :

**État initial :**
```
[5] | 3, 8, 4, 2
 ↑
trié
```

**Étape 1 : Insérer 3**
```
[5] | 3, 8, 4, 2
5 > 3 → décaler 5 vers la droite
[3, 5] | 8, 4, 2
```

**Étape 2 : Insérer 8**
```
[3, 5] | 8, 4, 2
8 > 5 → déjà à la bonne place
[3, 5, 8] | 4, 2
```

**Étape 3 : Insérer 4**
```
[3, 5, 8] | 4, 2
8 > 4 → décaler 8
5 > 4 → décaler 5
3 < 4 → insérer ici
[3, 4, 5, 8] | 2
```

**Étape 4 : Insérer 2**
```
[3, 4, 5, 8] | 2
8 > 2 → décaler 8
5 > 2 → décaler 5
4 > 2 → décaler 4
3 > 2 → décaler 3
Insérer au début
[2, 3, 4, 5, 8]
```

✅ Tableau trié !

---

## Tests

```javascript
// Test 1 : Tableau simple
const arr1 = [5, 3, 8, 4, 2];
insertionSort(arr1);
console.log(arr1); // [2, 3, 4, 5, 8]

// Test 2 : Tableau déjà trié
const arr2 = [1, 2, 3, 4, 5];
insertionSort(arr2);
console.log(arr2); // [1, 2, 3, 4, 5]

// Test 3 : Tableau inversé
const arr3 = [5, 4, 3, 2, 1];
insertionSort(arr3);
console.log(arr3); // [1, 2, 3, 4, 5]

// Test 4 : Avec doublons
const arr4 = [3, 1, 4, 1, 5, 9, 2, 6, 5];
insertionSort(arr4);
console.log(arr4); // [1, 1, 2, 3, 4, 5, 5, 6, 9]

// Test 5 : Tableau vide
const arr5 = [];
insertionSort(arr5);
console.log(arr5); // []

// Test 6 : Un seul élément
const arr6 = [42];
insertionSort(arr6);
console.log(arr6); // [42]
```

---

## Analyse de complexité

### Complexité temporelle
- **Meilleur cas** : O(n) - tableau déjà trié (aucun décalage)
- **Cas moyen** : O(n²)
- **Pire cas** : O(n²) - tableau inversé (maximum de décalages)

### Complexité spatiale
- O(1) - tri en place

### Comparaison avec le tri à bulles

| Critère | Tri à bulles | Tri par insertion |
|---------|--------------|-------------------|
| Meilleur cas | O(n) | O(n) |
| Pire cas | O(n²) | O(n²) |
| En pratique | Plus lent | Plus rapide |
| Stable | Oui | Oui |
| Utilisé pour | Rarement | Petits tableaux |

**Avantage du tri par insertion** : Très efficace pour les petits tableaux ou les tableaux presque triés.

---

## Contraintes
- Ne pas utiliser `Array.sort()`
- Tri en place
- Durée estimée : 30 minutes

