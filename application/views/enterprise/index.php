<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('enterprise/add'); ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="example" cellspacing="0" width="100%">
                    <thead>
                        <tr>
    						<th>ID</th>
    						<th>Nombre</th>
    						<th>URL</th>
    						<th>Logo</th>
    						<th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($enterprises as $e): ?>
                            <tr>
        						<td><?php echo $e['id_enterprise']; ?></td>
        						<td><?php echo $e['name']; ?></td>
        						<td><?php echo $e['url']; ?></td>
        						<td>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <a href="#" class="thumbnail" data-name="<?php echo $e['name']; ?>">
                                            <img src="<?php echo site_url('uploads/enterprises/'.$e['picture']); ?>" alt="<?php echo $e['name']; ?>">
                                        </a>
                                    </div>
                                </td>
        						<td>
                                    <a href="<?php echo site_url('enterprise/edit/'.$e['id_enterprise']); ?>" class="btn btn-info btn-xs">
                                        <span class="fa fa-pencil"></span> Editar
                                    </a> 
                                    <a href="<?php echo site_url('enterprise/remove/'.$e['id_enterprise']); ?>" class="btn btn-danger btn-xs del-row" data-title="<?php echo $e['name']; ?>">
                                        <span class="fa fa-trash"></span> Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-preview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <img src="" width="100%" height="auto" id="img-prev">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        $(".thumbnail").click(function (e) {
            e.preventDefault();
            var name  = $(this).attr('data-name');
            var image = $(this).find('img').attr('src');

            $("#modal-preview").find('.modal-title').text(name);
            $("#modal-preview").find('#img-prev').attr('src', image);
            $("#modal-preview").modal('show');
        });
    });
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.bootstrap.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('table').DataTable( {
            lengthChange: false,
            buttons: [ 
                {
                    extend: 'copyHtml5',
                    text: 'Copiar',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'LETTER',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(doc) {
                       doc.defaultStyle.alignment = 'center';
                       doc.styles.tableHeader.alignment = 'center';
                       doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                   }
                },
                {
                    extend: 'colvis',
                    text: 'Seleccionar columnas',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        table.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)');
    });
</script>
