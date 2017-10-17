<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Tarea</h3>
            </div>
			<?php echo form_open('task/edit/'.$task['id_task']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<!-- NAME -->
					<div class="col-md-6">
						<label for="name" class="control-label">
							<span class="text-danger">*</span>
							Nombre
						</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $task['name']); ?>" class="form-control input-lg" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<!-- USER -->
					<div class="col-md-6">
						<label for="user_id" class="control-label">
							<span class="text-danger">*</span> Usuario
						</label>
						<div class="form-group">
							<select name="user_id" class="form-control input-lg">
								<option value="">selecciona un usuario</option>
								<?php 
									$udata = $this->Rel_tasks_user_model->get_task_user($task['id_task']);
									foreach($all_users as $user):
										$selected = ($user['id_user'] == $udata['user_id']) ? 'selected' : "";
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
					<!-- STATUS -->
					<div class="col-md-6">
						<label for="status_id" class="control-label">
							<span class="text-danger">*</span>
							Estado
						</label>
						<div class="form-group">
							<select name="status_id" class="form-control input-lg">
								<option value="">Selecciona una opción</option>
								<?php foreach ($status as $s): ?>
									<?php 
										$selected = ($task['status_id'] == $s['id_status']) ? 'selected' : '' ; //
									?>
									<option value="<?php echo $s['id_status']; ?>" <?php echo $selected; ?>>
										<?php echo $s['name']; ?>
									</option>
								<?php endforeach ?>
							</select>
							<span class="text-danger"><?php echo form_error('status_id');?></span>
						</div>
					</div>
					<!-- date_start -->
					<div class="col-md-4">
						<label for="date_start" class="control-label">
							<span class="text-danger">*</span>
							Fecha Inicial
						</label>
						<div class="form-group">
			                <div class="input-group date">
			                    <input type="text" name="date_start" value="<?php echo ($this->input->post('date_start') ? $this->input->post('date_start') : $task['date_start']); ?>" class="has-datepicker form-control input-lg" id="date_start" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			                <span class="text-danger"><?php echo form_error('date_start');?></span>
			            </div>
					</div>
					<!-- date_end -->
					<div class="col-md-4">
						<label for="date_end" class="control-label">
							<span class="text-danger">*</span>
							Fecha Compromiso
						</label>
						<div class="form-group">
							<div class="input-group date">
			                    <input type="text" name="date_end" value="<?php echo ($this->input->post('date_end') ? $this->input->post('date_end') : $task['date_end']); ?>" class="has-datepicker form-control input-lg" id="date_end" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			                <span class="text-danger"><?php echo form_error('date_end');?></span>
						</div>
					</div>
					<!-- date_delivered -->
					<div class="col-md-4">
						<label for="date_delivered" class="control-label">
							Fecha Entrega
						</label>
						<div class="form-group">
							<input type="text" value="<?php echo $task['date_delivered']; ?>" class="form-control input-lg" disabled />
						</div>
					</div>
					<!-- description -->
					<div class="col-md-12">
						<label for="description" class="control-label">
							Descripción
						</label>
						<div class="form-group">
							<textarea name="description" class="form-control input-lg" id="description">
								<?php echo ($this->input->post('description') ? $this->input->post('description') : $task['description']); ?>
							</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-lg btn-block btn-success">
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
			focus: true                  // set focus to editable area after initializing summernote
    	});
    });
</script>