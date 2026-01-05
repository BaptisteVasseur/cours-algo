# Exercice 3 - Algorithme de Diff et Patch

## Objectif
Implémenter l'algorithme de réconciliation : comparer deux Virtual DOM et mettre à jour uniquement ce qui a changé.

## Problème à résoudre

Actuellement, chaque re-render recrée tout le DOM :

```javascript
setState({ count: count + 1 });
// → render() détruit et recrée tout le DOM ❌
```

**Problèmes** :
- ❌ Perte de focus des inputs
- ❌ Animations réinitialisées
- ❌ Performance dégradée
- ❌ Événements re-attachés

**Solution** : Comparer ancien et nouveau Virtual DOM, modifier uniquement ce qui change !

---

## Partie 1 : Algorithme de diff

```javascript
function diff(oldVNode, newVNode) {
  // Retourne un "patch" : description des changements
  
  // Cas 1 : Types différents → REPLACE
  if (typeof oldVNode !== typeof newVNode) {
    return { type: 'REPLACE', newVNode };
  }
  
  // Cas 2 : Texte → TEXT
  if (typeof newVNode === 'string') {
    if (oldVNode !== newVNode) {
      return { type: 'TEXT', newText: newVNode };
    }
    return null; // Pas de changement
  }
  
  // Cas 3 : Tag différent → REPLACE
  if (oldVNode.type !== newVNode.type) {
    return { type: 'REPLACE', newVNode };
  }
  
  // Cas 4 : Même tag → UPDATE
  return {
    type: 'UPDATE',
    props: diffProps(oldVNode.props, newVNode.props),
    children: diffChildren(oldVNode.children, newVNode.children)
  };
}
```

---

## Partie 2 : Diff des props

```javascript
function diffProps(oldProps, newProps) {
  const patches = {};
  
  // Props modifiées ou ajoutées
  for (const [key, value] of Object.entries(newProps)) {
    if (oldProps[key] !== value) {
      patches[key] = value;
    }
  }
  
  // Props supprimées
  for (const key of Object.keys(oldProps)) {
    if (!(key in newProps)) {
      patches[key] = null; // null = supprimer
    }
  }
  
  return patches;
}
```

### Tests

```javascript
const oldProps = { class: 'btn', id: 'old' };
const newProps = { class: 'btn btn-primary', title: 'Click' };

const patches = diffProps(oldProps, newProps);
console.log(patches);
// {
//   class: 'btn btn-primary',  // modifié
//   title: 'Click',            // ajouté
//   id: null                   // supprimé
// }
```

---

## Partie 3 : Diff des children

```javascript
function diffChildren(oldChildren, newChildren) {
  const patches = [];
  const maxLength = Math.max(oldChildren.length, newChildren.length);
  
  for (let i = 0; i < maxLength; i++) {
    patches[i] = diff(oldChildren[i], newChildren[i]);
  }
  
  return patches;
}
```

### Exemple

```javascript
const oldChildren = [
  { type: 'li', props: {}, children: ['Item 1'] },
  { type: 'li', props: {}, children: ['Item 2'] }
];

const newChildren = [
  { type: 'li', props: {}, children: ['Item 1'] },
  { type: 'li', props: {}, children: ['Item 2 modifié'] },
  { type: 'li', props: {}, children: ['Item 3'] }
];

const patches = diffChildren(oldChildren, newChildren);
console.log(patches);
// [
//   null,                          // Item 1 : pas de changement
//   { type: 'UPDATE', ... },       // Item 2 : texte modifié
//   { type: 'REPLACE', ... }       // Item 3 : ajouté
// ]
```

---

## Partie 4 : Algorithme de patch

```javascript
function patch(parent, patches, oldVNode, index = 0) {
  if (!patches) return;
  
  const element = parent.childNodes[index];
  
  switch (patches.type) {
    case 'REPLACE':
      const newElement = createDOMNode(patches.newVNode);
      parent.replaceChild(newElement, element);
      break;
      
    case 'TEXT':
      element.textContent = patches.newText;
      break;
      
    case 'UPDATE':
      // Patcher les props
      patchProps(element, patches.props);
      
      // Patcher les children
      patches.children.forEach((childPatch, i) => {
        patch(element, childPatch, oldVNode.children[i], i);
      });
      break;
  }
}
```

