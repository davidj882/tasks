<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Notifications Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('notification/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Id Notification</th>
						<th>User Id</th>
						<th>Type</th>
						<th>Status</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($notifications as $n){ ?>
                    <tr>
						<td><?php echo $n['id_notification']; ?></td>
						<td><?php echo $n['user_id']; ?></td>
						<td><?php echo $n['type']; ?></td>
						<td><?php echo $n['status']; ?></td>
						<td>
                            <a href="<?php echo site_url('notification/edit/'.$n['id_notification']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('notification/remove/'.$n['id_notification']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
