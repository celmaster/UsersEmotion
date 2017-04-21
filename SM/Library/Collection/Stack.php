<?php
/*Classe criada para gerir as funcionalidades de uma estrutura de dados do tipo pilha
 * 
 * Marcelo Barbosa.
 * dezembro, 2013.
 */

// declaracao do namespace
namespace SM\Library\Collection;

// importacao de classes
use SM\Library\Utils\Tools\CollectionTool;
    
// declaração de classes
class Stack extends LinearlyLinkedCollection
{
    
    // declaração de métodos
    public function __construct($objectName = "Stack")
    {   
        // método construtor
        // inicializa a superclasse
        parent::__construct($objectName);        
    }        
    
    public function insert($object, $keyValue)
    {
        // insere um elemento na pilha
        // declaração de variáveis
        
        try
        {
            if($this->isEmpty())
            {
                // cria um node para inserir na estrutura de dados
                $node = new Node($keyValue);
                $node->setKey($keyValue);
                $node->setObject($object);

                // adicionando o elemento na pilha        
                $node->setNext($this->root);        
                $this->root = $node;  
                $this->end = $this->root;
            }else
                {
                    // cria um node para inserir na estrutura de dados
                    $node = new Node($keyValue);
                    $node->setKey($keyValue);
                    $node->setObject($object);
                    
                    $this->root->setPrior($node);
                    $node->setNext($this->root);        
                    $this->root = $node;
                }

            // incrementando o contador
            $this->setSize($this->getSize() + 1); 
            
        }catch(\Exception $e)
              {
                echo $e->getMessage();
              }
    }
    
    public function removeFirstObject()
    {
        // remove o primeiro elemento da pilha
        // declaração de variáveis        
        $next = $this->root->getNext();
        $status = false;
        
        // verifica se a pilha esta vazia         
        if(!$this->isEmpty())
        {   
            //  removendo o elemento do rooto
            Collection::removeNode($this->root);
            
            /* caso nao haja proximos elementos na pilha, significa que ela 
             * estara vazia apos a remocao do no atual.
             */ 
            if(isset($next))
            {    
                // pegando o próximo nó
                $this->root = $next;
            }else
                {
                    $this->root = null;
                }
                
            // altera o valor da variavel logica
            $status = true;
                
            // decrementando o contador
            $this->setSize($this->getSize() - 1);
        }
        
        // retorno de valor 
        return $status;
    }

}