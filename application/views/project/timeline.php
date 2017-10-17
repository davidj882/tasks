<ul class="timeline">
	<?php foreach ($data_timeline as $key => $value): ?>
		<?php if (es_bidimensional($value)): ?>
			<?php foreach ($value as $key1 => $val1): ?>
					<!-- timeline time label -->
			    <li class="time-label">
			    	<?php $color_date = date_back(); $color_date = ($color_date == $color_date)? date_back() : $color_date; ?>
			    	<span class="<?php echo date_back(); ?>">
			            <?php echo date_format(date_create($val1['date']), 'd M Y'); ?>
			        </span>
			    </li>
			    <!-- /.timeline-label -->

			    <!-- timeline item -->
			    <li>
			        <!-- timeline icon -->
			        <i class="fa <?php echo icon($val1['type']); ?>"></i>
			        <div class="timeline-item">
			        	<span class="time">
			        		<i class="fa fa-clock-o"></i> 
			        		<?php echo date_format(date_create($val1['date']), 'H:i'); ?>
			        	</span>
			            <h3 class="timeline-header">
			            	<a href="#">
			            		<?php echo title($val1['type'], $val1['title']); ?>
			            	</a>
			            </h3>

			            <div class="timeline-body">
			                <?php if (in_array($val1['type'], array('created_project','start_task'))): ?>
			                	<?php echo $val1['desc'] ?>
			                <?php endif ?>

			                <?php if ($val1['type'] == 'delivered_task'): ?>
			                	<?php 
			                		$path		= site_url('uploads/evidences/task_'.$val1['id'].'/');
			                		$evidences  = $this->Evidence_model->get_all_task_evidences($val1['id']);
			                	?>
			                	<?php foreach ($evidences as $e): ?>
			                		<img src="<?php echo $path.$e['filename']; ?>" alt="<?php echo $e['date']; ?>" class="margin" width="150" height="100">
			                	<?php endforeach ?>
			                <?php endif ?>
			            </div>

			            <div class="timeline-footer">
			                <?php 
			                	$project 	= strpos($val1['type'], 'project');
			                	$task 		= strpos($val1['type'], 'task');
			                	if ($task !== false) {
			                		$task_user = $this->Task_model->task_user($val1['id'], 'task');
			                		echo "Tarea asignada a : <b>".$task_user['fullname']."</b>";
			                	}
			                	if ($project !== false) {
			                		$task_user = $this->Task_model->task_user($val1['id'], 'project');
			                		echo "Proyecto asignado a : <b>".$task_user['fullname']."</b>";
			                	}
			                ?>
			            </div>
			        </div>
			    </li>
			    <!-- END timeline item -->
			<?php endforeach ?>
		<?php else: ?>
			<!-- timeline time label -->
		    <li class="time-label">
			    <?php $color_date = date_back(); $color_date = ($color_date == $color_date)? date_back() : $color_date; ?>
			    <span class="<?php echo date_back(); ?>">
		            <?php echo date_format(date_create($value['date']), 'd M Y'); ?>
		        </span>
		    </li>
		    <!-- /.timeline-label -->

		    <!-- timeline item -->
		    <li>
		        <!-- timeline icon -->
		        <i class="fa <?php echo icon($value['type']); ?>"></i>
		        <div class="timeline-item">
		        	<span class="time">
		        		<i class="fa fa-clock-o"></i> 
		        		<?php echo date_format(date_create($value['date']), 'H:i'); ?>
		        	</span>
		            <h3 class="timeline-header">
		            	<?php echo title($value['type'], $value['title']); ?>
		            </h3>

		            <div class="timeline-body">
		                <?php if (in_array($value['type'], array('created_project','start_task'))): ?>
		                	<?php echo (empty($value['desc']))? $value['description']:$value['desc']; ?>
		                <?php endif ?>

		                <?php if ($value['type'] == 'delivered_task'): ?>
		                	<?php 
		                		$path		= site_url('uploads/evidences/task_'.$value['id'].'/');
		                		$evidences  = $this->Evidence_model->get_all_task_evidences($value['id']);
		                	?>
		                	<?php foreach ($evidences as $e): ?>
		                		<img src="<?php echo $path.$e['filename']; ?>" alt="<?php echo $e['date']; ?>" class="margin" width="150" height="100">
		                	<?php endforeach ?>
		                <?php endif ?>
		            </div>

		            <div class="timeline-footer">
		                <?php 
		                	$project 	= strpos($value['type'], 'project');
		                	$task 		= strpos($value['type'], 'task');
		                	if ($task !== false) {
		                		$task_user = $this->Task_model->task_user($value['id'], 'task');
		                		echo "Tarea asignada a : <b>".$task_user['fullname']."</b>";
		                	}
		                	if ($project !== false) {
		                		$task_user = $this->Task_model->task_user($value['id'], 'project');
		                		echo "Proyecto asignado a : <b>".$task_user['fullname']."</b>";
		                	}
		                ?>
		            </div>
		        </div>
		    </li>
		    <!-- END timeline item -->
		<?php endif ?>
	<?php endforeach; ?>
</ul>
<?php 
	function es_bidimensional($array)
	{ 
		if (!is_array($array)) return false;  // paranoia si no nos pasan un array 

		foreach ($array as $elemento) { 
			if (!is_array($elemento)) return false;  
			foreach ($elemento as $elem) { 
				if (is_array($elem)) return false; 
			} 
		} 

		return true; 
	}

	function icon($type)
	{
		switch ($type) {
			case 'created_project':
				$icon = 'fa-briefcase bg-blue';
				break;
			case 'start_project':
				$icon = 'fa-flag bg-green';
				break;
			case 'end_project':
				$icon = 'fa-hourglass-end bg-navy';
				break;
			case 'start_task':
				$icon = 'fa-tasks bg-green';
				break;
			case 'end_task':
				$icon = 'fa-tasks bg-navy';
				break;
			case 'view_task':
				$icon = 'fa-eye bg-aqua';
				break;
			case 'process_task':
				$icon = 'fa-hourglass-start bg-olive';
				break;
			case 'delivered_task':
				$icon = 'fa-hourglass-end bg-light-blue';
				break;
		}

		return $icon;
	}

	function title($type, $title)
	{
		switch ($type) {
			case 'created_project':
				$title = '<a>'.$title.'</a>';
				break;
			case 'start_project':
				$title = '<a>'.$title.'</a>';
				break;
			case 'end_project':
				$title = '<a>'.$title.'</a>';
				break;
			case 'start_task':
				$title = '<a>'.$title.'</a> - Inicio de tarea';
				break;
			case 'end_task':
				$title = '<a>'.$title.'</a> - Termina tarea';
				break;
			case 'view_task':
				$title = '<a>'.$title.'</a> - Tarea vista';
				break;
			case 'process_task':
				$title = '<a>'.$title.'</a> - Tarea en proceso';
				break;
			case 'delivered_task':
				$title = '<a>'.$title.'</a> - Tarea entregada';
				break;
		}

		return $title;
	}

	function date_back()
	{
		//$backgrounds = array('bg-red','bg-yellow','bg-aqua','bg-blue','bg-light-blue','bg-green','bg-navy','bg-teal','bg-olive','bg-lime','bg-orange','bg-fuchsia','bg-purple','bg-maroon','bg-black');
		
		$a=array('bg-red','bg-yellow','bg-aqua','bg-blue','bg-light-blue','bg-green','bg-navy','bg-teal','bg-olive','bg-lime','bg-orange','bg-fuchsia','bg-purple','bg-maroon','bg-black');
		$random_keys=array_rand($a, 2);

		return $a[$random_keys[0]];
	}
?>