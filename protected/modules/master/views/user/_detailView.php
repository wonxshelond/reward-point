<?php


?>
<style>
  table tr.child_table th{
    text-align:left !important;
  }
</style>

<!-- isi dari detail data User -->
<table class="items table table-striped table-bordered">

	<tr class="child_table">
		<th>Username</th><td>:</td><td><?php echo $data->username; ?></td>
	</tr>

	<tr class="child_table">
		<th>Full Name</th><td>:</td><td><?php echo $data->name; ?></td>
	</tr>

	<tr class="child_table">
		<th>Level</th><td>:</td><td><?php echo $data->level=='1'?'Admin':'Operator / CS'; ?></td>
	</tr> 

	<tr class="child_table">
		<th>Status</th><td>:</td><td><?php echo  $data->active=='1'?'Active':'Non-Active'; ?></td>
	</tr>

	<tr class="child_table">
		<th>Last Login</th><td>:</td><td><?php echo date('d F Y',strtotime($data->last_login)); ?></td>
	</tr>
	
	

</table>