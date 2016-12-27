<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "congregacaos", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">		 
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Congregações</li>
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
			Gerenciar congregações
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<th class="col-md-1"><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Congregação:</th>
					<th>Telefone:</th>
					<th>E-mail:</th>
				</tr >
				<?php if (!empty($congregacaos)) {
					$i=0;
					foreach ($congregacaos as $congregacao) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $congregacao['Congregacao']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $congregacao['Congregacao']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Congregacao']['nome']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php $congregacao['Congregacao']['telefone'] = '('.substr($congregacao['Congregacao']['telefone'], 0, 2).') '.substr($congregacao['Congregacao']['telefone'], 2, -4).'-'.substr($congregacao['Congregacao']['telefone'], -4);
								echo $congregacao['Congregacao']['telefone']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Congregacao']['email']; ?></td>
						</tr>
						<?php $i++;
					}
				} else { ?>
					<tr>
						<td cellspacing="100%" cellpadding="100%" colspan="4" align="center">
							<?php echo "Você ainda não cadastrou nenhuma Congregação!"; ?>
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