<?php

/* Classe abstrata criada para modelar uma estrutura de dados generica
 * 
 * Marcelo Barbosa,
 * janeiro, 2017.
 */

// declaracao do namespace
namespace SM\Library\Collection;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Interfaces\iCollection;

// declaracao da classe
abstract class Collection extends Generic implements iCollection
{
    // declaracao de atributos
    protected $root;                // inicio da estrutura de dados        
    private $size;                  // quatidade de elementos na estrutura de dados
    private $index;                 // indice com auto incremento
    
    // declaracao de metodos
    public function __construct($objectName = "Collection", $size = 0, $index = 0)
    {
        // metodo construtor
        // inicializa a superclasse
        parent::__construct($objectName);
        
        // inicializa os atributos
        $this->size = $size;
        $this->index = $index;
        $this->root = null;
    }
    
    // metodos de encapsulamento
    public function setIndex($index)
    {
        $this->index = $index;
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    } 

    public function getSize()
    {
        return $this->size;
    }
    
    // metodos de manipulacao de dados    
    protected function compare($value1, $value2)
    {
        // compara o valor de dois objetos
        // declaracao de variaveis
        $status = false;
        
        if(!is_object($value1) && !is_object($value2))
        {
            if($value1 == $value2)
            {
                $status = true;
            }
        }else
            {
                if(($value1 instanceof iComparison) &&
                   ($value2 instanceof iComparison))
                {
                    $status = $value1->equals($value2);
                }
            }
        
        // retorno de valor
        return $status;
    }
    
    protected function getNodePropertyValue(Node $node, $type)
    {
        // recupera o valor de uma propriedade de um no
        // declaracao de variaveis
        $value = null;
        if($type == 1)
        {
            $value = $node->getObject();
        }else
            {
                $value = $node->getKey();
            }
            
        // retorno de valor    
        return $value;
    }
    
    protected abstract function getNode($search, $typeSearch = 1);    
    
    public function add($object)
    {
        // insere um elemento na estrutura de dados        
        $this->insert($object, $this->getIndex());
        $this->setIndex($this->getIndex() + 1);
    }
    
     public function destroy()
    {
        // destroi toda a estrutura de dados, apagando todos os elementos
        // verificando se ha elementos na estrutura de dados
        if(!$this->isEmpty())
        {
            /* utlizando o loop condicional para remover o elemento inicial modo
              que o proximo elemento seja o alvo para remocao */
            do
            {
                $this->removeFirstObject();
            }while($this->root->getObject() !== null);    

        }else
            {
                echo "<br>Can't destroy " . $this->getObjectName() . "! " 
                        . $this->getObjectName() . " is empty!<br>";
            }

    }
    
    public function get($index = 0)
    {
        // obtem um objeto por seu indice
        // declaracao de variaveis
        $obj = null;

        // verifica se a estrutura de dados nao esta vazia
        if(!$this->isEmpty())
        {
            if($index < $this->getSize())
            {
                // cria uma variavel de controle para o laco de repeticao
                $pointer = 0;
                $obj = $this->root;

                while(($obj !== null) && ($pointer < $index))
                {
                    $obj = $obj->getNext();                        
                    $pointer++;
                }
            }
        }

        // retorno de valor
        return $obj;

    }
    
    public function getByKey($key)
    {
        // obtem um objecto atraves de sua chave
        // declaracao de variaveis
        $obj = $this->getNode($key, 2);
        $value = null;
                
        if($obj !== null)
        {
           $value = $obj->getObject();
        }
        
        //retorno de valor
        return $value;
    }
    
    public function getKeyOf($obj)
    {
        // obtem um objecto atraves de sua chave
        // declaracao de variaveis
        $obj = $this->getNode($obj);
        $key = null;
        
        if($obj !== null)
        {
           $key = $obj->getKey();
        }
        
        //retorno de valor
        return $key;
    }
    
