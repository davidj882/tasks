<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Rel Project User Add</h3>
            </div>
            <?php echo form_open('rel_project_user/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
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
					<div class="col-md-6">
						<label for="project_id" class="control-label"><span class="text-danger">*</span>Project</label>
						<div class="form-group">
							<select name="project_id" class="form-control">
								<option value="">select project</option>
								<?php 
								foreach($all_projects as $project)
								{
									$selected = ($project['id_project'] == $this->input->post('project_id')) ? ' selected="selected"' : "";

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