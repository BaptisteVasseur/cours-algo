class TreeNode {
  constructor(value) {
    this.value = value;
    this.left = null;
    this.right = null;
  }
}

class BinaryTree {
  constructor() {
    this.root = null;
  }

  insert(value) {
    const newNode = new TreeNode(value);
    
    if (this.root === null) {
      this.root = newNode;
      return;
    }
    
    function insertNode(node, newNode) {
      if (newNode.value < node.value) {
        if (node.left === null) {
          node.left = newNode;
        } else {
          insertNode(node.left, newNode);
        }
      } else if (newNode.value > node.value) {
        if (node.right === null) {
          node.right = newNode;
        } else {
          insertNode(node.right, newNode);
        }
      }
    }
    
    insertNode(this.root, newNode);
  }

  contains(value) {
    function search(node, value) {
      if (node === null) return false;
      if (node.value === value) return true;
      
      if (value < node.value) {
        return search(node.left, value);
      } else {
        return search(node.right, value);
      }
    }
    
    return search(this.root, value);
  }

  size() {
    function countNodes(node) {
      if (node === null) return 0;
      return 1 + countNodes(node.left) + countNodes(node.right);
    }
    
    return countNodes(this.root);
  }
}

const tree = new BinaryTree();
tree.insert(10);
tree.insert(5);
tree.insert(15);
tree.insert(3);
tree.insert(7);

console.log('Taille de l\'arbre:', tree.size());
console.log('Contient 7:', tree.contains(7));
console.log('Contient 20:', tree.contains(20));

