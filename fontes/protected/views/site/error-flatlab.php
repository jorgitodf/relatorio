<?php
/* @var $this SiteController */
/* @var $error C */

$this->pageTitle = Yii::app()->name . '::Error';
?>
<div class="body-500">
    <section class="error-wrapper">
        <i class="icon-500"></i>
        <h1>Ouch!</h1>
        <h2><?php echo $error['code']; ?> <?php echo $error['type']; ?></h2>
        <p class="page-500"><?php echo $error['message']; ?> <a class="btn btn-default" data-toggle="modal" href="#myModal">Trace</a></p>
        <br />
        <br />
    </section>
    <!-- Modal -->
    <div style="display: none;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?php echo $error['code']; ?> <?php echo $error['type']; ?></h4>
                </div>
                <div class="modal-body">
                    <?php
                    //var_dump($error);
                    ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
