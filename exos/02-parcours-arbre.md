# Exercice 3 - Parcours d'Arbre Binaire

## Objectif
Implémenter les parcours d'un arbre binaire : préfixe, infixe, postfixe et en largeur.

## Arbre de référence

```
        10
       /  \
      5    15
     / \   / \
    3   7 12  20
```

```javascript
const tree = new BinaryTree();
tree.insert(10);
tree.insert(5);
tree.insert(15);
tree.insert(3);
tree.insert(7);
tree.insert(12);
tree.insert(20);
```

---

## Partie 1 : Parcours Préfixe (Pre-order)

**Ordre** : Racine → Gauche → Droite  
**Résultat attendu** : `[10, 5, 3, 7, 15, 12, 20]`

```javascript
preOrder() {
  const result = [];
  
  function traverse(node) {
    // ...
  }
  
  traverse(this.root);
  return result;
}
```

---

## Partie 2 : Parcours Infixe (In-order)

**Ordre** : Gauche → Racine → Droite  
**Résultat attendu** : `[3, 5, 7, 10, 12, 15, 20]` (trié pour un BSR)

```javascript
inOrder() {
  const result = [];
  
  function traverse(node) {
      // ...
  }
  
  traverse(this.root);
  return result;
}
```

---

## Partie 3 : Parcours Postfixe (Post-order)

**Ordre** : Gauche → Droite → Racine  
**Résultat attendu** : `[3, 7, 5, 12, 20, 15, 10]`

```javascript
postOrder() {
  const result = [];
  
  function traverse(node) {
      // ...
  }
  
  traverse(this.root);
  return result;
}
```

---

## Partie 4 : Parcours en Largeur (BFS)

**Ordre** : Niveau par niveau  
**Résultat attendu** : `[10, 5, 15, 3, 7, 12, 20]`

Utilisez une file (Queue) :

```javascript
breadthFirst() {
    // ...
}
```

---

## Récapitulatif

| Parcours | Ordre | Résultat |
|----------|-------|----------|
| **Préfixe** | Racine → Gauche → Droite | [10, 5, 3, 7, 15, 12, 20] |
| **Infixe** | Gauche → Racine → Droite | [3, 5, 7, 10, 12, 15, 20] |
| **Postfixe** | Gauche → Droite → Racine | [3, 7, 5, 12, 20, 15, 10] |
| **Largeur** | Niveau par niveau | [10, 5, 15, 3, 7, 12, 20] |

## Contraintes
- Utilisez la récursivité (sauf pour BFS)
- Durée estimée : 25 minutes

