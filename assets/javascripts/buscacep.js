
function buscaCep(cep){
    cep = cepFilter(cep);
    $("#cep").val(cep);
    limpaCampos();
    if(cep.length === 8) {
        $.ajax({
            type: "GET",
            dataType: "jsonp",
            url: "http://api.postmon.com.br/v1/cep/" + cep,
            cache: false,
            data: {cep: cep},
            beforeSend: function () {
                showLoading();
            }
        })
            .done(function (data) {
                if (data.logradouro) {
                    console.log(data);
                    $("#logradouro").val(data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#uf").val(data.estado).change();
                }
                hideLoading();
            })
            .error(function () {
                showErrorCep();
                hideLoading();
            })
        ;
    }
}

function limpaCampos(){
    $("#logradouro").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

function showErrorCep(){
    $(".errorCep").show();
}
function hidErrorCep(){
    $(".errorCep").hide();
}

function cepFilter(cep){
    return cep.replace(/[^0-9]/g,'');
}