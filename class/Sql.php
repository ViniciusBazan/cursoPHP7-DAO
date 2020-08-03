<?php

	class Sql extends PDO {

		private $conn;

		// O metodo construtor automaticamente faz a conexão com o banco
		public function __construct(){

			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","usbw");

		}


		/*
		* METODO  : setParams
		* OBJETIVO: verifica se existem parametros, se ouver chama o metodo setParam enquanto houver parametros
		*/
		private function setParams($statment, $parameters = array()){

			foreach ($parameters as $key => $value){

				$this->setParam($statment, $key, $value);

			}

		}


		private function setParam($statment, $key, $value){


				$statment->bindParam($key, $value);

		}


		/*
		* METODO   : query
		* OBJETIVO : preparar o comando e chamar o metodo setParams
		* $stmt    : prepara o comando para executar no banco
		* setParams: espera passar o $stmt e parametros em forma de array (caso não existe parametros, por padrão, passa um array vazio) 
		*/
		public function query($rawQuery, $params = array()){

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;

		}


		/*
		* METODO  : select
		* OBJETIVO: retornar chave associativas => valor
		* $stmt   : chama o metodo query query
		*/
		public function select($rawQuery, $params = array()){

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

	}

?>