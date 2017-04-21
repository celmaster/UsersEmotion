<?php

/* Classe criada para gerenciar os dados da tabela provocation via padrao DAO
 * 
 * Marcelo Barbosa,
 * dezembro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\Provocation;

// declaracao de classe
class ProvocationDAO extends DAO
{
    // declaracao de metodos    
    public function __construct()
    {
        // metodo construtor
        $model = new Provocation();        
        parent::__construct(DbConfiguration::getUsersEmotionConfiguration(),"provocation", $model->getContext(), 0, "emotionsName");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new Provocation($data["emotionsName"],
                                   $data["color"],
                                   $data["image"]);
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();                  
             }
        
        // retorno de valor
        return $obj;
    }

}