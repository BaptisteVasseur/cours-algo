# Exercice 2 - Implémenter render()

## Objectif
Créer la fonction `render()` complète qui transforme un Virtual DOM en DOM réel.

## Rappel

```javascript
render(vnode, container)
```

- `vnode` : Virtual DOM (objet créé par createElement)
- `container` : Élément HTML où insérer le résultat

---

## Partie 1 : render() de base

```javascript
function render(vnode, container) {
  // Vider le container
  container.innerHTML = '';
  
  // Créer et insérer les éléments
  const domNode = createDOMNode(vnode);
  container.appendChild(domNode);
}

function createDOMNode(vnode) {
  // Cas 1 : Texte
  if (typeof vnode === 'string') {
    return document.createTextNode(vnode);
  }
  
  // Cas 2 : Array (Fragment)
  if (Array.isArray(vnode)) {
    const fragment = document.createDocumentFragment();
    vnode.forEach(child => {
      fragment.appendChild(createDOMNode(child));
    });
    return fragment;
  }
  
  // Cas 3 : Élément
  const { type, props, children } = vnode;
  const element = document.createElement(type);
  
  // Appliquer les props
  setProps(element, props);
  
  // Ajouter les enfants récursivement
  children.forEach(child => {
    element.appendChild(createDOMNode(child));
  });
  
  return element;
}
```

---

## Partie 2 : Gérer les props

```javascript
function setProps(element, props) {
  Object.entries(props).forEach(([key, value]) => {
    setProp(element, key, value);
  });
}

function setProp(element, key, value) {
  // Event listeners : onClick, onChange, etc.
  if (key.startsWith('on')) {
    const eventName = key.substring(2).toLowerCase();
    element.addEventListener(eventName, value);
  }
  // class
  else if (key === 'class' || key === 'className') {
    element.className = value;
  }
  // style string
  else if (key === 'style' && typeof value === 'string') {
    element.style.cssText = value;
  }
  // style object
  else if (key === 'style' && typeof value === 'object') {
    Object.assign(element.style, value);
  }
  // value pour input
  else if (key === 'value') {
    element.value = value;
  }
  // checked pour checkbox
  else if (key === 'checked') {
    element.checked = value;
  }
  // Autres attributs
  else {
    element.setAttribute(key, value);
  }
}
```

---

## Partie 3 : Tests

### Test 1 : Élément simple

```javascript
const vnode = h('div', { className: 'container' }, 'Hello World');
const root = document.getElementById('root');
render(vnode, root);
```

**DOM** :
```html
<div class="container">Hello World</div>
```

### Test 2 : Avec événement

```javascript
const vnode = h('button', {
  onClick: () => alert('Cliqué !'),
  className: 'btn'
}, 'Cliquer');

render(vnode, root);
```

### Test 3 : Liste

```javascript
const items = ['Item 1', 'Item 2', 'Item 3'];

const vnode = h('ul', null,
  items.map((text, i) => h('li', { key: i }, text))
);

render(vnode, root);
```

---

## Partie 4 : Gérer les props booléennes

```javascript
function setProp(element, key, value) {
  if (key.startsWith('on')) {
    const eventName = key.substring(2).toLowerCase();
    element.addEventListener(eventName, value);
  }
  else if (key === 'class' || key === 'className') {
    element.className = value;
  }
  else if (key === 'style') {
    if (typeof value === 'string') {
      element.style.cssText = value;
    } else if (typeof value === 'object') {
      Object.assign(element.style, value);
    }
  }
  else if (key === 'value') {
    element.value = value;
  }
  else if (key === 'checked') {
    element.checked = value;
  }
  // Props booléennes : disabled, readonly, etc.
  else if (typeof value === 'boolean') {
    if (value) {
      element.setAttribute(key, '');
    } else {
      element.removeAttribute(key);
    }
  }
  else if (value !== null && value !== undefined) {
    element.setAttribute(key, value);
  }
}
```

### Tests

```javascript
// Input disabled
const input1 = h('input', { type: 'text', disabled: true });
render(input1, root);

// Button non disabled
const button1 = h('button', { disabled: false }, 'Actif');
render(button1, root);
```

---

## Partie 5 : Formulaires interactifs

```javascript
function Form() {
  return h('form', {
    onSubmit: (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);
      console.log({
        name: formData.get('name'),
        email: formData.get('email')
      });
    }
  },
    h('div', null,
      h('label', null, 'Nom :'),
      h('input', { type: 'text', name: 'name', required: true })
    ),
    h('div', null,
      h('label', null, 'Email :'),
      h('input', { type: 'email', name: 'email', required: true })
    ),
    h('button', { type: 'submit' }, 'Envoyer')
  );
}

render(Form(), root);
```

---

## Partie 6 : État avec re-render

```javascript
// État global simple
let state = {
  count: 0,
  todos: []
};

function setState(newState) {
  state = { ...state, ...newState };
  render(App(), root);
}

function Counter() {
  return h('div', null,
    h('h1', null, `Count: ${state.count}`),
    h('button', {
      onClick: () => setState({ count: state.count + 1 })
    }, '+'),
    h('button', {
      onClick: () => setState({ count: state.count - 1 })
    }, '-')
  );
}

function App() {
  return h('div', { className: 'app' },
    h(Counter)
  );
}

render(App(), root);
```

---

## Partie 7 : Todo List complète

