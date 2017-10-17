<div class="row">
	<?php $profile_id = $this->session->userdata('profile'); ?>
	<?php if ($profile_id < 3): ?>
		<div class="col-md-3">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h4 class="box-title">Usuarios</h4>
				</div>
				<div class="box-body">
					<!-- the events -->
					<style type="text/css">
						.external-event{
							color: white;
							cursor: pointer;
						}
					</style>
					<div id="external-events">
						<?php foreach ($users_colors as $uc): ?>
							<?php $style = 'style="background-color:'.$uc['color'].';"'; ?>
							<div class="external-event" data-id="<?php echo $uc['id_user']; ?>" <?php echo $style; ?>>
								<?php echo $uc['fullname']; ?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /. box -->
		</div>
		<!-- /.col -->
	<?php endif ?>

	<div class="<?php echo ($profile_id < 3) ? 'col-md-9' : 'col-md-12' ; ?>">
		<div class="box box-primary">
			<div class="box-body no-padding">
				<!-- THE CALENDAR -->
				<div id="calendar"></div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<!-- /.col -->
</div>

<div class="modal fade" id="modal-event">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-success" id="alert-process" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Tu tarea está ahora en proceso</strong> <?php echo date('d-m-Y H:i'); ?>
				</div>
				<div class="alert alert-info" id="modal-alert"></div>
				<div class="modal-desc"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

				<a href="#" class="btn btn-success" id="btn-process" style="display: none;">
					<i class="fa fa-code"></i> En Proceso
				</a>
				
				<a href="#" class="btn btn-success" id="btn-evidence" style="display: none;">
					<i class="fa fa-image"></i> Evidencias
				</a>
				<a href="#" class="btn btn-success" id="btn-developments" style="display: none;">
					<i class="fa fa-code"></i> Desarrollo
				</a>
			</div>
		</div>
	</div>
</div>

<?php if ($profile_id < 3): ?>
	<div class="modal fade" id="modal-task-user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					<div id="overlay" style="display: none;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-block" data-dismiss="modal">
						Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?php echo site_url('assets/plugins/fullcalendar/fullcalendar.min.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/plugins/fullcalendar/fullcalendar.print.css'); ?>" media="print">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo site_url('assets/plugins/fullcalendar/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/plugins/fullcalendar/locale/es.js'); ?>"></script>

<script> 	
	$(document).ready(function() {
		$("#modal-event").on('hidden.bs.modal', function() {
			$(this).find("#btn-process").hide();
			$(this).find("#alert-process").hide();
			$(this).find("#btn-evidence").hide();
			$(this).find("#btn-developments").hide();

			$('#calendar').fullCalendar( 'refetchEvents' );
		});

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month, agendaWeek, listMonth'
			},
			eventSources: [
				{
					events: function(start, end, timezone, callback) {

						$.ajax({
							url: '<?php echo site_url('calendar/get_events/'); ?>',
							dataType: 'json',
							data: {
								start: start.unix(),
								end: end.unix()
							},
							success: function(msg) {
								//console.log(msg);
								var events = msg.events;
								callback(events);
							}
						});
					},
					eventRender: function(event, element) {
				        element.qtip({
				            content: event.description
				        });
				    }
				},
			],
			eventClick: function(calEvent, jsEvent, view) {

				var event_id 		= calEvent.id;
				var event_desc 		= calEvent.description;
				var event_title 	= calEvent.title;
				var event_date_end 	= calEvent.end_task;
				var event_type 		= calEvent.type_task;
				var event_status	= calEvent.status;

				var profile 	= "<?php echo $this->session->userdata('profile') ?>";
				var id_user	    = "<?php echo $this->session->userdata('id_user') ?>";

				var path_evi	= "<?php echo site_url('evidence/') ?>";
				var path_dev	= "<?php echo site_url('developments/') ?>";

				if (event_status == 1) {

					if (event_type == 'own') {
						$.ajax({
							url: "<?php echo site_url('task/change_status'); ?>",
							type: "POST",
							data:{
								task_id: event_id,
								status_id: event_status
							},
							success: function(response) {
								console.log(response);
							}
						});
					}

				}else if (event_status == 2) {

					if (event_type == 'own') {						
						$("#btn-process").attr('data-id', event_id);
						$("#btn-process").attr('data-status', event_status).show();
					}

				}else if(event_status == 3){
					
					if (event_type == 'project') {
			        	$("#modal-event").find("#btn-evidence").attr('href', path_evi+"view/"+event_id);
			        	$("#modal-event").find("#btn-developments").attr('href', path_dev+"view/"+event_id);
					}else if(event_type == 'own'){
						$("#modal-event").find("#btn-evidence").attr('href', path_evi+"upload/"+event_id);
			        	$("#modal-event").find("#btn-developments").attr('href', path_dev+"upload/"+event_id);
					}

					$("#btn-evidence").show();
					$("#btn-developments").show();

				}else if(event_status == 4){

					if (event_type == 'own') {
						$("#modal-event").find("#btn-evidence").attr('href', path_evi+"view/"+event_id);
				        $("#modal-event").find("#btn-developments").attr('href', path_dev+"view/"+event_id);

				        $("#btn-evidence").show();
						$("#btn-developments").show();
					}
				}

				$("#modal-event").find("#modal-alert").html("<h3>Fecha limite: <b>"+event_date_end+"</b><h3>");
		        $("#modal-event").find(".modal-desc").html(event_desc);
		        $("#modal-event").find(".modal-title").text(event_title);
		       
		        $("#modal-event").modal('show');
		        // change the border color just for fun
		        //$(this).css('border-color', 'red');
		    },
		    fixedWeekCount: false,
			weekends: false,
			eventAfterRender: function(event, element, view) {
				//$(element).css('height','5%');
				//$(element).css('font-size','14px');
				$(element).css('cursor','pointer');
            },
			businessHours: {
			    // days of week. an array of zero-based day of week integers (0=Sunday)
			    dow: [ 1, 2, 3, 4, 5], // Monday - Friday

			    start: '8:00', // a start time (10am in this example)
			    end: '19:00', // an end time (6pm in this example)
			},
		});

		// UPDATE TASK STATUS
		$("#btn-process").click(function(e) {
			e.preventDefault();

			var event_id 		= $(this).attr('data-id');
			var event_status 	= $(this).attr('data-status');

			$.ajax({
				url: "<?php echo site_url('task/change_status'); ?>",
				type: "POST",
				data:{
					task_id: event_id,
					status_id: event_status
				},
				success: function(response) {
					$(this).hide();
					$("#alert-process").show('slow');
				}
			});
		});
	});
</script>

<?php if ($profile_id < 3): ?>
	<script type="text/javascript">
		$(document).ready(function() {
			// TASK BY USER
			$(".external-event").click(function(e) {
				e.preventDefault();
				var id_user = $(this).attr('data-id');
				var path 	= "<?php echo site_url('task/task_by_user/'); ?>"+id_user;
				$("#modal-task-user").find(".modal-title").html('Tareas de usuario');
				$("#modal-task-user").find(".modal-body").load(path, function() {
					$("#modal-task-user").find(".modal-body #overlay").show();
				});
				$("#modal-task-user").modal('show');
			});

			$("#modal-task-user").on('hidden.bs.modal', function () {
				$(this).find(".modal-body").html('');
			});
		});
	</script>
<?php endif; ?>
