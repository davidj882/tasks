<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body">
            	<?php if (isset($add)): ?>
            		<div class="alert callout callout-success">
            			<button type="button" class="close" data-dismiss="callout" aria-hidden="true">&times;</button>
            			<h4>
            				<?php echo count($added); ?> Archivos fueron subidos correctamente
            			</h4>
	            		<?php foreach ($added as $f): ?>
            				<p>
	            				<b><?php echo $f['filename']; ?></b>
            				</p>
	            		<?php endforeach ?>
            			
        				<?php $path_view = site_url('developments/view/'.$task_id); ?>
            			<a href="<?php echo $path_view; ?>" class="btn btn-link btn-lg">
            				Ver Evidencias
            			</a>
            		</div>
            	<?php endif ?>

            	<?php echo form_open_multipart('developments/upload/'.$task_id); ?>
            		<div class="row clearfix">
                        <?php if (isset($data_file)): ?>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php foreach ($data_file as $key => $value): ?>
                                        El archivo <strong><?php echo $value['file_name']; ?></strong> fue subido correctamente
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="path">Ruta del desarrollo</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    <input type="text" name="path" class="form-control" value="<?php echo $this->input->post('path'); ?>" placeholder="http://">
                                </div>
                                <span class="text-danger">
                                    <?php echo form_error('path');?>
                                </span>
                            </div>
                        </div>
            			<div class="col-md-12">
		            		<div class="form-group">
		            			<label for="development">Desarrollo</label>
                                <input type="file" name="development" class="development" id="development">
                                <p class="help-block">
                                    <i class="fa fa-file-archive-o"></i> Sube un archivo comprimido en formato zip o rar
                                </p>
                                <span class="text-danger">
                                    <?php echo form_error('development');?>
                                    <?php if (isset($error)): ?>
                                        <?php print_r($error); ?>
                                    <?php endif ?>
                                </span>
		            		</div>
            			</div>
            		</div>
            		<button type="submit" class="btn btn-lg btn-block btn-success">
            			<i class="fa fa-upload"></i> Subir
            		</button>
            	<?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/css/fileinput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/js/fileinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.3/js/locales/es.min.js"></script>

<script>
	$(document).ready(function() {
		$("#development").fileinput({
			language: "es",
    		allowedFileExtensions: ["zip", "rar"],
    		mainClass: "input-group-lg"
		});
	});
</script>