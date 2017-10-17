<!-- Letter Avatar -->
<script src="<?php echo site_url('assets/plugins/letteravatar/letteravatar.js'); ?>"></script>
<!-- Widget: user widget style 1 -->
<div class="row">
	<div class="col-md-12">
		<div class="box box-widget widget-user-2">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-yellow">
				<div class="widget-user-image">
					<?php if (empty($picture)): ?>
                        <img class="img-circle round" width="128" height="128" avatar="<?php echo $fullname; ?>">
                    <?php else: ?>
                        <img src="<?php echo site_url('uploads/users/').$picture; ?>" class="img-circle">
                    <?php endif ?>
				</div>
				<!-- /.widget-user-image -->
				<h3 class="widget-user-username">
					<?php echo $fullname; ?>
				</h3>
				<h5 class="widget-user-desc">
					<?php echo $profile; ?>
				</h5>
			</div>
			<div class="box-footer no-padding">
				<ul class="nav nav-stacked">
					<?php foreach ($tasks_user as $tu): ?>
						<li>
							<a href="#">
								<?php echo $tu['name']; ?>
								<?php if ($tu['date_delivered']): ?>
									<?php if (date_create($tu['date_delivered']) <= date_create($tu['date_end'])): ?>
										<span class="pull-right badge bg-green">
											Entregada
										</span>
									<?php else: ?>
										<span class="pull-right badge bg-red">
											Entregada a Destiempo
										</span>
									<?php endif ?>
								<?php elseif($tu['date_process']): ?>
									<span class="pull-right badge bg-blue">
										En Proceso
									</span>
								<?php elseif($tu['date_view']): ?>
									<span class="pull-right badge bg-aqua">
										Vista
									</span>
								<?php endif ?>
							</a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- /.widget-user -->
