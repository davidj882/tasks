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
            			
        				<?php $path_view = site_url('evidence/view/'.$task_id); ?>
            			<a href="<?php echo $path_view; ?>" class="btn btn-link btn-lg">
            				Ver Evidencias
            			</a>
            		</div>
            	<?php endif ?>
                
                <?php if (isset($errors)): ?>
                    <?php print_r($errors); ?>
                <?php endif ?>

            	<?php echo form_open_multipart('evidence/upload/'.$task_id); ?>
            		<div class="row clearfix">
            			<div class="col-md-12">
		            		<div class="form-group">
		            			<label for="evidence">Evidencias</label>
		            			<input type="file" name="evidence[]" class="evidence" id="evidence" multiple>
								<p class="help-block">
									Archivos permitidos "jpg", "png", "gif"
								</p>

                                <?php if (isset($error)): ?>
    								<span class="text-danger">
    									<?php echo $error; ?>
    								</span>
                                <?php endif ?>
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
		$("#evidence").fileinput({
			language: "es",
    		allowedFileExtensions: ["jpg", "png", "gif"],
    		mainClass: "input-group-lg"
		});
	});
</script>