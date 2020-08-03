<?php

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		// Metodos para definir e pegar o idusuario
		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}


		// Metodos para definir e pegar o deslogin
		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}



		// Metodos para definir e pegar o dessenha
		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}



		// Metodos para definir e pegar o dtcadastro
		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}



		// Busca um usuário no banco a partir de um ID
		public function loadById($id){

			$sql     = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
					":ID"=>$id
			));

			if (isset($results[0])){

				$this->setData($results[0]);

			}

		}



		// Lista todos os usuarios
		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

		}



		// Lista todos os usuarios buscando pelo login
		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%".$login."%"
			));

		}


		// Lista o usuario autenticado
		public function login($login, $password){

			$sql     = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
					":LOGIN"=>$login,
					":PASSWORD"=>$password
			));

			if (isset($results[0])){


				$this->setData($results[0]);
				

			} else{

				throw new Exception ("Login e/ou senha inválidos");

			}


		}

		// Define todos os valores dos usuarios usandos os set's
		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

		}


		// Insere os valores no banco por meio de uma proedure criada no banco
		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				":LOGIN"=>$this->getDeslogin(),
				":PASSWORD"=>$this->getDessenha()
			));


			if (isset($results[0])){
				$this->setData($results[0]);
			}

		}


		// Altera um dado do banco já existente
		public function update($login, $password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));

		}


		// Deleta um registro do banco
		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$this->getIdusuario()
			));

			$this->setIdusuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtcadastro(new DateTime());

		}

		// Imprime na tela o JSON com os dados, caso alguém tente imprimir na tela o objeto da classe usuario
		public function __toString(){

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));

		}

	}

?>