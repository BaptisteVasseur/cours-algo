# Validateur de Parenthèses

## ### Exercice 1 :

Utiliser une pile pour valider que les parenthèses, crochets et accolades sont bien équilibrés dans une chaîne de caractères.
Créez une fonction `isBalanced(str)` qui vérifie si tous les symboles ouvrants ont leur symbole fermant correspondant et dans le bon ordre.

### Symboles à gérer
- Parenthèses : `(` et `)`
- Crochets : `[` et `]`
- Accolades : `{` et `}`

## Principe

Utilisez une pile pour :
1. Parcourir la chaîne caractère par caractère
2. Si c'est un symbole ouvrant `(`, `[`, `{` → empiler
3. Si c'est un symbole fermant `)`, `]`, `}` → dépiler et vérifier la correspondance
4. À la fin, la pile doit être vide

## Exemples

```javascript
isBalanced("()");           // true
isBalanced("()[]{}");       // true
isBalanced("([{}])");       // true
isBalanced("({[]})");       // true

isBalanced("(]");           // false
isBalanced("([)]");         // false
isBalanced("((()");         // false
isBalanced("())");          // false
isBalanced("{[}]");         // false
```

## Exemples avec du code

```javascript
isBalanced("function test() { return [1, 2]; }"); // true
isBalanced("if (x > 0) { console.log('ok'); }");  // true
isBalanced("const arr = [1, 2, (3 + 4)];");       // true

isBalanced("function test() { return [1, 2; }");  // false
isBalanced("if (x > 0 { console.log('ok'); }");   // false
```

## Tests à valider

```javascript
// Tests de base
console.assert(isBalanced("()") === true);
console.assert(isBalanced("()[]{}") === true);
console.assert(isBalanced("([{}])") === true);

// Tests négatifs
console.assert(isBalanced("(]") === false);
console.assert(isBalanced("([)]") === false);
console.assert(isBalanced("((()") === false);

// Tests complexes
console.assert(isBalanced("function test() { return [1, 2]; }") === true);
console.assert(isBalanced("{[()]}[]") === true);
console.assert(isBalanced("") === true); // chaîne vide

// Edge cases
console.assert(isBalanced(")(") === false);
console.assert(isBalanced("}") === false);
```

Modifiez votre fonction pour qu'elle retourne la position du premier caractère incorrect :

```javascript
function findUnbalanced(str) {
  // Retourne -1 si équilibré
  // Retourne l'index du problème sinon
}

findUnbalanced("()");      // -1 (équilibré)
findUnbalanced("(]");      // 1 (problème à l'index 1)
findUnbalanced("((()");    // 0 (première parenthèse jamais fermée)
```

## Contraintes
- Utilisez votre classe `Stack` créée dans l'exercice 1
- Durée estimée : 30 minutes

