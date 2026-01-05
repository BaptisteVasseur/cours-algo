# Exercice 1 - Implémenter createElement

## Objectif
Créer une fonction `createElement` complète, similaire à `React.createElement`.

## Contexte

En React, le JSX est compilé en appels à `React.createElement()` :

```jsx
// JSX
<div className="app">
  <h1>Hello</h1>
</div>

// Compilé en
React.createElement('div', { className: 'app' },
  React.createElement('h1', null, 'Hello')
)
```

On va créer notre propre version !

---

## Partie 1 : createElement de base

```javascript
function createElement(type, props, ...children) {
  return {
    type,
    props: props || {},
    children: children.flat()
  };
}
```

### Tests

```javascript
const vnode1 = createElement('div', { class: 'container' }, 'Hello');
console.log(vnode1);
// { type: 'div', props: { class: 'container' }, children: ['Hello'] }

const vnode2 = createElement('div', null,
  createElement('h1', null, 'Titre'),
  createElement('p', null, 'Paragraphe')
);
console.log(vnode2);
```

---

## Partie 2 : Gérer les tableaux d'enfants

```javascript
function createElement(type, props, ...children) {
  return {
    type,
    props: props || {},
    children: flattenChildren(children)
  };
}

function flattenChildren(children) {
  return children.reduce((flat, child) => {
    if (Array.isArray(child)) {
      return flat.concat(flattenChildren(child));
    }
    
    // Ignorer null, undefined, false, true
    if (child === null || child === undefined || typeof child === 'boolean') {
      return flat;
    }
    
    // Convertir les nombres en string
    if (typeof child === 'number') {
      return flat.concat(String(child));
    }
    
    return flat.concat(child);
  }, []);
}
```

### Tests

```javascript
// Tableau d'enfants
const items = ['Item 1', 'Item 2', 'Item 3'];
const vnode = createElement('ul', null,
  items.map(text => createElement('li', null, text))
);

console.log(vnode);

// Avec null/undefined (ignorés)
const vnode2 = createElement('div', null,
  'Texte',
  null,
  undefined,
  false && createElement('p', null, 'Hidden'),
  createElement('p', null, 'Visible')
);

console.log(vnode2);
// children: ['Texte', { type: 'p', props: {}, children: ['Visible'] }]
```

---

## Partie 3 : Gérer les composants fonctions

```javascript
function createElement(type, props, ...children) {
  // Si type est une fonction, c'est un composant
  if (typeof type === 'function') {
    // Appeler le composant avec ses props et children
    const componentProps = { ...props, children };
    return type(componentProps);
  }
  
  return {
    type,
    props: props || {},
    children: flattenChildren(children)
  };
}
```

### Tests

```javascript
// Composant fonction
function Button({ text, onClick }) {
  return createElement('button', { onClick, className: 'btn' }, text);
}

const vnode = createElement(Button, { 
  text: 'Cliquer',
  onClick: () => console.log('Cliqué !')
});

console.log(vnode);
// { type: 'button', props: { onClick: [Function], className: 'btn' }, children: ['Cliquer'] }

// Composant avec children
function Card({ title, children }) {
  return createElement('div', { className: 'card' },
    createElement('h2', null, title),
    createElement('div', { className: 'card-body' }, children)
  );
}

const card = createElement(Card, { title: 'Mon titre' },
  createElement('p', null, 'Contenu de la carte')
);

console.log(card);
```

---

## Partie 4 : Gérer les fragments

React utilise `<></>` pour grouper sans div. On va créer `Fragment` :

```javascript
const Fragment = Symbol('Fragment');

function createElement(type, props, ...children) {
  if (typeof type === 'function') {
    const componentProps = { ...props, children: flattenChildren(children) };
    return type(componentProps);
  }
  
  // Fragment : retourner directement les enfants
  if (type === Fragment) {
    return flattenChildren(children);
  }
  
  return {
    type,
    props: props || {},
    children: flattenChildren(children)
  };
}
```

### Tests

