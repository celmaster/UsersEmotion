<?php
    
/* Pagina responsavel por gerar uma interface adaptavel ao estado emocional
 * do usuario, provocando uma emocao contraria aquela que esteja sentindo
 * 
 * Marcelo Barbosa,
 * dezembro, 2015.
 */

// importacao de pacotes
require_once('SM/autoload.php');

// importacao de pacotes
use SM\Library\Model\Provocation;
use SM\Library\Database\UserEmotionDAO;
use SM\Configuration\SystemRules;
use SM\Configuration\SystemConfiguration;
 
// declaracao de variaveis
$cssFile = SystemConfiguration::getCSSDir() . "/emotionStyle.css";
$jsFile = SystemConfiguration::getJSDir() . "/scriptLibrary.js";
        
$provocation = null;

// cricao do DAO para emocoes de usuario
$userEmotionDAO = new UserEmotionDAO();

// verifica se ha alguma emocao de usuario para processar
$userEmotion = $userEmotionDAO->getFirst();

$provocation = new Provocation("", "#FFFFFF", SystemConfiguration::getImageDir() . "/Preloader.gif");

// caso o objeto seja nulo, nao havera adaptacao
if($userEmotion !== null)
{    
    // remove o registro da tabela
    $userEmotionDAO->removeObject($userEmotion);

    // obtem a provocacao referente ao estado emocional do usuario
    $provocation = SystemRules::getProvocationByUserEmotionalState($userEmotion->getUsersEmotionName());
}

?>

<!-- Documento HTML -->
<!DOCTYPE html>
<html>
    <!-- Cabecalho -->    
    <head>
        <title>Users's Emotions</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?=$cssFile?>">
        <script type="text/javascript" src="<?=$jsFile?>"></script>        
        
        <!-- Folhas de estilo em cascata inseridas no documento -->
        <style type="text/css">
            body 
            { 
                background-color:<?=$provocation->getColor()?>; 
            }
        </style>
        
    </head>
    
    <!-- Corpo -->
    <body>
        <div class="scenary">
            <div class="content">
                <img id="image" src="<?=$provocation->getImage()?>" title="" alt="" />
            </div>
        </div>	
        <!-- script PHP -->
        <?php
            // imprime o formulario para monitoramento de emocoes
            echo SystemRules::getFormEmotionMonitor(SystemConfiguration::getControllerDir() . "/EmotionController.php");
        ?>
    </body>
</html>