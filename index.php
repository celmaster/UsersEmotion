<?php
    
/* Verifica se os bancos de dados existem para direcionar o usuario a aplicacao
 * 
 * 
 * Marcelo Barbosa,
 * dezembro, 2015.
 */

// importacao de pacotes
require_once('SM/autoload.php');

// importacao de pacotes
use SM\Configuration\DbConfiguration;
use SM\Configuration\SystemConfiguration;
use SM\Library\Utils\Tools\DatabaseTool;
use SM\Library\Model\Emotion;
use SM\Library\Database\EmotionDAO;

// verifica se o banco de dados existe
if(!DatabaseTool::hasDatabase("usersEmotionsDB", DbConfiguration::getMinDefaultConfiguration()))
{
    // cria o banco de dados
    DbConfiguration::initDbSystem();
    DbConfiguration::initUsersEmotionDb();
    
    // inicializa a tabela de dados
    $emotionDAO = new EmotionDAO();
    
    // insere as emocoes que serao trabalhadas pela proposta do aplicativo
    if($emotionDAO->getQuantityOfRegisters() == 0)
    {
        $emotionDAO->insert(new Emotion("Animado"));
        $emotionDAO->insert(new Emotion("Entediado"));
        $emotionDAO->insert(new Emotion("Feliz"));
        $emotionDAO->insert(new Emotion("Triste"));
        $emotionDAO->insert(new Emotion("Bravo"));
        $emotionDAO->insert(new Emotion("Sonolento"));
        $emotionDAO->insert(new Emotion("Frustrado"));
        $emotionDAO->insert(new Emotion("Relaxado"));
    }
}

// redireciona o usuario para o script principal
SystemConfiguration::letsgoByRoot("main.php");
