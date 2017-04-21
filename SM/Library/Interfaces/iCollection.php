<?php

/* Interface responsavel por uma assinatura generica de todos os metodos a 
 * serem utilizados por estruturas de dados.
 *  
 * Marcelo Barbosa.
 * dezembro, 2013. 
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Collection\Node;

//declaracao da interface
interface iCollection
{
    // declaracao dos metodos
    public function add($object);
    public function contains($obj);
    public function destroy();
    public function get($index);
    public function getByKey($key);
    public function getKeyOf($obj);
    public function getSize();
    public function insert($object, $key);
    public function isEmpty();
    public function removeFirstObject();
    public function select();
    public function toArray();
    public function update(Node $object);
}