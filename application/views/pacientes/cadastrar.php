<script>

$(document).ready(function(){
     
     buscarGrupos();
     $("#convenio").on("change", function(){
         if($("#convenio option:selected" ).val() == "0"){
           $(".grupo").hide();
           showCadastroGrupo(0); 
         }else{
           $(".grupo").show();
           buscarGrupos();
         }
         
     })
     
     $("#convenio").on("click", function(){
         if($("#grupo option:selected" ).val() == "0"){
             showCadastroGrupo(1);
         }else{
             showCadastroGrupo(0);
         }
     });
     $("#grupo").on("click", function(){
        if($("#grupo option:selected").val() == "0"){
            showCadastroGrupo(1);
        }else{
            showCadastroGrupo(0);
        }
     });

    $("#buscaCep").on("click", function(){
        alert(1);
    })
    $("#cep").on("keyup", function(){
        buscaCep($("#cep").val());
    })

     
});

function buscarGrupos(){
    url = "<?php echo base_url(); ?>index.php/Convenios/buscarGruposJson";
    $.ajax({
        method: "POST",
        url: url,
        data: { convenio: $("#convenio").val()}
      })
    .done(function(json) {
            
        if(json){
            if($.parseJSON(json).length > 0){
                html = "<option value='' id='cadastrar' selected>Selecione</option>";
                html += "<option value='0' id='cadastrar'>Novo grupo</option>";
            }else{
                html = "<option value='' id='cadastrar'>Nenhum grupo enontrado</option>";
                html += "<option value='0' id='cadastrar'>Novo grupo</option>";
            }
            $.each($.parseJSON(json), function() {
                html += "<option value='" + this.id + "'";
                if(this.id === $("#grupoId").val()){
                    html += " selected ";
                    $("#grupoId").val(this.id);
                }
                html += " >" +this.nome + "</option>";
            });
            
            $("#grupo").html(html);
        }
    });
}

