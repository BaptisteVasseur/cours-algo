# Exercice 0 - Fondamentaux de l'Algorithmie

## Objectif

Avant de plonger dans les structures de données complexes, vous allez vous échauffer en recréant des **fonctions natives JavaScript** from scratch. Cela vous permettra de :
- Maîtriser les bases de l'algorithmie (boucles, conditions, variables)
- Comprendre comment fonctionnent les méthodes que vous utilisez quotidiennement
- Développer votre logique de programmation

## Règles importantes

**INTERDICTIONS** :
- ❌ Pas de méthodes natives (sauf indication contraire)
- ❌ Pas de `Array.prototype.push`, `.map()`, `.filter()`, etc.
- ❌ Pas de librairies externes

**AUTORISÉ** :
- Boucles (`for`, `while`, `do...while`)
- Conditions (`if`, `else`, `switch`)
- Opérateurs (`+`, `-`, `*`, `/`, `%`, `===`, `!==`, etc.)
- Accès aux éléments : `arr[i]`, `arr.length`

---

## Niveau 1 : Fonctions de base (Facile)

### Exercice 1 - myPush()

Recréer `Array.prototype.push()` qui ajoute un élément à la fin d'un tableau.

```javascript
function myPush(arr, element) {
  // Votre code ici
  // Ne pas utiliser arr.push() !
}

// Tests
const arr1 = [1, 2, 3];
myPush(arr1, 4);
console.log(arr1); // [1, 2, 3, 4]

const arr2 = [];
myPush(arr2, 'hello');
console.log(arr2); // ['hello']
```

<details>
<summary>💡 Indice</summary>
Utilisez `arr.length` pour trouver le prochain index disponible.
</details>

---

### Exercice 2 - myPop()

Recréer `Array.prototype.pop()` qui retire et retourne le dernier élément.

```javascript
function myPop(arr) {
  // Votre code ici
  // Retourner l'élément retiré
}

// Tests
const arr1 = [1, 2, 3, 4];
const removed = myPop(arr1);
console.log(removed); // 4
console.log(arr1); // [1, 2, 3]

const arr2 = [];
console.log(myPop(arr2)); // undefined
```

<details>
<summary>💡 Indice</summary>
Sauvegardez l'élément à retourner, puis réduisez la taille du tableau avec `arr.length--`.
</details>

---

### Exercice 3 - myIndexOf()

Recréer `Array.prototype.indexOf()` qui retourne l'index de la première occurrence d'un élément.

```javascript
function myIndexOf(arr, element) {
  // Votre code ici
  // Retourner -1 si non trouvé
}

// Tests
console.log(myIndexOf([1, 2, 3, 2], 2)); // 1
console.log(myIndexOf([1, 2, 3], 5)); // -1
console.log(myIndexOf(['a', 'b', 'c'], 'b')); // 1
```

---

### Exercice 4 - myIncludes()

Recréer `Array.prototype.includes()` qui vérifie si un élément existe.

```javascript
function myIncludes(arr, element) {
  // Votre code ici
  // Retourner true ou false
}

// Tests
console.log(myIncludes([1, 2, 3], 2)); // true
console.log(myIncludes([1, 2, 3], 5)); // false
console.log(myIncludes([], 1)); // false
```

<details>
<summary>💡 Indice</summary>
Vous pouvez réutiliser votre fonction `myIndexOf()`.
</details>

---

### Exercice 5 - myReverse()

Recréer `Array.prototype.reverse()` qui inverse l'ordre des éléments.

```javascript
function myReverse(arr) {
  // Votre code ici
  // Modifier le tableau en place
}

// Tests
const arr1 = [1, 2, 3, 4, 5];
myReverse(arr1);
console.log(arr1); // [5, 4, 3, 2, 1]

const arr2 = ['a', 'b', 'c'];
myReverse(arr2);
console.log(arr2); // ['c', 'b', 'a']
```

<details>
<summary>💡 Indice</summary>
Échangez les éléments du début et de la fin, puis progressez vers le centre.
</details>

---

### Exercice 6 - myJoin()

Recréer `Array.prototype.join()` qui concatène les éléments en une chaîne.

```javascript
function myJoin(arr, separator = ',') {
  // Votre code ici
  // Retourner une chaîne de caractères
}

// Tests
console.log(myJoin([1, 2, 3], '-')); // "1-2-3"
console.log(myJoin(['a', 'b', 'c'], ' ')); // "a b c"
console.log(myJoin([1, 2, 3])); // "1,2,3"
console.log(myJoin([], '-')); // ""
```

---

## Niveau 2 : Fonctions de transformation (Moyen)

### 2.1 - myFilter()

Recréer `Array.prototype.filter()` qui filtre les éléments selon une condition.

```javascript
function myFilter(arr, callback) {
  // Votre code ici
  // callback(element, index, array) doit retourner true/false
}

// Tests
const numbers = [1, 2, 3, 4, 5, 6];
const evens = myFilter(numbers, (n) => n % 2 === 0);
console.log(evens); // [2, 4, 6]

const words = ['hello', 'world', 'hi', 'javascript'];
const long = myFilter(words, (w) => w.length > 4);
console.log(long); // ['hello', 'world', 'javascript']
```

