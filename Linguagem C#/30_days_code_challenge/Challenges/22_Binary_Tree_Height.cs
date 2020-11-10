using System;
class Node{
    public Node left,right;
    public int data;
    public Node(int data){
        this.data=data;
        left=right=null;
    }
}
class Solution{

    class CurrentNode {
        public Node c;
        public CurrentNode p;
        
        public CurrentNode(Node currNode, CurrentNode parentNode){
            c = currNode;
            p = parentNode;
        }

    }

    class PreOrderTraversal{
        public Node Root;
        
        public PreOrderTraversal(Node root){
            Root = root;
        }
        
        public int GetHeight(){
                  var maxHeight = 0;
      
      var currNode = new CurrentNode(Root, new CurrentNode(Root, null));
      var currHeight = 0;
      while(Root.data != -1){
          if(currNode.c.left != null && currNode.c.left.data != -1){
              currNode = new CurrentNode(currNode.c.left, currNode);
              currHeight++;
              continue;
          }

          if(currNode.c.right != null && currNode.c.right.data != -1){
              currNode = new CurrentNode(currNode.c.right, currNode);
              currHeight++;
              continue;
          }
          
          if(currHeight > maxHeight){
              maxHeight = currHeight;
          }

          currNode.c.data = -1;
          currNode = currNode.p;
          currHeight--;
      }
      
      return maxHeight;
        }
    }

	static int getHeight(Node root){
        return new PreOrderTraversal(root).GetHeight();
    }

	static Node insert(Node root, int data){
