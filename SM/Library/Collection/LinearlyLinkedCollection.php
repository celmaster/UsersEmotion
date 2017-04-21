<?php

/* Classe abstrata criada para modelar o conceito de estrutura de dados generica
 * com encadeamento linear.
 * 
 * Marcelo Barbosa,
 * janeiro, 2017.
 */

// declaracao do namespace
namespace SM\Library\Collection;

// declaracao da classe
abstract class LinearlyLinkedCollection extends Collection
{
    // declaracao de atributos
    protected $end;
    
    // declaracao de metodos
    protected function getNode($search, $typeSearch = 1)
    {
        // recupera um no atraves de seu valor (1) ou chave (2)        
        // declaracao de variaveis
        $node = null;
        
        // verifica se a estrutura de dados nao esta vazia        
        if(!$this->isEmpty())
        {
            // verifica se esta no inicio da estrutura de dados  
            $list = $this->root;
            $value = $this->getNodePropertyValue($list, $typeSearch);
            
            if($this->compare($search, $value))
            {
                $node = $list;
            }
            
            // verifica se esta no meio ou no fim da estrutura de dados
            if($node === null)
            {
                $list = $list->getNext();
                
                while($list !== null)
                {
                    $value = $this->getNodePropertyValue($list, $typeSearch);
                    if($this->compare($search, $value))
                    {
                        $node = $list;
                        break;
                    }
                    
                    $list = $list->getNext();
                }
            }
            
        }
        
        // retorno de valor
        return $node;
    }
    
    public function select($lineStyle = "", $reverse = false) 
    {
        // seleciona todos os elementos da estrutura e os armazena em uma string
        // declaracao de variaveis
        $result = "";
        
        if(!$this->isEmpty())
        {            
            // verifica se a ordem de selecao sera crescente ou decrescente
            if(!$reverse)
            {
                $result = parent::select($lineStyle);
            }else
                {
                    $node = $this->end;
                    
                    while($node != null)
                    {
                        if(is_object($node->getObject()))
                        {
                            $result .= $node->getObject()->toString();
                        }else
                            {
                                 $result .= $node->getObject();
                            }
                         $node = $node->getPrior();

                         // aplica o estilo de linha caso o proximo elemento nao seja nulo
                         if($node != null)
                         {
                             $result .= $lineStyle;
                         }
                    }
                }
        }
        
        // retorno de valor
        return $result;
    }
}

