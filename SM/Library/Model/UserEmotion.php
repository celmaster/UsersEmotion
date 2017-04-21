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
class UserEmotion extends Generic implements IContextObject
{
    // declaracao de atributos
    private $usersEmotionName;
    
    // declaracao de metodos
    public function __construct($usersEmotionName = "") 
    {
        // metodo construtor
        // inicializa a superclasse
        parent::__construct("UserEmotion");
        
        $this->usersEmotionName = $usersEmotionName;
    }
    
    // metodos de encapsulamento
    public function setUsersEmotionName($usersEmotionName)
    {
        $this->usersEmotionName = $usersEmotionName;
    }
    
    public function getUsersEmotionName()
    {
        return $this->usersEmotionName;
    }
    
    public function toString()
    {
        // retorna os dados da classe em uma string
        return "<br>user's emotion's name: " . $this->getUsersEmotionName() ."<br>";
    }
    
    public function getContext() 
    {
        // retorna o contexto da classe
        // declaracao de variaveis
        $context = new Context();
        
        // insercao de dados
        $context->add(new ContextElement("usersEmotionName", $this->getUsersEmotionName(), true));
        
        // retorno de valor
         return $context;
    }
        
}

