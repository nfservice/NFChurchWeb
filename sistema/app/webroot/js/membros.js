var action = '<?php echo $this->request->params['action'] ?>';
    var cont = '<?php echo !empty($this->request->data['Relacionamento']) ? count($this->request->data['Relacionamento']) : 0 ?>';
    function addParente(callback){
        $('select').select2('destroy');
        cont++;
        membro = $('#Relacionamento0Membro2Id').parent().clone().html();
        membro = membro.replaceAll('Relacionamento0Membro2Id','Relacionamento'+cont+'Membro2Id').replaceAll('data[Relacionamento][0][membro2_id]','data[Relacionamento]['+ cont+'][membro2_id]');
        relacionamento = $('#Relacionamento0TiporelacionamentoId').parent().clone().html();
        relacionamento = relacionamento.replaceAll('Relacionamento0TiporelacionamentoId','Relacionamento'+cont+'TiporelacionamentoId').replaceAll('data[Relacionamento][0][tiporelacionamento_id]','data[Relacionamento]['+ cont+'][tiporelacionamento_id]');
        $('#parente').append('<div id="'+cont+'" class="col-md-12"><input type="hidden" name="data[Relacionamento]['+cont+'][membro_id]" id="Relacionamento'+cont+'PessoaId" value="<?php echo !empty($this->request->data['Membro']['id']) ? $this->request->data['Membro']['id'] : null ?>"><div class="form-group col-md-6">'+membro+'</div><div class="col-md-1 form-group"><a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>\', \'Relacionamento'+cont+'Membro2Id\', \'Relacionamento0Membro2Id\');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="form-group col-md-3">'+relacionamento+'</div><div class="form-group col-md-1"><a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "tiporelacionamentos", "action" => "add")); ?>\', \'Relacionamento'+cont+'TiporelacionamentoId\', \'Relacionamento'+cont+'TiporelacionamentoId\');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo de Relacionamento" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="col-md-1" style="margin-top: 22px !important"><a href="javascript:;" onclick="removeParente('+cont+')" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i></a></div></div>');

        if (callback) {
            callback();
        }
    }

    function addToolTip() {
        $('[data-toggle="tooltip"]').tooltip();
        $('select').select2();
    }

    $(document).ready(function(){
        addToolTip();
    });