<div class="row">
    <div class="col-md-12">
        <div class="box box-primary" id="to-print">
            <div class="box-header with-border">
                <h3 class="box-title">Leer el correo</h3>

                <div class="box-tools pull-right">
                    <a href="<?php echo site_url('message/') ?>" class="btn btn-box-tool no-print" data-toggle="tooltip" title="Cerrar">
                        <i class="fa fa-window-close"></i>
                    </a>
                    <!-- <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next">
                        <i class="fa fa-chevron-right"></i>
                    </a> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <?php if (!isset($error)): ?>
                    <div class="mailbox-read-info">
                        <?php 
                            $subject    = $message_data['subject'];
                            $fullname   = $message_data['fullname'];
                            $email      = $message_data['email'];
                            $date_send  = $message_data['date_send'];
                            $message    = $message_data['message'];
                            $date       = date_create($date_send)->format('d M Y H:i');
                        ?>
                        <h3><?php echo $subject; ?></h3>
                        <h5>
                            De: <?php echo $fullname; ?>
                            &#60;
                                <a href="mailto:<?php echo $email; ?>" class="no-print">
                                    <?php echo $email; ?>
                                </a>
                            &#62;
                            <span class="mailbox-read-time pull-right">
                                <?php echo $date; ?>
                            </span>
                        </h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-right">
                        <!-- <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                                <i class="fa fa-reply"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                <i class="fa fa-share"></i>
                            </button>
                        </div>
                            /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm no-print" title="Imprimir" id="print">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <?php echo $message; ?>
                    </div>
                    <!-- /.mailbox-read-message -->
                <?php else: ?>
                    <div class="mailbox-read-message text-center">
                        <h1 class="text-danger">
                            El mensaje que estas intentando ver, no es para ti <br />:(
                        </h1>
                    </div>
                <?php endif ?>
            </div>
            <!-- /.box-body
            <div class="box-footer">
                <ul class="mailbox-attachments clearfix">
                    <li>
                        <span class="mailbox-attachment-icon">
                            <i class="fa fa-file-pdf-o"></i>
                        </span>

                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name">
                                <i class="fa fa-paperclip"></i> Sep2014-report.pdf
                            </a>
                            <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon">
                            <i class="fa fa-file-word-o"></i>
                        </span>

                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name">
                                <i class="fa fa-paperclip"></i> App Description.docx
                            </a>
                            <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                            <span class="mailbox-attachment-size">
                                2.67 MB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                            <span class="mailbox-attachment-size">
                                1.9 MB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            /.box-footer -->
            <!--<div class="box-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-reply"></i> Reply
                    </button>
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-share"></i> Forward
                    </button>
                </div>
                <button type="button" class="btn btn-default">
                    <i class="fa fa-trash-o"></i> Delete
                </button>
                <button type="button" class="btn btn-default">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
             /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.5.1/jQuery.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#print").click(function(e) {
            $("#to-print").print({
                addGlobalStyles : true,
                stylesheet : null,
                rejectWindow : true,
                noPrintSelector : ".no-print",
                iframe : true,
                append : null,
                prepend : null
            });
        });
    })
</script>