# Exercice 3 - Fonction Render Simple

## Objectif
Créer une fonction récursive qui transforme un Virtual DOM en vrai DOM HTML.

## Principe

La fonction `render()` est le cœur de React :
- Elle prend un Virtual DOM (arbre d'objets)
- Elle crée le DOM réel (éléments HTML)
- Elle l'insère dans la page

C'est un **parcours d'arbre récursif** !

---

## Partie 1 : Render de base

```javascript
function render(vnode, container) {
  // Cas 1 : nœud texte
  if (typeof vnode === 'string' || typeof vnode === 'number') {
    const textNode = document.createTextNode(vnode);
    container.appendChild(textNode);
    return;
  }
  
  // Cas 2 : nœud élément
  const { type, props, children } = vnode;
  
  // Créer l'élément
  const element = document.createElement(type);
  
  // Ajouter les propriétés
  for (const [key, value] of Object.entries(props)) {
    element.setAttribute(key, value);
  }
  
  // Rendre les enfants récursivement
  for (const child of children) {
    render(child, element);
  }
  
  // Ajouter au container
  container.appendChild(element);
}
```

---

## Partie 2 : Tests

### Test 1 : Élément simple

```javascript
const vdom = {
  type: 'div',
  props: { class: 'container' },
  children: ['Hello World']
};

const root = document.getElementById('root');
render(vdom, root);
```

**Résultat dans le DOM** :
```html
<div class="container">Hello World</div>
```

### Test 2 : Éléments imbriqués

```javascript
const vdom = {
  type: 'div',
  props: { class: 'container' },
  children: [
    {
      type: 'h1',
      props: {},
      children: ['Mon Titre']
    },
    {
      type: 'p',
      props: {},
      children: ['Mon paragraphe']
    }
  ]
};

render(vdom, root);
```

**Résultat** :
```html
<div class="container">
  <h1>Mon Titre</h1>
  <p>Mon paragraphe</p>
</div>
```

### Test 3 : Liste

```javascript
const items = ['Item 1', 'Item 2', 'Item 3'];

const vdom = {
  type: 'ul',
  props: { class: 'list' },
  children: items.map(text => ({
    type: 'li',
    props: {},
    children: [text]
  }))
};

render(vdom, root);
```

---

## Partie 3 : Améliorer render()

### Gérer les événements

```javascript
function render(vnode, container) {
  if (typeof vnode === 'string' || typeof vnode === 'number') {
    container.appendChild(document.createTextNode(vnode));
    return;
  }
  
  const { type, props, children } = vnode;
  const element = document.createElement(type);
  
  // Gérer les props et événements
  for (const [key, value] of Object.entries(props)) {
    if (key.startsWith('on')) {
      // Event listener : onClick → click
      const eventName = key.substring(2).toLowerCase();
      element.addEventListener(eventName, value);
    } else if (key === 'className') {
      element.className = value;
    } else if (key === 'style' && typeof value === 'object') {
      Object.assign(element.style, value);
    } else {
      element.setAttribute(key, value);
    }
  }
  
  // Rendre les enfants
  for (const child of children) {
    render(child, element);
  }
  
  container.appendChild(element);
}
```

### Test avec événements

```javascript
const vdom = {
  type: 'button',
  props: {
    className: 'btn btn-primary',
    onClick: () => alert('Cliqué !')
  },
  children: ['Cliquer']
};

render(vdom, root);
```

---

## Partie 4 : Fonction h() + render()

Combiner les deux pour créer notre mini-React :

```javascript
function h(type, props, ...children) {
  return {
    type,
    props: props || {},
    children: children.flat()
  };
}

function render(vnode, container) {
  // Clear container
  container.innerHTML = '';
  
  // Render
  renderNode(vnode, container);
}

function renderNode(vnode, container) {
  if (typeof vnode === 'string' || typeof vnode === 'number') {
    container.appendChild(document.createTextNode(vnode));
    return;
  }
  
  const { type, props, children } = vnode;
  const element = document.createElement(type);
  
  // Props
  for (const [key, value] of Object.entries(props)) {
    if (key.startsWith('on')) {
      const eventName = key.substring(2).toLowerCase();
      element.addEventListener(eventName, value);
    } else if (key === 'className') {
      element.className = value;
    } else if (key === 'style' && typeof value === 'object') {
      Object.assign(element.style, value);
    } else {
      element.setAttribute(key, value);
    }
  }
  
  // Children
  for (const child of children) {
    renderNode(child, element);
  }
  
  container.appendChild(element);
}
```

### Exemple complet

```javascript
const App = h('div', { className: 'app' },
  h('h1', {}, 'Ma Todo List'),
  h('ul', {},
    h('li', {}, 'Faire les courses'),
    h('li', {}, 'Coder en JS'),
    h('li', {}, 'Apprendre les algos')
  ),
  h('button', { 
    onClick: () => console.log('Ajouté !'),
    className: 'btn'
  }, 'Ajouter')
);

const root = document.getElementById('root');
render(App, root);
```

---

## Partie 5 : Créer des composants

```javascript
function Button({ text, onClick }) {
  return h('button', { 
    className: 'btn btn-primary',
    onClick 
  }, text);
}

function TodoItem({ text }) {
  return h('li', { className: 'todo-item' }, text);
}

function TodoList({ todos }) {
  return h('ul', { className: 'todo-list' },
    todos.map(todo => TodoItem({ text: todo }))
  );
}

function App() {
  const todos = ['Faire les courses', 'Coder', 'Étudier'];
  
  return h('div', { className: 'app' },
    h('h1', {}, 'Ma Todo List'),
    TodoList({ todos }),
    Button({ 
      text: 'Ajouter',
      onClick: () => console.log('Ajouté !')
    })
  );
}

render(App(), root);
```

---

## Partie 6 : Exercices pratiques

### Exercice 6.1 : Carte de profil

```javascript
function ProfileCard({ name, role, avatar, bio }) {
  return h('div', { className: 'card' },
    h('img', { src: avatar, alt: name }),
    h('h2', {}, name),
    h('p', { className: 'role' }, role),
    h('p', { className: 'bio' }, bio)
  );
}

const card = ProfileCard({
  name: 'Baptiste',
  role: 'Développeur',
  avatar: 'avatar.jpg',
  bio: 'Passionné de code'
});

render(card, root);
```

### Exercice 6.2 : Formulaire

```javascript
function Form() {
  return h('form', { 
    onSubmit: (e) => {
      e.preventDefault();
      console.log('Soumis !');
    }
  },
    h('div', { className: 'form-group' },
      h('label', {}, 'Nom :'),
      h('input', { type: 'text', name: 'name', placeholder: 'Votre nom' })
    ),
    h('div', { className: 'form-group' },
      h('label', {}, 'Email :'),
      h('input', { type: 'email', name: 'email', placeholder: 'Votre email' })
    ),
    h('button', { type: 'submit' }, 'Envoyer')
  );
}

render(Form(), root);
```

### Exercice 6.3 : Navigation

```javascript
function Nav({ links, currentPath }) {
  return h('nav', { className: 'navbar' },
    h('ul', {},
      links.map(link => 
        h('li', { 
          className: link.path === currentPath ? 'active' : ''
        },
          h('a', { 
            href: link.path,
            onClick: (e) => {
              e.preventDefault();
              console.log('Navigate to:', link.path);
            }
          }, link.text)
        )
      )
    )
  );
}

const nav = Nav({
  currentPath: '/about',
  links: [
    { path: '/home', text: 'Accueil' },
    { path: '/about', text: 'À propos' },
    { path: '/contact', text: 'Contact' }
  ]
});

render(nav, root);
```

---

## Partie 7 : Analyser la complexité

### Complexité de render()

```javascript
function render(vnode, container) {
  // Visiter tous les nœuds de l'arbre : O(n)
  // n = nombre de nœuds dans le Virtual DOM
}
```

- **Parcours** : on visite chaque nœud une fois → O(n)
- **Création DOM** : chaque nœud crée un élément → O(1) par nœud
- **Total** : O(n)

### Pourquoi c'est efficace ?

- Une seule passe sur l'arbre
- Pas de comparaison (pour l'instant)
- Création directe du DOM

---

## Partie 8 : Limites de cette approche

### Problème : Re-render complet

```javascript
let count = 0;

function Counter() {
  return h('div', {},
    h('p', {}, `Count: ${count}`),
    h('button', { 
      onClick: () => {
        count++;
        render(Counter(), root); // ❌ Recrée TOUT le DOM
      }
    }, 'Incrémenter')
  );
}

render(Counter(), root);
```

**Problème** : Chaque clic recrée tout le DOM, même ce qui n'a pas changé !

**Solution** : Algorithme de diff + patch (prochain exercice)

---

## Partie 9 : Créer un exemple complet

```html
<!DOCTYPE html>
<html>
<head>
  <style>
    .app {
      max-width: 600px;
      margin: 50px auto;
      font-family: sans-serif;
    }
    .btn {
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      background: #007bff;
      color: white;
    }
    .todo-item {
      padding: 10px;
      margin: 5px 0;
      background: #f5f5f5;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div id="root"></div>
  
  <script>
    // Votre code h() et render() ici
    
    // Application
    function App() {
      return h('div', { className: 'app' },
        h('h1', {}, '🚀 Mini React'),
        h('p', {}, 'Un exemple de Virtual DOM fait maison'),
        h('div', {},
          h('button', { 
            className: 'btn',
            onClick: () => alert('Hello !')
          }, 'Dire bonjour')
        )
      );
    }
    
    render(App(), document.getElementById('root'));
  </script>
</body>
</html>
```

---

## Récapitulatif

### Ce qu'on a appris

1. **render()** = parcours récursif d'arbre
2. Virtual DOM → DOM réel
3. Gestion des props et événements
4. Création de composants
5. Complexité O(n)

### Lien avec le cours

- **Récursivité** : render appelle render sur les enfants
- **Arbres** : parcours en profondeur
- **Complexité** : O(n) linéaire

### Prochaine étape

Dans le prochain exercice :
- Algorithme de **diff** pour comparer deux Virtual DOM
- Algorithme de **patch** pour mettre à jour seulement ce qui change
- Optimisation des performances

## Contraintes
- Utilisez la récursivité
- Durée estimée : 20 minutes

