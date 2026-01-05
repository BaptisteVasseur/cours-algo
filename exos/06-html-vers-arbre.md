# Exercice 2 - Parser du HTML vers un Arbre

## Objectif
Convertir du HTML (string) en Virtual DOM (arbre d'objets).

## Contexte

Quand on écrit du JSX, le compilateur le transforme en Virtual DOM.
Dans cet exercice, on va créer un parseur simple pour comprendre ce processus.

---

## Partie 1 : Parsing simple (sans attributs)

### HTML → Virtual DOM

```javascript
function parseHTML(html) {
  // Version simplifiée : un seul élément
  
  // Extraire le tag
  const tagMatch = html.match(/<(\w+)>(.*?)<\/\1>/s);
  
  if (!tagMatch) {
    return html; // Texte simple
  }
  
  const [, type, content] = tagMatch;
  
  return {
    type,
    props: {},
    children: [content]
  };
}
```

### Tests

```javascript
console.log(parseHTML('<div>Hello</div>'));
// { type: 'div', props: {}, children: ['Hello'] }

console.log(parseHTML('<h1>Titre</h1>'));
// { type: 'h1', props: {}, children: ['Titre'] }
```

---

## Partie 2 : Parser avec attributs

```javascript
function parseHTMLWithProps(html) {
  const tagMatch = html.match(/<(\w+)([^>]*)>(.*?)<\/\1>/s);
  
  if (!tagMatch) {
    return html.trim();
  }
  
  const [, type, attributesStr, content] = tagMatch;
  
  // Parser les attributs
  const props = {};
  const attrRegex = /(\w+)="([^"]*)"/g;
  let attrMatch;
  
  while ((attrMatch = attrRegex.exec(attributesStr)) !== null) {
    const [, key, value] = attrMatch;
    props[key] = value;
  }
  
  return {
    type,
    props,
    children: [content.trim()]
  };
}
```

### Tests

```javascript
console.log(parseHTMLWithProps('<div class="container">Hello</div>'));
// { type: 'div', props: { class: 'container' }, children: ['Hello'] }

console.log(parseHTMLWithProps('<button id="btn" class="primary">Click</button>'));
// { type: 'button', props: { id: 'btn', class: 'primary' }, children: ['Click'] }
```

---

## Partie 3 : Parser récursif (éléments imbriqués)

```javascript
function parseHTMLRecursive(html) {
  html = html.trim();
  
  // Cas de base : texte simple
  if (!html.startsWith('<')) {
    return html;
  }
  
  // Extraire le premier tag
  const tagMatch = html.match(/^<(\w+)([^>]*)>/);
  if (!tagMatch) return html;
  
  const [fullTag, type, attributesStr] = tagMatch;
  
  // Parser les props
  const props = {};
  const attrRegex = /(\w+)="([^"]*)"/g;
  let attrMatch;
  
  while ((attrMatch = attrRegex.exec(attributesStr)) !== null) {
    props[attrMatch[1]] = attrMatch[2];
  }
  
  // Trouver le tag de fermeture correspondant
  const closeTag = `</${type}>`;
  let depth = 1;
  let pos = fullTag.length;
  
  while (depth > 0 && pos < html.length) {
    if (html.substr(pos, type.length + 2) === `<${type}`) {
      depth++;
      pos += type.length + 2;
    } else if (html.substr(pos, closeTag.length) === closeTag) {
      depth--;
      if (depth === 0) break;
      pos += closeTag.length;
    } else {
      pos++;
    }
  }
  
  const content = html.substring(fullTag.length, pos);
  
  // Parser les enfants récursivement
  const children = parseChildren(content);
  
  return {
    type,
    props,
    children
  };
}

function parseChildren(html) {
  html = html.trim();
  if (!html) return [];
  
  const children = [];
  let current = '';
  let i = 0;
  
  while (i < html.length) {
    if (html[i] === '<') {
      // Sauvegarder le texte accumulé
      if (current.trim()) {
        children.push(current.trim());
        current = '';
      }
      
      // Parser l'élément
      const tagMatch = html.substr(i).match(/^<(\w+)[^>]*>/);
      if (tagMatch) {
        const type = tagMatch[1];
        const closeTag = `</${type}>`;
        
        let depth = 1;
        let end = i + tagMatch[0].length;
        
        while (depth > 0 && end < html.length) {
          if (html.substr(end, type.length + 2) === `<${type}`) {
            depth++;
          } else if (html.substr(end, closeTag.length) === closeTag) {
            depth--;
            if (depth === 0) {
              end += closeTag.length;
              break;
            }
          }
          end++;
        }
        
        const elementHTML = html.substring(i, end);
        children.push(parseHTMLRecursive(elementHTML));
        i = end;
      } else {
        current += html[i];
        i++;
      }
    } else {
      current += html[i];
      i++;
    }
  }
  
  if (current.trim()) {
    children.push(current.trim());
  }
  
  return children;
}
```

### Tests

```javascript
const html1 = `
  <div class="container">
    <h1>Titre</h1>
    <p>Paragraphe</p>
  </div>
`;

console.log(JSON.stringify(parseHTMLRecursive(html1), null, 2));

const html2 = `
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
  </ul>
`;

console.log(JSON.stringify(parseHTMLRecursive(html2), null, 2));
```

---

## Partie 4 : Version simplifiée avec DOMParser

En pratique, on utilise le DOMParser du navigateur :

```javascript
function htmlToVDOM(html) {
  const parser = new DOMParser();
  const doc = parser.parseFromString(html, 'text/html');
  
  return domNodeToVNode(doc.body.firstChild);
}

function domNodeToVNode(node) {
  // Cas 1 : nœud texte
  if (node.nodeType === Node.TEXT_NODE) {
    return node.textContent.trim();
  }
  
  // Cas 2 : nœud élément
  if (node.nodeType === Node.ELEMENT_NODE) {
    const type = node.tagName.toLowerCase();
    const props = {};
    
    // Récupérer les attributs
    for (const attr of node.attributes) {
      props[attr.name] = attr.value;
    }
    
    // Récupérer les enfants récursivement
    const children = Array.from(node.childNodes)
      .map(domNodeToVNode)
      .filter(child => child !== ''); // Retirer les textes vides
    
    return { type, props, children };
  }
}
```

### Tests

```javascript
const html = `
  <div class="container" id="main">
    <h1>Titre</h1>
    <p>Paragraphe avec <strong>gras</strong></p>
    <ul>
      <li>Item 1</li>
      <li>Item 2</li>
    </ul>
  </div>
`;

const vdom = htmlToVDOM(html);
console.log(JSON.stringify(vdom, null, 2));
```

---

## Partie 5 : Virtual DOM → HTML

L'inverse : convertir un Virtual DOM en HTML string

```javascript
function vdomToHTML(vnode) {
  // Cas de base : texte
  if (typeof vnode === 'string') {
    return vnode;
  }
  
  const { type, props, children } = vnode;
  
  // Construire les attributs
  const attrsStr = Object.entries(props)
    .map(([key, value]) => `${key}="${value}"`)
    .join(' ');
  
  const openTag = attrsStr 
    ? `<${type} ${attrsStr}>`
    : `<${type}>`;
  
  // Construire les enfants récursivement
  const childrenHTML = children
    .map(child => vdomToHTML(child))
    .join('');
  
  return `${openTag}${childrenHTML}</${type}>`;
}
```

### Tests

```javascript
const vdom = {
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
};

console.log(vdomToHTML(vdom));
// <div class="container"><h1>Titre</h1><p>Paragraphe</p></div>
```

---

## Partie 6 : Pretty print HTML

Formatter le HTML avec indentation :

```javascript
function vdomToHTMLPretty(vnode, indent = 0) {
  const spaces = '  '.repeat(indent);
  
  // Cas de base : texte
  if (typeof vnode === 'string') {
    return `${spaces}${vnode}\n`;
  }
  
  const { type, props, children } = vnode;
  
  // Construire les attributs
  const attrsStr = Object.entries(props)
    .map(([key, value]) => `${key}="${value}"`)
    .join(' ');
  
  const openTag = attrsStr 
    ? `<${type} ${attrsStr}>`
    : `<${type}>`;
  
  // Si un seul enfant texte, format inline
  if (children.length === 1 && typeof children[0] === 'string') {
    return `${spaces}${openTag}${children[0]}</${type}>\n`;
  }
  
  // Sinon, format avec indentation
  let html = `${spaces}${openTag}\n`;
  
  for (const child of children) {
    html += vdomToHTMLPretty(child, indent + 1);
  }
  
  html += `${spaces}</${type}>\n`;
  
  return html;
}
```

### Test

```javascript
const vdom = {
  type: 'div',
  props: { class: 'container' },
  children: [
    { type: 'h1', props: {}, children: ['Titre'] },
    {
      type: 'ul',
      props: {},
      children: [
        { type: 'li', props: {}, children: ['Item 1'] },
        { type: 'li', props: {}, children: ['Item 2'] }
      ]
    }
  ]
};

console.log(vdomToHTMLPretty(vdom));
```

**Output** :
```html
<div class="container">
  <h1>Titre</h1>
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
</div>
```

---

## Partie 7 : Exercices

### Exercice 7.1 : Parser du Markdown simplifié

```javascript
function markdownToVDOM(markdown) {
  // # Titre → <h1>Titre</h1>
  // **gras** → <strong>gras</strong>
  // *italique* → <em>italique</em>
  
  // Votre code ici
}

const md = '# Mon titre\nDu texte avec **gras** et *italique*';
console.log(markdownToVDOM(md));
```

### Exercice 7.2 : Extraire tous les textes

```javascript
function extractAllText(vnode) {
  // Retourner tout le texte contenu dans l'arbre
  
  // Votre code ici
}

const vdom = {
  type: 'div',
  props: {},
  children: [
    { type: 'h1', props: {}, children: ['Titre'] },
    { type: 'p', props: {}, children: ['Paragraphe'] }
  ]
};

console.log(extractAllText(vdom)); // "Titre Paragraphe"
```

### Exercice 7.3 : Compter les éléments d'un type

```javascript
function countElements(vnode, targetType) {
  // Compter combien d'éléments d'un type donné
  
  // Votre code ici
}

console.log(countElements(vdom, 'div')); // 1
console.log(countElements(vdom, 'p'));   // 1
```

---

## Récapitulatif

1. **HTML → Virtual DOM** : parsing de string vers arbre
2. **Virtual DOM → HTML** : sérialisation d'arbre vers string
3. **Manipulation d'arbres** : extraction, comptage, transformation
4. **Lien avec la récursivité** : parcours d'arbre

### Dans React

```jsx
// JSX
<div className="container">
  <h1>Titre</h1>
</div>

// Est compilé en
React.createElement('div', { className: 'container' },
  React.createElement('h1', {}, 'Titre')
)

// Qui crée un Virtual DOM
{
  type: 'div',
  props: { className: 'container' },
  children: [
    { type: 'h1', props: {}, children: ['Titre'] }
  ]
}
```

## Contraintes
- Utilisez la récursivité
- Durée estimée : 40 minutes

