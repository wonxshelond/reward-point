<style>
  table tr.child_table th{
    text-align:left !important;
  }
</style>

<!-- isi dari detail data Tenant -->
<table class="items table table-striped table-bordered">

	<tr class="child_table">
		<th>Voucher Name</th><td>:</td><td><?php echo $data->voucher_name; ?></td>
	</tr>

	<tr class="child_table">
		<th>Point Required</th><td>:</td><td><?php echo $data->point_required; ?></td>
	</tr>

	<tr class="child_table">
		<th>Start Date</th><td>:</td><td><?php echo date('d F Y',strtotime($data->start_date)); ?></td>
	</tr>

	<tr class="child_table">
		<th>End Date</th><td>:</td><td><?php echo date('d F Y',strtotime($data->end_date)); ?></td>
	</tr>

	<tr class="child_table">
		<th>Remaining </th><td>:</td>
		<td>
			<?php 
				$str = strtotime($data->end_date) - strtotime(date('Y-m-d')); 
				$days = floor($str/3600/24);

				if ($days <= 0 )
					echo 'Expired';
				else
					echo $days.' Days';
			?>
		</td>
	</tr>
	
	<tr class="child_table">
		<th>Voucher Image</th><td>:</td>
		<td>
			<?php
				if (!empty($data->image)) {
					echo "<img src='./uploads/$data->image' width='300' height='100'/>";
				}else{
					echo '-';
				}
			?>
	   </td>
	</tr>

</table>