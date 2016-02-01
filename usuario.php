<?php

include "conexao.php";
public class Usuario{
	var $nome, $senha;

	function getNome(){
		return $this->nome;
	}

	public function usuario($nome, $senha){
		$consultar = new conexao();
		$this->nome = $nome;
		$this->senha = md5($senha);
		
		$sql = "SELECT nome, id WHERE nome=".$this->nome .",senha=".$this->senha;
		$resultado = $conexao->selectDB($sql);
			if($resultado > 0){
				$this->geraSessao($this);
				return true;
			}else{
				return false;
			}
		}

		$consultar->selectDB()
	}

	public function geraSessao($usuario){
		session_start();
		$SESSION['usuario'] = $usuario;


	}

	public function deslogar(){

	}

}