```javascript
let state = {
  todos: [
    { id: 1, text: 'Apprendre les algos', completed: false },
    { id: 2, text: 'Créer un mini-React', completed: false }
  ],
  input: ''
};

function setState(newState) {
  state = { ...state, ...newState };
  render(App(), root);
}

function TodoItem({ todo }) {
  return h('li', {
    className: todo.completed ? 'completed' : '',
    style: {
      textDecoration: todo.completed ? 'line-through' : 'none'
    }
  },
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
    h('span', null, todo.text),
    h('button', {
      onClick: () => {
        setState({
          todos: state.todos.filter(t => t.id !== todo.id)
        });
      }
    }, '×')
  );
}

function TodoList() {
  return h('div', { className: 'todo-list' },
    h('h1', null, 'Ma Todo List'),
    h('div', null,
      h('input', {
        type: 'text',
        value: state.input,
        onInput: (e) => setState({ input: e.target.value }),
        placeholder: 'Nouvelle tâche...'
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
      state.todos.map(todo => h(TodoItem, { key: todo.id, todo }))
    )
  );
}

function App() {
  return h('div', { className: 'app' },
    h(TodoList)
  );
}

render(App(), root);
```

---

## Partie 8 : Optimisation avec shouldUpdate

```javascript
function render(vnode, container, oldVNode = null) {
  // Si oldVNode existe, faire un diff (voir exercice suivant)
  if (oldVNode) {
    patch(container, oldVNode, vnode);
  } else {
    container.innerHTML = '';
    const domNode = createDOMNode(vnode);
    container.appendChild(domNode);
  }
}
```

---

## Partie 9 : Gérer les refs

```javascript
function setProps(element, props) {
  Object.entries(props).forEach(([key, value]) => {
    if (key === 'ref') {
      // Callback ref
      if (typeof value === 'function') {
        value(element);
      }
      // Object ref
      else if (value && typeof value === 'object') {
        value.current = element;
      }
    } else {
      setProp(element, key, value);
    }
  });
}
```

### Test

```javascript
let inputRef = null;

function Form() {
  return h('form', null,
    h('input', {
      type: 'text',
      ref: (el) => { inputRef = el; }
    }),
    h('button', {
      onClick: () => {
        inputRef.focus();
        inputRef.select();
      }
    }, 'Focus')
  );
}

render(Form(), root);
```

---

## Partie 10 : Code complet

```javascript
export function render(vnode, container) {
  container.innerHTML = '';
  const domNode = createDOMNode(vnode);
  if (domNode) {
    container.appendChild(domNode);
  }
}

function createDOMNode(vnode) {
  // Null/undefined
  if (vnode === null || vnode === undefined) {
    return null;
  }
  
  // Texte
  if (typeof vnode === 'string' || typeof vnode === 'number') {
    return document.createTextNode(String(vnode));
  }
  
  // Array (Fragment)
  if (Array.isArray(vnode)) {
    const fragment = document.createDocumentFragment();
    vnode.forEach(child => {
      const node = createDOMNode(child);
      if (node) fragment.appendChild(node);
    });
    return fragment;
  }
  
  // Élément
  const { type, props, children } = vnode;
  const element = document.createElement(type);
  
  // Props
  setProps(element, props);
  
  // Children
  children.forEach(child => {
    const node = createDOMNode(child);
    if (node) element.appendChild(node);
  });
  
  return element;
}

function setProps(element, props) {
  Object.entries(props).forEach(([key, value]) => {
    setProp(element, key, value);
  });
}

function setProp(element, key, value) {
  // Ref
  if (key === 'ref') {
    if (typeof value === 'function') {
      value(element);
    } else if (value) {
      value.current = element;
    }
  }
  // Events
  else if (key.startsWith('on')) {
    const eventName = key.substring(2).toLowerCase();
    element.addEventListener(eventName, value);
  }
  // ClassName
  else if (key === 'class' || key === 'className') {
    element.className = value;
  }
  // Style
  else if (key === 'style') {
    if (typeof value === 'string') {
      element.style.cssText = value;
    } else if (typeof value === 'object') {
      Object.assign(element.style, value);
    }
  }
  // Value
  else if (key === 'value') {
    element.value = value;
  }
  // Checked
  else if (key === 'checked') {
    element.checked = value;
  }
  // Boolean props
  else if (typeof value === 'boolean') {
    if (value) {
      element.setAttribute(key, '');
    } else {
      element.removeAttribute(key);
    }
  }
  // Autres
  else if (value !== null && value !== undefined) {
    element.setAttribute(key, value);
  }
}
```

---

## Récapitulatif

### Ce qu'on a appris

1. **render()** : transformer Virtual DOM → DOM réel
2. **createDOMNode()** : fonction récursive de création
3. **setProps()** : gérer tous les types de props
4. **Gestion des événements** : addEventListener
5. **Formulaires** : value, checked, onChange
6. **État et re-render** : setState déclenche render()

### Complexité

- **render()** : O(n) où n = nombre de nœuds
- Chaque nœud est visité une fois
- Création de DOM : O(1) par nœud

### Problème actuel

❌ Re-render complet à chaque changement
❌ Tous les événements sont re-créés
❌ Perd le focus des inputs

**Solution** : Algorithme de diff + patch (prochain exercice)

## Contraintes
- Durée estimée : 40 minutes

