<?php
// set field yang berisi array
$default_array_field = array('gender','religion','income','hobby','cc');
// jika field merupakan array isi dengan index 0 jika bukan isi dengan -
foreach($data as $key => $val){
  
   if (empty($data->$key)){
    
     if (in_array($key,$default_array_field))
      $data->$key = '0';
     else
      $data->$key = '-';

   }
}

// Option untuk field array
$genders      = array('Male','Female');

$religions    = array('Moslem','Christian','Chatolic','Hindu','Budhist');

$incomes      = array('<= Rp 2.500.000','Rp 10.000.000 - Rp 25.000.000 ','Rp 2.500.000 - Rp 5.000.000',
                'Rp 25.000.000 - Rp 50.000.000','Rp 5.000.000 - Rp 10.000.000','>= Rp 50.000.000');

$hobbies      = array( 'Fashion & Accessories', 'Electronic & Gadgets',
                'Salon & beauty','Music & Movie',
                'Sport & Sports wear', 'Book & Stationary',
                'Kids & Toys','Late Night Entertainment',
                'Food & Beverage(restaurant)','Home Furnishing',
                'Food & Beverage (cafe/coffee shop)',
                'Others');

$credit_cards = array('BCA','Citibank', 'ANZ',
                'HSBC', 'BII ', 'Mandiri',
                'BNI', 'UOB', 'Other', 'CIMB Niaga', 'AMEX');
?>
<!-- setting agar th rata kiri -->
<style>
  table tr.child_table th{
    text-align:left !important;
  }
</style>

<!-- isi dari detail data member -->
<table class="items table table-striped table-bordered">

  <tr>
    <th colspan="6">Member Identity</th>
  </tr>

  <tr class="child_table">
      <th>ID Member</th><td>:</td><td><?php echo $data->id_member; ?></td>
      <th>Member Name</th><td>:</td><td><?php echo $data->first_name.$data->family_name; ?></td>
  </tr>
 <tr class="child_table">
      <th>ID Identity</th><td>:</td><td><?php echo $data->no_identity; ?></td>
      <th>Gender</th><td>:</td><td><?php echo $genders[$data->gender] ?></td>
  </tr>

  <tr class="child_table">
      <th>Type Member</th><td>:</td><td><?php echo $data->type_card; ?></td>
      <th>Point</th><td>:</td><td><?php echo $data->point; ?></td>
  </tr>

  <tr>
    <th colspan="6">Member Personalization</th>
  </tr>

  <tr class="child_table">
      <th>Birth</th><td>:</td><td><?php echo $data->place_birth.', '.date('d F Y',strtotime($data->date_birth)); ?></td>
      <th>Citizenship</th><td>:</td><td><?php echo $data->citizenship; ?></td>
  </tr>

  <tr class="child_table">
      <th>Marital Status</th><td>:</td><td><?php echo $data->marital_status; ?></td>
      <th>Children Number</th><td>:</td><td><?php echo $data->children_number; ?></td>
  </tr>

  <tr class="child_table">
      <th>Religion</th><td>:</td><td><?php echo $religions[$data->religion]; ?></td>
      <th>Address</th><td>:</td><td><?php echo $data->address; ?></td>
  </tr>

  <tr class="child_table">
      <th>Phone 1</th><td>:</td><td><?php echo $data->phone1; ?></td>
      <th>Mobile 1</th><td>:</td><td><?php echo $data->mobile1; ?></td>
  </tr>

  <tr class="child_table">
      <th>Phone 2</th><td>:</td><td><?php echo $data->phone2; ?></td>
      <th>Mobile 2</th><td>:</td><td><?php echo $data->mobile2; ?></td>
  </tr>

  <tr>
    <th colspan="6">Member Preference</th>
  </tr>

  <tr class="child_table">
      <th>Email</th><td>:</td><td><?php echo $data->email; ?></td>
      <th>Income</th><td>:</td><td><?php echo empty($data->income)?'-':$incomes[$data->income]; ?></td>
  </tr>

  <tr class="child_table">
      <th>Hobby</th><td>:</td>
      <td>
       <ul>
        <?php 
            if (!empty($data->hobby)){
                // pisahkan masing-masing nilai field hobby dengan memecah ;
                // sehingga menjadi array
                $db_hobby = explode(';',$data->hobby);
                
                // set flag other hobby ke false
                $flag_other_hobby = false;

                // membuat unordered list
                echo '<ul>';
                foreach($db_hobby as $hobby){
                    // jika nilai field hobby ada yang 11 berarti other hobby terisi
                    if ($hobby == '11' )
                     $flag_other_hobby = true;
                    else
                     echo '<li>'.$hobbies[$hobby].'</li>';
                }

                // jika flag other hobby true cetak field other_hobby
                if ($flag_other_hobby)
                  echo '<li>'.$data->other_hobby.'</li>';

                echo '</ul>'; // penutup tag unorderd list

            } else echo '-'; // jika kosong cetak -
        ?>
        
      </td>
      <th>Credit Card</th><td>:</td>
      <td>

        <?php 
           
            if (!empty($data->cc)){
                // pisahkan masing-masing nilai field cc dengan memecah ;
                // sehingga menjadi array
                $db_cc = explode(';',$data->cc);
                
                // set flag other cc ke false
                $flag_other_cc = false;

                // membuat unordered list
                echo '<ul>';
                foreach($db_cc as $cc){
                    // jika nilai field cc ada yang 8 berarti other cc terisi
                    if ($cc == '8' )
                      $flag_other_cc = true;
                    else
                    echo '<li>'.$credit_cards[$cc].'</li>';
                }

                // jika flag other cc true cetak field other_cc
                if ($flag_other_cc)
                  echo '<li>'.$data->other_cc.'</li>';

                echo '</ul>'; // penutup tag unorderd list

            } else echo '-'; // jika kosong cetak -
        ?>
      </td>
  </tr>

</table>