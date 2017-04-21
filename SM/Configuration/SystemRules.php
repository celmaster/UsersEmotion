<?php

/* Classe estatica criada para definir as regras do sistema
 * 
 * Marcelo Barbosa, 
 * outubro, 2015.
 */

// declaracao do namespace
namespace SM\Configuration;

// importacao de classes
use SM\Library\Collection\LinkedList;
use SM\Library\Model\Provocation;
use SM\Library\Model\Emotion;

// declaracao da classe
class SystemRules
{
    // declaracao de metodos estaticos
    public static function getListOfProvocations()
    {
        // retorna uma lista de provocacoes
        // declaracao de variaveis
        $list = new LinkedList();

        // insere os elementos na lista
        $list->insert(new Provocation("Entediado", "#262C7F", SystemConfiguration::getImageDir() . "/Entediado.jpg"), "Animado");
        $list->insert(new Provocation("Animado", "#FFFF00", SystemConfiguration::getImageDir() . "/Animado.jpg"), "Entediado");
        $list->insert(new Provocation("Triste", "#5D1E66", SystemConfiguration::getImageDir() . "/Triste.jpg"), "Feliz");
        $list->insert(new Provocation("Feliz", "#FF8000", SystemConfiguration::getImageDir() . "/Feliz.jpg"), "Triste");
        $list->insert(new Provocation("Sonolento", "#C35BEF", SystemConfiguration::getImageDir() . "/Sonolento.jpg"), "Bravo");
        $list->insert(new Provocation("Bravo", "#DF0000", SystemConfiguration::getImageDir() . "/Raiva.jpg"), "Sonolento");
        $list->insert(new Provocation("Relaxado", "#5A95F2", SystemConfiguration::getImageDir() . "/Relaxado.jpg"), "Frustrado");
        $list->insert(new Provocation("Frustrado", "#000000", SystemConfiguration::getImageDir() . "/Frustrado.jpg"), "Relaxado");

        // retono de valor
        return $list;
    }

    public static function getProvocationByUserEmotionalState($userEmotionalState)
    {
        // obtem uma provocacao relacionada ao estado emocional do usuario
        // declaracao de variaveis
        $provacation = new Provocation();    

        // obtem a lista de provocacoes ao estado emocional
        $list = SystemRules::getListOfProvocations();

        // retorna a provocacao relativa ao estado emocional do usuario
        $object = $list->getByKey($userEmotionalState);

        // verifica se retornou um valor diferente de nulo
        if($object !== null)
        {
            $provacation = $object;
        }else
            {
                $provacation = null;
            }

        // retorno de valor
        return $provacation;
    }
    
    public static function getFormEmotionMonitor($serviceURL)
    {
        // obtem um formulario para motinoramento de emocoes de usuario
        $strForm = "<form id=\"formEmotion\">\n"
                 . "   <input type=\"hidden\" id=\"serviceURL\" name=\"serviceURL\" value=\"".$serviceURL."\" />\n"
                 . "</form>\n";

        // retorno de valor
        return $strForm;
    }
}
