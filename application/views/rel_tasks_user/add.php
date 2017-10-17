<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Rel Tasks User Add</h3>
            </div>
            <?php echo form_open('rel_tasks_user/add'); ?>
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
									$selected = ($task['id_task'] == $this->input->post('task_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$task['id_task'].'" '.$selected.'>'.$task['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('task_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="user_id" class="control-label"><span class="text-danger">*</span>User</label>
						<div class="form-group">
							<select name="user_id" class="form-control">
								<option value="">select user</option>
								<?php 
								foreach($all_users as $user)
								{
									$selected = ($user['id_user'] == $this->input->post('user_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$user['id_user'].'" '.$selected.'>'.$user['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('user_id');?></span>
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