# Exercice 2 - Comparer les Algorithmes de Tri

## Objectif
Comparer empiriquement les performances des différents algorithmes de tri vus en cours.

## Partie 1 : Tableau récapitulatif théorique

Complétez ce tableau avec ce que vous avez appris :

| Algorithme | Meilleur cas | Cas moyen | Pire cas | Espace | Stable |
|------------|-------------|-----------|----------|--------|--------|
| **Tri à bulles** | ? | ? | ? | ? | ? |
| **Tri insertion** | ? | ? | ? | ? | ? |
| **Tri fusion** | ? | ? | ? | ? | ? |
| **Tri rapide** | ? | ? | ? | ? | ? |

<details>
<summary>Correction</summary>

| Algorithme | Meilleur cas | Cas moyen | Pire cas | Espace | Stable |
|------------|-------------|-----------|----------|--------|--------|
| **Tri à bulles** | O(n) | O(n²) | O(n²) | O(1) | Oui |
| **Tri insertion** | O(n) | O(n²) | O(n²) | O(1) | Oui |
| **Tri fusion** | O(n log n) | O(n log n) | O(n log n) | O(n) | Oui |
| **Tri rapide** | O(n log n) | O(n log n) | O(n²) | O(log n) | Non |

</details>

---

## Partie 2 : Benchmark pratique

Créez une fonction pour mesurer le temps d'exécution :

```javascript
function benchmark(sortFunction, arr, label) {
    const arrCopy = [...arr]; // Copie pour ne pas modifier l'original

    const start = performance.now();
    sortFunction(arrCopy);
    const end = performance.now();

    const time = (end - start).toFixed(3);
    console.log(`${label}: ${time}ms`);

    return time;
}
```

---

## Partie 3 : Générer des tableaux de test

### Tableau aléatoire

```javascript
function generateRandom(size) {
    return Array.from({ length: size }, () =>
        Math.floor(Math.random() * size)
    );
}
```

### Tableau déjà trié

```javascript
function generateSorted(size) {
    return Array.from({ length: size }, (_, i) => i);
}
```

### Tableau inversé

```javascript
function generateReversed(size) {
    return Array.from({ length: size }, (_, i) => size - i);
}
```

### Tableau presque trié

```javascript
function generateNearlySorted(size) {
    const arr = Array.from({ length: size }, (_, i) => i);
    // Échanger 5% des éléments
    const swaps = Math.floor(size * 0.05);
    for (let i = 0; i < swaps; i++) {
        const idx1 = Math.floor(Math.random() * size);
        const idx2 = Math.floor(Math.random() * size);
        [arr[idx1], arr[idx2]] = [arr[idx2], arr[idx1]];
    }
    return arr;
}
```

---

## Partie 4 : Comparer tous les tris

```javascript
function compareAllSorts(size) {
    console.log(`\n=== Comparaison avec ${size} éléments ===\n`);

    // Générer un tableau aléatoire
    const randomArray = generateRandom(size);

    console.log("Tableau aléatoire:");
    benchmark(bubbleSort, randomArray, "  Tri à bulles");
    benchmark(insertionSort, randomArray, "  Tri insertion");
    benchmark(mergeSort, randomArray, "  Tri fusion");
    benchmark(quickSort, randomArray, "  Tri rapide");

    // Tableau déjà trié
    const sortedArray = generateSorted(size);

    console.log("\nTableau déjà trié:");
    benchmark(bubbleSort, sortedArray, "  Tri à bulles");
    benchmark(insertionSort, sortedArray, "  Tri insertion");
    benchmark(mergeSort, sortedArray, "  Tri fusion");
    benchmark(quickSort, sortedArray, "  Tri rapide");

    // Tableau inversé
    const reversedArray = generateReversed(size);

    console.log("\nTableau inversé:");
    benchmark(bubbleSort, reversedArray, "  Tri à bulles");
    benchmark(insertionSort, reversedArray, "  Tri insertion");
    benchmark(mergeSort, reversedArray, "  Tri fusion");
    benchmark(quickSort, reversedArray, "  Tri rapide");
}

// Lancer les tests
compareAllSorts(100);
compareAllSorts(1000);
compareAllSorts(5000);
```

---

## Partie 5 : Résultats attendus

### Pour 100 éléments (tableau aléatoire)

Ordre approximatif :
1. Tri fusion : ~0.5ms
2. Tri rapide : ~0.6ms
3. Tri insertion : ~1ms
4. Tri à bulles : ~2ms

### Pour 1000 éléments (tableau aléatoire)

Ordre approximatif :
1. Tri rapide : ~2ms
2. Tri fusion : ~3ms
3. Tri insertion : ~8ms
4. Tri à bulles : ~15ms

### Pour 5000 éléments (tableau aléatoire)

Ordre approximatif :
1. Tri rapide : ~10ms
2. Tri fusion : ~15ms
3. Tri insertion : ~200ms
4. Tri à bulles : ~600ms

**Observation** : La différence entre O(n log n) et O(n²) devient énorme !

---

## Partie 6 : Analyse des résultats

### Questions

1. **Quel algorithme est le plus rapide pour un tableau aléatoire ?**
   <details>
   <summary>Réponse</summary>
   Le tri rapide, car il a de bonnes constantes et est O(n log n) en moyenne.
   </details>

2. **Quel algorithme est le plus rapide pour un tableau déjà trié ?**
   <details>
   <summary>Réponse</summary>
   Le tri insertion (avec optimisation), car il est O(n) sur un tableau trié.
   </details>

