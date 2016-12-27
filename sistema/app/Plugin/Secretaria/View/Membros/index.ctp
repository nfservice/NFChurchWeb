<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "membros", "action" => "delete")); ?>';
	$(document).ready(function(){
		$('#myModal').on('hidden.bs.modal', function () {
		  // do something…
		  $(this).children().children().children('div[class="modal-body"]').empty()
		});
	})
</script>
<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">		 
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Membros</li>
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
			Gerenciar membros
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<thead>
					<tr>
						<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
						<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>RG</th>
						<th>CPF</th>
						<th>Telefone</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($membros)) {
						foreach ($membros as $membro) { ?>
							<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $membro['Membro']['id']; ?>">
								<td><input type="checkbox" value="<?php echo $membro['Membro']['id']; ?>"></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['nome']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['email']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['rg']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['cpf']; ?></td>
								<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['fone']; ?></td>
							</tr>
						<?php }
					} else { ?>
						<tr>
							<td cellspacing="100%" cellpadding="100%" colspan="6" align="center">
								<?php echo "Você ainda não cadastrou nenhum Membro!"; ?>
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