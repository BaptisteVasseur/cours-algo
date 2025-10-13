# Exercice 3 - Tri d'Objets

## Objectif
Adapter les algorithmes de tri pour trier des tableaux d'objets selon différents critères.

## Contexte

En développement web, on trie rarement des nombres simples. On trie plutôt :
- Des utilisateurs par nom, âge, date d'inscription...
- Des produits par prix, note, popularité...
- Des articles par date de publication...

---

## Partie 1 : Tri d'utilisateurs par âge

### Données

```javascript
const users = [
  { name: "Alice", age: 25, city: "Paris" },
  { name: "Bob", age: 30, city: "Lyon" },
  { name: "Charlie", age: 20, city: "Paris" },
  { name: "David", age: 35, city: "Marseille" },
  { name: "Eve", age: 28, city: "Lyon" }
];
```

### Consigne

Adaptez le tri par insertion pour trier par âge croissant :

```javascript
function sortUsersByAge(users) {
  // Votre code ici
  // Indice : comparer user.age au lieu de arr[i]
}

const sorted = sortUsersByAge([...users]);
console.log(sorted);
// [
//   { name: "Charlie", age: 20, ... },
//   { name: "Alice", age: 25, ... },
//   { name: "Eve", age: 28, ... },
//   { name: "Bob", age: 30, ... },
//   { name: "David", age: 35, ... }
// ]
```

---

## Partie 2 : Tri par nom (ordre alphabétique)

### Consigne

Triez les utilisateurs par ordre alphabétique de nom :

```javascript
function sortUsersByName(users) {
  // Votre code ici
  // Indice : utilisez localeCompare() pour comparer des chaînes
}

const sorted = sortUsersByName([...users]);
console.log(sorted);
// Alice, Bob, Charlie, David, Eve
```

### Rappel sur `localeCompare()`

```javascript
"Alice".localeCompare("Bob");    // -1 (Alice < Bob)
"Bob".localeCompare("Alice");    // 1 (Bob > Alice)
"Alice".localeCompare("Alice");  // 0 (égal)
```

---

## Partie 3 : Fonction de tri générique

### Consigne

Créez une fonction de tri qui accepte un critère personnalisé :

```javascript
function sortBy(arr, key, order = 'asc') {
  // arr : tableau à trier
  // key : propriété de l'objet (ex: "age", "name")
  // order : 'asc' (croissant) ou 'desc' (décroissant)
  
  // Votre code ici
}

// Exemples d'utilisation
sortBy(users, 'age', 'asc');   // Âge croissant
sortBy(users, 'age', 'desc');  // Âge décroissant
sortBy(users, 'name', 'asc');  // Nom alphabétique
sortBy(users, 'city', 'asc');  // Ville alphabétique
```

### Tests

```javascript
const users = [
  { name: "Alice", age: 25 },
  { name: "Bob", age: 30 },
  { name: "Charlie", age: 20 }
];

// Test 1 : Tri par âge croissant
const byAge = sortBy([...users], 'age', 'asc');
console.assert(byAge[0].age === 20);
console.assert(byAge[2].age === 30);

// Test 2 : Tri par âge décroissant
const byAgeDesc = sortBy([...users], 'age', 'desc');
console.assert(byAgeDesc[0].age === 30);
console.assert(byAgeDesc[2].age === 20);

// Test 3 : Tri par nom
const byName = sortBy([...users], 'name', 'asc');
console.assert(byName[0].name === "Alice");
console.assert(byName[2].name === "Charlie");
```

---

## Partie 4 : Tri avec fonction de comparaison personnalisée

### Consigne

Créez une fonction de tri qui accepte une fonction de comparaison (comme `Array.sort()`) :

```javascript
function customSort(arr, compareFn) {
  // compareFn(a, b) doit retourner :
  //   - négatif si a < b
  //   - positif si a > b
  //   - 0 si a === b
  
  // Votre code ici (utilisez insertion sort)
}
```

### Exemples d'utilisation

```javascript
const products = [
  { name: "Laptop", price: 1200, rating: 4.5 },
  { name: "Phone", price: 800, rating: 4.8 },
  { name: "Tablet", price: 500, rating: 4.2 },
  { name: "Watch", price: 300, rating: 4.6 }
];

// Tri par prix croissant
customSort(products, (a, b) => a.price - b.price);

// Tri par note décroissante
customSort(products, (a, b) => b.rating - a.rating);

// Tri par nom
customSort(products, (a, b) => a.name.localeCompare(b.name));
```
