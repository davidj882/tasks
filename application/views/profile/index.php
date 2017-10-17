<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Profiles Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('profile/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Id Profile</th>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($profiles as $p){ ?>
                    <tr>
						<td><?php echo $p['id_profile']; ?></td>
						<td><?php echo $p['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('profile/edit/'.$p['id_profile']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('profile/remove/'.$p['id_profile']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
