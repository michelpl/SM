<script>
    
</script>
<div class="row">
    <div class="col-xs-12">
        <form id="form" action="<?php echo base_url(); ?>index.php/Convenios/cadastrar" class="form-horizontal" method="POST">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>

                    <h2 class="panel-title">Cadastro de convênios</h2>
                    <p class="panel-subtitle">
                        Insira as informações do convênio no formulário abaixo e depois clique em salvar.<br>
                        Todos os campos marcados com * são obrigatórios.
                    </p>
                </header>
                <div class="panel-body">
                    <fieldset>
                        <?php if(isset($_REQUEST['grupoId'])){?>
                            <input type="hidden" name="grupoId" id="grupoId" value="<?php echo $_REQUEST['grupoId']; ?>" />
                            <input type="hidden" name="convenio" id="convenio" value="<?php echo $grupo[0]['convenio_id']; ?>" />
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome do convenio: <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <?php if(isset($grupo[0]['convenioNome'])){ ?>
                                <input type="text" name="convenioNome" class="form-control"required value="<?php if(isset($grupo[0]['convenioNome'])){ echo $grupo[0]['convenioNome'];} ?>" disabled="disabled" />
                                <?php }else{ ?>
                                    <select data-plugin-selectTwo class="form-control populate" name="convenio" required title="Selecione o convênio" required title="Escolha o convenio">
                                        <option value="">Selecione</option>
                                        <?php

                                            foreach($comboConvenios as $convenio){
                                                echo "<option " . $selected . " value='" . $convenio->id . "'>" . $convenio->nome . "</option>";
                                            }
                                        ?>
                                    </select>
                                <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Grupo: <span class="required">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="nome" class="form-control" placeholder="Nome do grupo" required title="Insira o nome do grupo" value="<?php if(isset($grupo[0]['nome'])){ echo $grupo[0]['nome'];} ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status: <span class="required">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" data-plugin-multiselect id="status" name="status">
                                    <?php if(isset($grupo[0]['status'])){
                                        if($grupo[0]['status'] == 1){
                                            echo "<option value='1' selected>Ativo </option>";
                                            echo "<option value='0'>Inativo (Não será possível selecioná-lo na ficha de um paciente)</option>";
                                        }else{
                                            echo "<option value='1'>Ativo </option>";
                                            echo "<option value='0' selected>Inativo (Não será possível selecioná-lo na ficha de um paciente)</option>";
                                        }
                                    }else{ ?>
                                        <option value='1'>Ativo </option>
                                        <option value="0">Inativo (Não será possível selecioná-lo na ficha de um paciente)</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                        
                    
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