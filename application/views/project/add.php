<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Nuevo Proyecto</h3>
            </div>
            <?php echo form_open('project/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
          			<div class="col-md-4">
						<label for="name" class="control-label"><span class="text-danger">*</span> Nombre</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control input-lg" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="user_id" class="control-label">
							<span class="text-danger">*</span> Usuario
						</label>
						<div class="form-group">
							<select name="user_id" class="form-control input-lg">
								<option value="">selecciona un usuario</option>
								<?php 
									foreach($all_users as $user):
										$selected = ($user['id_user'] == $this->input->post('user_id')) ? ' selected="selected"' : "";
								?>
									<option value="<?php echo $user['id_user']; ?>" <?php echo $selected; ?>>
										<?php echo $user['name']."  ".$user['lastname']; ?>
									</option>
								<?php
									endforeach;
								?>
							</select>
							<span class="text-danger"><?php echo form_error('user_id');?></span>
						</div>
					</div>
          			<div class="col-md-4">
						<label for="enterprise_id" class="control-label"><span class="text-danger">*</span> Empresa</label>
						<div class="form-group">
							<select name="enterprise_id" class="form-control input-lg">
								<option value="">selecciona una empresa</option>
								<?php 
								foreach($all_enterprises as $enterprise)
								{
									$selected = ($enterprise['id_enterprise'] == $this->input->post('enterprise_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$enterprise['id_enterprise'].'" '.$selected.'>'.$enterprise['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('enterprise_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="date_start" class="control-label"><span class="text-danger">*</span> Fecha Inicial</label>
						<div class="form-group">
			                <div class="input-group date">
			                    <input type="text" name="date_start" value="<?php echo $this->input->post('date_start'); ?>" class="has-datepicker form-control input-lg" id="date_start" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			                <span class="text-danger"><?php echo form_error('date_start');?></span>
			            </div>
					</div>
					<div class="col-md-6">
						<label for="date_end" class="control-label"><span class="text-danger">*</span> Fecha Entrega</label>
						<div class="form-group">
			                <div class="input-group date">
			                    <input type="text" name="date_end" value="<?php echo $this->input->post('date_end'); ?>" class="has-datepicker form-control input-lg" id="date_end" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			                <span class="text-danger"><?php echo form_error('date_end');?></span>
			            </div>
					</div>
					<div class="col-md-6">
						<label for="description" class="control-label"><span class="text-danger">*</span> Descripción</label>
						<div class="form-group">
							<textarea name="description" id="description" class="form-control input-lg">
								<?php echo $this->input->post('description'); ?>
							</textarea>
							<span class="text-danger"><?php echo form_error('description');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="specifications" class="control-label"><span class="text-danger">*</span> Especificaciones</label>
						<div class="form-group">
							<textarea name="specifications" id="specifications" class="form-control input-lg">
								<?php echo $this->input->post('specifications'); ?>
							</textarea>
							<span class="text-danger"><?php echo form_error('specifications');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="ranges" class="control-label">
							<span class="text-danger">*</span> Alcances y Limitaciones</label>
						<div class="form-group">
							<textarea name="ranges" id="ranges" class="form-control input-lg">
								<?php echo $this->input->post('ranges'); ?>
							</textarea>
							<span class="text-danger"><?php echo form_error('ranges');?></span>
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

<!-- DATEPICKER PLUGIN -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/datepicker/datepicker3.css'); ?>">
<script src="<?php echo site_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/datepicker/locales/bootstrap-datepicker.es.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('.date').datepicker({
    		format: 'yyyy-mm-dd',
    		language: 'es'
    	});
    });
</script>
<!-- SUMMERNOTE PLUGIN -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/summernote/summernote.css') ?>">
<script src="<?php echo site_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('textarea').summernote({
			height: 300,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			//focus: true                  // set focus to editable area after initializing summernote
    	});
    });
</script>