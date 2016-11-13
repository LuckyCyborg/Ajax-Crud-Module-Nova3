<table class='table table-striped table-hover table-bordered'>	
<tr>
	<th>Title</th>
	<th>Comment</th>
	<th>Action</th>
</tr>
	<?php foreach ($rows as $row) { ?>
	<tr>
		<td><?=$row->title;?></td>
		<td><?=$row->comment;?></td>
		<td>
		<a href='#' id='<?=$row->id;?>' class='edit btn btn-warning btn-xs' data-toggle='modal' data-target='#edit'><i class='fa fa-edit'></i> Edit</a>
		<a href='#' id='<?=$row->id;?>' class='delete btn btn-danger btn-xs'><i class='fa fa-times'></i> Delete</a
		</td>
	</tr>
<?php } ?>

</table>

<?=$rows->links();