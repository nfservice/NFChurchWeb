<h1>Visitantes</h1>
<div>
	<h3>
		<?php echo $this->Html->link('Novo Visitante', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'add')); ?>
	</h3>
</div>
<?php echo $this->Form->create(array('Pesquisa')); ?>
<h4>Filtrar por:</h4>
<select name="tipo" onChange="TrocaFitro(this.value,this.options[this.selectedIndex].innerHTML);">
	<option value="nome">Nome</option>
	<option value="CPF">CPF</option>
	<option value="telefone">Telefone</option>
</select>
<div id="normal">
	<input type="text" size="50" id="texto" name="razaosocial" placeholder="Filtrar:"/>
	<input type="submit" style="margin-left:20px;" name="submit" value="Pesquisar"/>
</div>	
<?php echo $this->Form->end(); ?>
<<<<<<< HEAD
<table class="table">
	<tr>
		<th>
			Nome:
		</th>
		<th>
			Telefone:
		</th>
		<th>
			Email:
		</th>
		<th>
			Ações:
		</th>
	</tr>
	<?php foreach ($visitantes as $visitante) { ?>
		<tr>
			<td>
				<?php echo $visitante['Visitante']['nome']; ?>
			</td>
			<td>
				<?php echo $visitante['Visitante']['fone']; ?>
			</td>
			<td>
				<?php echo $visitante['Visitante']['email']; ?>
			</td>
			<td>
				<?php echo $this->Html->link('Editar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'edit', $visitante['Visitante']['id'])); ?>
				&nbsp;
				<?php echo $this->Html->link('Visualizar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'view', $visitante['Visitante']['id'])); ?>
				&nbsp;
				<?php echo $this->Form->postLink('Deletar', array('action' => 'delete', $visitante['Visitante']['id']), null, __('Deseja deletar a Visitante %s?', $visitante['Visitante']['nome'])); ?>
			</td>
		</tr>
	<?php } ?>
</table>
=======
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Responsive table
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                 </span>
            </header>
            <div class="panel-body">
                <section id="unseen">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($visitantes as $visitante) { ?>
                        <tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
							<td>
								<?php echo $visitante['Visitante']['nome']; ?>
							</td>
							<td>
								<?php echo $visitante['Visitante']['fone']; ?>
							</td>
							<td>
								<?php echo $visitante['Visitante']['email']; ?>
							</td>
						</tr>
						<?php } ?>
                        
                        </tbody>
                    </table>
                </section>
            </div>
        </section>                
    </div>
</div>
>>>>>>> cd2ff942a876fee06ecd764d81643ada93a1a2ba
