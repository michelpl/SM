
<link href="<?php echo base_url();?>assets/stylesheets/login.css" rel="stylesheet" type="text/css" />
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        

        <div class="panel panel-sign">
            
            <div class="panel-body">
                <div class="full-width">
                    <a href="/" class="logo">
                        <img src="<?php echo base_url();?>assets/images/logo.png" height="54" alt="CPA" />
                    </a>   
                </div>
                <hr>
                <?php echo validation_errors(); ?>
                <?php echo form_open('VerifyLogin'); ?>
                    <div class="form-group mb-lg">
                        <label>Usuário</label>
                        <div class="input-group input-group-icon">
                            <input name="username" type="text" class="form-control input-lg" placeholder="Nome de usuário" required="required" />
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-user"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left">Senha</label>
                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" class="form-control input-lg" placeholder="Senha" required="password" />
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">Entrar</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright <?php echo date("Y") ?>. All Rights Reserved.</p>
    </div>

<!-- end: page -->

<!-- Vendor -->
<script src="assets/vendor/jquery/jquery.js"></script>
<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>

