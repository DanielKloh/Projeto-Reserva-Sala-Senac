<?php

require_once "../model/reserva.php";
require_once "util.php";


class detalhesReserva{
    
    
    public function buscarDados($reservaID){

        $reserva = new Reserva();

        return $reserva->abrir($reservaID);

    }

	function excluirController()
	{
		if(isset($_POST['id']))
		{	
			// excluir	
			$id= Util::clearparam($_POST['id']);
			$reserva = new Reserva(); 
			echo $reserva->excluir($id);
			
		}
	}

}
?>