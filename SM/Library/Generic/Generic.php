<?php
 /*
  * Classe abstrata criada para modelar um objeto generico com metodos que definam a realidade de um objeto generico modelado.
  * 
  * Marcelo Barbosa.
  * dezembro, 2013.
  */

// declaracao do namespace
namespace SM\Library\Generic;

// declaracao de classes
abstract class Generic
{
    // declaracao de atributos
    private $objectName;
    
    // declaracao de metodos
    // 
    // metodo construtor
    public function __construct($objectName = "")
    {
        // inicializando atributos
        $this->objectName = $objectName;
        
    }
    
    // metodos gatilhadores
    public function getObjectName()
    {
        return $this->objectName;
    }        
    
    public function setObjectName($objectName)
    {
        $this->objectName = $objectName;
    }        
    
    public function equals(Generic $obj) 
    {
        /* verifica se dois objetos sao iguais e retorna um valor 
         * logico para tal premissa.
         */
        
        // declaracao de variaveis
        $comparison = false;
        
        if(strcmp($this->getObjectName(), $obj->getObjectName()) == 0)
        {
            $comparison = true;
        }
        
        // retorno de valor
        return $comparison;
    }
    
    // metodos abstratos
    public abstract function toString();        
}

?>

