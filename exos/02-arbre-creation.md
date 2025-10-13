# Exercice 2 - Créer un Arbre Binaire

## Objectif
Implémenter une structure d'arbre binaire de recherche avec les opérations de base.

## Partie 1 : Classe TreeNode

Créez une classe `TreeNode` représentant un nœud :

```javascript
class TreeNode {
  constructor(value) {
    this.value = value;
    this.left = null;
    this.right = null;
  }
}
```

### Exemple d'utilisation

```javascript
const root = new TreeNode(10);
root.left = new TreeNode(5);
root.right = new TreeNode(15);
root.left.left = new TreeNode(3);
root.left.right = new TreeNode(7);

// Arbre créé :
//        10
//       /  \
//      5    15
//     / \
//    3   7
```

---

## Partie 2 : Classe BinaryTree

Créez une classe `BinaryTree` avec ces méthodes :

```javascript
class BinaryTree {
  constructor() {
    this.root = null;
  }

  insert(value) {
    // Votre code ici
  }

  contains(value) {
    // Votre code ici
  }

  size() {
    // Votre code ici
  }
}
```

---

## Partie 3 : insert()

Pour un arbre binaire de recherche :
- Valeur < parent → aller à gauche
- Valeur > parent → aller à droite

```javascript
insert(value) {
  const newNode = new TreeNode(value);
  
  if (this.root === null) {
    this.root = newNode;
    return;
  }
  
  function insertNode(node, newNode) {
    // Votre code ici
  }
  
  insertNode(this.root, newNode);
}
```

### Tests

```javascript
const tree = new BinaryTree();
tree.insert(10);
tree.insert(5);
tree.insert(15);
tree.insert(3);
tree.insert(7);

// Arbre créé :
//        10
//       /  \
//      5    15
//     / \
//    3   7
```

---

## Partie 4 : contains()

Recherche récursive d'une valeur :

```javascript
contains(value) {
  function search(node, value) {
    if (node === null) return false;
    if (node.value === value) return true;
    
    // Votre code ici
  }
  
  return search(this.root, value);
}
```

---

## Partie 5 : size()

Compte le nombre total de nœuds :

```javascript
size() {
  function countNodes(node) {
    if (node === null) return 0;
    // Votre code ici
  }
  
  return countNodes(this.root);
}
```

---

## Contraintes
- Utilisez la récursivité
- Durée estimée : 30 minutes

