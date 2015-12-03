<div style="width:7cm;height:10cm;font-family:arial;color:purple" onclick="window.print()">
<h4 style="text-align:center;margin-top:-5px">Lumiere Club</h4>
<h6 style="text-align:center;margin-top:-21px">Lippo Mall Kemang</h6>

<p align="center" style="margin-top:-21px;margin-bottom:0px">Redeem Point</p>
==============================
<table width="100%" style="color:purple;font-size:12px">
	<tr>
		<td>ID Member</td><td>:</td><td align="right"><?php echo $id_member; ?></td>
	<tr>

	<tr>
		<td>Member Name</td><td>:</td><td align="right"><?php echo $member_name; ?></td>
	<tr>

	<tr>
		<td>Point</td><td>:</td><td align="right"><?php echo $point; ?></td>
	<tr>

	<tr>
		<td>Redeem Point</td><td>:</td><td align="right"><?php echo $redeem_point; ?></td>
	<tr>

	<tr>
		<td>Remaining Point</td></td><td>:</td ><td align="right"><?php echo $remaining; ?></td>
	</tr>

	<tr>
		<td colspan="3">
			<ol style="margin-top:5px;margin-left:-25px;font-size:11px">
				<?php  foreach($vouchers as $voucher): ?>
					<li><?php echo $voucher[0]; ?> (<?php echo $voucher[1];?>)</li>
				<?php endforeach; ?>
			</ol>
		</td>
	</tr>
	
</table>
==============================
<table width="100%" align="right" style="color:purple;font-size:11px">
	<tr>
	 <td align="right">Jakarta, <?php echo date('d F Y'); ?></td>
	<tr>
	<tr>
	 <td><br/><br/><br/></td>
	<tr>
	<tr>
	 <td align="right">(<?php echo $name; ?>)</td>
	<tr>
</table>
</div>

<?php function numberToWords($number)
{
	$words = array ('zero',
			'one',
			'two',
			'three',
			'four',
			'five',
			'six',
			'seven',
			'eight',
			'nine',
			'ten',
			'eleven',
			'twelve',
			'thirteen',
			'fourteen',
			'fifteen',
			'sixteen',
			'seventeen',
			'eighteen',
			'nineteen',
			'twenty',
			30=> 'thirty',
			40 => 'fourty',
			50 => 'fifty',
			60 => 'sixty',
			70 => 'seventy',
			80 => 'eighty',
			90 => 'ninety',
			100 => 'hundred',
			1000=> 'thousand');
   $number_in_words = '';
	if (is_numeric ($number))
	{
		$number = (int) round($number);
		if ($number < 0)
		{
			$number = -$number;
			$number_in_words = 'minus ';
		}
		if ($number > 1000)
		{
			$number_in_words = $number_in_words . numberToWords(floor($number/1000)) . " " . $words[1000];
			$hundreds = $number % 1000;
			$tens = $hundreds % 100;
			if ($hundreds > 100)
			{
				$number_in_words = $number_in_words . ", " . numberToWords ($hundreds);
			}
			elseif ($tens)
			{
				$number_in_words = $number_in_words . " and " . numberToWords ($tens);
			}
		}
		elseif ($number == 1000){
			$number_in_words = "one thousand";
		}
		elseif ($number > 100)
		{
			$number_in_words = $number_in_words . numberToWords(floor ($number / 100)) . " " . $words[100];
			$tens = $number % 100;
			if ($tens)
			{
				$number_in_words = $number_in_words . " and " . numberToWords ($tens);
			}
		}elseif ($number == 100){
			$number_in_words = "one hundred";
		}
		elseif ($number > 20)
		{
			$number_in_words = $number_in_words . " " . $words[10 * floor ($number/10)];
			$units = $number % 10;
			if ($units)
			{
				$number_in_words = $number_in_words . numberToWords ($units);
			}
		}
		else
		{
			$number_in_words = $number_in_words . " " . $words[$number];
		}
		return $number_in_words;
	}
	return false;
}
?>