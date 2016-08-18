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
    <div class="col-xs-6">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle title="Minimizar"></a>
                </div>

                <h2 class="panel-title">Buscar paciente</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" action="<?php echo base_url(); ?>index.php/Pacientes">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Paciente</label>
                        <div class="col-md-10">
                            <div class="input-group input-search">
                                <input type="text" placeholder="Digite o nome, CPF ou marca ótica do paciente" id="search" name="search" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</div>
<?php if (isset($pacientes)&& is_array($pacientes) && count($pacientes) > 0) { ?>
    <?php if(isset($_REQUEST['search'])){ ?>
        <?php if (count($pacientes) > 1) { ?>
            <p><?php echo count($pacientes); ?> resultados para a busca: <span class="bold">"<?php echo $_REQUEST['search']; ?>"</span></p>
        <?php } else { ?>
            <p><?php echo count($pacientes); ?> resultado para a busca: <span class="bold">"<?php echo $_REQUEST['search']; ?>"</span></p>
        <?php } ?>
    <?php } ?>
    <ul class="list-unstyled">
        <?php foreach ($pacientes as $paciente) { ?>
            <li>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#" title="Minimizar"></a>
                                </div>

                                <h2 class="panel-title">
                                    <?php if ($paciente['status'] == 1) { ?>
                                        <span class="label label-success label-sm text-weight-semibold va-middle mr-sm">Paciente ativo</span>
                                    <?php } else { ?>
                                        <span class="label label-danger label-sm text-weight-semibold va-middle mr-sm">Paciente inativo</span>
                                    <?php } ?>
                                        <span class="va-middle">
                                            <?php echo $paciente['nome']; ?>
                                            
                                        </span>

                                </h2>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                        <section class="">
                                            <div class="panel-body">
                                                    <?php if(count($paciente['consultaNaoFinalizada'])>0){ ?>
                                                    <form id="form-consulta-<?php echo $paciente['id']; ?>" action="<?php echo base_url(); ?>index.php/Consultas?pacienteId=<?php echo $paciente['id']; ?>" method="POST">
                                                            <h4 class="btn-link novaConsulta" style="cursor:pointer" pacienteId="<?php echo $paciente['id']; ?>"><span><i class="fa fa-plus"></i> Nova consulta</span></h4>
                                                    </form>
                                                <?php }else{ ?>
                                                    <h4><a href="<?php echo base_url(); ?>index.php/Consultas?pacienteId=<?php echo $paciente['id']; ?>"><i class="fa fa-plus"></i> Nova consulta</a></h4>
                                                <?php } ?>
                                                <p>Iniciar nova consulta</p>
                                            </div>
                                        </section>
                                    </div>
                                    <?php if(count($paciente['consultaNaoFinalizada'])>0){ ?>
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                            <section class="">
                                                <div class="panel-body">
                                                    <h4><a href="<?php echo base_url(); ?>index.php/Consultas?pacienteId=<?php echo $paciente['id']; ?>&retorno=1"><i class="fa fa-history" ></i> Retorno</a></h4>
                                                    <p>Última consulta em: 10/01/2015</p>
                                                </div>
                                            </section>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br>
                                <p>Convênio: <?php echo $paciente['convenio']; ?></p>
                                <p>CPF: <?php echo $paciente['cpf']; ?></p>
                                <?php if (isset($paciente['email'])) { ?>
                                    <p>E-mail: <?php echo $paciente['email']; ?></p>
                                <?php } ?>
                                <hr class="dotted short">
                                <h5>
                                    <a href="<?php echo base_url(); ?>index.php/Pacientes/editar?pacienteId=<?php echo $paciente['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                        Editar ficha cadastral do paciente.
                                    </a>
                                </h5>
                            </div>

                            <!--<div class="panel-footer" style="display: block;"> <a href="#"><h5><i class="fa fa-plus-square"></i> Ver dados pessoais do paciente</h5></a></div>-->
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