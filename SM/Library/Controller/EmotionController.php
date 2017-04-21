<?php

/* Gerencia os dados de emocoes
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// importacao do autoload
require_once('../../autoload.php');

// importacao de classes
use SM\Configuration\SystemConfiguration;
use SM\Library\IO\Request;
use SM\Library\Database\UserEmotionDAO;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Database\ExpressMessageDAO;
use SM\Library\Model\ExpressMessage;
use SM\Library\Model\UserEmotion;
use SM\Library\Interfaces\iController;
use SM\Library\Utils\ProcessContext;
use SM\Library\Utils\JSONManager;

// declaracao da classe
class EmotionController implements iController
{
    // declaracao de atributos
    private $emotion;
    private $operation;
    
    // declaracao de metodos
    public function __construct() 
    {
        // metodo construtor
        // obtem dados de parametros
        $emotionName = Request::getParameter("emotion", "post");       
        
        $this->operation = Request::getParameter("operation", "post");
        $this->emotion = new UserEmotion($emotionName);        
    }
    
    private function save(UserEmotion $emotion)
    {
        // grava uma categoria no banco de dados
        // declaracao de variaveis
        $dao = new UserEmotionDAO();
        $status = $dao->insert($emotion);               
    }
    
    private function delete(UserEmotion $emotion)
    {
        // remove o registro de uma categoria
        // declaracao de variaveis
       $dao = new UserEmotionDAO();
       $status = $dao->removeObject($emotion);
       
       // redireciona para o script principal
       SystemConfiguration::letsgoByRoot("index.php");
    }
        
    public function exec()
    {
        // executa uma operacao
        switch($this->operation)
        {
            case "save":
                $this->save($this->emotion);
            break;            
        
            case "delete":
                $this->delete($this->emotion);
            break;
        
            case "hasEmotion":
                
                // verifica se ha dados postados via ExpressMessage
                $expressMessageDAO = new ExpressMessageDAO();
                
                // cria um contexto para consulta
                $context = new Context();
                $context->add(new ContextElement("receiverAddress", "usersEmotionApp", false, true));
                
                // obtem a emocao do usuario armazenada no modulo de comunicacao
                $expressMessage = $expressMessageDAO->getObjectByCondition(ProcessContext::getCondition($context), $context);
                
                if($expressMessage !== null)
                {
                    // remove a mensagem
                    $expressMessageDAO->removeObject($expressMessage);
                    
                    // obtem a emocao e a posta para o app processa-la
                    $array = JSONManager::jsonToArray($expressMessage->getDataContent());
                    $profileFields = $array->emotional_state;
                    
                    $this->save(new UserEmotion($profileFields[0]->predicate));
                    
                    // informa o cliente, via AJAX, que um dado de usuario foi encontrado
                    echo "emotionFound";
                }
                
            break;
        }
    }
}

// instancia o controller para execucao
$controller = new EmotionController();
$controller->exec();