# Implémenter une Pile

### Exercice 1 :

Créer une classe `Stack` qui implémente le comportement d'une pile (LIFO - Last In, First Out).
Implémentez une classe `Stack` avec les méthodes suivantes :

### Méthodes à implémenter

1. **`constructor()`** : Initialise une pile vide

2. **`push(element)`** : Ajoute un élément au sommet de la pile
   - Paramètre : `element` (n'importe quel type)
   - Retour : rien

3. **`pop()`** : Retire et retourne l'élément au sommet de la pile
   - Retour : l'élément retiré, ou `undefined` si la pile est vide

4. **`peek()`** : Retourne l'élément au sommet sans le retirer
   - Retour : l'élément au sommet, ou `undefined` si la pile est vide

5. **`isEmpty()`** : Vérifie si la pile est vide
   - Retour : `true` si vide, `false` sinon

6. **`size()`** : Retourne le nombre d'éléments dans la pile
   - Retour : nombre d'éléments

7. **`clear()`** : Vide complètement la pile

## Exemple d'utilisation

```javascript
const stack = new Stack();

stack.push(1);
stack.push(2);
stack.push(3);

console.log(stack.peek()); // 3
console.log(stack.size()); // 3

console.log(stack.pop());  // 3
console.log(stack.pop());  // 2
console.log(stack.size()); // 1

console.log(stack.isEmpty()); // false
stack.clear();
console.log(stack.isEmpty()); // true
```

## Tests à valider

Votre implémentation doit passer ces tests :

```javascript
const stack = new Stack();

// Test 1: Pile vide
console.assert(stack.isEmpty() === true, "Une pile neuve devrait être vide");
console.assert(stack.size() === 0, "La taille devrait être 0");

// Test 2: Push
stack.push(10);
stack.push(20);
console.assert(stack.size() === 2, "La taille devrait être 2");
console.assert(stack.peek() === 20, "Le sommet devrait être 20");

// Test 3: Pop
const removed = stack.pop();
console.assert(removed === 20, "L'élément retiré devrait être 20");
console.assert(stack.size() === 1, "La taille devrait être 1");

// Test 4: Clear
stack.clear();
console.assert(stack.isEmpty() === true, "La pile devrait être vide après clear");
```

## Contraintes
- Utilisez un tableau JavaScript pour stocker les éléments
- Ne pas utiliser les méthodes natives JavaScript qui feraient tout le travail
- Durée estimée : 30 minutes

---

### Exercice 2 : `toArray()`

Retourne tous les éléments de la pile sous forme de tableau (du sommet vers le bas).

```javascript
const stack = new Stack();
stack.push(1);
stack.push(2);
stack.push(3);

console.log(stack.toArray()); // [3, 2, 1]
```

### Exercice 3 : `contains(element)`

Vérifie si un élément existe dans la pile.

```javascript
stack.push('A');
stack.push('B');
stack.push('C');

console.log(stack.contains('B')); // true
console.log(stack.contains('D')); // false
```

### Exercice 4 : `reverse()`

Inverse l'ordre des éléments dans la pile.

```javascript
stack.push(1);
stack.push(2);
stack.push(3);

stack.reverse();
console.log(stack.pop()); // 1 (au lieu de 3)
```

### Exercice 5 : `clone()`

Crée une copie indépendante de la pile.

```javascript
const original = new Stack();
original.push(1);
original.push(2);

const copy = original.clone();
copy.push(3);

console.log(original.size()); // 2
console.log(copy.size()); // 3
```

### Exercice 6 : `getMin()` et `getMax()`

Retourne le minimum et le maximum de la pile (pour des nombres).

```javascript
stack.push(5);
stack.push(2);
stack.push(8);
stack.push(1);

console.log(stack.getMin()); // 1
console.log(stack.getMax()); // 8
```

### Exercice 7 : Itérateur (for...of)

Rendre la pile itérable avec `Symbol.iterator`.

```javascript
stack.push('A');
stack.push('B');
stack.push('C');

for (const item of stack) {
  console.log(item); // C, B, A (du sommet au bas)
}
```
