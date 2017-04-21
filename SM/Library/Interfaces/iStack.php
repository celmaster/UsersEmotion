<?php

/* Interface iStack, responsável por disponibilizar a assinatura dos métodos de uma estrutura do tipo pilha.
 * 
 * Marcelo Barbosa.
 * dezembro, 2013. 
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Collection\Node;

// declaracao da interface
interface iStack
{
    public function isEmpty();
    public function insert($object, $keyValue);
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
