# Ajax Crud Module Nova 3
Example module using Ajax for listing, adding, editing, deleting and pagination for Nova 3

This module serves as an example of using Ajax with Nova. The index.php file loads the only view, containing an add and edit modal and div placeholder for the actualy content which is loaded via ajax and loaded into the div:

```php
<div id='crudBody' class='table-responsive'></div>
```

To open a model data-target must contain an id matching the id of a model:

```php
<p><a href="#" class="label label-info" data-toggle="modal" data-target="#addmodel"><i class='fa fa-plus'></i> Add new</a></p>
```

Links top model:

```php
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
```

To open an edit is the same process:

Edit button: 

```php
<a href="#" id="3" class="edit btn btn-warning btn-xs" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</a>
```

Edit model:

```php
<div class="modal fade" id="editmodel" tabindex="-1" role="dialog">
```