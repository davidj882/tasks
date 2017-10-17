<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Rel Enterprise User Add</h3>
            </div>
            <?php echo form_open('rel_enterprise_user/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="enterprise_id" class="control-label"><span class="text-danger">*</span>Enterprise</label>
						<div class="form-group">
							<select name="enterprise_id" class="form-control">
								<option value="">select enterprise</option>
								<?php 
								foreach($all_enterprises as $enterprise)
								{
									$selected = ($enterprise['id_enterprise'] == $this->input->post('enterprise_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$enterprise['id_enterprise'].'" '.$selected.'>'.$enterprise['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('enterprise_id');?></span>
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
					<div class="col-md-6">
						<label for="role_id" class="control-label"><span class="text-danger">*</span>Role</label>
						<div class="form-group">
							<select name="role_id" class="form-control">
								<option value="">select role</option>
								<?php 
								foreach($all_roles as $role)
								{
									$selected = ($role['id_role'] == $this->input->post('role_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$role['id_role'].'" '.$selected.'>'.$role['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('role_id');?></span>
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