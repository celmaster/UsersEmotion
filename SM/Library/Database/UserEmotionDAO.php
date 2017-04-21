<?php

/* Classe criada para gerenciar os dados da tabela emotion via padrao DAO
 * 
 * Marcelo Barbosa,
 * dezembro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\UserEmotion;

// declaracao de classe
class UserEmotionDAO extends DAO
{
    // declaracao de metodos    
    public function __construct()
    {
        // metodo construtor
        $model = new UserEmotion();
        parent::__construct(DbConfiguration::getUsersEmotionConfiguration(),"useremotion", $model->getContext(), 0, "usersEmotionName");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new UserEmotion($data["usersEmotionName"]);
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();
             }
        
        // retorno de valor
        return $obj;
    }

}
?>