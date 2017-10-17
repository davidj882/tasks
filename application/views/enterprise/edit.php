<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Empresa</h3>
            </div>
			<?php echo form_open_multipart('enterprise/edit/'.$enterprise['id_enterprise']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="name" class="control-label"><span class="text-danger">*</span> Nombre</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $enterprise['name']); ?>" class="form-control input-lg" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="url" class="control-label"><span class="text-danger">*</span> URL</label>
						<div class="form-group">
							<input type="text" name="url" value="<?php echo ($this->input->post('url') ? $this->input->post('url') : $enterprise['url']); ?>" class="form-control input-lg" id="url" />
							<span class="text-danger"><?php echo form_error('url');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="picture" class="control-label"><span class="text-danger">*</span> Logo</label>
						<?php if (!empty($enterprise['picture'])): ?>
							<div class="form-group">
								<input type="checkbox" id="change-logo" data-on="Cambiar" data-off="Mantener" data-toggle="toggle">
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="prev-logo">
									<a href="#" class="thumbnail">
										<img src="<?php echo site_url('uploads/enterprises/').$enterprise['picture']; ?>">
									</a>
								</div>
							</div>
							<div class="form-group" id="new-logo">
								<input id="picture" name="picture" type="file" class="picture" data-show-upload="false" data-show-caption="true">
								<p class="help-block">Archivos permitidos "jpg", "png", "gif"</p>
								<span class="text-danger"><?php echo form_error('picture');?></span>
							</div>

							<input type="hidden" name="pic_old" value="<?php echo $enterprise['picture']; ?>">
						<?php else: ?>
							<div class="form-group">
								<input id="picture" name="picture" type="file" class="picture" data-show-upload="false" data-show-caption="true">
								<p class="help-block">Archivos permitidos "jpg", "png", "gif"</p>
								<span class="text-danger"><?php echo form_error('picture');?></span>

								<?php if (isset($error)): ?>
									<p class="help-block text-danger">
										<?php print_r($error); ?>
									</p>
								<?php endif ?>
							</div>
						<?php endif ?>

					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-block btn-lg btn-success">
					<i class="fa fa-check"></i> Actualizar
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>

<!-- bootstrap-toggle library -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
	$(document).ready(function() {
		$("#new-logo").hide();

		$('#change-logo').change(function() {
			var value = $(this).prop('checked');
			if (value) {
				$("#prev-logo").hide();
				$("#new-logo").show();
				$("#picture").attr('name', 'picture');
			}else{
				$("#new-logo").hide();
				$("#prev-logo").show();
				$("#picture").attr('name', '');
			}
		})
	});
</script>

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