---

### 2.2 - myMap()

Recréer `Array.prototype.map()` qui transforme chaque élément.

```javascript
function myMap(arr, callback) {
  // Votre code ici
  // callback(element, index, array) retourne la nouvelle valeur
}

// Tests
const numbers = [1, 2, 3, 4];
const doubled = myMap(numbers, (n) => n * 2);
console.log(doubled); // [2, 4, 6, 8]

const words = ['hello', 'world'];
const upper = myMap(words, (w) => w.toUpperCase());
console.log(upper); // ['HELLO', 'WORLD']
```

---

### 2.3 - myFind()

Recréer `Array.prototype.find()` qui retourne le premier élément satisfaisant la condition.

```javascript
function myFind(arr, callback) {
  // Votre code ici
  // Retourner undefined si rien n'est trouvé
}

// Tests
const numbers = [1, 2, 3, 4, 5];
const found = myFind(numbers, (n) => n > 3);
console.log(found); // 4

const users = [
  { name: 'Alice', age: 25 },
  { name: 'Bob', age: 30 }
];
const user = myFind(users, (u) => u.name === 'Bob');
console.log(user); // { name: 'Bob', age: 30 }
```

---

### 2.4 - myEvery()

Recréer `Array.prototype.every()` qui vérifie si tous les éléments respectent une condition.

```javascript
function myEvery(arr, callback) {
  // Votre code ici
  // Retourner true ou false
}

// Tests
console.log(myEvery([2, 4, 6], (n) => n % 2 === 0)); // true
console.log(myEvery([2, 3, 6], (n) => n % 2 === 0)); // false
console.log(myEvery([], (n) => n > 10)); // true (tableau vide)
```

---

### 2.5 - mySome()

Recréer `Array.prototype.some()` qui vérifie si au moins un élément respecte une condition.

```javascript
function mySome(arr, callback) {
  // Votre code ici
  // Retourner true ou false
}

// Tests
console.log(mySome([1, 3, 5], (n) => n % 2 === 0)); // false
console.log(mySome([1, 3, 4], (n) => n % 2 === 0)); // true
console.log(mySome([], (n) => n > 10)); // false (tableau vide)
```

---

### 2.6 - myConcat()

Recréer `Array.prototype.concat()` qui fusionne plusieurs tableaux.

```javascript
function myConcat(arr, ...arrays) {
  // Votre code ici
  // Retourner un nouveau tableau
}

// Tests
const arr1 = [1, 2];
const arr2 = [3, 4];
const arr3 = [5, 6];
console.log(myConcat(arr1, arr2, arr3)); // [1, 2, 3, 4, 5, 6]
console.log(myConcat([1], 2, [3, 4])); // [1, 2, 3, 4]
```

---

## Niveau 3 : Fonctions sur les chaînes (Bonus)

### 3.1 - myCharAt()

Recréer `String.prototype.charAt()`.

```javascript
function myCharAt(str, index) {
  // Votre code ici
}

// Tests
console.log(myCharAt('hello', 1)); // 'e'
console.log(myCharAt('hello', 10)); // ''
```

---

### 3.2 - mySubstring()

Recréer `String.prototype.substring()`.

```javascript
function mySubstring(str, start, end = str.length) {
  // Votre code ici
}

// Tests
console.log(mySubstring('hello world', 0, 5)); // 'hello'
console.log(mySubstring('hello world', 6)); // 'world'
```

---

### 3.3 - mySplit()

Recréer `String.prototype.split()`.

```javascript
function mySplit(str, separator) {
  // Votre code ici
  // Retourner un tableau
}

// Tests
console.log(mySplit('hello world', ' ')); // ['hello', 'world']
console.log(mySplit('a,b,c', ',')); // ['a', 'b', 'c']
console.log(mySplit('hello', '')); // ['h', 'e', 'l', 'l', 'o']
```

---

### 3.4 - myRepeat()

Recréer `String.prototype.repeat()`.

```javascript
function myRepeat(str, count) {
  // Votre code ici
}

// Tests
console.log(myRepeat('abc', 3)); // 'abcabcabc'
console.log(myRepeat('x', 5)); // 'xxxxx'
console.log(myRepeat('hello', 0)); // ''
```

---

### 3.5 - myTrim()

Recréer `String.prototype.trim()` qui retire les espaces au début et à la fin.

```javascript
function myTrim(str) {
  // Votre code ici
}

// Tests
console.log(myTrim('  hello  ')); // 'hello'
console.log(myTrim('  world')); // 'world'
console.log(myTrim('test  ')); // 'test'
```

---

## Analyse de complexité

Pour chaque fonction que vous implémentez, essayez de déterminer sa complexité :
- **Temporelle** : O(1), O(n), O(n²), O(n log n) ?
- **Spatiale** : Combien de mémoire supplémentaire utilisez-vous ?

### Exemple

```javascript
// myIndexOf : O(n) temporelle, O(1) spatiale
// On parcourt le tableau au pire n fois, sans créer de nouvelles structures

// myMap : O(n) temporelle, O(n) spatiale
// On parcourt le tableau une fois, et on crée un nouveau tableau de taille n
```