---

## Partie 5 : Patcher les props

```javascript
function patchProps(element, props) {
  for (const [key, value] of Object.entries(props)) {
    if (value === null) {
      // Supprimer la prop
      removeProp(element, key);
    } else {
      // Ajouter/modifier la prop
      setProp(element, key, value);
    }
  }
}

function removeProp(element, key) {
  if (key.startsWith('on')) {
    // Supprimer event listener (complexe, on simplifie)
    const eventName = key.substring(2).toLowerCase();
    element.removeEventListener(eventName, element[`__${key}`]);
  } else if (key === 'class' || key === 'className') {
    element.className = '';
  } else {
    element.removeAttribute(key);
  }
}
```

---

## Partie 6 : Intégrer diff + patch dans render

```javascript
let currentVNode = null;

function render(vnode, container) {
  if (!currentVNode) {
    // Premier render
    container.innerHTML = '';
    const domNode = createDOMNode(vnode);
    container.appendChild(domNode);
  } else {
    // Re-render : diff + patch
    const patches = diff(currentVNode, vnode);
    patch(container, patches, currentVNode, 0);
  }
  
  currentVNode = vnode;
}
```

---

## Partie 7 : Test avec un compteur

```javascript
let count = 0;

function Counter() {
  return h('div', null,
    h('h1', null, `Count: ${count}`),
    h('button', {
      onClick: () => {
        count++;
        render(Counter(), root);
      }
    }, '+')
  );
}

render(Counter(), root);
```

**Avant (sans diff)** :
- Chaque clic recrée le DOM complet
- L'événement onClick est re-attaché

**Après (avec diff)** :
- Seul le texte du h1 est modifié
- Le bouton n'est pas re-créé

---

## Partie 8 : Gérer les keys pour les listes

Sans keys, le diff est naïf :

```javascript
// Ancien : [A, B, C]
// Nouveau : [A, C, B]
// Sans key → pense que B et C ont changé de contenu

// Avec keys → comprend que c'est juste un réordonnancement
```

### Diff avec keys

```javascript
function diffChildren(oldChildren, newChildren) {
  // Si les enfants ont des keys
  if (newChildren[0]?.key !== undefined) {
    return diffChildrenWithKeys(oldChildren, newChildren);
  }
  
  // Sinon, diff simple par index
  const patches = [];
  const maxLength = Math.max(oldChildren.length, newChildren.length);
  
  for (let i = 0; i < maxLength; i++) {
    patches[i] = diff(oldChildren[i], newChildren[i]);
  }
  
  return patches;
}

function diffChildrenWithKeys(oldChildren, newChildren) {
  const patches = [];
  const oldKeyed = new Map();
  
  // Indexer les anciens enfants par key
  oldChildren.forEach((child, i) => {
    if (child.key !== null) {
      oldKeyed.set(child.key, { child, index: i });
    }
  });
  
  // Comparer avec les nouveaux enfants
  newChildren.forEach((newChild, i) => {
    if (oldKeyed.has(newChild.key)) {
      const old = oldKeyed.get(newChild.key);
      patches[i] = {
        ...diff(old.child, newChild),
        oldIndex: old.index,
        newIndex: i
      };
    } else {
      // Nouvel enfant
      patches[i] = { type: 'INSERT', newVNode: newChild };
    }
  });
  
  return patches;
}
```

---

## Partie 9 : Exemple complet avec Todo List

