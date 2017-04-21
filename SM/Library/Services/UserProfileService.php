<?php

/* Servico criado para gerenciar os dados da entidade UserProfile
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */


// importacao do autoload
require_once('../../autoload.php');

// importacao de classes
use SM\Library\Database\UserProfileDAO;
use SM\Library\Database\ExpressMessageDAO;
use SM\Library\Utils\TimeStamp;
use SM\Library\IO\Request;
use SM\Library\Model\UserProfile;
use SM\Library\Utils\JSONManager;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Model\ExpressMessage;
use SM\Library\Utils\ProcessContext;
use SM\Configuration\SystemConfiguration;
use SM\Library\Collection\LinkedList;
use SM\Library\Utils\StringManager;

// declaracao da classe
class UserProfileService
{
    // declaracao de atributos
    private $operation;    
    
    // declaracao de metodos
    public function __construct() 
    {
        // metodo construtor
        $this->operation = Request::getParameter("serviceOperation", "post");
    }
    
    private function setUserProfile($profile)
    {
        // atualiza os dados de um perfil de usuario
        // declaracao de variaveis  
        $status = 0;
        $abilityToSee = "";
        $fontSize = "";
        $graphicalElementSize = "";
		$interest = "";
        $interestList = new LinkedList("interest");

        $json = JSONManager::jsonToArray($profile);

        foreach ($json->{"abilities"} as $value) 
        {
           if(StringManager::equalsIgnoreCase($value->{"predicate"}, "AbilityToSee"))
           {
               $abilityToSee = $value->{"object"};
           }
        }

        foreach ($json->{"interface_preferences"} as $value) 
        {
           if(StringManager::equalsIgnoreCase($value->{"predicate"}, "FontSize"))
           {
               $fontSize = $value->{"object"};
           }else if(StringManager::equalsIgnoreCase($value->{"predicate"}, "GraphicalElementSize"))
               {
                    $graphicalElementSize = $value->{"object"};
               }   
        }

        foreach ($json->{"interest"} as $value) 
        {
           $subgroup = $value->{"subgroup"};
           if($interestList->getKeyOf($subgroup) === null)
           {
               $interestList->add($subgroup);
           }
        }
		
		if(!$interestList->isEmpty())
		{
			$interest = ProcessContext::getListToJSON($interestList);
		}
        
        $userProfileDAO = new UserProfileDAO();
        
        if($userProfileDAO->updateObject(new UserProfile($abilityToSee, $fontSize, $graphicalElementSize, $interest)))
        {
            $status = 1;
        }
        
        return $status;
        
    }
    
    private function hasNewProfile()
    {
        // verifica se ha novos perfis de usuario
        // declaracao de variaveis
        $status = 0;
        $expressMessage = null;
        $expressMessageDAO = null;
        $receiverAddress = Request::getParameter("appName", "post");

        // verifica se o endereco do receptor esta disponivel
        if($receiverAddress != null)
        {
            // cria um contexto
            $context = new Context();
            $context->add(new ContextElement("receiverAddress", $receiverAddress, false, true));  
            
            // obtencao de dados            
            $expressMessageDAO = new ExpressMessageDAO();

            // obtencao da mensagem expressa
            $expressMessage = $expressMessageDAO->getObjectByCondition(ProcessContext::getCondition($context), $context);            
            
            if($expressMessage != null)
            {
                // remove o registro da mensagem
                $expressMessageDAO->removeObject($expressMessage);

                // faz a adaptacao de interface    
                $status = $this->setUserProfile($expressMessage->getDataContent());                
            }
        }
        
        // imprime o valor
        echo $status;
    }
    
    public function execService()
    {
        // executa o servico        
        switch($this->operation)
        {   
            case "hasNewProfile":                
                $this->hasNewProfile();
            break;    
        }
    }
    
}

// inicia o servico
$service = new UserProfileService();
$service->execService();
