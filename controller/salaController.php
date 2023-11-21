<?php

require_once "util.php";
require_once "../model/sala.php";
require_once "../model/periodo.php";

class salaController
{
	
	function salvar()
	{
		if(isset($_POST['salvar']))
		{
			$nome = Util::clearparam($_POST['nome']);
			$id = Util::clearparam($_POST['id']);

			$sala = new sala();
			$sala->salvar($id,$nome);
			header("Location: sala_list.php");
			exit();
		}
	}
	
	function excluir()
	{
		
		if(isset($_POST['excluir']))
		{
			$id = Util::clearparam($_POST['id']);
			
			$sala = new sala();
			$sala->excluir($id);
		
			header("Location: sala_list.php");
			exit();
				
		}
		
	}
	
	function abrir()
	{
		
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$sala = new sala();
			return $sala->abrir( $_GET['id']);
		}	
	}
	
	// listagem
	function listarcontroller()
	{
		
		$sala = new sala();
		
		$linhas = $sala->listar();
		
		$tabela = '';
		foreach($linhas as $linha)
		{
			$tabela .= '<tr>
							<td>'.$linha['id'].'</td>
							<td><a href="sala_form.php?id='.$linha['id'].'">'.$linha['nome'].'</a></td>
						</tr>		
							';
		}
		
		return $tabela;
		
	}

	function listarSalas()
	{
		
		$sala = new sala();
		
		$linhas = $sala->listar();
		
		$tabela = '';
		foreach($linhas as $linha)
		{
			$tabela .= '<tr>
							<td>'.$linha['id'].'</td>
							<td><a href="visualizarSala.php?salaId='.$linha['id'].'">'.$linha['nome'].'</a></td>
						</tr>		
							';
		}
		
		return $tabela;
		
	}

	public function buscarNomeSala($id){
		
		$sala = new sala();
		
		$linhas = $sala->listar();


		for ($i=0; $i < count($linhas); $i++) { 
			if( $linhas[$i]['id'] == $id ){
				return $linhas[$i]['nome'];
			}
		}	
	}

	public function buscarPeriodos(){

		$periodo = new periodo();

		$listaPeriodo = $periodo->listar();
	
		$contador = 1;

		for ($i=0; $i < count($listaPeriodo); $i++) { 
		
			$str = strtolower($listaPeriodo[$i]["nome"]);
		
			echo '<option id="'.str_replace('ã', 'a', $str).'" value="'.$contador.'">'.$listaPeriodo[$i]["nome"].'</option>';
		
			$contador++;
		}
		return;
	}
}

?>