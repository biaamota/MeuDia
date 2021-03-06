<?php
include 'conexao.php';

$idUsuario = $_SESSION['idusuario'];
$idTarefa = $_GET['id'];

$stmt = $conexao->query("
						SELECT
						  t.id, t.titulo, t.descricao, t.h_inicio, t.h_fim, t.subtitulo, p.descricao AS prioridade, p.nemotecnico AS nemotecnico 
						FROM
						  tarefa t 
						  INNER JOIN
							prioridade p 
							ON p.id = t.prioridade 
						WHERE
						  usuario = '$idUsuario'
						AND
						  t.id = '$idTarefa'
						  "
						);
    $contagem = $stmt->rowCount();
    if($contagem == 1){

		$resultado = $stmt->fetchAll();

		foreach($resultado as $linha){
        
		echo"
		<form class='form-horizontal' action='../php/submitAlterarTarefa.php?id=".$linha['id']."' method='POST'>
		<fieldset>

		<!-- Título-->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='titulo'>Título</label>  
			<div class='col-md-4'>
				<input id='titulo' name='titulo' type='text' placeholder='' value='".$linha['titulo']."' class='form-control input-md' required=''>
			</div>
		</div>

		<!-- Subtitulo -->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='subtitulo'>Subtitulo</label>  
			<div class='col-md-4'>
				<input id='subtitulo' name='subtitulo' type='text' placeholder='' value='".$linha['subtitulo']."' class='form-control input-md' required=''>
			</div>
		</div>

		<!-- Descrição -->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='descricao'>descricao</label>
			<div class='col-md-4'>                     
				<textarea class='form-control' id='descricao' name='descricao'>".$linha['descricao']."</textarea>
			</div>
		</div>

		<!-- Horário de Início-->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='hinicio'>Horário de Início</label>  
			<div class='col-md-1'>
				<input id='hinicio' name='hinicio' type='time' placeholder='' value='".$linha['h_inicio']."' class='form-control input-md' required=''>
			</div>
		</div>

		<!-- Horário de Termino -->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='hfim'>Horário de Termino</label>
			<div class='col-md-1'>
				<input id='hfim' name='hfim' type='time' placeholder='' value='".$linha['h_fim']."' class='form-control input-md'>
			</div>
		</div>

		<!-- Tipo de Tarefa -->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='tipotarefa'>Tipo de Tarefa</label>
			<div class='col-md-3'>
				<select id='tipotarefa' name='tipotarefa' class='form-control'>";
					include '../php/selectTipoTarefa.php';
			echo"
				</select>
			</div>
		</div>

		<!-- Prioridade -->
		<div class='form-group'>
		<label class='col-md-4 control-label' for='prioridade'>Prioridade</label>
			<div class='col-md-3'>
				<select id='prioridade' name='prioridade' class='form-control'>";
					include '../php/selectPrioridade.php';
			echo"
				</select>
			</div>
		</div>

		<!-- Alterar registros -->
		<div class='form-group'>
			<div class='col-md-4'>
				<button id='singlebutton' name='singlebutton' class='btn btn-success'>Alterar</button>
			</div>
		</div>
		</fieldset>
		</form>";
		}
	}
?>