```javascript
// Sans Fragment : crée un div
const withDiv = createElement('div', null,
  createElement('h1', null, 'Titre'),
  createElement('p', null, 'Paragraphe')
);

// Avec Fragment : pas de div wrapper
const withFragment = createElement(Fragment, null,
  createElement('h1', null, 'Titre'),
  createElement('p', null, 'Paragraphe')
);

console.log(withFragment);
// [
//   { type: 'h1', ... },
//   { type: 'p', ... }
// ]
```

---

## Partie 5 : Créer un alias h()

Convention : `h` pour hyperscript (comme dans Vue, Preact)

```javascript
const h = createElement;

// Utilisation
const vnode = h('div', { className: 'app' },
  h('h1', null, 'Titre'),
  h('p', null, 'Paragraphe')
);
```

---

## Partie 6 : Supporter les props spéciales

```javascript
function createElement(type, props, ...children) {
  if (typeof type === 'function') {
    const componentProps = { 
      ...props, 
      children: flattenChildren(children) 
    };
    return type(componentProps);
  }
  
  if (type === Fragment) {
    return flattenChildren(children);
  }
  
  // Normaliser les props
  const normalizedProps = normalizeProps(props);
  
  return {
    type,
    props: normalizedProps,
    children: flattenChildren(children)
  };
}

function normalizeProps(props) {
  if (!props) return {};
  
  const normalized = {};
  
  for (const [key, value] of Object.entries(props)) {
    // className → class
    if (key === 'className') {
      normalized.class = value;
    }
    // style object → style string
    else if (key === 'style' && typeof value === 'object') {
      normalized.style = objectToStyleString(value);
    }
    // Autres props
    else {
      normalized[key] = value;
    }
  }
  
  return normalized;
}

function objectToStyleString(styleObj) {
  return Object.entries(styleObj)
    .map(([key, value]) => {
      // camelCase → kebab-case
      const kebabKey = key.replace(/([A-Z])/g, '-$1').toLowerCase();
      return `${kebabKey}: ${value}`;
    })
    .join('; ');
}
```

### Tests

```javascript
const vnode = createElement('div', {
  className: 'container',
  style: {
    backgroundColor: 'blue',
    fontSize: '16px'
  }
});

console.log(vnode.props);
// {
//   class: 'container',
//   style: 'background-color: blue; font-size: 16px'
// }
```

---

## Partie 7 : Supporter les keys (pour les listes)

```javascript
function createElement(type, props, ...children) {
  if (typeof type === 'function') {
    const componentProps = { ...props, children: flattenChildren(children) };
    return type(componentProps);
  }
  
  if (type === Fragment) {
    return flattenChildren(children);
  }
  
  // Extraire key des props
  const { key, ...restProps } = props || {};
  
  return {
    type,
    props: normalizeProps(restProps),
    children: flattenChildren(children),
    key: key || null
  };
}
```

### Tests

```javascript
const items = [
  { id: 1, text: 'Item 1' },
  { id: 2, text: 'Item 2' }
];

const list = createElement('ul', null,
  items.map(item => 
    createElement('li', { key: item.id }, item.text)
  )
);

console.log(list.children);
// [
//   { type: 'li', props: {}, children: ['Item 1'], key: 1 },
//   { type: 'li', props: {}, children: ['Item 2'], key: 2 }
// ]
```

---

## Partie 8 : API complète

```javascript
// Fragment
export const Fragment = Symbol('Fragment');

// createElement
export function createElement(type, props, ...children) {
  // Composant fonction
  if (typeof type === 'function') {
    const componentProps = { 
      ...props, 
      children: flattenChildren(children) 
    };
    return type(componentProps);
  }
  
  // Fragment
  if (type === Fragment) {
    return flattenChildren(children);
  }
  
  // Extraire key
  const { key, ...restProps } = props || {};
  
  // Élément normal
  return {
    type,
    props: normalizeProps(restProps),
    children: flattenChildren(children),
    key: key !== undefined ? key : null
  };
}

// Alias
export const h = createElement;

// Helpers
function flattenChildren(children) {
  return children.reduce((flat, child) => {
    if (Array.isArray(child)) {
      return flat.concat(flattenChildren(child));
    }
    if (child === null || child === undefined || typeof child === 'boolean') {
      return flat;
    }
    if (typeof child === 'number') {
      return flat.concat(String(child));
    }
    return flat.concat(child);
  }, []);
}

function normalizeProps(props) {
  if (!props) return {};
  
  const normalized = {};
  
  for (const [key, value] of Object.entries(props)) {
    if (key === 'className') {
      normalized.class = value;
    } else if (key === 'style' && typeof value === 'object') {
      normalized.style = objectToStyleString(value);
    } else {
      normalized[key] = value;
    }
  }
  
  return normalized;
}

function objectToStyleString(styleObj) {
  return Object.entries(styleObj)
    .map(([key, value]) => {
      const kebabKey = key.replace(/([A-Z])/g, '-$1').toLowerCase();
      return `${kebabKey}: ${value}`;
    })
    .join('; ');
}
```

