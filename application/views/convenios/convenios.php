<!--INÍCIO MODAL-->

<script>
$(document).ready(function(){
    $(".novaConsulta").click(function(){
        $(".<?php echo $page; ?>").addClass("nav-active").parent().parent().addClass("nav-active nav-expanded");

        $.magnificPopup.open({
            items: {
                src: '#modalRetorno'
            },
            type: 'inline'
        });
        $("#criarNova").attr("formId", "form-consulta-" + $(this).attr("pacienteId"));
    });
    $("#criarNova").on("click",function(){
        $("#" + $(this).attr("formId")).submit();
    });
});
    
    

</script>
    <div id="modalRetorno" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Atenção</h2>
            </header>
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <h4>Esse paciente ainda não possui retorno da última consulta. <br>Deseja <span class="text-danger">FINALIZAR</span> a consulta anterior e iniciar uma nova?</h4>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary modal-dismiss" id="criarNova" formId="">Sim, finalizar</button>
                        <button class="btn btn-primary modal-dismiss">Cancelar</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>

<style>
    .info > h4 {
        color: #999;
    }

    .h3.title.text {
        margin-left: 4px;
    }
</style>
<div class="row">
    <div class="col-md-12 col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle title="Minimizar"></a>
                </div>

                <h2 class="panel-title">Buscar convênio</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" action="<?php echo base_url(); ?>index.php/Convenios">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Convênio</label>
                        
                        <div class="col-md-7">
                            <select data-plugin-selectTwo class="form-control populate" name="convenio" required title="Selecione o convênio" required title="Escolha o convenio">
                                <option value="">Selecione</option>
                                <?php

                                    foreach($comboConvenios as $convenio){
                                        echo "<option " . $selected . " value='" . $convenio->id . "'>" . $convenio->nome . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" name="search">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<?php if (isset($convenios)&& is_array($convenios) && count($convenios) > 0) { ?>
    <?php if(isset($_REQUEST['search'])){ ?>
        <?php if (count($convenios) > 1) { ?>
            <p><?php echo count($convenios); ?> resultados para a busca: <span class="bold">"<?php echo $_REQUEST['search']; ?>"</span></p>
        <?php } else { ?>
            <p><?php echo count($convenios); ?> resultado para a busca: <span class="bold">"<?php echo $_REQUEST['search']; ?>"</span></p>
        <?php } ?>
    <?php } ?>
    <ul class="list-unstyled">
        <?php
        foreach ($convenios as $convenio) { ?>
            <li>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#" title="Minimizar"></a>
                                </div>

                                <h2 class="panel-title">
                                    <?php if ($convenio['status'] == 1) { ?>
                                        <span class="label label-success label-sm text-weight-semibold va-middle mr-sm">Ativo</span>
                                    <?php } else { ?>
                                        <span class="label label-danger label-sm text-weight-semibold va-middle mr-sm">Inativo</span>
                                    <?php } ?>
                                        <span class="va-middle">
                                            <?php echo $convenio['nome']; ?>
                                        </span>
                                </h2>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div>
                                        <section class="">
                                            <div class="panel-body">
                                                <h4>
                                                    <a href="<?php echo base_url(); ?>index.php/Convenios/editar?grupoId=<?php echo $convenio['id']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                        Editar convênio
                                                    </a>
                                                </h4>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </section>
                    </div>
                </div>

            </li>
            <?php
        }
        ?>


    </ul>
<?php } else { ?>
    <p>Nenhum resultado encontrado.</p>
<?php } ?>
<hr class="solid mb-none" />

<ul class="pagination hidden">
    <li class="prev disabled">
        <a href="#">
            <i class="fa fa-chevron-left"></i>
        </a>
    </li>
    <li class="active">
        <a href="#">1</a>
    </li>
    <li>
        <a href="#">2</a>
    </li>
    <li>
        <a href="#">3</a>
    </li>
    <li>
        <a href="#">4</a>
    </li>
    <li>
        <a href="#">5</a>
    </li>
    <li class="next">
        <a href="#">
            <i class="fa fa-chevron-right"></i>
        </a>
    </li>
</ul>


<!-- end: page -->
</section>