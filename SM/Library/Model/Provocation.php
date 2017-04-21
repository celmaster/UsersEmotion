<?php

/* Modelo criado para especificar uma provocacao referente ao estado emocional
 * do usuario.
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
class Provocation extends Generic implements IContextObject
{
    // declaracao de atributos
    private $emotionsName;
    private $color;
    private $image;
    
    // declaracao de metodos
    public function __construct($emotionsName = "", $color = "", $image = "")
    {
        // metodo construtor
        $this->emotionsName = $emotionsName;
        $this->color = $color;
        $this->image = $image;
    }
    
     // metodos de encapsulamento
    public function setEmotionsName($emotionsName)
    {
        $this->emotionsName = $emotionsName;
    }
    
    public function getEmotionsName()
    {
        return $this->emotionsName;
    }
    
    public function setColor($color)
    {
        $this->color = $color;
    }
    
    public function getColor()
    {
        return $this->color;
    }        
    
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    public function getImage()
    {
        return $this->image;
    }
    
    public function toString() 
    {
        // retorna os dados da classe em uma string
        return "<br>emotion's name: " . $this->getEmotionsName()
              ."<br>color: " . $this->getColor()
              ."<br>image: " .$this->getImage() . "<br>";
    }
    
    public function getContext()
    {
        // retorna o contexto da classe
        // declaracao de variaveis
        $context = new Context();
        
        // insercao de dados
        $context->add(new ContextElement("emotionsName", $this->getEmotionName(), true));
        $context->add(new ContextElement("color", $this->getColor()));
        $context->add(new ContextElement("image", $this->getImage()));
        
        // retorno de valor
         return $context;
    }
    
    public function equals(Generic $obj) 
    {
        // verifica se dois objetos sao iguais
        // declaracao de variaveis
        $status = true;
        
        // verifica se pertence a mesma instancia
        if($obj instanceof Provocation)
        {    
            $object = new Provocation();
            $object = $obj;
            
            if((strcmp($this->getEmotionsName(), $object->getEmotionsName()) != 0) ||
               (strcmp($this->getColor(), $object->getColor()) != 0) ||
               (strcmp($this->getImage(), $object->getImage()) != 0))
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