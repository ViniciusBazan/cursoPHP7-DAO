<?php


require_once("config.php");



/*
* Carrega um usuario
$root = new Usuario();

$root->loadbyId(3);

echo $root;
*/



/* Carrega todos os usuarios
$lista = Usuario::getList();

echo json_encode($lista);
*/




/* Carrega uma lista de usuários buscando pelo login
$search = Usuario::search("jo");

echo json_encode($search);
*/

// Carrega um usuário usando login e senha (autenticado)
$usuario = new Usuario();
$usuario->login("jose","123456");
echo $usuario;

?>