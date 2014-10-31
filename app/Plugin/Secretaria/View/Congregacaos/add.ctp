<script>
	var cont = 0;
	var next = 1;
	
	function addContato()
	{
		contato = $('#contato0').clone().outerHTML();
		$('#all').append(contato.replaceAll('contato0', 'contato'+next).replaceAll('Contato0Nome', 'Contato'+next+'Nome').replaceAll('Contato0Email', 'Contato'+next+'Email').replaceAll('Contato0Telefone', 'Contato'+next+'Telefone').replaceAll('Contato0ChurchId', 'Contato'+next+'ChurchId').replaceAll('Contato0UserId', 'Contato'+next+'UserId').replaceAll('remove0', 'remove'+next).replaceAll('[Contato][0][nome]', '[Contato]['+next+'][nome]').replaceAll('[Contato][0][email]', '[Contato]['+next+'][email]').replaceAll('[Contato][0][telefone]', '[Contato]['+next+'][telefone]').replaceAll('[Contato][0][church_id]', '[Contato]['+next+'][chirch_id]').replaceAll('[Contato][0][user_id]', '[Contato]['+next+'][user_id]'));
		$('#remove'+next).html('<a href="javascript:;" onclick="delContato('+next+')">Remover</a>');
		cont++;
		next++;
		console.debug('teste');
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
						$("#CongregacaoEndereco"+id+"Numero").focus();
					}   
			});
		}
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
</script>
<h1>Nova Congregação</h1>
<?php echo $this->Form->create('Congregacao', array('role' => 'form', 'class' => 'formModal')); ?>
<div class="row">
	<?php
		echo $this->Form->input('nome', array('label' => 'Nome: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
		echo $this->Form->input('cnpj', array('label' => 'Cnpj: ', 'type' => 'text', 'class' => 'cnpj', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->input('email', array('label' => 'E-mail: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
		echo $this->Form->input('telefone', array('label' => 'Telefone', 'type' => 'text', 'class' => 'telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
	?>
</div>
	<h3>Endereço:</h3>
	<div class="row">
	<?php
		echo $this->Form->input('CongregacaoEndereco.0.cep', array('label' => 'Cep: ', 'type' => 'text', 'onKeyUp' => 'if(this.value.replace("-","").replaceAll("_","").length == 8){getEnderecoProspeccao(this.value, 0);}', 'class' => 'cep', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
		echo $this->Form->input('CongregacaoEndereco.0.logradouro', array('label' => 'Logradouro: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
		echo $this->Form->input('CongregacaoEndereco.0.numero', array('label' => 'Número: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
		echo $this->Form->input('CongregacaoEndereco.0.complemento', array('label' => 'Complemento:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
		echo $this->Form->input('CongregacaoEndereco.0.bairro', array('label' => 'Bairro:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
		echo $this->Form->input('CongregacaoEndereco.0.cidade', array('label' => 'Cidade:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
		echo $this->Form->input('CongregacaoEndereco.0.estado_id', array('label' => 'Estado:', 'options' => $estados, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	?>
</div>
<h3>Contatos:</h3>
<div class="row">
<div id="all">
	<div id="contato0">
		<?php
			echo $this->Form->input('Contato.0.church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
			echo $this->Form->input('Contato.0.user_id', array('type' => 'hidden'));
			echo $this->Form->input('Contato.0.nome', array('label' => 'Nome:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('Contato.0.email', array('label' => 'E-mail:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('Contato.0.telefone', array('label' => 'Telefone:', 'class' => 'telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
		?>
		<div id="remove0">
			
		</div>
		<br>
	</div>
</div>
<div class="form-group col-md-2">
    <button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
</div>
<?php echo $this->Form->input('Salvar Congregação', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-3')));
?>
</div>
<?php echo $this->Form->end(); ?>