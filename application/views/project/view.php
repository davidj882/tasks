<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">
                	<?php echo $project_data['name']; ?>
                </h3>
            </div>
            <div class="box-body">
            	<div class="row clearfix">
            		<div class="col-md-6">
            			<div class="info-box">
            				<span class="info-box-icon bg-green">
            					<i class="fa fa-hourglass-start"></i>
            				</span>

            				<div class="info-box-content">
            					<span class="info-box-text">Fecha de inicio</span>
            					<span class="info-box-number">
            						<?php echo date_format(date_create($project_data['date_start']), 'd M Y'); ?>
            					</span>
            				</div>
            				<!-- /.info-box-content -->
            			</div>
            		</div>
            		<div class="col-md-6">
            			<div class="info-box">
            				<span class="info-box-icon bg-red">
            					<i class="fa fa-hourglass-end"></i>
            				</span>

            				<div class="info-box-content">
            					<span class="info-box-text">Fecha de Entrega</span>
            					<span class="info-box-number">
            						<?php echo date_format(date_create($project_data['date_end']), 'd M Y'); ?>
            					</span>
            				</div>
            				<!-- /.info-box-content -->
            			</div>
            		</div>
            		<div class="col-md-6">
            			<h2><i class="fa fa-file-text"></i> Descripción</h2>
            			<p>
            				<?php echo $project_data['description']; ?>
            			</p>
            		</div>
            		<div class="col-md-6">
            			<h2><i class="fa fa-puzzle-piece"></i> Especificaciónes</h2>
            			<p>
            				<?php echo $project_data['specifications']; ?>
            			</p>
            		</div>
            		<div class="col-md-6">
            			<h2><i class="fa fa-sliders"></i> Alcances</h2>
            			<p>
            				<?php echo $project_data['ranges']; ?>
            			</p>
            		</div>
            		<div class="col-md-6">
            			<h2><i class="fa fa-ban"></i> Limitantes</h2>
            			<p>
            				<?php echo $project_data['limits']; ?>
            			</p>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>