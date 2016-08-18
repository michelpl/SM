<?php if(isset($profile)){ ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-6 col-lg-4">
            <section class="panel">
                
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                            <img alt="<?php echo $username; ?>" class="rounded img-responsive" src="<?php echo base_url(); ?>assets/images/<?php echo $this->session->user['image'] ?>" width="100%">
                            <div class="thumb-info-title">
                                    <span class="thumb-info-inner"><?php echo $this->session->user['firstName'] . " " . $this->session->user['lastName']; ?></span>
                                    <span class="thumb-info-type"><?php echo $this->session->user['profileName']; ?></span>
                            </div>
                    </div>

                    <div class="widget-toggle-expand mb-md">
                        <div class="widget-content-expanded">
                            <form id="form" action="<?php echo base_url(); ?>index.php/Perfil" class="form-horizontal" method="post">
                                <input name="userId" type="hidden" value="<?php print_r($this->session->user['id']); ?>" />
                                <section class="panel">
                                    <header class="panel-heading">
                                            <h2 class="panel-title">Alterar senha</h2>
                                            <p class="panel-subtitle">
                                                    Insira sua senha antiga, a nova senha e clique em alterar.
                                            </p>
                                    </header>
                                    <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Senha antiga <span class="required">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="form-control password" type="password" name="oldPassword" title="Insira sua senha antiga" required autocomplete="off" value="" placeholder="Sua senha antiga">
                                                </div>
                                                
                                            </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Nova senha <span class="required">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control password" minlenght="3" type="password" maxlength="10" data-plugin-maxlength="" title="Insira sua nova senha" name="newPassword" required autocomplete="off" value="" placeholder="Senha de 5 a 10 caracteres">
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                            <div class="row">
                                                    <div class="col-sm-3 col-sm-offset-8">
                                                        <button class="btn btn-primary" name="save">Alterar</button>
                                                    </div>
                                            </div>
                                    </footer>
                                </section>
                        </form>
                        </div>
                    </div>

                    <hr class="dotted short">

            </div>
            </section>
        </div>
<?php } ?>      