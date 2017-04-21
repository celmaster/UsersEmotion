<?php

/*
 * Interface criada para disponibilizar a assinatura dos métodos básicos de uma estrutura de dados do tipo fila
 * 
 * Marcelo Barbosa, 
 * janeiro, 2014.
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Collection\Node;

// declaracao da interface
interface iQueue
{
    // declaracao dos metodos
    public function isEmpty();
    public function insert($object, $key);    
    public function removeFirstObject();    
    public function select();    
    public function get($index);
    public function getByKey($key);
    public function getKeyOf($obj);
    public function update(Node $object);
    public function getSize();
    public function destroy();
    public function toArray();
}