---

## Partie 9 : Exemple complet

```javascript
// Composants
function Button({ text, onClick, variant = 'primary' }) {
  return h('button', {
    className: `btn btn-${variant}`,
    onClick
  }, text);
}

function Card({ title, children }) {
  return h('div', { className: 'card' },
    h('h2', { className: 'card-title' }, title),
    h('div', { className: 'card-body' }, children)
  );
}

function TodoItem({ text, completed }) {
  return h('li', {
    className: completed ? 'todo-item completed' : 'todo-item'
  },
    h('input', { type: 'checkbox', checked: completed }),
    h('span', null, text)
  );
}

function TodoList({ todos }) {
  return h('ul', { className: 'todo-list' },
    todos.map(todo => 
      h(TodoItem, { 
        key: todo.id,
        text: todo.text,
        completed: todo.completed 
      })
    )
  );
}

function App() {
  const todos = [
    { id: 1, text: 'Apprendre les algos', completed: true },
    { id: 2, text: 'Créer un mini-React', completed: false },
    { id: 3, text: 'Comprendre le Virtual DOM', completed: false }
  ];
  
  return h('div', { className: 'app' },
    h(Card, { title: 'Ma Todo List' },
      h(TodoList, { todos }),
      h(Button, { 
        text: 'Ajouter',
        onClick: () => console.log('Ajouté !'),
        variant: 'success'
      })
    )
  );
}

// Créer le Virtual DOM
const vdom = App();
console.log(JSON.stringify(vdom, null, 2));
```

---

## Partie 10 : Tests unitaires

```javascript
function testCreateElement() {
  // Test 1 : Élément simple
  const t1 = createElement('div', null, 'Hello');
  console.assert(t1.type === 'div');
  console.assert(t1.children[0] === 'Hello');
  
  // Test 2 : Props
  const t2 = createElement('div', { className: 'test', id: 'main' });
  console.assert(t2.props.class === 'test');
  console.assert(t2.props.id === 'main');
  
  // Test 3 : Children multiples
  const t3 = createElement('div', null, 'A', 'B', 'C');
  console.assert(t3.children.length === 3);
  
  // Test 4 : Children array
  const t4 = createElement('ul', null, ['A', 'B'].map(x => createElement('li', null, x)));
  console.assert(t4.children.length === 2);
  
  // Test 5 : Composant
  const Button = ({ text }) => createElement('button', null, text);
  const t5 = createElement(Button, { text: 'Click' });
  console.assert(t5.type === 'button');
  
  // Test 6 : Fragment
  const t6 = createElement(Fragment, null, 'A', 'B');
  console.assert(Array.isArray(t6));
  
  // Test 7 : Key
  const t7 = createElement('li', { key: '123' }, 'Item');
  console.assert(t7.key === '123');
  
  console.log('✅ Tous les tests passent !');
}

testCreateElement();
```

---

## Récapitulatif

### API créée

```javascript
createElement(type, props, ...children)
h(type, props, ...children)  // alias
Fragment                      // pour grouper sans wrapper
```

### Fonctionnalités

✅ Éléments HTML
✅ Props et attributs
✅ Children (simples, multiples, arrays)
✅ Composants fonctions
✅ Fragments
✅ Keys pour les listes
✅ Normalisation (className → class, style object → string)
✅ Filtrage (null, undefined, boolean)

### Lien avec React

Notre `createElement` fait exactement la même chose que `React.createElement` !

## Contraintes
- Durée estimée : 30 minutes

