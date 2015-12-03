<!-- tampilan untuk halaman default -->
<?php
$receipt_year = !empty($_GET['receipt_year'])?$_GET['receipt_year']:date('Y');
$receipt_chart = $receipt->chart($receipt_year);

$redeem_year = !empty($_GET['redeem_year'])?$_GET['redeem_year']:date('Y');
$redeem_chart = $redeem->chart($redeem_year);


?>
<!-- Bagian untuk menampilkan statistic Add point -->
<div class="span-4" style="width:90%">
 <h4 style="text-align:center">Statistic Add point</h4>
 <?php
$this->widget(
    'yiiwheels.widgets.highcharts.WhHighCharts',
    array(
        'pluginOptions' => array(
			'chart'  => array('defaultSeriesType'=>'column'),
            'title'  => array('text' => 'Monthly Report'),
            'xAxis'  => array(
                'categories' => array_keys($receipt_chart),
            ),
            'yAxis'  => array(
				'min'=>0,
				'max'=>30,
                'title' => array('text' => 'Number Of Add Point')
            ),
            'series' => array(
                array('data' => array_values(array_map('intval',array_values($receipt_chart)))),
                
            )
        )
    )
);

$year= array();
for($i=date('Y');$i>=2012;$i--){
	$year[$i]=$i;
}

echo "<center>".CHtml::dropDownList('receipt_year',$receipt_year,$year).'</center>';
?>
<script>
$(document).ready(function(){

	$('#receipt_year').on('change',function(){

		window.location = "?r=app/index&receipt_year="+this.value;

	});

	$('#redeem_year').on('change',function(){

		window.location = "?r=app/index&redeem_year="+this.value;

	});

});

</script>
</div>
<!-- akhir bagian untuk menampilkan statistic Add point -->

<!-- Bagian untuk menampilkan statistic Redeem Point -->
<div class="span-4" style="width:90%">
 <h4 style="text-align:center">Statistic Redeem point</h4>
 <?php
$this->widget(
    'yiiwheels.widgets.highcharts.WhHighCharts',
    array(
        'pluginOptions' => array(
			'chart' => array('defaultSeriesType'=>'column'),
            'title'  => array('text' => 'Monthly Report'),
            'xAxis'  => array(
                'categories' => array_keys($redeem_chart)
            ),
            'yAxis'  => array(
				'min'=>0,
				'max'=>30,
                'title' => array('text' => 'Number Of Redeem Point')
            ),
            'series' => array(
                array('data' => array_values(array_map('intval',array_values($redeem_chart)))),
            )
        )
    )
);
echo "<center>".CHtml::dropDownList('redeem_year',$redeem_year,$year).'</center>';
?>

</div>
<!-- akhir bagian untuk menampilkan statistic Redeem Point -->