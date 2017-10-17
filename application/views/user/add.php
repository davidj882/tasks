<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Agregar Usuario</h3>
            </div>
            <?php echo form_open_multipart('user/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="profile_id" class="control-label"><span class="text-danger">*</span> Perfil</label>
						<div class="form-group">
							<select name="profile_id" class="form-control input-lg">
								<option value="">selecciona un perfil</option>
								<?php 
								foreach($all_profiles as $profile)
								{
									$selected = ($profile['id_profile'] == $this->input->post('profile_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$profile['id_profile'].'" '.$selected.'>'.$profile['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('profile_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label"><span class="text-danger">*</span> Nombre(s)</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control input-lg" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="lastname" class="control-label"><span class="text-danger">*</span> Apellidos</label>
						<div class="form-group">
							<input type="text" name="lastname" value="<?php echo $this->input->post('lastname'); ?>" class="form-control input-lg" id="lastname" />
							<span class="text-danger"><?php echo form_error('lastname');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="username" class="control-label"><span class="text-danger">*</span> Usuario</label>
						<div class="form-group">
							<input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control input-lg" id="username" />
							<span class="text-danger"><?php echo form_error('username');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="password" class="control-label"><span class="text-danger">*</span> Contraseña</label>
						<div class="form-group">
							<input type="text" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control input-lg" id="password" />
							<span class="text-danger"><?php echo form_error('password');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label"><span class="text-danger">*</span> Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control input-lg" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="color" class="control-label"><span class="text-danger">*</span> Color</label>
						<div class="form-group">
							<input type="text" name="color" value="<?php echo $this->input->post('color'); ?>" class="form-control input-lg" id="color" />
							<span class="text-danger"><?php echo form_error('color');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="picture" class="control-label">Imágen</label>
						<div class="form-group">
							<input id="picture" name="picture" type="file" class="picture" data-show-upload="false" data-show-caption="true">
							<p class="help-block">Archivos permitidos "jpg", "png", "gif"</p>
							<span class="text-danger"><?php echo form_error('picture');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-block btn-lg btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>

<!-- fileinput library -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/css/fileinput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/js/fileinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/js/locales/es.min.js"></script>

<script>
	$(document).ready(function() {
		$("#picture").fileinput({
			language: "es",
    		allowedFileExtensions: ["jpg", "png", "gif"],
    		mainClass: "input-group-lg"
		});
	});
</script>

<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?php echo site_url('assets/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">
<script src="<?php echo site_url('assets/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>

<script>
	$(document).ready(function() {
		//Colorpicker
    	$("#color").colorpicker();
	});
</script>