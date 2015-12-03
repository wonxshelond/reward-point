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
      $pdf->Text((290/2)-($pdf->GetStringWidth('Report Data Member')/2),45,'Report Data Member');

      $awal = date('d F Y',strtotime($tgl1));
	  $akhir = date('d F Y',strtotime($tgl2));
	 $periode = "$awal to $akhir";
		 
		
		$pdf->SetFont('Arial','',14);
	   $pdf->Text((290/2)-($pdf->GetStringWidth($periode)/2),54,$periode);


    
     //$pdf->Line(10, 10, 210-10, 10);
     $pdf->SetXY(10,60);
      $pdf->SetFont('Helvetica','',12);

     $content = Member::model()->findAll(array(
		'condition'=>'register_date BETWEEN :date1 AND :date2',
		'params'=>array(':date1'=>$tgl1,':date2'=>$tgl2)
	));

	if (is_null($content)) {
		$pdf->SetFont('Helvetica','',48);
		$pdf->Text((290/2)-($pdf->GetStringWidth("No Data Found")/2),84,"No Data Found");
		$pdf->Output();
		Yii::app()->end();
	}

	$mandatory_filter = ' AND register_date BETWEEN :tgl1 AND :tgl2';
	$params_mandatory_filter = array(':tgl1'=>$tgl1,':tgl2'=>$tgl2);

	$total = count($content);

	$total_diamond = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card'.$mandatory_filter,
		'params'=>array(':type_card'=>'diamond') + $params_mandatory_filter,
	)));

	$total_male_diamond = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card AND gender = :gender'.$mandatory_filter,
		'params'=>array(':type_card'=>'diamond',':gender'=>'0') + $params_mandatory_filter,
	)));

	$total_female_diamond = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card AND gender = :gender'.$mandatory_filter,
		'params'=>array(':type_card'=>'diamond',':gender'=>'1') + $params_mandatory_filter,
	)));


	$total_regular = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card'.$mandatory_filter,
		'params'=>array(':type_card'=>'regular') + $params_mandatory_filter,
	)));

	

	$total_male_regular = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card AND gender = :gender '.$mandatory_filter,
		'params'=>array(':type_card'=>'regular',':gender'=>'0') + $params_mandatory_filter,
	)));

	$total_female_regular = count(Member::model()->findAll(array(
		'condition' => 'LOWER(type_card) = :type_card AND gender = :gender'.$mandatory_filter,
		'params'=>array(':type_card'=>'regular',':gender'=>'1')+$params_mandatory_filter,
	)));


	if ($content==null) {
		$pdf->SetFont('Helvetica','',48);
		$pdf->Text((290/2)-($pdf->GetStringWidth("No Data Found")/2),84,"No Data Found");
		$pdf->Output();
		Yii::app()->end();
	}
    $pdf->SetFont('Arial','',16);
    $text_color = '0,0,0';
    $back_color = '255,255,255';
	$pdf->Text(10,70,'Summary');
	$pdf->Line(10, 72, 100, 72);
    $pdf->SetXY(10,75);
	$columns = array();
	$cols = array();
	
    $cols[] = array('text' => 'Total Member', 'width' => '140','height' => '15', 'align' => 'L', 
                    'font_name' => 'Arial', 'font_size' => '14', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total, 'width' => '135','height' => '15', 'align' => 'R', 
                    'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	
	$columns[] = $cols;
    $pdf->WriteTable($columns);
    $pdf->SetXY(10,95);

	// Total Diamond
    $columns = array();
	$cols = array();
	$cols[] = array('text' => 'Diamond', 'width' => '91', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => 'Diamond Male', 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => 'Diamond Female', 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
   

    $columns[] = $cols;
    $cols = array();
	$cols[] = array('text' => $total_diamond, 'width' => '91', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total_male_diamond, 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total_female_diamond, 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $columns[] = $cols;
    $pdf->WriteTable($columns);
    // End Total Diamond

	// Total Regular
    $columns = array();
	$cols = array();
	$cols[] = array('text' => 'Regular', 'width' => '91', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => 'Regular Male', 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => 'Regular Female', 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
   

    $columns[] = $cols;
    $cols = array();
	$cols[] = array('text' => $total_regular, 'width' => '91', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total_male_regular, 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
	$cols[] = array('text' => $total_female_regular, 'width' => '92', 'height' => '15', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $columns[] = $cols;
    $pdf->WriteTable($columns);
    $pdf->SetXY(10,135);
	// End Total Regular
    $pdf->Ln();
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
    
    $cols[] = array('text' => 'ID Member', 'width' => '30', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

     $cols[] = array('text' => 'Type', 'width' => '20', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Name', 'width' => '55', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Gender', 'width' => '25', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Birth Date', 'width' => '45', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => 'Citizenship', 'width' => '40', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
     $cols[] = array('text' => 'Email', 'width' => '50', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '145,145,145',
                    'textcolor' => '255,255,255', 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $columns[] = $cols;
    
    
     $no=1;
     foreach($content as $member){

        
        $cols = array();
        $cols[] = array('text' => $no, 'width' => '12', 'height' => '7', 'align' => 'C', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' =>$back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => $member->id_member, 'width' => '30', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');

    $cols[] = array('text' => $member->type_card, 'width' => '20', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' =>$back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => $member->first_name.' '.$member->family_name, 'width' => '55', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => $member->gender=='0'?'Male':'Female', 'width' => '25', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
    $cols[] = array('text' => date('d F Y',strtotime($member->date_birth)), 'width' => '45', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
     $cols[] = array('text' => $member->citizenship, 'width' => '40', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
        $cols[] = array('text' => $member->email, 'width' => '50', 'height' => '7', 'align' => 'L', 
                    'font_name' => 'helvetica', 'font_size' => '12', 'font_style' => '', 'fillcolor' => $back_color,
                    'textcolor' => $text_color, 'drawcolor' => '110,110,110', 'linewidth' => '0.4', 'linearea' => 'LTBR');
       $columns[] = $cols;
       $no++;
     }   

     $pdf->WriteTable($columns);
     
     $pdf->Output();