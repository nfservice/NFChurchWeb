<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "cargos", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">		 
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Cargos</li>
	</ul> 
	<!--breadcrumbs end -->
</div>

<?php 
	// form flutuante (menuRoll)
	echo $this->element('menuRoll');
?>

<div class="col-lg-12 menuRollNext">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar Cargos
		</header>
		<div class="panel-body">
			
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
					<th class="col-md-1"><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Cargo:</th>
					<th>Descrição</th>
				</tr>
				<?php if (!empty($cargos)) {
					$i=0;
					foreach ($cargos as $cargo) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $cargo['Cargo']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $cargo['Cargo']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $cargo['Cargo']['id'])); ?>');"><?php echo $cargo['Cargo']['nome']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $cargo['Cargo']['id'])); ?>');"><?php echo $cargo['Cargo']['descricao']; ?></td>
						</tr>
						<?php $i++;
					}
				} else { ?>
					<tr>
						<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
							<?php echo "Você Ainda Não Cadastrou Nenhum Cargo!"; ?>
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