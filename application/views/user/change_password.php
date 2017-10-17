<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <?php if (isset($update_password)): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>¡Contraseña Actualizada Correctamente!</strong>
                    </div>
                <?php endif ?>
                <?php echo form_open('user/change_password'); ?>
                
                    <div class="form-group">
                        <label for="">Contraseña Anterior</label>
                        <input type="text" name="old_pass" class="form-control input-lg" placeholder="Ingresa tu contraseña actual">
                        <span class="text-danger"><?php echo form_error('old_pass');?></span>
                    </div>

                    <div class="form-group">
                        <label for="">Contraseña Nueva</label>
                        <input type="text" name="new_pass" class="form-control input-lg" placeholder="Ingresa tu nueva contraseña">
                        <span class="text-danger"><?php echo form_error('new_pass');?></span>
                    </div>

                    <div class="form-group">
                        <label for="">Confirmar contraseña</label>
                        <input type="text" name="pass_con" class="form-control input-lg" placeholder="Confirma tu nueva contraseña">
                        <span class="text-danger"><?php echo form_error('pass_con');?></span>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-lg">
                        <i class="fa fa-unlock-alt"></i> Cambiar contraseña
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>