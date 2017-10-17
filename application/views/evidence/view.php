<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <?php echo $task_data['name']; ?>
                </h3>
                <div class="box-tools">
                    <a href="#" class="btn btn-info" id="task-desc">
                        <i class="fa fa-tasks"></i> Tarea
                    </a>
                    <?php if (isset($project_data)): ?>
                        <a href="#" class="btn btn-info" id="project-desc">
                            <i class="fa fa-briefcase"></i> Proyecto
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="box-body">

                <div id="carousel-id" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($evidences as $ec => $val): ?>
                            <?php $active1 = ($ec == 0) ? 'class="active"' : ''; ?>
                            <li data-target="#carousel-id" data-slide-to="<?php echo $ec; ?>" <?php echo $active1; ?>></li>                            
                        <?php endforeach ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($evidences as $e => $v): ?>
                            <?php $active = ($e == 0) ? 'item active' : 'item'; ?>
                            <div class="<?php echo $active; ?>">
                                <?php 
                                    $folder = 'task_'.$task_id;
                                    $path   = site_url('uploads/evidences/'.$folder.'/'.$v['filename']);
                                ?>
                                <img src="<?php echo $path; ?>" width="100%" height="auto">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="alert callout callout-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h1>Subida el <?php echo $v['date']; ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-id" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-id" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info" id="modal-data-task">
    <div class="modal-dialog modal-info">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $task_data['name']; ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $task_data['description']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<?php if (isset($project_data)): ?>
    <div class="modal modal-info" id="modal-data-project">
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <?php echo $project_data['name']; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-file-text"></i> Descripción
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php echo $project_data['description']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-puzzle-piece"></i> Especificaciones
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <?php echo $project_data['specifications']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-sliders"></i> Alcance
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php echo $project_data['ranges']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-ban"></i> Limitaciones
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php echo $project_data['limits']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-block" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<style type="text/css">
    .carousel-inner > .item > img {
        margin: 0 auto;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#task-desc").click(function(e) {
            $("#modal-data-task").modal('show');
        });

        $("#project-desc").click(function(e) {
            $("#modal-data-project").modal('show');
        });
    });
</script>