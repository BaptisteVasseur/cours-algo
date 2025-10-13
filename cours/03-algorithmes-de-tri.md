# Les Algorithmes de Tri - Organiser les données efficacement

## Table des matières
1. [Introduction aux algorithmes de tri](#introduction-aux-algorithmes-de-tri)
2. [Tri à bulles (Bubble Sort)](#tri-à-bulles-bubble-sort)
3. [Tri par insertion (Insertion Sort)](#tri-par-insertion-insertion-sort)
4. [Tri fusion (Merge Sort)](#tri-fusion-merge-sort)
5. [Tri rapide (Quick Sort)](#tri-rapide-quick-sort)
6. [Comparaison des algorithmes](#comparaison-des-algorithmes)
7. [Applications pratiques](#applications-pratiques)

---

## Introduction aux algorithmes de tri

### Qu'est-ce qu'un algorithme de tri ?

Un **algorithme de tri** est une méthode pour réorganiser une collection d'éléments dans un ordre défini (croissant, décroissant, alphabétique, etc.).

### Pourquoi trier est important ?

Le tri est une opération fondamentale en informatique car :
- **Recherche efficace** : Un tableau trié permet la recherche binaire en O(log n)
- **Détection de doublons** : Facile à repérer dans une liste triée
- **Fusion de données** : Combiner des listes triées est très efficace
- **Présentation** : Afficher des données de manière organisée pour l'utilisateur

### Exemples dans la vie courante

- **Classement sportif** : Équipes triées par points
- **E-commerce** : Produits triés par prix, note, popularité
- **Contacts téléphone** : Triés par ordre alphabétique
- **Résultats de recherche** : Triés par pertinence

### Critères d'évaluation d'un algorithme de tri

| Critère | Description |
|---------|-------------|
| **Complexité temporelle** | Nombre d'opérations en fonction de n |
| **Complexité spatiale** | Mémoire supplémentaire utilisée |
| **Stabilité** | Préserve l'ordre relatif des éléments égaux |
| **En place** | Trie sans utiliser de mémoire supplémentaire |
| **Adaptatif** | Plus rapide si les données sont partiellement triées |

### Stabilité : un concept important

Un tri est **stable** s'il préserve l'ordre relatif des éléments ayant la même valeur.

```
Exemple : Trier par âge
[{nom: "Alice", age: 25}, {nom: "Bob", age: 30}, {nom: "Claire", age: 25}]

Tri stable :   [{nom: "Alice", age: 25}, {nom: "Claire", age: 25}, {nom: "Bob", age: 30}]
               (Alice reste avant Claire car ils ont le même âge)

Tri instable : [{nom: "Claire", age: 25}, {nom: "Alice", age: 25}, {nom: "Bob", age: 30}]
               (L'ordre entre Alice et Claire peut changer)
```

---

## Tri à bulles (Bubble Sort)

### Principe

Le tri à bulles compare des paires d'éléments adjacents et les échange s'ils sont dans le mauvais ordre. On répète jusqu'à ce que le tableau soit trié.

### Analogie

Imaginez des bulles d'air dans l'eau : les plus grosses (grandes valeurs) remontent progressivement vers la surface (fin du tableau).

### Fonctionnement

```
[5, 3, 8, 4, 2]

Passage 1:
  5 > 3 → échange → [3, 5, 8, 4, 2]
  5 < 8 → OK       → [3, 5, 8, 4, 2]
  8 > 4 → échange → [3, 5, 4, 8, 2]
  8 > 2 → échange → [3, 5, 4, 2, 8] ✓ 8 est placé

Passage 2:
  3 < 5 → OK       → [3, 5, 4, 2, 8]
  5 > 4 → échange → [3, 4, 5, 2, 8]
  5 > 2 → échange → [3, 4, 2, 5, 8] ✓ 5 est placé

Passage 3:
  3 < 4 → OK       → [3, 4, 2, 5, 8]
  4 > 2 → échange → [3, 2, 4, 5, 8] ✓ 4 est placé

Passage 4:
  3 > 2 → échange → [2, 3, 4, 5, 8] ✓ Terminé !
```

### Complexité

| Cas | Complexité |
|-----|------------|
| Meilleur (trié) | O(n) avec optimisation |
| Moyen | O(n²) |
| Pire (inversé) | O(n²) |
| Espace | O(1) |

### Caractéristiques

- ✅ Stable
- ✅ En place
- ✅ Simple à comprendre
- ❌ Lent pour les grands tableaux

---

## Tri par insertion (Insertion Sort)

### Principe

Le tri par insertion construit progressivement un tableau trié en insérant chaque élément à sa place correcte.

### Analogie

Comme trier des cartes dans votre main : vous prenez une carte et vous la placez à sa position correcte parmi les cartes déjà triées.

### Fonctionnement

```
[5, 3, 8, 4, 2]

[5] | 3, 8, 4, 2       (5 est "trié")

Insérer 3:
  3 < 5 → décaler 5
  [3, 5] | 8, 4, 2

Insérer 8:
  8 > 5 → déjà à sa place
  [3, 5, 8] | 4, 2

Insérer 4:
  4 < 8 → décaler 8
  4 < 5 → décaler 5
  4 > 3 → insérer ici
  [3, 4, 5, 8] | 2

Insérer 2:
  2 < 8 → décaler 8
  2 < 5 → décaler 5
  2 < 4 → décaler 4
  2 < 3 → décaler 3
  [2, 3, 4, 5, 8] ✓
```

### Complexité

| Cas | Complexité |
|-----|------------|
| Meilleur (trié) | O(n) |
| Moyen | O(n²) |
| Pire (inversé) | O(n²) |
| Espace | O(1) |

### Caractéristiques

- ✅ Stable
- ✅ En place
- ✅ Efficace pour les petits tableaux
- ✅ Très efficace pour les tableaux presque triés
- ❌ Lent pour les grands tableaux désordonnés

### Quand l'utiliser ?

Le tri par insertion est **le choix idéal** pour :
- Les petits tableaux (< 20 éléments)
- Les tableaux presque triés
- L'insertion d'éléments dans une liste déjà triée

---

## Tri fusion (Merge Sort)

### Principe : Diviser pour régner

Le tri fusion utilise la stratégie "diviser pour régner" :
1. **Diviser** : Couper le tableau en deux moitiés
2. **Régner** : Trier récursivement chaque moitié
3. **Combiner** : Fusionner les deux moitiés triées

### Analogie

Comme trier deux paquets de cartes déjà triés : on prend toujours la plus petite carte des deux paquets.

### Fonctionnement visuel

```
            [38, 27, 43, 3, 9, 82, 10]
                       ↓
            ┌─────────────────────────┐
            ↓                         ↓
      [38, 27, 43, 3]          [9, 82, 10]
            ↓                         ↓
      ┌───────────┐             ┌─────────┐
      ↓           ↓             ↓         ↓
  [38, 27]    [43, 3]       [9, 82]     [10]
      ↓           ↓             ↓
  ┌─────┐     ┌─────┐       ┌─────┐
  ↓     ↓     ↓     ↓       ↓     ↓
[38]  [27]  [43]  [3]     [9]   [82]

           FUSION (remontée)

  [27, 38]  [3, 43]       [9, 82]    [10]
      ↓           ↓             ↓
      └─────┬─────┘       └─────┬────┘
            ↓                   ↓
    [3, 27, 38, 43]        [9, 10, 82]
            ↓                   ↓
            └───────────┬───────┘
                        ↓
           [3, 9, 10, 27, 38, 43, 82]
```

### Complexité

| Cas | Complexité |
|-----|------------|
| Meilleur | O(n log n) |
| Moyen | O(n log n) |
| Pire | O(n log n) |
| Espace | O(n) |

### Pourquoi O(n log n) ?

```
Tableau de 8 éléments :

Niveau 0: [8]                → 8 fusions
Niveau 1: [4] + [4]          → 8 fusions
Niveau 2: [2] + [2] + [2] + [2] → 8 fusions
Niveau 3: 8 × [1]            → 0 fusion

Niveaux = log₂(8) = 3
Fusions par niveau = n = 8
Total = n × log(n) = 24 opérations
```

### Caractéristiques

- ✅ Stable
- ✅ Complexité garantie O(n log n)
- ✅ Prévisible (même performance dans tous les cas)
- ❌ Utilise O(n) de mémoire supplémentaire
- ❌ Constantes plus élevées que Quick Sort

---

## Tri rapide (Quick Sort)

### Principe : Diviser pour régner avec pivot

Le tri rapide utilise aussi "diviser pour régner" mais différemment :
1. **Choisir un pivot** (un élément du tableau)
2. **Partitionner** : placer les éléments < pivot à gauche, > pivot à droite
3. **Récursion** : trier récursivement les deux partitions

### Différence avec Merge Sort

| Merge Sort | Quick Sort |
|------------|------------|
| Division en 2 moitiés égales | Division selon un pivot |
| Complexité dans la fusion | Complexité dans le partitionnement |
| Toujours O(n log n) | O(n²) dans le pire cas |

### Fonctionnement visuel

```
[5, 3, 7, 6, 2, 9]   pivot = 9
[5, 3, 7, 6, 2] < 9, [] > 9
→ [5, 3, 7, 6, 2, 9]

[5, 3, 7, 6, 2]      pivot = 2
[] < 2, [5, 3, 7, 6] > 2
→ [2, 5, 3, 7, 6, 9]

[5, 3, 7, 6]         pivot = 6
[5, 3] < 6, [7] > 6
→ [2, 5, 3, 6, 7, 9]

[5, 3]               pivot = 3
[] < 3, [5] > 3
→ [2, 3, 5, 6, 7, 9] ✓
```

### Le pire cas : pourquoi O(n²) ?

Avec un tableau déjà trié `[1, 2, 3, 4, 5]` et pivot = dernier élément :

```
Niveau 1: [1, 2, 3, 4] pivot=5  → n opérations
Niveau 2: [1, 2, 3] pivot=4    → n-1 opérations
Niveau 3: [1, 2] pivot=3       → n-2 opérations
Niveau 4: [1] pivot=2          → n-3 opérations

Total: n + (n-1) + (n-2) + ... + 1 = n(n+1)/2 = O(n²)
```

### Solutions pour éviter le pire cas

**1. Pivot aléatoire**
```javascript
const randomIndex = Math.floor(Math.random() * (high - low + 1)) + low;
[arr[randomIndex], arr[high]] = [arr[high], arr[randomIndex]];
```

**2. Médiane de trois**
```javascript
const mid = Math.floor((low + high) / 2);
const median = [arr[low], arr[mid], arr[high]].sort()[1];
```

### Complexité

| Cas | Complexité |
|-----|------------|
| Meilleur | O(n log n) |
| Moyen | O(n log n) |
| Pire | O(n²) |
| Espace | O(log n) - stack de récursion |

### Caractéristiques

- ❌ Non stable (par défaut)
- ✅ En place (version optimisée)
- ✅ Très rapide en pratique
- ✅ Cache-friendly
- ❌ Pire cas O(n²)

---

## Comparaison des algorithmes

### Tableau récapitulatif

| Algorithme | Meilleur | Moyen | Pire | Espace | Stable |
|------------|---------|-------|------|--------|--------|
| **Tri à bulles** | O(n) | O(n²) | O(n²) | O(1) | ✅ Oui |
| **Tri insertion** | O(n) | O(n²) | O(n²) | O(1) | ✅ Oui |
| **Tri fusion** | O(n log n) | O(n log n) | O(n log n) | O(n) | ✅ Oui |
| **Tri rapide** | O(n log n) | O(n log n) | O(n²) | O(log n) | ❌ Non |

### Performance en pratique (ordre croissant de rapidité)

1. **Tri à bulles** - Le plus lent, à éviter en production
2. **Tri par insertion** - Bon pour petits tableaux ou presque triés
3. **Tri fusion** - Fiable et prévisible
4. **Tri rapide** - Le plus rapide en moyenne

### Quand utiliser quel algorithme ?

| Situation | Algorithme recommandé |
|-----------|----------------------|
| Petits tableaux (< 20) | Tri par insertion |
| Tableaux presque triés | Tri par insertion |
| Stabilité requise | Tri fusion |
| Performance garantie | Tri fusion |
| Performance moyenne optimale | Tri rapide |
| Mémoire limitée | Tri rapide (en place) |
| Données en streaming | Tri par insertion |

---

## Conclusion

Les algorithmes de tri sont fondamentaux en informatique. Retenez :

1. **O(n²)** (Bubble, Insertion) : Simples mais lents pour les grands tableaux
2. **O(n log n)** (Merge, Quick) : Efficaces pour les grands tableaux
3. **Contexte** : Le "meilleur" algorithme dépend de votre situation
4. **En pratique** : Utilisez les fonctions natives (`.sort()`) optimisées

Le choix d'un algorithme de tri dépend de vos contraintes : taille des données, mémoire disponible, besoin de stabilité, et caractéristiques des données à trier.
