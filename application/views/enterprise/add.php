<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Nuevo Cliente</h3>
            </div>
            <?php echo form_open_multipart('enterprise/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="name" class="control-label"><span class="text-danger">*</span> Nombre</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control input-lg" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="url" class="control-label"><span class="text-danger">*</span> URL</label>
						<div class="form-group">
							<input type="text" name="url" value="<?php echo $this->input->post('url'); ?>" class="form-control input-lg" id="url" placeholder="Escribe la URL sin http://" />
							<span class="text-danger"><?php echo form_error('url');?></span>
						</div>
					</div>
					<div class="col-md-12">
						<label for="picture" class="control-label"><span class="text-danger">*</span> Logo</label>
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