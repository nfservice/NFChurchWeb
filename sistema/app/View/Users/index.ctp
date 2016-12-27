<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "", "controller" => "users", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>

<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Gerenciar Usuários</li>
	</ul>
</div>
<?php 
	// form flutuante (menuRoll)
	echo $this->element('menuRoll');
?>
<div class="col-md-12"> 
	<section class="panel">
		<header class="panel-heading">
			Gerenciar usuários
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Telefone:</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($users)) {
						foreach ($users as $user) { ?>
							<tr class="tr-visitantes-click"  id="<?php echo 'dados_' . $user['User']['id']; ?>">
								<td><input type="checkbox" value="<?php echo $user['User']['id']; ?>"></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['nome']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['username']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['telefone']; ?></td>
							</tr>
						<?php }
					} else { ?>
						<tr>
							<td cellspacing="100%" cellpadding="100%" colspan="4" align="center">
								<?php echo "Você ainda não cadastrou nenhum Usuário!"; ?>
							</td>
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

