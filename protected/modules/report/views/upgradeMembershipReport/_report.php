<?php $pdf = new MYPDF();
     //$pdf->setMargins(20,20,20);
     $pdf->AliasNbPages();
     
     $pdf->AddPage('L','A4');
     $pdf->AddFont('PT_Serif-Web-Bold','','PT_Serif-Web-Bold.php');
     
     $pdf->SetFont('PT_Serif-Web-Bold','',32);
     $pdf->image('./images/lippo.jpg',25,4,50,30);
     $pdf->Text((290/2)-($pdf->GetStringWidth('Lumiere Club')/2),15,'Lumiere Club');
     $pdf->SetFont('PT_Serif-Web-Bold','',30);
     $pdf->Text((290/2)-($pdf->GetStringWidth('Lippo Mall Kemang')/2),26,'Lippo Mall Kemang');

     $pdf->SetFont('Times','',12);
     $pdf->Text((290/2)-($pdf->GetStringWidth('Jl. Pangeran Antasari 36 Jakarta Selatan - 12150')/2),33,'Jl. Pangeran Antasari 36 Jakarta Selatan - 12150');
    //$pdf->setDrawColor(105,102,102);      
    $pdf->Line(10, 36, 290-5, 36);
     

		

       $pdf->SetFont('Arial','',22);
      $pdf->Text((290/2)-($pdf->GetStringWidth('Report Data Upgrade Membership')/2),45,'Report Data Upgrade Membership');

      $awal = date('d F Y',strtotime($tgl1));
	  $akhir = date('d F Y',strtotime($tgl2));
	 $periode = "$awal to $akhir";
		 
		
		$pdf->SetFont('Arial','',14);
	   $pdf->Text((290/2)-($pdf->GetStringWidth($periode)/2),54,$periode);


    
     //$pdf->Line(10, 10, 210-10, 10);
     $pdf->SetXY(10,60);
      $pdf->SetFont('Helvetica','',12);

     $content = UpgradeMembership::model()->with(array('member','user'))->findAll(array(
		'condition'=>'upgrade_date BETWEEN :date1 AND :date2',
		'params'=>array(':date1'=>$tgl1,':date2'=>$tgl2)
	));

	if ($content==null) {
		$pdf->SetFont('Helvetica','',48);
		$pdf->Text((290/2)-($pdf->GetStringWidth("No Data Found")/2),84,"No Data Found");
		$pdf->Output();
		Yii::app()->end();
	}

    

	$total = count($content);

	 $total_upgradeed_member_male = count(UpgradeMembership::model()->with(array('member'))->findAll(array(
		'condition'=>'upgrade_date BETWEEN :date1 AND :date2 AND member.gender = :gender',
		'params'=>array(':date1'=>$tgl1,':date2'=>$tgl2,':gender'=>'0')
	)));

	$total_upgradeed_member_female = count(UpgradeMembership::model()->with(array('member'))->findAll(array(
		'condition'=>'upgrade_date BETWEEN :date1 AND :date2 AND member.gender = :gender',
		'params'=>array(':date1'=>$tgl1,':date2'=>$tgl2,':gender'=>'1')
	)));

    $pdf->SetFont('Arial','',16);
    $text_color = '0,0,0';
    $back_color = '255,255,255';
	$pdf->Text(10,70,'Summary');
	$pdf->Line(10, 72, 100, 72);
    $pdf->SetXY(10,75);
	$columns = array();
	$cols = array();
	
    $cols[] = array('text' => 'Total Upgraded Member', 'width' => '140','height' => '15', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '14', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total, 'width' => '135','height' => '15', 'align' => 'R', 
                    'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	
	$columns[] = $cols;
    $pdf->WriteTable($columns);
    $pdf->SetXY(10,95);

	// Total Upgrade Member by gender
    $columns = array();
	$cols = array();
	$cols[] = array('text' => 'Male', 'width' => '140', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => 'Female', 'width' => '135', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	
   

    $columns[] = $cols;
    $cols = array();
	$cols[] = array('text' => $total_upgradeed_member_male, 'width' => '140', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total_upgradeed_member_female, 'width' => '135', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	

    $columns[] = $cols;
    $pdf->WriteTable($columns);
    // End Total Diamond

	// Buat halaman baru Lanscape
    $pdf->AddPage('L');

    $pdf->SetFont('Arial','',16);
    $pdf->Text(10,15,'Details Report');
	$pdf->Line(10, 17, 100, 17);
	$pdf->SetXY(10,25);

    $columns = array();
    $cols = array();
    $cols[] = array('text' => 'No.', 'width' => '12', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => 'Member Name', 'width' => '50', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => 'New ID Member', 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

     $cols[] = array('text' =>'Old ID Member', 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' =>'Old Point', 'width' => '25', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Upgrade Date', 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'CS', 'width' => '45', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    
    $columns[] = $cols;
    
    
     $no=1;
	
	$pdf->x1=30;
     foreach($content as $upmember){
		
		
		 
        $text_color = '0,0,0';
        $back_color = '255,255,255';
        $cols = array();
        $cols[] = array('text' => $no.'.', 'width' => '12', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' =>$back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => $upmember->member->first_name.' '.$upmember->member->family_name, 'width' => '50', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => $upmember->new_idmember, 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' =>$back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => $upmember->old_idmember, 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

	 $cols[] = array('text' => $upmember->old_point, 'width' => '25', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => date('d F Y',strtotime($upmember->upgrade_date)), 'width' => '35', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

   
     $cols[] = array('text' => $upmember->user->name, 'width' => '45', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
       
       $columns[] = $cols;
       $no++;
     }   
	
     $pdf->WriteTable($columns);
    
     $pdf->Output();