<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listado de usuarios</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-user-plus"></i>
                    </a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" id="example" cellspacing="0" width="100%">
                    <thead>
                        <tr>
    						<th>Id User</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
    						<td><?php echo $u['id_user']; ?></td>
                            <td><?php echo $u['name']; ?></td>
                            <td><?php echo $u['lastname']; ?></td>
    						<td><?php echo $u['email']; ?></td>
                            <td><?php echo $u['username']; ?></td>
                            <td>
                                <?php 
                                    $profile = $this->Profile_model->get_profile($u['profile_id']);
                                    echo $profile['name'];
                                ?>
                            </td>
    						<td>
                                <a href="<?php echo site_url('user/edit/'.$u['id_user']); ?>" class="btn btn-info btn-xs">
                                    <span class="fa fa-pencil"></span> Editar
                                </a>
                                <a href="<?php echo site_url('user/remove/'.$u['id_user']); ?>" class="btn btn-danger btn-xs">
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
        var table = $('#example').DataTable( {
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
