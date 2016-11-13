<div class="modal fade" id="addmodel" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		
      		<div class="modal-header">

        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Add</h4>

      		</div>
      		
      		<div class="modal-body">

           	   <div class="container-fluid">  

                <form id="create" class="form-horizontal" action="<?=site_url('admin/crud');?>" method="post">
      
           		<div id="title-group" class="form-group">
		            <label class="control-label" for="title">Title</label>
		            <input type="text" class="form-control" name="title">
		        </div>

	            <div id="comment-group" class="form-group">
	                <label class="control-label" class="form-group">Description</label>
	                <textarea class="form-control" name="comment" cols="50" rows="5"></textarea>
	            </div>

	            <p><br><label>&nbsp;</label>

	                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-check"></i> Save</button>

	                <button type="submit" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel & Close</button>
	            </p>

           		</form>

                </div>

      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="editmodel" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		
      		<div class="modal-header">

        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Edit</h4>

      		</div>
      		
      		<div class="modal-body">

                <div class="container-fluid">

           		<form id="update" class="form-horizontal" method="post">
      
           		<div id="title-group" class="form-group">
		            <label class="control-label" for="title">Title</label>
		            <input type="text" class="form-control" name="title">
		        </div>

	            <div id="comment-group" class="form-group">
	                <label class="control-label" class="form-group">Description</label>
	                <textarea class="form-control" name="comment" cols="50" rows="5"></textarea>
	            </div>

	            <p><br><label>&nbsp;</label>

	                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-check"></i> Update</button>

	                <button type="submit" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel & Close</button>
	            </p>

           		</form>

                </div>

      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<section class="content-header">
    <h1><?= __d('system', 'Dashboard'); ?></h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/crud'); ?>'><i class="fa fa-book"></i> <?= __d('system', 'Crud'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box box-widget">
    <div class="box-body">
        <h4><strong><?= __d('crud', 'Manage Items.'); ?></strong></h4>

        <p><a href="#" class="label label-info" data-toggle="modal" data-target="#addmodel"><i class='fa fa-plus'></i> Add new</a></p>
      
        <div id='crudBody' class='table-responsive'></div>

    </div>
</div>

</section>
	
	