3. **Quel algorithme est le plus rapide pour un tableau inversé ?**
   <details>
   <summary>Réponse</summary>
   Le tri fusion, car il a une complexité garantie O(n log n).
   Le tri rapide peut être O(n²) si le pivot est mal choisi.
   </details>

4. **Pourquoi le tri rapide peut être plus lent que le tri fusion sur un tableau trié ?**
   <details>
   <summary>Réponse</summary>
   Avec un mauvais choix de pivot (dernier élément), le tri rapide devient O(n²).
   Solution : utiliser un pivot aléatoire ou médiane de trois.
   </details>

---

## Partie 7 : Visualisation graphique

Créez un tableau de résultats :

```javascript
function benchmarkSuite() {
    const sizes = [10, 50, 100, 500, 1000, 2000, 5000];
    const algorithms = [
        { name: "Bubble", func: bubbleSort },
        { name: "Insertion", func: insertionSort },
        { name: "Merge", func: mergeSort },
        { name: "Quick", func: quickSort }
    ];

    console.log("Size\t" + algorithms.map(a => a.name).join("\t"));

    for (const size of sizes) {
        const arr = generateRandom(size);
        const times = [];

        for (const algo of algorithms) {
            const copy = [...arr];
            const start = performance.now();
            algo.func(copy);
            const end = performance.now();
            times.push((end - start).toFixed(2));
        }

        console.log(`${size}\t${times.join("\t")}`);
    }
}

benchmarkSuite();
```

**Résultat exemple** :
```
Size    Bubble  Insertion  Merge   Quick
10      0.02    0.01       0.03    0.02
50      0.20    0.15       0.10    0.08
100     0.80    0.50       0.20    0.15
500     18.5    10.2       1.2     0.8
1000    72.3    38.5       2.5     1.6
2000    285     148        5.2     3.5
5000    1750    920        14.5    9.2
```

---

## Partie 8 : Comparaison avec le tri natif

JavaScript utilise Timsort (hybride merge + insertion) :

```javascript
function compareWithNative(size) {
    const arr = generateRandom(size);

    console.log(`\n=== ${size} éléments ===`);

    benchmark(bubbleSort, arr, "Bubble Sort");
    benchmark(insertionSort, arr, "Insertion Sort");
    benchmark(mergeSort, arr, "Merge Sort");
    benchmark(quickSort, arr, "Quick Sort");
    benchmark((a) => [...a].sort((x, y) => x - y), arr, "Native Sort");
}

compareWithNative(1000);
compareWithNative(10000);
```

**Observation** : Le tri natif est optimisé et souvent plus rapide !

---

## Partie 9 : Test de stabilité

Vérifiez si les tris sont stables :

```javascript
function testStability(sortFunction, name) {
    const arr = [
        { value: 3, id: 'a' },
        { value: 1, id: 'b' },
        { value: 3, id: 'c' },
        { value: 2, id: 'd' },
        { value: 3, id: 'e' }
    ];

    sortFunction(arr, (a, b) => a.value - b.value);

    console.log(`${name}:`);
    arr.forEach(item => console.log(`  ${item.value} (${item.id})`));

    // Vérifier l'ordre des éléments avec value=3
    const threes = arr.filter(x => x.value === 3);
    const stable = threes[0].id === 'a' &&
        threes[1].id === 'c' &&
        threes[2].id === 'e';

    console.log(`  Stable: ${stable ? 'Oui' : 'Non'}\n`);
}

testStability(insertionSort, "Tri insertion");
testStability(mergeSort, "Tri fusion");
testStability(quickSort, "Tri rapide");
```

---

## Partie 10 : Recommandations pratiques

### Quand utiliser chaque algorithme ?

| Algorithme | À utiliser quand... |
|------------|---------------------|
| **Tri à bulles** | Jamais en production (uniquement pédagogique) |
| **Tri insertion** | Petits tableaux (<10 éléments) ou presque triés |
| **Tri fusion** | Stabilité requise, taille grande, garantie O(n log n) |
| **Tri rapide** | Meilleure performance moyenne, grandes données |
| **Native sort** | Par défaut en JavaScript (Timsort) |

### Stratégie hybride (utilisée en pratique)

```javascript
function hybridSort(arr) {
    // Petits tableaux : insertion sort
    if (arr.length < 10) {
        return insertionSort(arr);
    }

    // Grands tableaux : quick sort
    return quickSort(arr);
}
```

---

## Exercice final : Trouver le meilleur tri

Créez une fonction qui choisit automatiquement le meilleur algorithme :

```javascript
function smartSort(arr) {
    const size = arr.length;

    // Très petit
    if (size < 10) {
        return insertionSort(arr);
    }

    // Vérifier si presque trié (échantillon)
    let inversions = 0;
    for (let i = 0; i < Math.min(size, 100); i++) {
        if (arr[i] > arr[i + 1]) inversions++;
    }

    if (inversions / size < 0.1) {
        return insertionSort(arr); // Presque trié
    }

    // Sinon, tri rapide
    return quickSort(arr);
}
```

---

## Questions de synthèse

1. Pourquoi Quick Sort est-il généralement plus rapide que Merge Sort ?
2. Dans quel cas Insertion Sort bat-il Quick Sort ?
3. Pourquoi JavaScript utilise-t-il Timsort au lieu de Quick Sort ?
4. Qu'est-ce qu'un tri stable et pourquoi est-ce important ?

## Contraintes
- Testez avec plusieurs tailles de tableaux
- Comparez différents types de données (aléatoire, trié, inversé)
- Durée estimée : 30 minutes
