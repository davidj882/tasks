<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Rel Roles Permission Edit</h3>
            </div>
			<?php echo form_open('rel_roles_permission/edit/'.$rel_roles_permission['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="role_id" class="control-label"><span class="text-danger">*</span>Role</label>
						<div class="form-group">
							<select name="role_id" class="form-control">
								<option value="">select role</option>
								<?php 
								foreach($all_roles as $role)
								{
									$selected = ($role['id_role'] == $rel_roles_permission['role_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$role['id_role'].'" '.$selected.'>'.$role['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('role_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="permission_id" class="control-label"><span class="text-danger">*</span>Permission</label>
						<div class="form-group">
							<select name="permission_id" class="form-control">
								<option value="">select permission</option>
								<?php 
								foreach($all_permissions as $permission)
								{
									$selected = ($permission['id_permission'] == $rel_roles_permission['permission_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$permission['id_permission'].'" '.$selected.'>'.$permission['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('permission_id');?></span>
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