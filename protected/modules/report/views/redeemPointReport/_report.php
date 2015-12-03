<?php $pdf = new MYPDF();
     //$pdf->setMargins(20,20,20);
     $pdf->AliasNbPages();
     
     $pdf->AddPage('P','A4');
     $pdf->AddFont('PT_Serif-Web-Bold','','PT_Serif-Web-Bold.php');
     
     $pdf->SetFont('PT_Serif-Web-Bold','',32);
     $pdf->image('./images/lippo.jpg',10,4,40,30);
     $pdf->Text((230/2)-($pdf->GetStringWidth('Lumiere Club')/2),15,'Lumiere Club');
     $pdf->SetFont('PT_Serif-Web-Bold','',30);
     $pdf->Text((230/2)-($pdf->GetStringWidth('Lippo Mall Kemang')/2),26,'Lippo Mall Kemang');

     $pdf->SetFont('Times','',12);
     $pdf->Text((230/2)-($pdf->GetStringWidth('Jl. Pangeran Antasari 36 Jakarta Selatan - 12150')/2),33,'Jl. Pangeran Antasari 36 Jakarta Selatan - 12150');
    //$pdf->setDrawColor(105,102,102);      
    $pdf->Line(10, 36, 210-5, 36);
     

		

       $pdf->SetFont('Arial','',22);
      $pdf->Text((230/2)-($pdf->GetStringWidth('Report Redeem Point')/2),45,'Report Redeem Point');

      $awal = date('d F Y',strtotime($tgl1));
	  $akhir = date('d F Y',strtotime($tgl2));
	 $periode = "$awal to $akhir";
		 
		
		$pdf->SetFont('Arial','',14);
	   $pdf->Text((230/2)-($pdf->GetStringWidth($periode)/2),54,$periode);


    
     //$pdf->Line(10, 10, 210-10, 10);
     $pdf->SetXY(10,60);
      $pdf->SetFont('Helvetica','',12);

     $content = Redeem::model()->with(array('member','user','detail_redeem'))->findAll(array(
		'condition'=>'redeem_date BETWEEN :date1 AND :date2',
		'order'=>'t.id_member DESC',
		'params'=>array(':date1'=>$tgl1,':date2'=>$tgl2)
	));

	if (is_null($content)) {
		$pdf->SetFont('Helvetica','',48);
		$pdf->Text((290/2)-($pdf->GetStringWidth("No Data Found")/2),84,"No Data Found");
		$pdf->Output();
		Yii::app()->end();
	}


    $sql = "SELECT voucher.voucher_name,SUM(detail_redeem.voucher_number) as jumlah FROM
	 redeem JOIN detail_redeem ON redeem.id_redeem = detail_redeem.id_redeem
	 JOIN voucher ON voucher.id_voucher = detail_redeem.id_voucher WHERE redeem_date BETWEEN '".$tgl1."' AND '".$tgl2."'
	 GROUP BY voucher.id_voucher ORDER BY jumlah DESC ";
	 $results = Yii::app()->db->createCommand($sql)->queryAll();

    $pdf->SetFont('Arial','',16);
    $text_color = '0,0,0';
    $back_color = '255,255,255';
	$pdf->Text(10,70,'Summary');
	$pdf->Line(10, 72, 100, 72);
    $pdf->SetXY(10,75);
	$columns = array();
	$cols = array();
	$text_color = '';
	$pdf->x1=25;
    $cols[] = array('text' => 'No', 'width' => '20','height' => '8', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	
$cols[] = array('text' => 'Voucher Name', 'width' => '120','height' => '8', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	
$cols[] = array('text' => 'Qty', 'width' => '30','height' => '8', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$columns[] = $cols;
    $pdf->WriteTable($columns);
    $no=1;

    foreach($results as $result){
         $columns_content = array();
         $cols_content = array();
		 $cols_content[] = array('text' => $no, 'width' => '20', 'height' => '8', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		 $cols_content[] = array('text' => $result['voucher_name'], 'width' => '120', 'height' => '8', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
          $cols_content[] = array('text' => $result['jumlah'], 'width' => '30', 'height' => '8', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

        $columns_content[] = $cols_content;
	    $pdf->WriteTable($columns_content);

		$no++;

	}

	$pdf->Ln();
   
    $pdf->AddPage('L');

    $pdf->SetFont('Arial','',16);
    $pdf->Text(10,15,'Details Report');
	$pdf->Line(10, 17, 100, 17);
	$pdf->SetXY(10,25);
    $columns = array();
    $cols = array();
    $pdf->x1='';
     foreach($content as $redeem){
		
		

	 $columns_head = array();
     $cols_head = array();
	 $cols_head[] = array('text' => 'ID Member : ', 'width' => '50', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');
    $cols_head[] = array('text' => $redeem->id_member, 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

    $cols_head[] = array('text' => 'Redeem Date : ', 'width' => '45', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

	 $cols_head[] = array('text' => date('d F Y',strtotime($redeem->redeem_date)), 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

	

    
    $columns_head[] = $cols_head;
	$pdf->WriteTable($columns_head);

	$columns_head2 = array();
    $cols_head2 = array();
	 $cols_head2[] = array('text' => 'Member Name : ', 'width' => '50', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

      if (empty($redeem->member->fullname)) {
			// current id_member adalah bertipe regular
			$up = new UpgradeMembership();
			$get_new_id_member = $up->getNewIdMember($redeem->id_member);

			if (!is_null($get_new_id_member)) {
                 $cols_head2[] = array('text' => $get_new_id_member->member->fullname, 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');
			}
	  }else{
                 $cols_head2[] = array('text' => $redeem->member->fullname, 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

	}

    $cols_head2[] = array('text' => 'CS : ', 'width' => '45', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

	 $cols_head2[] = array('text' => $redeem->user->name, 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => '');

	

    
    $columns_head2[] = $cols_head2;
	$pdf->WriteTable($columns_head2);
	
   $pdf->Ln();
;
	 $columns = array();
    $cols = array();
	 $cols[] = array('text' => 'No', 'width' => '12', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Voucher Name', 'width' => '45', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => 'Qty', 'width' => '25', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    
    $columns[] = $cols;
	$pdf->WriteTable($columns);
	 $no=1;
     foreach($redeem->detail_redeem as $detail) {
		

		$columns_content = array();
    $cols_content = array();
	 $cols_content[] = array('text' => $no, 'width' => '12', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols_content[] = array('text' => $detail->voucher->voucher_name, 'width' => '45', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols_content[] = array('text' => $detail->voucher_number, 'width' => '25', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255',
                    'textcolor' => '0,0,0', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    
    $columns_content[] = $cols_content;
	$pdf->WriteTable($columns_content);
		$no++;
	 }
    
	$pdf->Ln();
    
    
     

		

		
     }   
     
	   
    
    
    $pdf->Output();
