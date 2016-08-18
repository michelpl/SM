<?php foreach ($pacientes as $paciente) { ?>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <img src="assets/images/!logged-user.jpg" class="rounded img-responsive" alt="<?php echo $paciente->nome; ?>">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?php echo $paciente->nome; ?></span>
                            <span class="thumb-info-type">Paciente</span>

                        </div>
                    </div>

                    <ul>
                            <?php
                            /*if (!empty($paciente->dataConsulta)) {
                                echo date("d/m/Y", strtotime($paciente->dataConsulta));
                            } else {
                                echo "ainda não avaliado";
                            }*/
                            ?>
                        <li>CPF: <?php echo $paciente->cpf; ?></li>
                        <li>Data de nascimento: <?php echo date( "d/m/Y", strtotime($paciente->data_nascimento)); ?></li>
                        <li>E-mail: <?php echo $paciente->email; ?></li>
                        <li>Convênio: <?php echo $paciente->convenio; ?></li>
                    </ul>
                    <hr class="dotted short">
                    <h6 class="text-muted">Observação</h6>

                    <p></p>

                    <hr class="dotted short">

                </div>
            </section>


            <section class="panel hidden ">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">
                        <span class="label label-primary label-sm text-weight-normal va-middle mr-sm">3</span>
                        <span class="va-middle">Histórico de consultas</span>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="content">
                        <ul class="simple-user-list">
                            <li>
                                <h5>03/03/2015 - Retorno</h5>
                            </li>
                            <li>
                                <h5>10/01/2015 - Consulta</h5>
                            </li>
                        </ul>
                        <hr class="dotted short">

                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </section>

            <section class="panel hidden">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Popular Posts</h2>
                </header>
                <div class="panel-body">
                    <ul class="simple-post-list">
                        <li>
                            <div class="post-image">
                                <div class="img-thumbnail">
                                    <a href="#">
                                        <img src="assets/images/post-thumb-1.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="post-info">
                                <a href="#">Nullam Vitae Nibh Un Odiosters</a>
                                <div class="post-meta">
                                    Jan 10, 2013
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-image">
                                <div class="img-thumbnail">
                                    <a href="#">
                                        <img src="assets/images/post-thumb-2.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="post-info">
                                <a href="#">Vitae Nibh Un Odiosters</a>
                                <div class="post-meta">
                                    Jan 10, 2013
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-image">
                                <div class="img-thumbnail">
                                    <a href="#">
                                        <img src="assets/images/post-thumb-3.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="post-info">
                                <a href="#">Odiosters Nullam Vitae</a>
                                <div class="post-meta">
                                    Jan 10, 2013
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

        </div>
        <div class="col-md-8 col-lg-9">

            <div class="tabs">
                <!----  MENU ABAS ------->
                <ul class="nav nav-tabs tabs-primary">
                    <?php if (isset($_REQUEST['retorno'])) { ?>
                        <li class="active">
                            <a href="#retorno" data-toggle="tab">Retorno</a>
                        </li>
                        <li class="">
                        <?php } else { ?>
                        <li class="active">
                        <?php } ?>
                        <a href="#anamnese" data-toggle="tab">Anamnese</a>
                    </li>

                    <li>
                        <a href="#exameFisico" data-toggle="tab">Exame físico</a>
                    </li>
                    <li>
                        <a href="#historico" data-toggle="tab">Histórico</a>
                    </li>
                </ul>

                <!----  CONTEÚDO ABAS ------->
                <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Consultas/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                <div class="tab-content">
                    <!----  ABA 2------->
                    <?php if (isset($_REQUEST['retorno'])) { ?>
                        <div class="tab-pane active" id="retorno">
                            <fieldset>
                                <br>
                                <h3>Retorno</h3>
                                <hr class="divide-bottom " />
                                <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Perfil/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="evolucao">Evolução:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="evolucao" data-plugin-textarea-autosize style="min-height: 150px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="exameComplementar">Exames complementares:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="exameComplementar" data-plugin-textarea-autosize style="min-height: 150px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="conduta">Conduta:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="conduta" data-plugin-textarea-autosize style="min-height: 150px;"><?php
                                                if (isset($paciente->evacuacao)) {
                                                    
                                                }
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-9 col-sm-offset-3">
                                                <button class="btn btn-primary" name="save" value="retorno">Salvar ficha de retorno</button>
                                            </div>
                                        </div>
                                    </footer>
                                </form>
                            </fieldset>
                        </div>
                    <?php } ?>
                    <!----  ABA 2 ------->
                    <?php if (isset($_REQUEST['retorno'])) { ?>
                        <div class="tab-pane" id="anamnese">
                    <?php } else { ?>
                            
                        <div class="tab-pane active" id="anamnese">
                        <?php } ?>
                            
                            <fieldset>
                                <?php if (isset($consultaAtual['id'])) {?> 
                                <input type="hidden" name="consultaId" value="<?php echo $consultaAtual['id']; ?>"/>
                                <?php }?>
                                <?php if (isset($consultaAtual['anamnese_id'])) {?> 
                                <input type="hidden" name="anamneseId" value="<?php echo $consultaAtual['anamnese_id']; ?>"/>
                                <?php }?>
                                <br>
                                <h3>Ficha de anamnese</h3>
                                <hr class="divide-bottom " />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="queixaPrincipal">Queixa principal:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="1" name="queixaPrincipal" data-plugin-textarea-autosize><?php if (isset($consultaAtual['queixa_principal'])){ echo $consultaAtual['queixa_principal']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="hda">História da doença atual:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="hda" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['hda'])){ echo $consultaAtual['hda']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="historiaPatologicaPregressa">História Patológica Pregressa:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="historiaPatologicaPregressa" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['historia_patologica_pregressa'])){ echo $consultaAtual['historia_patologica_pregressa']; }?></textarea>
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                    </footer>
                            </fieldset>
                        </div>

                        <!----  ABA 3------->
                        <div class="tab-pane" id="exameFisico">
                            <fieldset>
                                <h3 class="mb-md">Exame físico</h3>
                                <?php if (isset($consultaAtual['exame_fisico_id'])) {?> 
                                <input type="hidden" name="exameFisicoId" value="<?php echo $consultaAtual['exame_fisico_id']; ?>"/>
                                <?php }?>
                                
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="inspecao">Inspeção:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="inspecao" data-plugin-textarea-autosizestyle="min-height: 150px;" ><?php if (isset($consultaAtual['inspecao'])){ echo $consultaAtual['inspecao']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="toqueRetal">Toque retal:</label>
                                        <div class="col-md-8">
                                                <textarea class="form-control" rows="5" name="toqueRetal" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['toque_retal'])){ echo $consultaAtual['toque_retal']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="anuscopia">Anuscopia:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="anuscopia" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['anuscopia'])){ echo $consultaAtual['anuscopia']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="retossigmoidoscopia">Retossigmoidoscopia:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="retossigmoidoscopia" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['retossigmoidoscopia'])){ echo $consultaAtual['retossigmoidoscopia']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="conduta">Conduta:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="conduta" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['conduta'])){ echo $consultaAtual['conduta']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="examesComplementares">Exames complementares:</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="5" name="examesComplementares" data-plugin-textarea-autosize style="min-height: 150px;"><?php if (isset($consultaAtual['exames_complementares'])){ echo $consultaAtual['exames_complementares']; }?></textarea>
                                        </div>
                                    </div>
                                    <br>

                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <button class="btn btn-primary" name="save" value="consulta">Salvar anamnese e exame físico</button>
                                            </div>
                                        </div>
                                    </footer>
                                
                            </fieldset>
                        </div>
                        <!----  ABA 4 ------->
                        <div class="tab-pane" id="historico">
                            <?php
                            
                            
                            ?>
                                <h3 class="mb-md">Histórico</h3>
                                <hr class="divide-bottom" />
                                    <?php  if(isset($historico) && count($historico)>0){ ?>
                                        <?php foreach($historico as $hist){ ?>
                                        <div class="row">
                                                <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Perfil/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                                                    <fieldset>
                                                        <section class="panel col-md-12">
                                                            <header class="panel-heading">
                                            
                                                                <h5>Atendimento iniciado em <?php echo  date( "d/m/Y", strtotime($hist['data_criacao']));  ?></h5>
                                                            </header>
                                                            <div class="panel-body panel right">
                                                                <p>Consulta: <?php echo date( "d/m/Y", strtotime($hist['data_criacao']));  ?></p>    
                                                                <p>Retorno: <?php if(!empty($hist['dataRetorno'])){ echo date( "d/m/Y", strtotime($hist['dataRetorno'])); }else{ echo "consulta finalizada sem retorno";  } ?></p>    
                                                                <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim  btn btn-primary" href="#hist-<?=$hist['id']?>"  style="float:right;">Visualizar atendimento</a>
                                                                <div id="hist-<?=$hist['id']?>" class="modal-block modal-block-primary mfp-hide">
                                                                    <section class="panel">
                                                                        <header class="panel-heading">
                                                                            <h2 class="panel-title">Histórico</h2>
                                                                            <div class="panel-actions">
                                                                                <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                                                                                <a class="modal-dismiss panel-action-dismiss" href="#"></a>
                                                                            </div>
                                                                        </header>
                                                                        <div class="panel-body">
                                                                            <div class="tabs">
                                                                                <!----  MENU ABAS ------->
                                                                                <ul class="nav nav-tabs tabs-primary">
                                                                                    <?php if(!empty($hist['dataRetorno'])){ ?>
                                                                                    <li class="active">
                                                                                        <a href="#histRetorno" data-toggle="tab">Retorno</a>
                                                                                    </li>
                                                                                    <li>
                                                                                    <?php }else{ ?>
                                                                                    <li class="active">
                                                                                    <?php }?>    
                                                                                        <a href="#histAnamnese" data-toggle="tab">Anamnese</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="#histExameFisico" data-toggle="tab">Exame físico</a>
                                                                                    </li>
                                                                                </ul>
                                                                                <!----  CONTEÚDO ABAS ------->
                                                                                <div class="tab-content">
                                                                                    <!-- Histórico Retorno -->
                                                                                    <?php if(!empty($hist['dataRetorno'])){ ?>
                                                                                    
                                                                                    <div class="tab-pane active" id="histRetorno">
                                                                                        <fieldset>
                                                                                            <br>
                                                                                            <h3>Retorno</h3>
                                                                                            <hr class="divide-bottom " />
                                                                                            <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Perfil/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="evolucao">Evolução:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['evolucao'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="exameComplementar">Exames complementares:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['exame_complementar'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="conduta">Conduta:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['condutaRetorno'] ?>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </form>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="histAnamnese">
                                                                                    <?php }else{  ?>
                                                                                    <div class="tab-pane active" id="histAnamnese">
                                                                                    <?php } ?>
                                                                                    <!-- Histórico Anamnese -->
                                                                                        <fieldset>
                                                                                            <br>
                                                                                            <h3>Ficha de anamnese</h3>
                                                                                            <hr class="divide-bottom " />
                                                                                            <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Perfil/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="queixaPrincipal">Queixa principal:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['queixa_principal'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="textareaAutosize">História da doença atual:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['hda'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="historiaPatologicaPregressa">História Patológica Pregressa:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['historia_patologica_pregressa'] ?>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </form>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                    <!-- Histórico exame físico-->
                                                                                    <div class="tab-pane" id="histExameFisico">
                                                                                        <fieldset>
                                                                                            <h3 class="mb-md">Exame físico</h3>

                                                                                            <form class="form-horizontal form-bordered" method="post" action="<?php echo base_url(); ?>index.php/Perfil/save?pacienteId=<?= $_REQUEST['pacienteId']; ?>">
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="inspecao">Inspeção:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['inspecao'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="toqueRetal">Toque retal:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['toque_retal'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="anuscopia">Anuscopia:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['anuscopia'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="retossigmoidoscopia">Retossigmoidoscopia:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['retossigmoidoscopia'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="textareaAutosize">Conduta:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['conduta'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-md-3 control-label" for="textareaAutosize">Exames complementares:</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <?= $hist['exames_complementares'] ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                            </form>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </fieldset>
                                                </form>
                                        </div>
                                    <?php 
                                        }
                                    }else{ ?>
                                        <h4>Esse paciente ainda não possui nenhuma consulta.</h4>
                                    <?php 
                                    } 
                                    ?>
                                    <footer class="panel-footer">
                                    </footer>
                            </div>

                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-12 col-lg-3 hidden">

                <h4 class="mb-md">Sale Stats</h4>
                <ul class="simple-card-list mb-xlg">
                    <li class="primary">
                        <h3>488</h3>
                        <p>Nullam quris ris.</p>
                    </li>
                    <li class="primary">
                        <h3>$ 189,000.00</h3>
                        <p>Nullam quris ris.</p>
                    </li>
                    <li class="primary">
                        <h3>16</h3>
                        <p>Nullam quris ris.</p>
                    </li>
                </ul>

                <h4 class="mb-md">Projects</h4>
                <ul class="simple-bullet-list mb-xlg">
                    <li class="red">
                        <span class="title">Porto Template</span>
                        <span class="description truncate">Lorem ipsom dolor sit.</span>
                    </li>
                    <li class="green">
                        <span class="title">Tucson HTML5 Template</span>
                        <span class="description truncate">Lorem ipsom dolor sit amet</span>
                    </li>
                    <li class="blue">
                        <span class="title">Porto HTML5 Template</span>
                        <span class="description truncate">Lorem ipsom dolor sit.</span>
                    </li>
                    <li class="orange">
                        <span class="title">Tucson Template</span>
                        <span class="description truncate">Lorem ipsom dolor sit.</span>
                    </li>
                </ul>

                <h4 class="mb-md">Messages</h4>
                <ul class="simple-user-list mb-xlg">
                    <li>
                        <figure class="image rounded">
                            <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                        </figure>
                        <span class="title">Joseph Doe Junior</span>
                        <span class="message">Lorem ipsum dolor sit.</span>
                    </li>
                    <li>
                        <figure class="image rounded">
                            <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle">
                        </figure>
                        <span class="title">Joseph Junior</span>
                        <span class="message">Lorem ipsum dolor sit.</span>
                    </li>
                    <li>
                        <figure class="image rounded">
                            <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle">
                        </figure>
                        <span class="title">Joe Junior</span>
                        <span class="message">Lorem ipsum dolor sit.</span>
                    </li>
                    <li>
                        <figure class="image rounded">
                            <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                        </figure>
                        <span class="title">Joseph Doe Junior</span>
                        <span class="message">Lorem ipsum dolor sit.</span>
                    </li>
                </ul>
            </div>

        </div>
        <?php
    }?>