# Exercice 1 - Créer une Structure de Virtual DOM

## Objectif
Comprendre la structure d'un Virtual DOM en créant des objets représentant des éléments HTML.

## Contexte

Le Virtual DOM est simplement un **arbre d'objets JavaScript** qui représente la structure HTML.

### Exemple HTML

```html
<div class="container">
  <h1>Titre</h1>
  <p>Paragraphe</p>
</div>
```

### Représentation en Virtual DOM

```javascript
{
  type: 'div',
  props: { class: 'container' },
  children: [
    {
      type: 'h1',
      props: {},
      children: ['Titre']
    },
    {
      type: 'p',
      props: {},
      children: ['Paragraphe']
    }
  ]
}
```

**C'est juste un arbre binaire/n-aire !**

---

## Partie 1 : Structure de base

### Créer un Virtual Node

```javascript
function createVNode(type, props = {}, ...children) {
  return {
    type,      // Type d'élément : 'div', 'h1', 'p'...
    props,     // Attributs : { class: '...', id: '...' }
    children   // Enfants : tableau de VNodes ou strings
  };
}
```

### Exemples d'utilisation

```javascript
// Élément simple sans enfant
const vnode1 = createVNode('div');
console.log(vnode1);
// { type: 'div', props: {}, children: [] }

// Élément avec props
const vnode2 = createVNode('div', { class: 'container', id: 'main' });
console.log(vnode2);
// { type: 'div', props: { class: 'container', id: 'main' }, children: [] }

// Élément avec texte
const vnode3 = createVNode('h1', {}, 'Hello World');
console.log(vnode3);
// { type: 'h1', props: {}, children: ['Hello World'] }

// Éléments imbriqués
const vnode4 = createVNode(
  'div',
  { class: 'container' },
  createVNode('h1', {}, 'Titre'),
  createVNode('p', {}, 'Paragraphe')
);
console.log(vnode4);
```

---

## Partie 2 : Tests

Créez les Virtual DOM pour ces structures HTML :

### Test 1 : Bouton simple

```html
<button class="btn btn-primary">Cliquer</button>
```

```javascript
const button = createVNode(
  'button',
  { class: 'btn btn-primary' },
  'Cliquer'
);
```

### Test 2 : Liste

```html
<ul class="list">
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
</ul>
```

```javascript
const list = createVNode(
  'ul',
  { class: 'list' },
  createVNode('li', {}, 'Item 1'),
  createVNode('li', {}, 'Item 2'),
  createVNode('li', {}, 'Item 3')
);
```

### Test 3 : Formulaire

```html
<form>
  <input type="text" placeholder="Nom" />
  <button type="submit">Envoyer</button>
</form>
```

```javascript
const form = createVNode(
  'form',
  {},
  createVNode('input', { type: 'text', placeholder: 'Nom' }),
  createVNode('button', { type: 'submit' }, 'Envoyer')
);
```

---

## Partie 3 : Fonction h() (comme JSX)

En React, on utilise JSX qui se compile en appels à `React.createElement()`.
Créons notre propre fonction `h()` (h pour hyperscript) :

```javascript
function h(type, props, ...children) {
  return {
    type,
    props: props || {},
    children: children.flat() // Flatten pour gérer les arrays
  };
}
```

### Utilisation

```javascript
// Au lieu de :
const vdom1 = createVNode('div', {}, 
  createVNode('h1', {}, 'Titre')
);

// On peut écrire :
const vdom2 = h('div', {},
  h('h1', {}, 'Titre')
);

// Ou avec un tableau d'enfants :
const items = ['Item 1', 'Item 2', 'Item 3'];
const vdom3 = h('ul', {},
  items.map(item => h('li', {}, item))
);
```

---

## Partie 4 : Comparaison avec un arbre binaire

Rappelez-vous de l'exercice sur les arbres :

```javascript
// Arbre binaire classique
class TreeNode {
  constructor(value) {
    this.value = value;
    this.left = null;
    this.right = null;
  }
}

// Virtual DOM = arbre n-aire
function VNode(type, props, children) {
  return {
    type,      // ~ value
    props,     // métadonnées
    children   // ~ left, right mais en tableau
  };
}
```

**Le Virtual DOM est un arbre, donc on peut utiliser les algorithmes de parcours d'arbre !**

---

## Partie 5 : Parcourir le Virtual DOM

### Parcours en profondeur

```javascript
function traverseVDOM(vnode, callback) {
  // Visiter le nœud courant
  callback(vnode);
  
  // Parcourir les enfants
  if (vnode.children) {
    for (const child of vnode.children) {
      if (typeof child === 'object') {
        traverseVDOM(child, callback);
      }
    }
  }
}

// Utilisation
const vdom = h('div', {},
  h('h1', {}, 'Titre'),
  h('p', {}, 'Paragraphe')
);

traverseVDOM(vdom, (node) => {
  if (typeof node === 'object') {
    console.log(node.type);
  }
});
// Output: div, h1, p
```

