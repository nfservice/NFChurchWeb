<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "departamentos", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Gerenciar Departamentos</li>
	</ul> 
</div>
<?php 
	// form flutuante (menuRoll)
	echo $this->element('menuRoll');
?>
<div class="col-md-12">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar Departamentos
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
					<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Nome:</th>
					<th>Descrição:</th>
				</tr >
				<?php 
				if (!empty($departamentos)) {
					$i = 0;
					foreach ($departamentos as $departamento) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $departamento['Departamento']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $departamento['Departamento']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $departamento['Departamento']['id'])); ?>');"><?php echo $departamento['Departamento']['nome']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $departamento['Departamento']['id'])); ?>');"><?php echo $departamento['Departamento']['descricao']; ?></td>
						</tr>
						<?php $i++;
					}
				} else { ?>
				<tr>
					<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
						<?php echo "Você ainda não cadastrou nenhum Departamento"; ?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</section>
</div>

<?php 
	// modal de edit dos cadastros
	echo $this->element('modal/modalEdit');

	// modal de confirmação de exclusão dos cadastros
	echo $this->element('modal/modalExcluir');
?>