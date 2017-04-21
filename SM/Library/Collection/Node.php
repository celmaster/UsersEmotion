<?php
/*
 * Classe para definir um objeto
 * 
 * Marcelo Barbosa.
 * dezembro, 2013.
*/

// declaracao do namespace
namespace SM\Library\Collection;

class Node extends Pointer
{
    // declaração de atributos
    private $object;         
    private $key;


    // declaração de métodos
    public function __construct($objectName = "")
    {
        // método construtor         
        // inicialização de atributos             
       parent::__construct($objectName); 
    }

    // métodos gatilhadores
    public function setObject($newObject)
    {
        $this->object = $newObject;
    }   

    public function getObject()
    {
        return $this->object;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }   

    public function getKey()
    {
        return $this->key;
    }

    public function toString()
    {
        // converte os valores da classe em strings
        // declaração de variáveis
        $stringValue = "";

        // verificando se o objeto da classe é ou não uma instancia de uma classe
        if(!is_object($this->object))
        {
            $stringValue .= " ". $this->getObject(); 
        }else
            {

                $stringValue .= " ". $this->object->toString();
            }

        // retorno de valor
        return $stringValue;

    }

}