```javascript
let state = {
  todos: [
    { id: 1, text: 'Apprendre les algos', completed: false },
    { id: 2, text: 'Créer mini-React', completed: false }
  ],
  input: ''
};

function setState(updates) {
  state = { ...state, ...updates };
  render(App(), root);
}

function TodoItem({ todo }) {
  return h('li', { key: todo.id },
    h('input', {
      type: 'checkbox',
      checked: todo.completed,
      onChange: () => {
        setState({
          todos: state.todos.map(t =>
            t.id === todo.id ? { ...t, completed: !t.completed } : t
          )
        });
      }
    }),
    h('span', {
      style: {
        textDecoration: todo.completed ? 'line-through' : 'none'
      }
    }, todo.text),
    h('button', {
      onClick: () => {
        setState({
          todos: state.todos.filter(t => t.id !== todo.id)
        });
      }
    }, '×')
  );
}

function App() {
  return h('div', { className: 'app' },
    h('h1', null, 'Todo List avec Diff !'),
    h('div', null,
      h('input', {
        type: 'text',
        value: state.input,
        onInput: (e) => setState({ input: e.target.value })
      }),
      h('button', {
        onClick: () => {
          if (state.input.trim()) {
            setState({
              todos: [...state.todos, {
                id: Date.now(),
                text: state.input,
                completed: false
              }],
              input: ''
            });
          }
        }
      }, 'Ajouter')
    ),
    h('ul', null,
      state.todos.map(todo => h(TodoItem, { todo }))
    )
  );
}

render(App(), root);
```

**Avec diff + patch** :
- ✅ Cocher une todo modifie seulement ce li
- ✅ Ajouter une todo n'affecte pas les existantes
- ✅ L'input garde le focus
- ✅ Performance optimale

---

## Partie 10 : Analyse de complexité

### Diff simple (sans keys)
- **Complexité** : O(n) où n = nombre de nœuds
- Parcours linéaire de l'arbre

### Diff avec keys
- **Complexité** : O(n) en moyenne
- Utilisation d'un Map pour les lookups O(1)

### Patch
- **Complexité** : O(p) où p = nombre de patches
- Seuls les changements sont appliqués

### Comparaison

| Sans diff | Avec diff |
|-----------|-----------|
| O(n) création DOM | O(n) diff + O(p) patch |
| Recrée tout | Modifie seulement ce qui change |
| Événements perdus | Événements préservés |

---

## Partie 11 : Optimisations avancées

### 1. Bail out early

```javascript
function diff(oldVNode, newVNode) {
  // Si même référence, pas de changement
  if (oldVNode === newVNode) {
    return null;
  }
  
  // ...
}
```

### 2. Shallow comparison pour les props

```javascript
function shouldUpdate(oldProps, newProps) {
  const oldKeys = Object.keys(oldProps);
  const newKeys = Object.keys(newProps);
  
  if (oldKeys.length !== newKeys.length) return true;
  
  for (const key of newKeys) {
    if (oldProps[key] !== newProps[key]) return true;
  }
  
  return false;
}
```

### 3. Mémorisation des composants

```javascript
function memo(Component) {
  let cachedProps = null;
  let cachedVNode = null;
  
  return function MemoizedComponent(props) {
    if (cachedProps && shallowEqual(cachedProps, props)) {
      return cachedVNode;
    }
    
    cachedProps = props;
    cachedVNode = Component(props);
    return cachedVNode;
  };
}

// Usage
const MemoizedTodoItem = memo(TodoItem);
```

---

## Récapitulatif

### Algorithmes implémentés

1. **diff()** : Comparer deux arbres → O(n)
2. **patch()** : Appliquer les changements → O(p)
3. **diffChildren()** : Comparer les enfants
4. **diffProps()** : Comparer les props

### Types de patches

- `REPLACE` : Remplacer un nœud
- `TEXT` : Changer du texte
- `UPDATE` : Mettre à jour props + children
- `INSERT` : Insérer un nouveau nœud
- `REMOVE` : Supprimer un nœud

### Lien avec le cours

- **Arbres** : diff est un parcours d'arbre
- **Complexité** : O(n) pour parcourir
- **Optimisation** : keys pour éviter les faux positifs
- **Map/Set** : pour les lookups en O(1)

### C'est exactement ce que fait React !

React utilise un algorithme de diff similaire (appelé "reconciliation").
La seule différence : React est plus optimisé (fiber, concurrent mode, etc.)

## Contraintes
- Durée estimée : 30 minutes

