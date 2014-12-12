<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "patrimonio", "controller" => "bens", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">		 
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Biblioteca</a></li>
		<li class="active">Cadastros</li>
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
			Gerenciar Bens
		</header>
		<div class="panel-body">
			
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
					<th class="col-md-1"><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Item</th>
					<th>Estoque</th>
				</tr>
				<?php if (!empty($itens)) {
					$i=0;
					foreach ($itens as $item) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $item['Item']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $item['Item']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $item['Item']['id'])); ?>');"><?php echo $item['Item']['titulo'].' - '.$item['Autor']['nome'].' ('.$item['Item']['isbn'].')'; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $item['Item']['id'])); ?>');"><?php echo $item['Item']['estoque']; ?></td>
						</tr>
				<?php 
						$i++;
					}
				} else { ?>
					<tr>
						<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
							<?php echo "Você ainda não cadastrou nada!"; ?>
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