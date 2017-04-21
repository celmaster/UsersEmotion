<?php

/* Modelo criado para especificar uma emocao.
 * 
 * Marcelo Barbosa, 
 * dezembro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Model;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Interfaces\IContextObject;

// declaracao da classe
class Emotion extends Generic implements IContextObject
{
    // declaracao de atributos
    private $name;
    
    // declaracao de metodos
    public function __construct($name = "") 
    {
        // metodo construtor
        $this->name = $name;
    }
    
    // metodos de encapsulamento
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function toString()
    {
        // retorna os dados da classe em uma string
        return "<br>emotion's name: " . $this->getName() ."<br>";
    }
    
    public function getContext()
    {
        // retorna o contexto da classe
        // declaracao de variaveis
        $context = new Context();
        
        // insercao de dados
        $context->add(new ContextElement("name", $this->getName(), true));
        
        // retorno de valor
         return $context;
    }
    
    public function equals(Generic $obj) 
    {
        // verifica se dois objetos sao iguais
        // declaracao de variaveis
        $status = true;
        
        // verifica se pertence a mesma instancia
        if($obj instanceof Emotion)
        {    
            $object = new Emotion();
            $object = $obj;
            
            if(strcmp($this->getName(), $object->getName()) != 0)
            {
                $status = false;
            }            
            
        }else
            {
                $status = false;
            }
            
        // retorno de valor
        return $status;
    }

}
?>