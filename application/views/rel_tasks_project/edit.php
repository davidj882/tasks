<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Rel Tasks Project Edit</h3>
            </div>
			<?php echo form_open('rel_tasks_project/edit/'.$rel_tasks_project['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="task_id" class="control-label"><span class="text-danger">*</span>Task</label>
						<div class="form-group">
							<select name="task_id" class="form-control">
								<option value="">select task</option>
								<?php 
								foreach($all_tasks as $task)
								{
									$selected = ($task['id_task'] == $rel_tasks_project['task_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$task['id_task'].'" '.$selected.'>'.$task['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('task_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="project_id" class="control-label"><span class="text-danger">*</span>Project</label>
						<div class="form-group">
							<select name="project_id" class="form-control">
								<option value="">select project</option>
								<?php 
								foreach($all_projects as $project)
								{
									$selected = ($project['id_project'] == $rel_tasks_project['project_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$project['id_project'].'" '.$selected.'>'.$project['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('project_id');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>