### Compter les nœuds

```javascript
function countNodes(vnode) {
  if (typeof vnode !== 'object') return 0;
  
  let count = 1; // Compter le nœud courant
  
  for (const child of vnode.children) {
    count += countNodes(child);
  }
  
  return count;
}

const vdom = h('div', {},
  h('h1', {}, 'Titre'),
  h('p', {}, 'Paragraphe'),
  h('ul', {},
    h('li', {}, 'Item 1'),
    h('li', {}, 'Item 2')
  )
);

console.log(countNodes(vdom)); // 6 nœuds
```

### Trouver la hauteur de l'arbre

```javascript
function getHeight(vnode) {
  if (typeof vnode !== 'object') return 0;
  if (vnode.children.length === 0) return 1;
  
  let maxHeight = 0;
  for (const child of vnode.children) {
    const height = getHeight(child);
    maxHeight = Math.max(maxHeight, height);
  }
  
  return 1 + maxHeight;
}

console.log(getHeight(vdom)); // 3 (div → ul → li)
```

---

## Partie 6 : Exercices pratiques

### Exercice 6.1 : Créer un composant Card

```javascript
function Card({ title, content, imageUrl }) {
  return h('div', { class: 'card' },
    h('img', { src: imageUrl, alt: title }),
    h('h2', {}, title),
    h('p', {}, content)
  );
}

const card = Card({
  title: 'Mon titre',
  content: 'Mon contenu',
  imageUrl: 'image.jpg'
});

console.log(card);
```

### Exercice 6.2 : Créer une liste dynamique

```javascript
function List({ items }) {
  return h('ul', {},
    items.map(item => h('li', { key: item.id }, item.text))
  );
}

const list = List({
  items: [
    { id: 1, text: 'Item 1' },
    { id: 2, text: 'Item 2' },
    { id: 3, text: 'Item 3' }
  ]
});
```

### Exercice 6.3 : Navigation

```javascript
function Nav({ links }) {
  return h('nav', {},
    h('ul', {},
      links.map(link => 
        h('li', {},
          h('a', { href: link.url }, link.text)
        )
      )
    )
  );
}

const nav = Nav({
  links: [
    { url: '/home', text: 'Accueil' },
    { url: '/about', text: 'À propos' },
    { url: '/contact', text: 'Contact' }
  ]
});
```

---

## Partie 7 : Visualiser le Virtual DOM

Créez une fonction pour afficher l'arbre :

```javascript
function displayVDOM(vnode, indent = 0) {
  const spaces = '  '.repeat(indent);
  
  if (typeof vnode === 'string') {
    console.log(`${spaces}"${vnode}"`);
    return;
  }
  
  const propsStr = Object.keys(vnode.props).length > 0
    ? ` ${JSON.stringify(vnode.props)}`
    : '';
    
  console.log(`${spaces}<${vnode.type}${propsStr}>`);
  
  for (const child of vnode.children) {
    displayVDOM(child, indent + 1);
  }
  
  console.log(`${spaces}</${vnode.type}>`);
}

const vdom = h('div', { class: 'container' },
  h('h1', {}, 'Titre'),
  h('p', {}, 'Paragraphe')
);

displayVDOM(vdom);
```

**Output** :
```
<div {"class":"container"}>
  <h1>
    "Titre"
  </h1>
  <p>
    "Paragraphe"
  </p>
</div>
```

---

## Partie 8 : Sérialiser en JSON

Le Virtual DOM peut être sérialisé et envoyé sur le réseau :

```javascript
function serializeVDOM(vnode) {
  return JSON.stringify(vnode, null, 2);
}

function deserializeVDOM(json) {
  return JSON.parse(json);
}

const vdom = h('div', {},
  h('h1', {}, 'Hello')
);

const json = serializeVDOM(vdom);
console.log(json);

const restored = deserializeVDOM(json);
console.log(restored);
```

**Utilité** : Server-Side Rendering (SSR)

---

## Récapitulatif

### Ce qu'on a appris

1. **Virtual DOM** = arbre d'objets JavaScript
2. Structure : `{ type, props, children }`
3. On peut utiliser les **algorithmes d'arbres** (parcours, hauteur, comptage)
4. C'est la base de React, Vue, etc.

### Lien avec le cours

- **Structures de données** : arbre n-aire
- **Récursivité** : parcourir l'arbre
- **Algorithmes** : recherche, comptage, transformation

### Prochaine étape

Dans les prochains exercices, on va :
1. Convertir le Virtual DOM en DOM réel
2. Comparer deux Virtual DOM (diff)
3. Mettre à jour le DOM de manière optimale (patch)

## Contraintes
- Durée estimée : 30 minutes