function showCadastroGrupo(exibir){
    if(exibir == 1){
        $(".novoGrupoBox").removeClass("hidden").show();
    }else{
        $(".novoGrupoBox").hide();
    }
}
</script>
<div class="row">
    <div class="col-xs-12">
        <form id="form" action="<?php echo base_url(); ?>index.php/Pacientes/cadastrar" class="form-horizontal" method="POST">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>

                    <h2 class="panel-title">Cadastro de pacientes</h2>
                    <p class="panel-subtitle">
                        Insira as informações do paciente no formulário abaixo e depois clique em salvar.<br>
                        Todos os campos marcados com * são obrigatórios.
                    </p>
                </header>
                <div class="panel-body">
                    <fieldset>
                        <?php if(isset($_REQUEST['pacienteId'])){?>
                            <input type="hidden" name="pacienteId" id="pacienteId" value="<?php echo $_REQUEST['pacienteId']; ?>" />
                        <?php } ?>
                        <?php if(isset($pacientes[0]['endereco_id'])){?>
                            <input type="hidden" name="enderecoId" id="enderecoId" value="<?php echo $pacientes[0]['endereco_id']; ?>" />
                        <?php } ?>
                        <br>
                        <h4>Informações pessoais</h4>
                        <hr class="divide-bottom " />
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome completo: <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="nome" class="form-control" placeholder="Nome completo do paciente" required title="Insira o nome completo do paciente" value="<?php if(isset($pacientes[0]['nome'])){ echo $pacientes[0]['nome'];} ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">CPF: <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="cpf" class="form-control maskCpf" placeholder="Digite o CPF sem pontos ou traços" title="Insira o CPF" <?php if(isset($pacientes[0]['cpf'])){ echo "value='" . $pacientes[0]['cpf'] . "' readonly";} ?> required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="dataNascimento">Data de nascimento: </label>
                            <div class="col-sm-6">
                                <input type="text" name="dataNascimento" class="form-control maskDate" placeholder="Data de nascimento(ex: 01/01/1950)" value="<?php if(isset($pacientes[0]['data_nascimento'])){ echo date("d/m/Y",  strtotime($pacientes[0]['data_nascimento']));} ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">E-mail: </label>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control" placeholder="E-mail - Opcional" value="<?php if(isset($pacientes[0]['email'])){ echo $pacientes[0]['email'];} ?>" />
                            </div>
                        </div>
                       
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profissão: </label>
                            <div class="col-sm-6">
                                <input type="text" name="profissao" class="form-control" placeholder="Profissão" value="<?php if(isset($pacientes[0]['profissao'])){ echo $pacientes[0]['profissao'];} ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Estado civil: </label>
                            <div class="col-md-6">
                                <select class="form-control" name="estadoCivil" data-plugin-multiselect id="estadoCivil" name="estadoCivil">
                                    <?php
                                        foreach($estadoCivil as $k => $ec){
                                            if(isset($pacientes[0]['estado_civil']) && $pacientes[0]['estado_civil'] === $k){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            echo "<option " . $selected . " value='" . $k . "'>" . $ec . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    
                    <br>
                    <h4>Convênio</h4>
                    <hr class="divide-bottom " />
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Marca ótica: </label>
                        <div class="col-sm-6">
                            <input type="text" name="marcaOtica" class="form-control" placeholder="Marca ótica" value="<?php if(isset($pacientes[0]['marca_otica'])){ echo $pacientes[0]['marca_otica'];} ?>" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Convênio: </label>
                        <div class="col-md-6">
                            <select data-plugin-selectTwo class="form-control populate" name="convenio" id="convenio" required title="Selecione o convênio">
                                <?php

                                    foreach($convenios as $convenio){
                                        if(isset($pacientes[0]['convenio_id'])){
                                            if($pacientes[0]['convenio_id'] === $convenio->id){
                                                $selected = "selected";
                                                $achou  = TRUE;
                                            }else{
                                                $selected = "";
                                            }

                                        }
                                        echo "<option " . $selected . " value='" . $convenio->id . "'>" . $convenio->nome . "</option>";
                                    }
                                    if(isset($pacientes[0]['convenio_id']) && !isset($achou)){
                                        echo "<option selected='selected' value='0'>Não encontrado</option>";
                                    }
                                ?>
                            </select>
                            <?php
                            if(isset($pacientes[0]['convenio_id']) && !isset($achou)){ ?>
                                 <div class="alert alert-danger">
                                    <strong>Atenção!</strong> O convênio desse paciente foi desabilitado ou não existe mais. <a href="<?php echo base_url(); ?>index.php/Convenios/editar?convenioId=<?php echo $pacientes[0]['convenio_id']; ?>" class="alert-link" target="_blank">Clique aqui para checar</a>.
                                </div>       
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="form-group grupo">
                        <label class="col-sm-2 control-label">Grupo: </label>
                        <div class="col-md-6">
                            <select  class="form-control" name="grupo" id="grupo" required title="Selecione o convênio">
                                <option value=''>Selecione</option>
                                <?php
                                    if(isset($pacientes[0]['grupoNome']) && $pacientes[0]['grupoNome'] != ""){ 
                                        echo "<option selected='selected' value='" . $pacientes[0]['grupo_id'] . "'>" . $pacientes[0]['grupoNome'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" id="grupoId" value="<?php if(isset($pacientes[0]['grupo_id'])){ echo $pacientes[0]['grupo_id'];} ?>" />
                        <br>
                    </div>
                    <div class="form-group novoGrupoBox hidden">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-md-6">
                            <input type="text" name="novoGrupo" class="form-control" placeholder="Novo grupo" required title="Insira o grupo do convênio" />
                        </div>
                        <br>
                    </div>
                        
                    
                    
                    
                    <br>
                    <h4>Endereço</h4>
                    <hr class="divide-bottom " />
                    <div class="form-group">
                        <label class="col-md-2 control-label">CEP </label>
                        <div class="col-md-6">
                            <div class="input-group input-group-icon">
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP sem pontos ou traços" value="<?php if(isset($pacientes[0]['cep'])){ echo $pacientes[0]['cep'];} ?>">
                                <span class="input-group-addon">
                                    <span class="icon" style="cursor: pointer;"><i id="buscaCep" class="fa fa-search"></i></span>
                                    <div class="loading"></div>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Logradouro<span class="required">*</span> </label>
                        <div class="col-sm-6">
                            <input type="text" id="logradouro" name="logradouro" class="form-control" placeholder="Rua, Avenida, Praça, Etc..." value="<?php if(isset($pacientes[0]['logradouro'])){ echo $pacientes[0]['logradouro'];} ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Número<span class="required">*</span> </label>
                        <div class="col-sm-6">
                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Número" value="<?php if(isset($pacientes[0]['numero'])){ echo $pacientes[0]['numero'];} ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Complemento </label>
                        <div class="col-sm-6">
                            <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Apto, Bloco, Casa, Frente/Fundos, Etc..." value="<?php if(isset($pacientes[0]['complemento'])){ echo $pacientes[0]['complemento'];} ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bairro<span class="required">*</span> </label>
                        <div class="col-sm-6">
                            <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro" value="<?php if(isset($pacientes[0]['bairro'])){ echo $pacientes[0]['bairro'];} ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cidade<span class="required">*</span> </label>
                        <div class="col-sm-6">
                            <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="<?php if(isset($pacientes[0]['cep'])){ echo $pacientes[0]['cep'];}else{ echo "Rio de Janeiro";} ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estado<span class="required">*</span> </label>
                        <div class="col-md-6">
                        <select class="form-control " id="uf" name="uf" required title="Selecione o estado">
                            <?php
                                foreach($estados as $uf => $estado){
                                    if(!isset($pacientes[0]['uf']) && $uf == "RJ"){
                                            $selected = "selected";
                                    }else{
                                        if(isset($pacientes[0]['uf']) && trim($pacientes[0]['uf']) == trim($uf)){
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        }
                                    }
                                    echo "<option " . $selected . " value='" . $uf . "'>" . $estado . "</option>";
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-primary" name="save">Salvar cadastro</button>
                        </div>
                        
                    </div>
                </footer>
            </section>
        </form>
    </div>
</div>


<hr class="solid mb-none" />



<!-- end: page -->
</section>