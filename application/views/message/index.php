<div class="row">
    <div class="col-md-3">
        <a href="<?php echo site_url('message/add'); ?>" class="btn btn-primary btn-block margin-bottom">
            <i class="fa fa-envelope-o"></i> Nuevo Mensaje
        </a>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Mensajes</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li <?php echo ($folder == 'inbox') ? 'class="active"' : '' ; ?>>
                        <a href="<?php echo site_url('message/'); ?>">
                            <i class="fa fa-inbox"></i> Recibidos
                            <span class="label label-primary pull-right">
                                <?php echo $total_nr; ?>
                            </span>
                        </a>
                    </li>
                    <li <?php echo ($folder == 'sent') ? 'class="active"' : '' ; ?>>
                        <a href="<?php echo site_url('message/sent/'); ?>">
                            <i class="fa fa-paper-plane-o"></i> Enviados
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <?php if (count($inbox) > 0): ?>
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php if ($folder == 'inbox'): ?>
                            Recibidos
                        <?php else: ?>
                            Enviados
                        <?php endif; ?>
                    </h3>
                    <!-- /.box-tools -->
                </div>

                <div class="box-body">
                    <table class="table table-striped" id="example" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo ($folder == 'inbox')? 'Remitente':'Destinatario'; ?>
                                </th>
                                <th>Asunto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inbox as $m): ?>
                                <tr>
                                    <td class="mailbox-name">
                                        <a href="<?php echo site_url('message/view/'.$m['id_message']) ?>">
                                            <?php echo $m['fullname']; ?>
                                        </a>
                                    </td>
                                    <td class="mailbox-subject">
                                        <b><?php echo $m['subject']; ?></b> - <?php echo word_limiter(strip_tags($m['message']), 5); ?>
                                    </td>
                                    <td class="mailbox-date">
                                        <?php echo date_create($m['date_send'])->format('d M Y H:i'); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                    
            <?php else: ?>
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php if ($folder == 'inbox'): ?>
                            Recibidos
                        <?php else: ?>
                            Enviados
                        <?php endif; ?>
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <h4 class="text-center">
                        No hay mensajes
                    </h4>
                </div>
            <?php endif; ?>
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


<!-- LINKS -->
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