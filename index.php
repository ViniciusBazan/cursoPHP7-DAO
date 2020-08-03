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


/* Carrega um usuário usando login e senha (autenticado)
$usuario = new Usuario();
$usuario->login("jose","123456");
echo $usuario;
*/


/* insere e mostra um novo usuario
$aluno = new Usuario();

$aluno->setDeslogin("aluno2");
$aluno->setDessenha("456@123");

$aluno->insert();

echo $aluno;
*/


// Atualiza um usuario

$usuario = new Usuario();

$usuario->loadById(8);

$usuario->update("professor", "!@#$%");

echo $usuario;

?>