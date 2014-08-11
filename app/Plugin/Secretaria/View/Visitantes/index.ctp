<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>

<div class="col-md-12">
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Visitantes</li>
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
			Gerenciar Visitantes
		</header>
		<div class="panel-body">
			<table class="table table-striped table-bordered" id="tableData">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>	
						<th>Nome</th>
						<th>Telefone</th>
						<th>E-mail</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($visitantes as $visitante) { ?>
					<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $visitante['Visitante']['id']; ?>">
						<td><input type="checkbox" value="<?php echo $visitante['Visitante']['id']; ?>"></td>
						<td class="btnModal" onclick="modalLoad('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['nome']; ?></td>
						<td class="btnModal" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['fone']; ?></td>
						<td class="btnModal" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['email']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
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