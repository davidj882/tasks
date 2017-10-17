<div class="row">
	<div class="col-md-3">
		<a href="<?php echo site_url('message/') ?>" class="btn btn-primary btn-block margin-bottom">
			<i class="fa fa-inbox"></i> Bandeja de entrada
		</a>

		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Carpetas</h3>

				<div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body no-padding">
				<ul class="nav nav-pills nav-stacked">
					<li>
						<a href="<?php echo site_url('message/') ?>">
							<i class="fa fa-inbox"></i> Recibidos
							<span class="label label-primary pull-right">
								<?php echo $total_nr; ?>
							</span>
						</a>
					</li>
					<li>
                        <a href="<?php echo site_url('message/sent') ?>">
                            <i class="fa fa-paper-plane-o"></i> Enviados
                        </a>
                    </li>
				</ul>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /. box -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="box box-primary">
			<?php echo form_open('message/add'); ?>
				<div class="box-header with-border">
					<h3 class="box-title">Crear Nuevo Mensaje</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="form-group">
						<select name="to" class="form-control input-lg">
							<option value="">Destinatario</option>
							<?php 
								foreach($all_users as $user):
									$selected = ($user['id_user'] == $this->input->post('to')) ? ' selected="selected"' : "";
							?>
								<option value="<?php echo $user['id_user']; ?>" <?php echo $selected; ?>>
									<?php echo $user['name']; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span class="text-danger"><?php echo form_error('to');?></span>
					</div>
					<div class="form-group">
						<input class="form-control input-lg" name="subject" placeholder="Asunto:" value="<?php echo $this->input->post('subject'); ?>">
						<span class="text-danger"><?php echo form_error('subject');?></span>
					</div>
					<div class="form-group">
						<textarea id="summer" name="message" class="form-control">
							<?php echo (!empty($this->input->post('message'))) ? $this->input->post('message') : "" ?>
						</textarea>
					</div>
					<!-- <div class="form-group">
						<div class="btn btn-default btn-file">
							<i class="fa fa-paperclip"></i> Attachment
							<input type="file" name="attachment">
						</div>
						<p class="help-block">Max. 32MB</p>
					</div> -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-paper-plane-o"></i> Enviar
						</button>
					</div>
					<button type="reset" id="reset" class="btn btn-default">
						<i class="fa fa-times"></i> Descartar
					</button>
				</div>
				<!-- /.box-footer -->
			<?php echo form_close(); ?>
		</div>
		<!-- /. box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

<!-- SUMMERNOTE PLUGIN -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/summernote/summernote.css') ?>">
<script src="<?php echo site_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('#summer').summernote({
			height: 300,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: true                  // set focus to editable area after initializing summernote
    	});

    	$("#reset").click(function() {
    		$('#summer').summernote('reset');
    	})
    });
</script>