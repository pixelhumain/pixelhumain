<div class="row">
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><?php echo $title?></h4>
		</div>
		<table id="sample-table-1" class="table table-hover">
			<thead>
				<tr>
					<?php
					foreach ($columns as $value) {			 	
					?>
					<th><?php echo $value ?></th>
					<?php 
					}
					?>
					<th>Remove</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($list as $value) {			 	
					?>
					<tr>
						<td class="center"><?php echo $value[$columnKeys[0]] ?></td>
						<td><?php echo $value[$columnKeys[1]] ?></td>
						<td><a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo $value[$columnKeys[0]];?>" data-name="<?php echo $value[$columnKeys[1]]?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a></td>
						<td><a href="#" class="btn btn-primary tooltips editBtn" data-id="<?php echo $value[$columnKeys[0]];?>" data-name="<?php echo $value[$columnKeys[1]]?>" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil fa fa-white"></i></a></td>
					</tr>
					<?php 
					}
					?>
				
			</tbody>
		</table>
	</div>
</div>
<div class="row">
<a href="#" class="btn btn-primary tooltips addBtn" data-id="<?php echo $value[$columnKeys[0]];?>" data-name="<?php echo $value[$columnKeys[1]]?>" data-placement="top" data-original-title="Add"><i class="fa fa-plus fa fa-white"></i></a>
</div>

<script type="text/javascript">
if($(".tooltips").length) {
	$('.tooltips').tooltip();
}
</script>
