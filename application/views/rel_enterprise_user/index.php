<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rel Enterprise User Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('rel_enterprise_user/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Enterprise Id</th>
						<th>User Id</th>
						<th>Role Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($rel_enterprise_user as $r){ ?>
                    <tr>
						<td><?php echo $r['id']; ?></td>
						<td><?php echo $r['enterprise_id']; ?></td>
						<td><?php echo $r['user_id']; ?></td>
						<td><?php echo $r['role_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('rel_enterprise_user/edit/'.$r['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('rel_enterprise_user/remove/'.$r['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
