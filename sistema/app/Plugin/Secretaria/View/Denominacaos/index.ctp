<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "denominacaos", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">		 
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Denominações</li>
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
			Gerenciar Denominações
		</header>
		<div class="panel-body">
			
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
					<th class="col-md-1"><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Denominação:</th>
					<th>Descrição</th>
				</tr>
				<?php if (!empty($denominacaos)) {
					$i=0;
					foreach ($denominacaos as $denominacao) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $denominacao['Denominacao']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $denominacao['Denominacao']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $denominacao['Denominacao']['id'])); ?>');"><?php echo $denominacao['Denominacao']['nome']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $denominacao['Denominacao']['id'])); ?>');"><?php echo $denominacao['Denominacao']['descricao']; ?></td>
						</tr>
						<?php $i++;
					}
				} else { ?>
					<tr>
						<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
							<?php echo "Você ainda não cadastrou nenhum Denominação!"; ?>
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