    public function contains($obj)
    {
        // verifica se um objeto existe
        // declaracao de variaveis
        $status = false;
        
        // altera o valor da variavel logica
        if($this->getKeyOf($obj) !== null)
        {
            $status = true;
        }
        
        // retorno de valor
        return $status;
    }
    public abstract function insert($object, $key);    
    
    public function isEmpty()
    {
        // retorna verdadeiro ou falso, caso a estrutura de dados esteja vazia
        if($this->root === null)
        {
            return true;
        }else
            {
                return false;
            }
    }
    
    public abstract function removeFirstObject();
    
    public function select($lineStyle = "") 
    {
        // seleciona todos os elementos da estrutura de dados
        // declaracao de variaveis
        $result = "";
        
        if(!$this->isEmpty())
        {
            
            // declaracao de variaveis
            $node = $this->root;
            
            while($node !== null)
            {
               if(is_object($node->getObject()))
               {
                   $result .= $node->getObject()->toString();
               }else
                   {
                        $result .= $node->getObject();
                   }
                $node = $node->getNext();
                
                // aplica o estilo de linha caso o proximo elemento nao seja nulo
                if($node != null)
                {
                    $result .= $lineStyle;
                }
            }
            
        }
        
        // retorno de valor
        return $result;
    }   
    
    public function update(Node $object)
    {
        // atualiza um objeto da estrutura de dados atraves do valor de sua chave
        // declaracao de variaveis
        $status = false;
        
        //verificando se a estrutura de dados nao esta vazia
        if(!$this->isEmpty())
        {
            $key = $object->getKey();            
            $obj = $this->getNode($key, 2);
            
            if($obj !== null)
            {
                $node = &$obj;
                $node->setObject($object->getObject());                
                
                // altera o valor da variavel logica
                $status = true;
            }
        }
        
        // retorno de valor
        return $status;
            
    }
    
    public function toArray() 
    {
        // retorna um array com todos os elementos da estrutura de dados
        // declaracao de variaveis        
        $array = null;
        
        // verifica se a estrutura de dados esta vazia
        if(!$this->isEmpty())
        {
            // pega o primeiro elemento da estrutura de dados
            $element = $this->root;
            
            while($element !== null)
            {
                $arrayList[] = $element;
                $element = $element->getNext();
            }
            
            $array = $arrayList;
        }        
        
        // retorno de valor
        return $array;
    }
    
    public function toString()
    {
        // passa todo o conteudo da estrutura de dados para uma string
        // declaracao de variaveis
        $stringValue = "";          

        // verificando se a estrutura de dados possui objetos            
        if(!$this->isEmpty())
        {   
            // pegando o primeiro no da estrutura de dados
            $node = $this->root;

            // percorrendo os dados da estrutura de dados
            do
            {
                // verificando se o valor do objeto e uma instancia
                if(is_object($node->getObject()))
                {
                    $stringValue .= "<br> Object's value: <br>"
                            . "&nbsp;&nbsp;&nbsp;"
                            . "<div style='margin-left:50px; border: 1px solid; border-radius: 3px; padding: 2px;'>"
                            . "<b>". Collection::objectToString($node->getObject())
                            . "</b></div><br> Key: &nbsp;<b>".$node->getKey()."</b><br><br>";
                }else 
                    {
                        // gravando os dados na string de retorno
                        $stringValue .= "<br> Object's value: "
                                . "&nbsp;&nbsp;&nbsp;<b>".$node->getObject()
                                ."</b><br> Key: &nbsp;<b>".$node->getKey()."</b><br><br>";
                    }

                // pegando o proximo objeto
                $node = $node->getNext();

            }while(isset($node));

        }else
            {
                $stringValue = "Empty!";
            }

        // inserindo a quantidade de itens na string de retorno
        $stringValue .= "<br><br>"
                . "<hr style='width:100%' noshade size='0.5' color='black'>"
                . "<br>Size: &nbsp;<b>".$this->getSize()."</b> object(s) in " . $this->getObjectName() . "<br>";    

        // retorno de valor
        return $stringValue;
    }  
}