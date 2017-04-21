<?php

/* Interface responsavel por definir o metodo de
 * convercao dos atributos de uma classe em um vetor. * 
 * 
 * Marcelo Barbosa,
 * dezembro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// declaracao da interface
interface iDataArray
{
    // declaracao dos metodos
    public function parseToArray();
}