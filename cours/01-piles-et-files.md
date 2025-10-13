# Les Piles et les Files - Structures de données fondamentales

## Table des matières
1. [Les Piles (Stack)](#les-piles-stack)
2. [Les Files (Queue)](#les-files-queue)
3. [Comparaison Pile vs File](#comparaison-pile-vs-file)
4. [Exemples dans la vie courante](#exemples-dans-la-vie-courante)
5. [Exemples en informatique](#exemples-en-informatique)
6. [Exemples en développement web](#exemples-en-développement-web)

---

## Les Piles (Stack)

### Principe LIFO

**LIFO = Last In, First Out** (Dernier Entré, Premier Sorti)

Comme une pile d'assiettes :
- Vous ajoutez une assiette au sommet
- Vous retirez l'assiette du sommet
- Vous ne pouvez pas retirer une assiette au milieu sans tout démonter

### Opérations principales

| Opération | Description | Complexité |
|-----------|-------------|------------|
| `push(x)` | Ajouter un élément au sommet | O(1) |
| `pop()` | Retirer et retourner l'élément du sommet | O(1) |
| `peek()` / `top()` | Voir l'élément du sommet sans le retirer | O(1) |
| `isEmpty()` | Vérifier si la pile est vide | O(1) |
| `size()` | Obtenir le nombre d'éléments | O(1) |

### Caractéristiques importantes

**Point d'accès unique** : On ne peut ajouter et retirer des éléments que par le sommet. Impossible d'accéder directement à un élément au milieu de la pile.
**Ordre inversé** : Si vous ajoutez 1, 2, 3 dans une pile, vous les retirerez dans l'ordre 3, 2, 1.
**Opérations constantes** : Toutes les opérations se font en temps constant O(1) car on travaille toujours au sommet.

### Avantages

- **Simplicité** : Facile à comprendre et implémenter
- **Performance** : Toutes les opérations en O(1) (temps constant)
- **Prévisibilité** : On sait toujours quel élément sera retiré (celui du sommet)
- **Gestion mémoire** : Naturellement adapté aux allocations/désallocations
- **Annulation** : Parfait pour mémoriser des actions et revenir en arrière

### Inconvénients

- **Accès limité** : On ne peut accéder qu'au sommet
- **Ordre strict** : Impossible d'accéder aux éléments du milieu ou du bas sans dépiler
- **Stack overflow** : Taille limitée en mémoire (notamment pour la call stack des fonctions)
- **Pas d'ordre chronologique** : L'ordre de sortie est inverse de l'ordre d'entrée

---

## Les Files (Queue)

### Principe FIFO

**FIFO = First In, First Out** (Premier Entré, Premier Sorti)

Comme une file d'attente au supermarché :
- Les gens arrivent à la fin de la file
- Le premier arrivé est le premier servi
- Pas de resquille !

### Opérations principales

| Opération | Description | Complexité |
|-----------|-------------|------------|
| `enqueue(x)` | Ajouter un élément à la fin | O(1) |
| `dequeue()` | Retirer et retourner l'élément du début | O(1)* |
| `front()` / `peek()` | Voir le premier élément sans le retirer | O(1) |
| `isEmpty()` | Vérifier si la file est vide | O(1) |
| `size()` | Obtenir le nombre d'éléments | O(1) |

*avec une implémentation optimisée (liste chaînée ou circular buffer)

**ttention** : Avec un tableau simple, `dequeue()` peut être O(n) car il faut décaler tous les éléments !

### Caractéristiques importantes

**Deux points d'accès** : On ajoute à la fin (rear) et on retire du début (front). L'accès au milieu n'est pas possible.
**Ordre préservé** : Si vous ajoutez 1, 2, 3 dans une file, vous les retirerez dans l'ordre 1, 2, 3.
**Fair scheduling** : Tout le monde attend son tour, pas de "passe-droit".

### Avantages

- **Équité** : Premier arrivé, premier servi (fair scheduling)
- **Ordre préservé** : Maintient l'ordre chronologique d'arrivée
- **Naturel** : Correspond à beaucoup de processus réels (files d'attente, messagerie...)
- **Buffering** : Idéal pour gérer des flux de données asynchrones
- **Prévisibilité** : On sait qui sera traité en premier

### Inconvénients

- **Accès limité** : Accès seulement au début et à la fin
- **Implémentation** : Plus complexe qu'une pile pour être efficace en O(1)
- **Latence** : Les derniers arrivés peuvent attendre longtemps si la file est longue
- **Pas de priorité** : Tout le monde attend son tour (sauf avec une priority queue)

---

## Comparaison Pile vs File

### Tableau comparatif

| Critère | Pile (Stack) | File (Queue) |
|---------|--------------|--------------|
| **Principe** | LIFO | FIFO |
| **Analogie** | Pile d'assiettes | File d'attente |
| **Accès** | Sommet uniquement | Début et fin |
| **Ordre de sortie** | Inverse de l'entrée | Identique à l'entrée |
| **Use case principal** | Retour en arrière | Ordonnancement |
| **Complexité ajout** | O(1) | O(1) |
| **Complexité retrait** | O(1) | O(1) ou O(n)* |

*O(n) avec array simple, O(1) avec liste chaînée

### Quand utiliser une Pile ?

**Utiliser une pile quand** :
- Vous devez **annuler** des actions (undo)
- Vous devez **revenir en arrière** (backtracking)
- Vous devez **inverser** l'ordre
- Vous gérez des **appels de fonctions** (récursion)
- Vous parsez des **expressions imbriquées** (parenthèses, XML)

### Quand utiliser une File ?

**Utiliser une file quand** :
- Vous devez traiter dans **l'ordre d'arrivée**
- Vous gérez des **tâches asynchrones**
- Vous faites du **buffering** de données
- Vous implémentez un **scheduler**
- Vous gérez des **événements** dans l'ordre

### Exemple de comparaison

Imaginons qu'on ajoute les nombres 1, 2, 3, 4, 5 dans chaque structure :

**Avec une PILE (Stack)** :
```
Ajout : push(1), push(2), push(3), push(4), push(5)

    5
    4
    3
    2
    1
  -----

Retrait : pop() → 5, pop() → 4, pop() → 3, pop() → 2, pop() → 1
Résultat : 5, 4, 3, 2, 1 (ordre INVERSÉ)
```

**Avec une FILE (Queue)** :
```
Ajout : enqueue(1), enqueue(2), enqueue(3), enqueue(4), enqueue(5)

Front → [ 1 ] → [ 2 ] → [ 3 ] → [ 4 ] → [ 5 ] → Rear

Retrait : dequeue() → 1, dequeue() → 2, dequeue() → 3, dequeue() → 4, dequeue() → 5
Résultat : 1, 2, 3, 4, 5 (MÊME ordre)
```

**Conclusion** : Avec une pile, l'ordre est inversé. Avec une file, l'ordre est préservé.

---

## Exemples dans la vie courante

### Pile (Stack) - Exemples quotidiens

#### 1. Pile d'assiettes dans une cuisine
Après avoir fait la vaisselle :
- Vous **empilez** les assiettes propres les unes sur les autres
- Quand vous avez besoin d'une assiette, vous prenez celle **du dessus**
- La **dernière assiette lavée** sera la **première utilisée**
- Les assiettes du bas attendent plus longtemps

**Principe LIFO** : Last In, First Out

#### 2. Pile de livres sur un bureau
Pendant vos études :
- Vous recevez un livre, vous le posez **sur la pile**
- Vous prenez toujours le livre **du dessus** pour travailler
- Pour accéder à un livre en dessous, vous devez **retirer** tous ceux au-dessus
- L'ordre de lecture est **inverse** de l'ordre d'arrivée

#### 3. Historique de navigation web
Dans votre navigateur :
- Vous visitez des pages : Accueil → Blog → Article → Contact
- Bouton "Retour" : Contact → Article → Blog → Accueil
- Vous **revenez en arrière** dans l'ordre inverse de la navigation
- C'est comme "dépiler" votre historique

#### 4. Pile d'assiettes dans un restaurant buffet
Au buffet :
- Le personnel **empile** les assiettes propres
- Les clients prennent l'assiette **du dessus**
- Les assiettes du bas peuvent rester longtemps inutilisées
- Si le personnel ajoute des assiettes, elles seront prises en premier

#### 5. Édition de texte (Ctrl+Z)
Quand vous tapez du texte :
- Chaque action est **mémorisée** dans une pile
- "Annuler" (Ctrl+Z) retire la **dernière action**
- Vous **revenez en arrière** action par action
- L'ordre est inversé par rapport à vos actions

### File (Queue) - Exemples quotidiens

#### 1. File d'attente au supermarché
À la caisse :
- Les clients **arrivent** et se placent **à la fin** de la file
- Le **premier arrivé** est **servi en premier**
- Tout le monde **attend son tour** dans l'ordre
- Pas de resquille ! (normalement...)

**Principe FIFO** : First In, First Out

#### 2. File d'attente à la banque avec tickets
Au guichet :
- Vous prenez un **ticket numéroté** (45, 46, 47...)
- Les numéros sont **appelés dans l'ordre**
- Le ticket 45 passe avant le 46, qui passe avant le 47
- Le système est **équitable** : premier arrivé, premier servi

#### 3. Imprimante au bureau
Quand plusieurs personnes impriment :
- Les documents sont envoyés à l'imprimante dans un certain ordre
- L'imprimante les traite **un par un** dans l'ordre d'arrivée
- Si vous envoyez un document en 3ème, vous attendez que les 2 premiers soient imprimés
- Impossible de "passer devant"

#### 4. Service client par téléphone
Quand vous appelez un service client :
- Message : "Vous êtes le **5ème** dans la file d'attente"
- Les appels sont traités dans **l'ordre d'arrivée**
- Vous entendez : "4ème... 3ème... 2ème... 1er... Un conseiller vous répond"
- **Patience** : il faut attendre son tour

#### 5. File d'attente au cinéma
Pour acheter des billets :
- Les gens **se rangent** dans l'ordre d'arrivée
- Le premier dans la file achète ses billets en premier
- Si vous arrivez en dernier, vous attendez que tout le monde passe
- Le système est **juste** : pas de privilège

#### 6. Préparation de commandes dans un restaurant
En cuisine :
- Les commandes arrivent dans un ordre : Table 1, Table 5, Table 3
- Le chef prépare les plats dans l'**ordre d'arrivée** des commandes
- Table 1 est servie en premier, puis Table 5, puis Table 3
- Même si Table 3 a commandé un plat simple, elle attend son tour

### Différence clé

**Pile** : "Dernier arrivé, premier servi" → Ordre **inversé**
- Exemple : Empiler des assiettes, prendre celle du dessus

**File** : "Premier arrivé, premier servi" → Ordre **préservé**
- Exemple : File d'attente au supermarché

**Astuce mnémotechnique** :
- **Pile** = revenir en arrière, annuler, inverser
- **File** = attendre son tour, ordre chronologique, équité

---

## Exemples en informatique générale

### Pile (Stack)

#### 1. Call Stack (Pile d'appels de fonctions)

Quand votre programme appelle des fonctions :
- **Fonction A** appelle **Fonction B**
- **Fonction B** appelle **Fonction C**
- Les appels sont **empilés** : [A, B, C]
- Quand **C termine**, on **dépile** et on revient à B
- Quand **B termine**, on **dépile** et on revient à A
- Ordre d'exécution : A → B → C → fin C → fin B → fin A

**Pourquoi une pile ?** Car on revient toujours à la fonction qui a appelé.

#### 2. Annuler/Refaire (Undo/Redo)

Dans un éditeur de texte :
- Chaque action (taper, supprimer, copier) est **empilée**
- **Ctrl+Z (Undo)** : dépile la dernière action et l'annule
- Les actions annulées vont dans une **pile de redo**
- **Ctrl+Y (Redo)** : dépile de la pile redo et réapplique l'action

**Deux piles** : une pour undo, une pour redo

#### 3. Validation de parenthèses/balises

Pour vérifier si les parenthèses sont équilibrées `((a + b) * c)` :
- Quand on voit une **parenthèse ouvrante** `(` → on l'empile
- Quand on voit une **parenthèse fermante** `)` → on dépile et on vérifie la correspondance
- À la fin, la pile doit être **vide**

**Application** : Vérifier la validité du HTML, XML, JSON

#### 4. Parcours en profondeur (DFS - Depth First Search)

Pour explorer un graphe ou un arbre en profondeur :
- On commence par un nœud et on l'empile
- On visite un voisin et on l'empile
- On continue **en profondeur** jusqu'au bout
- Quand on est bloqué, on **dépile** et on explore une autre branche

**Analogie** : Explorer un labyrinthe en marquant son chemin

#### 5. Évaluation d'expressions mathématiques

Pour calculer une expression comme `(3 + 4) * 2` :
- On utilise une pile pour stocker les valeurs et opérateurs
- Notation polonaise inverse (RPN) : `3 4 + 2 *`
- On empile les nombres, quand on voit un opérateur on dépile et calcule

**Calculatrices** : Certaines calculatrices utilisent ce principe

### File (Queue)

#### 1. Gestion de tâches asynchrones

Dans un système de traitement de tâches :
- Les tâches arrivent et sont **mises en file d'attente**
- Elles sont traitées **une par une** dans l'ordre d'arrivée
- Pendant qu'une tâche s'exécute, les autres **attendent**

**Exemple** : Envoi d'emails, génération de PDFs, traitement d'images

#### 2. Système de messagerie

Dans une application de chat :
- Les messages arrivent et sont **enfilés**
- Ils sont affichés dans **l'ordre d'envoi**
- Personne ne passe devant

**Fair scheduling** : Tout le monde est traité équitablement

#### 3. Parcours en largeur (BFS - Breadth First Search)

Pour explorer un graphe ou un arbre niveau par niveau :
- On commence par la racine
- On explore tous ses voisins **avant** d'aller plus profond
- On utilise une **file** pour maintenir l'ordre

**Analogie** : Explorer un arbre généalogique génération par génération

#### 4. Gestion d'événements

Dans un système d'événements :
- Les événements (clics, touches clavier) sont **enfilés**
- Ils sont traités **dans l'ordre** par la boucle d'événements
- Pas de "saut" dans le traitement

**Event loop** : Cœur des systèmes asynchrones

---

## Exemples en développement web

### Pile (Stack) dans le Web

#### 1. Historique de navigation (Browser Back/Forward)

**Fonctionnement** :
- Vous visitez : Accueil → Blog → Article → Contact
- Une **pile "back"** mémorise : [Accueil, Blog, Article]
- Bouton "Retour" : dépile Article → vous êtes sur Blog
- Cette page va dans une **pile "forward"**
- Bouton "Avancer" : redépile de forward

**Deux piles** : une pour revenir en arrière, une pour avancer

#### 2. React Hooks et Call Stack

**Context** :
- React doit suivre **quel composant** appelle quel hook
- Utilise une **pile d'exécution** pour savoir où on est
- Les hooks sont appelés dans un **ordre strict**
- Si l'ordre change, React perd le fil

**Règle** : Ne jamais mettre de hooks dans des conditions (sinon la pile change)

#### 3. Middleware Express (Stack de middlewares)

**Fonctionnement** :
- Vous définissez des middlewares (authentification, logs, validation...)
- Ils sont **empilés** dans l'ordre de déclaration
- Quand une requête arrive, elle traverse la pile
- Chaque middleware peut **passer au suivant** ou **arrêter**

**Exemple d'exécution** :
```
Requête → Middleware Auth → Middleware Logs → Route → Réponse
```

Si l'auth échoue, on ne passe jamais aux suivants (dépilage)

#### 4. Parsing HTML/XML

**Vérification de balises** :
- Quand on voit `<div>` → on l'**empile**
- Quand on voit `</div>` → on **dépile** et on vérifie que ça correspond
- Si on voit `</span>` mais qu'on a `<div>` au sommet → **erreur !**
- À la fin, la pile doit être **vide** (toutes les balises fermées)

**Application** : Validateur HTML, éditeur de code

#### 5. Redux DevTools (Time Travel Debugging)

**Concept** :
- Chaque **action Redux** est stockée dans une pile
- Bouton "Undo" : dépile la dernière action et revient à l'état précédent
- Bouton "Redo" : réapplique l'action
- Vous pouvez **remonter dans le temps** pour débugger

**Deux piles** : past (états passés) et future (états après undo)

### File (Queue) dans le Web

#### 1. Event Loop et Callback Queue (JavaScript)

**Fonctionnement de JavaScript** :
- Le code synchrone s'exécute immédiatement
- Les callbacks (setTimeout, événements) vont dans une **callback queue**
- Les Promises vont dans une **microtask queue** (prioritaire)
- L'**event loop** traite les files dans l'ordre FIFO

**Exemple** :
```
Code : console.log('1') → setTimeout(...) → Promise → console.log('4')

Exécution :
1. "1" (synchrone)
2. "4" (synchrone)
3. Promise (microtask queue)
4. setTimeout (callback queue)

Ordre FIFO respecté dans chaque queue !
```

#### 2. Service Worker et Message Queue

**Communication avec Service Worker** :
- Vous envoyez des messages au Service Worker
- Ils sont **mis en file d'attente**
- Traités **dans l'ordre d'envoi**
- Garantit que les messages ne se perdent pas et arrivent dans l'ordre

**Cas d'usage** : Synchronisation offline, notifications push

#### 3. Système de notifications toast

**Affichage séquentiel** :
- Plusieurs notifications arrivent en même temps
- Elles sont **enfilées**
- Affichées **une par une** pendant 3 secondes chacune
- La suivante n'apparaît que quand la précédente disparaît

**Pourquoi ?** Pour ne pas surcharger l'écran et garantir la lisibilité

#### 4. Rate Limiting (Limitation de requêtes)

**Protection API** :
- Limite : maximum 5 requêtes par seconde
- Si vous envoyez 10 requêtes d'un coup
- Les 5 premières passent immédiatement
- Les 5 suivantes sont **mises en file d'attente**
- Traitées après 1 seconde

**File d'attente** : évite de rejeter les requêtes, les met en attente

#### 5. Job Queue (Tâches en arrière-plan)

**Exemple : Envoi d'emails** :
- 1000 utilisateurs s'inscrivent en même temps
- Impossible d'envoyer 1000 emails instantanément
- On crée 1000 **jobs** dans une queue (Bull, BullMQ)
- Un **worker** traite les jobs **un par un** dans l'ordre

**Avantages** :
- Ne bloque pas le serveur
- Traitement asynchrone
- Réessai en cas d'échec
- Ordre garanti

#### 6. WebSocket Message Queue

**Gestion de la connexion** :
- Vous envoyez des messages WebSocket
- Mais la connexion n'est pas encore établie
- Les messages sont **stockés dans une file**
- Dès que connecté, tous les messages sont **envoyés dans l'ordre**

**Garantie** : Aucun message perdu, ordre préservé

#### 7. Animation Queue

**Animations séquentielles** :
- Vous voulez animer 3 éléments les uns après les autres
- Animation 1 → Animation 2 → Animation 3
- Chaque animation attend que la précédente soit **terminée**
- Utilisation d'une file pour maintenir l'ordre

**Alternative** : Avec des Promise chains, mais la file est plus claire

---

## Frameworks et Bibliothèques

### Piles dans les frameworks

| Framework/Lib | Utilisation de Pile |
|---------------|---------------------|
| **React** | Call stack pour les hooks, Error boundaries |
| **Redux** | Time travel debugging (undo/redo) |
| **Vue.js** | Watchers et computed properties stack |
| **Angular** | Change detection stack |
| **Express** | Middleware stack |

### Files dans les frameworks

| Framework/Lib | Utilisation de File |
|---------------|---------------------|
| **Node.js** | Event loop, callback queue |
| **RxJS** | Observable streams (queue de valeurs) |
| **Bull/BullMQ** | Job queues pour background tasks |
| **Socket.io** | Message queues |
| **Kafka** | Message broker (distributed queue) |

---

## Résumé et Mémo

### Pile (Stack) - LIFO : "Dernier entré, premier sorti"

**Principe** : Comme une pile d'assiettes, on accède qu'au sommet

**Quand utiliser ?**
- Revenir en arrière (undo/redo, navigation)
- Inverser un ordre
- Mémoriser un chemin parcouru
- Vérifier des paires (parenthèses, balises)
- Gérer des appels de fonctions (récursion)

**Exemples concrets** :
- Bouton "Retour" du navigateur
- Ctrl+Z / Ctrl+Y dans un éditeur
- Call stack des fonctions
- Validation de `((a + b) * c)`
- Redux DevTools time travel

**Caractéristique** : L'ordre de sortie est **inversé** par rapport à l'ordre d'entrée

### File (Queue) - FIFO : "Premier entré, premier sorti"

**Principe** : Comme une file d'attente, on respecte l'ordre d'arrivée

**Quand utiliser ?**
- Traiter dans l'ordre d'arrivée
- Garantir l'équité (premier arrivé, premier servi)
- Gérer des tâches asynchrones
- Bufferiser des données
- Ordonnancer des événements

**Exemples concrets** :
- File d'envoi d'emails
- Event loop de JavaScript
- Système de notifications
- Rate limiter d'API
- Spooler d'imprimante

**Caractéristique** : L'ordre de sortie est **identique** à l'ordre d'entrée

---

### Tableau de décision rapide

| Besoin | Structure à utiliser |
|--------|---------------------|
| Annuler des actions | **Pile** |
| Revenir en arrière | **Pile** |
| Vérifier des paires (parenthèses) | **Pile** |
| Inverser un ordre | **Pile** |
| Traiter dans l'ordre d'arrivée | **File** |
| Garantir l'équité | **File** |
| Gérer des tâches asynchrones | **File** |
| Parcours en profondeur (DFS) | **Pile** |
| Parcours en largeur (BFS) | **File** |

---

## Pile ou File ?

Pour chaque cas d'usage ci-dessous, déterminez s'il faut utiliser une **Pile (Stack)** ou une **File (Queue)**.

- 1. **Système de gestion de requêtes HTTP** : Les requêtes arrivent et doivent être traitées équitablement.
- 2. **Éditeur de texte** : Implémenter la fonctionnalité "Annuler la dernière modification".
- 3. **Calculatrice** : Évaluer l'expression mathématique `(5 + 3) * 2` en vérifiant les parenthèses.
- 4. **Serveur d'impression** : Plusieurs utilisateurs envoient des documents à imprimer.
- 5. **Navigateur web** : Implémenter les boutons "Page précédente" et "Page suivante".
- 6. **Système de tickets support** : Les clients ouvrent des tickets et doivent être traités dans l'ordre.
- 7. **Fonction récursive** : Le langage doit mémoriser où revenir après chaque appel de fonction.
- 8. **Parser JSON** : Vérifier que toutes les accolades `{}` et crochets `[]` sont bien fermés.
- 9. **Traitement de vidéos** : 100 vidéos doivent être encodées, une par une, dans l'ordre de soumission.
- 10. **Éditeur de code** : Détecter les balises HTML mal fermées comme `<div><span></div>`.
- 11. **Application de chat** : Afficher les messages dans l'ordre où ils ont été envoyés.
- 12. **Maze solver (résolution de labyrinthe)** : Explorer les chemins en profondeur jusqu'à trouver la sortie.
- 13. **Système de notifications toast** : Afficher les notifications une par une pendant 3 secondes chacune.
- 14. **Redux time-travel** : Pouvoir revenir à un état précédent de l'application.
- 15. **File d'attente de téléchargements** : Télécharger les fichiers dans l'ordre où ils ont été demandés.
- 16. **Auto-complétion** : Mémoriser les dernières recherches de l'utilisateur pour les suggérer.
- 17. **Playlist musicale** : Lire les chansons dans l'ordre d'ajout à la playlist.
- 18. **Ctrl+Z / Ctrl+Shift+Z dans Photoshop** : Annuler et refaire des actions.
- 19. **Système de cache LRU (Least Recently Used)** : Garder les éléments les plus récemment utilisés.
- 20. **Breadcrumb navigation** : Afficher le chemin parcouru (Accueil > Produits > Détail).

