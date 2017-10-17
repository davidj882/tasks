<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Status Task Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('status_task/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Id Status</th>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($status_task as $s){ ?>
                    <tr>
						<td><?php echo $s['id_status']; ?></td>
						<td><?php echo $s['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('status_task/edit/'.$s['id_status']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('status_task/remove/'.$s['id_status']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
