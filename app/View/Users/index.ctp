<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "profissaos", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>

<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Gerenciar Usuários</li>
	</ul>
</div>
<div class="col-md-12">
	<div class="panel menuRoll">
		<div class="panel-body row">
			
			<!-- form -->
			<?php echo $this->Form->create(array('Pesquisa' ,'action' => 'index', 'role' => 'form')); ?>
			<div class="form-group col-md-3">
				<a class="btn btn-success form-control btnModal" onclick="modalLoad('<?php echo $this->Html->url(array("controller" => "users", "action" => "add")); ?>');"><i class="fa fa-plus"></i> Adicionar Profissão</a>
			</div>
			<div class="form-group col-md-3">
				<a href="javascript:;" class="btn btn-danger form-control" data-toggle="modal" data-target="#confirmacaoExclusao"><i class="fa fa-trash-o"></i> Apagar</a>
			</div>
			<div class="form-group col-md-6">
				<div class="input-group m-bot15">
					<input type="text" class="form-control" id="texto" name="username" placeholder="Pesquise aqui">
					<span class="input-group-btn">
						<input class="btn btn-success" type="submit" value="Buscar">
					</span>
				</div>
			</div>
			<!-- end form -->
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
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
					<?php foreach ($users as $user) { ?>
					<tr class="tr-visitantes-click"  id="<?php echo 'dados_' . $user['User']['id']; ?>">
						<td><input type="checkbox" value="<?php echo $user['User']['id']; ?>"></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['nome']; ?></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['username']; ?></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>');"><?php echo $user['User']['telefone']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<!-- Modal -->	
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Editar</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<!-- modal -->

<!-- Modal -->
<div class="modal fade" id="confirmacaoExclusao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmação de exclusão.</h4>
            </div>
            <div class="modal-body" id="modalapagar">

                Deseja realmente excluir o(s) Usuário(s) selecionados?

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                <button class="btn btn-warning" type="button" id="apagar"> Excluir</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->