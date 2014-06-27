<?php echo $this->Html->script(array('jquery', 'mask'));?>
<script>
	var cont = '<?php echo count($this->request->data['Contato']) - 1; ?>';
	var next = '<?php echo count($this->request->data['Contato']); ?>';
	
	function addContato()
	{
		contato = $('#contato0').clone().outerHTML();
		$('#all').append(contato.replaceAll('contato0', 'contato'+next).replaceAll('Contato0Nome', 'Contato'+next+'Nome').replaceAll('Contato0Email', 'Contato'+next+'Email').replaceAll('Contato0Telefone', 'Contato'+next+'Telefone').replaceAll('Contato0ChurchId', 'Contato'+next+'ChurchId').replaceAll('Contato0UserId', 'Contato'+next+'UserId').replaceAll('remove0', 'remove'+next).replaceAll('[Contato][0][nome]', '[Contato]['+next+'][nome]').replaceAll('[Contato][0][email]', '[Contato]['+next+'][email]').replaceAll('[Contato][0][telefone]', '[Contato]['+next+'][telefone]').replaceAll('[Contato][0][church_id]', '[Contato]['+next+'][chirch_id]').replaceAll('[Contato][0][user_id]', '[Contato]['+next+'][user_id]').replaceAll('value=', ''));
		$('#remove'+next).html('<a href="javascript:;" onclick="delContato('+next+')">Remover</a>');
		cont++;
		next++;
		Mask();
	}

	function delContato(id)
	{
		$('#contato'+id).remove();
	}

	function Mask() {
		$('.cnpj').mask("99.999.999/9999-99");
		$('.telefone').mask("(99) 99999-999?9");
		$('.cep').mask("99999-999");
	}

	$(document).ready(function(){
		Mask();
		String.prototype.replaceAll = function(de, para){
	        var str = this;
	        var pos = str.indexOf(de);
	        while (pos > -1){
	            str = str.replace(de, para);
	            pos = str.indexOf(de);
	        }
	        return (str);
	    }

	    jQuery.fn.outerHTML = function(s) {
	        return (s)
	        ? this.before(s).remove()
	        : jQuery("<p>").append(this.eq(0).clone()).html();
	    }
	});
	function getEnderecoProspeccao(cep, id) {
		if(cep !== ""){
			$.getScript("https://www.nfservice.com.br/sistema/clientefornecedor/cep/"+cep, function(){
					if (resultadoCEP["resultado"]) {
						$('body').removeClass('loading');
						$("#CongregacaoEndereco"+id+"Logradouro").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
						$("#CongregacaoEndereco"+id+"Logradouro").parent().removeClass('error').removeClass('required').find('div.error-message').remove();
						$("#CongregacaoEndereco"+id+"Bairro").val(unescape(resultadoCEP["bairro"]));
						$("#CongregacaoEndereco"+id+"Bairro").parent().removeClass('error').removeClass('required').find('div.error-message').remove();
						$("#CongregacaoEndereco"+id+"Cidade").val(unescape(resultadoCEP["cidade"]));
						$("#CongregacaoEndereco"+id+"Cidade").parent().removeClass('error').removeClass('required').find('div.error-message').remove();
						var arg =unescape(resultadoCEP["uf"]);
						//$("#Endereco0EstadoId > option").each(function(){
						//	if($(this).text()==arg) $(this).parent("select").val($(this).val())
						//})
						$("#CongregacaoEndereco0EstadoId").val(unescape(resultadoCEP["uf"]));
						$("#CongregacaoEndereco0EstadoId").parent().removeClass('error').removeClass('required').find('div.error-message').remove();
						$("#Endereco"+id+"Numero").focus();
					}   
			});
		}
	}
</script>
<h1>Nova Congregação</h1>
	<?php
		echo $this->Form->create('Congregacao');
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('nome', array('label' => 'Nome: ', 'type' => 'text'));
		echo $this->Form->input('cnpj', array('label' => 'Cnpj: ', 'type' => 'text', 'class' => 'cnpj'));
		echo $this->Form->input('email', array('label' => 'E-mail: ', 'type' => 'text'));
		echo $this->Form->input('telefone', array('label' => 'Telefone', 'type' => 'text', 'class' => 'telefone'));
	?>
	<h3>Endereço:</h3>
	<?php
		echo $this->Form->input('CongregacaoEndereco.0.id', array('type' => 'hidden'));
		echo $this->Form->input('CongregacaoEndereco.0.cep', array('label' => 'Cep: ', 'type' => 'text', 'onKeyUp' => 'if(this.value.replace("-","").replaceAll("_","").length == 8){getEnderecoProspeccao(this.value, 0);}', 'class' => 'cep'));
		echo $this->Form->input('CongregacaoEndereco.0.logradouro', array('label' => 'Logradouro: ', 'type' => 'text'));
		echo $this->Form->input('CongregacaoEndereco.0.numero', array('label' => 'Número: ', 'type' => 'text'));
		echo $this->Form->input('CongregacaoEndereco.0.complemento', array('label' => 'Complemento:', 'type' => 'text'));
		echo $this->Form->input('CongregacaoEndereco.0.bairro', array('label' => 'Bairro:', 'type' => 'text'));
		echo $this->Form->input('CongregacaoEndereco.0.cidade', array('label' => 'Cidade:', 'type' => 'text'));
		echo $this->Form->input('CongregacaoEndereco.0.estado_id', array('label' => 'Estado:', 'options' => $estados));
	?>
	<h3>Contatos:</h3>
	<div id="all">
		<?php
			$i = 0;
			foreach ($this->request->data['Contato'] as $value) { ?>
				<?php echo '<div id="contato'.$i.'">' ?>
					<?php
						echo $this->Form->input('Contato.'.$i.'.id', array('type' => 'hidden'));
						echo $this->Form->input('Contato.'.$i.'.church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
						echo $this->Form->input('Contato.'.$i.'.user_id', array('type' => 'hidden'));
						echo $this->Form->input('Contato.'.$i.'.nome', array('label' => 'Nome:', 'type' => 'text'));
						echo $this->Form->input('Contato.'.$i.'.email', array('label' => 'E-mail:'));
						echo $this->Form->input('Contato.'.$i.'.telefone', array('label' => 'Telefone:', 'class' => 'telefone'));
					?>
					<?php echo '<div id="remove'.$i.'">'; ?>
						<?php if ($i >= 1) {
							echo '<a href="javascript:;" onclick="delContato('.$i.')">Remover</a>';
						} ?>
					</div>
					<br>
				</div>
		<?php 
			$i ++;
			}
		?>
	</div>
<?php
	echo $this->Html->link('Adicionar', 'javascript:;', array('onclick' => 'addContato()'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'congregacaos', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>