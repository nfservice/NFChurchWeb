function addToolTip() {
    $('[data-toggle="tooltip"]').tooltip();
}

function addSelect2Multi(membro, tiporelacionamento){
    if (!membro) {
        membro = '.membro';
    }
    if (!tiporelacionamento) {
        tiporelacionamento = '.tiporelacionamento';
    }
    $(tiporelacionamento).select2({
        placeholder: 'Relacionamento',
        allowClear: true,
        minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: commonurl+"secretaria/tiporelacionamentos/selectAjax",
            dataType: 'json',
            method: 'GET',
            quietMillis: 250,
            data: function (term) {
                return {
                    q: term, // search term
                };
            },
            results: function (data) {
                return { results: data.items };
            },
            processResults: function (data, page) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        formatNoMatches: function(term) {
            /* customize the no matches output */
            return 'Sem resultados.';
        },
        escapeMarkup: function (m) { return m; }, // we do not want to escape markup since we are displaying html in results
        initSelection: function(element, callback) {
            var data = {};
            $(element).each(function () {
                var value = this.value.split(",");
                data = {id: value[0], text: value[1]};
            });
            callback(data);
        }
    });

    $(membro).select2({
        placeholder: 'Nome Parente',
        allowClear: true,
        minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: commonurl+"secretaria/membros/selectAjax",
            dataType: 'json',
            method: 'GET',
            quietMillis: 250,
            cache: true,
            data: function (term) {
                return {
                    q: term, // search term
                };
            },
            results: function (data) {
                return { results: data.items };
            },
            processResults: function (data, page) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 1,
        formatNoMatches: function(term) {
            /* customize the no matches output */
            return 'Sem resultados.';
        },
        escapeMarkup: function (m) { return m; }, // we do not want to escape markup since we are displaying html in results
        initSelection: function(element, callback) {
            var data = {};
            $(element).each(function () {
                var value = this.value.split(",");
                data = {id: value[0], text: value[1]};
            });
            callback(data);
        }
    });
}

function addSelect2Ajax(){
    $('#MembroEscolaridadeId').select2({
        placeholder: 'Escolaridade',
        allowClear: true,
        //minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: commonurl+"secretaria/escolaridades/selectAjax",
            dataType: 'json',
            method: 'GET',
            quietMillis: 250,
            data: function (term) {
                return {
                    q: term, // search term
                };
            },
            results: function (data) {
                return { results: data.items };
            },
            processResults: function (data, page) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        formatNoMatches: function(term) {
            /* customize the no matches output */
            return 'Sem resultados.';
        },
        escapeMarkup: function (m) { return m; }, // we do not want to escape markup since we are displaying html in results
        initSelection: function(element, callback) {
            var data = {};
            $(element).each(function () {
                var value = this.value.split(",");
                data = {id: value[0], text: value[1]};
            });
            callback(data);
        }
    });
}

$(document).ready(function(){
    $('#RelacionamentoXMembro2Id').parent().hide();
    $('#RelacionamentoXTiporelacionamentoId').parent().hide();
    addToolTip();
    addSelect2Ajax();
    addSelect2Multi();
});