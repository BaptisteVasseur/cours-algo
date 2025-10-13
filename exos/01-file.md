# Implémenter une File

### Exercice 1 :

Créer une classe `Queue` qui implémente le comportement d'une file (FIFO - First In, First Out).
Implémentez une classe `Queue` avec les méthodes suivantes :

### Méthodes à implémenter

1. **`constructor()`** : Initialise une file vide

2. **`enqueue(element)`** : Ajoute un élément à la fin de la file
   - Paramètre : `element` (n'importe quel type)
   - Retour : rien

3. **`dequeue()`** : Retire et retourne l'élément au début de la file
   - Retour : l'élément retiré, ou `undefined` si la file est vide

4. **`front()`** : Retourne l'élément au début sans le retirer
   - Retour : le premier élément, ou `undefined` si la file est vide

5. **`isEmpty()`** : Vérifie si la file est vide
   - Retour : `true` si vide, `false` sinon

6. **`size()`** : Retourne le nombre d'éléments dans la file
   - Retour : nombre d'éléments

7. **`clear()`** : Vide complètement la file

## Exemple d'utilisation

```javascript
const queue = new Queue();

queue.enqueue("Alice");
queue.enqueue("Bob");
queue.enqueue("Charlie");

console.log(queue.front()); // "Alice"
console.log(queue.size());  // 3

console.log(queue.dequeue()); // "Alice"
console.log(queue.dequeue()); // "Bob"
console.log(queue.size());    // 1

console.log(queue.isEmpty()); // false
queue.clear();
console.log(queue.isEmpty()); // true
```

## Tests à valider

```javascript
const queue = new Queue();

// Test 1: File vide
console.assert(queue.isEmpty() === true, "Une file neuve devrait être vide");

// Test 2: Enqueue
queue.enqueue("Premier");
queue.enqueue("Deuxième");
queue.enqueue("Troisième");
console.assert(queue.size() === 3, "La taille devrait être 3");
console.assert(queue.front() === "Premier", "Le premier devrait être 'Premier'");

// Test 3: Dequeue
const first = queue.dequeue();
console.assert(first === "Premier", "Devrait retirer 'Premier'");
console.assert(queue.front() === "Deuxième", "Le nouveau premier devrait être 'Deuxième'");

// Test 4: Clear
queue.clear();
console.assert(queue.isEmpty() === true, "La file devrait être vide après clear");
```

## Cas d'usage réel

Imaginez une file d'attente pour l'envoi de mails :

```javascript
const mailQueue = new Queue();

mailQueue.enqueue({ to: "user@example.com", subject: "Bienvenue" });
mailQueue.enqueue({ to: "admin@example.com", subject: "Alerte" });

function processMailQueue() {
  while (!mailQueue.isEmpty()) {
    const mail = mailQueue.dequeue();
    console.log(`Envoi du mail à ${mail.to}: ${mail.subject}`);
  }
}
```

## Contraintes
- Utilisez un tableau JavaScript pour stocker les éléments
- Durée estimée : 30 minutes

### Exercice 2 : `toArray()`

Retourne tous les éléments de la file sous forme de tableau (du début à la fin).

```javascript
const queue = new Queue();
queue.enqueue(1);
queue.enqueue(2);
queue.enqueue(3);

console.log(queue.toArray()); // [1, 2, 3]
```

### Exercice 3 : `rear()`

Retourne le dernier élément de la file (à l'arrière) sans le retirer.

```javascript
queue.enqueue('A');
queue.enqueue('B');
queue.enqueue('C');

console.log(queue.front()); // 'A'
console.log(queue.rear());  // 'C'
```

### Exercice 4 : `contains(element)`

Vérifie si un élément existe dans la file.

```javascript
queue.enqueue('task1');
queue.enqueue('task2');

console.log(queue.contains('task1')); // true
console.log(queue.contains('task3')); // false
```

### Exercice 5 : `clone()`

Crée une copie indépendante de la file.

```javascript
const original = new Queue();
original.enqueue(1);
original.enqueue(2);

const copy = original.clone();
copy.enqueue(3);

console.log(original.size()); // 2
console.log(copy.size()); // 3
```

### Exercice 6 : File avec priorité

Créer une `PriorityQueue` où les éléments avec priorité plus élevée sont traités en premier.

```javascript
class PriorityQueue extends Queue {
  enqueue(element, priority = 0) {
    // ... Votre code ici pour insérer en fonction de la priorité
  }
  
  dequeue() {
    return this.items.shift()?.element;
  }
}

// Utilisation
const pq = new PriorityQueue();
pq.enqueue('Tâche normale', 1);
pq.enqueue('Tâche urgente', 5);
pq.enqueue('Tâche peu importante', 0);

console.log(pq.dequeue()); // 'Tâche urgente' (priorité 5)
console.log(pq.dequeue()); // 'Tâche normale' (priorité 1)
console.log(pq.dequeue()); // 'Tâche peu importante' (priorité 0)
```
