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
                <div class="row">
                    
                </div>
                <div class="row clearfix">
                    <?php foreach ($developments as $d): ?>
                        <?php 
                            $path_download = site_url('uploads/developments/task_'.$task_id.'/'.$d['file']);
                        ?>
                        <div class="col-md-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?php echo $d['file']; ?></h3>

                                    <p>Subido: <b><?php echo $d['date']; ?></b></p>
                                    
                                    <p>
                                        Tiempo de desarollo: 
                                        <b>
                                            <?php echo time_developed($d['date_process'], $d['date_delivered']); ?>
                                        </b>
                                    </p>
                                    <p>
                                        URL: 
                                        <a href="<?php echo $d['path']; ?>" target="_blank" style="color: white;">
                                            <b><?php echo $d['path']; ?></b>
                                        </a>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-code"></i>
                                </div>
                                <a href="<?php echo $path_download ?>" class="small-box-footer" download>
                                    <i class="fa fa-download"></i> Descargar
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
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

<?php 
    function time_developed($date_start, $date_end)
    {
        $date_start = date_create($date_start);
        $date_end   = date_create($date_end);
        $interval   = date_diff($date_start, $date_end);

        return $interval->format('%R%a días');
    }
?>