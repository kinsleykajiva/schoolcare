<?php

	use Mpdf\MpdfException;

	include '../checkReqst.php';
require_once  '../../../vendor/autoload.php';

include_once '../../dbaccess/classes/DBCompanyDetails.php';
	$companyObj = new DBCompanyDetails( USER , PASSWORD , DATABASE );
//print $USER_ID ;
$viewData = [];
if(isset($_POST['dataArr'])){
    $data = $_POST['dataArr'];
    $data = json_decode($data,TRUE);
    $trArr =$data['cart'];
    $taxArr =$data['tax'];
    $subtotal = $taxArr['subtotal'];
    $tax_sum = $taxArr['tax_sum'];
    $tax_perc = $taxArr['tax_perc'];
    $total_amount = $taxArr['total_amount'];
    // print_r($total_amount);exit;
    $rec = $_POST['id_gen'];
    $toAddress = $_POST['toAddress'];
    $toEmail = $_POST['toEmail'];
    $toPhone = $_POST['toPhone'];
    $toDueDate = $_POST['toDueDate'];
    $toName = $_POST['toName'];

    $companyDetails = '
                    <br> '.$companyObj->NAME.'
                    <br> '.$companyObj->CONTACTS.'
                    <br> '.$companyObj->EMAIL.'
                    <br> '.$companyObj->ADDRESS.'
                    ';

    $ToDetails = '
                   
                    <br>'.$toName.'
                    <br>'.$toPhone.'
                    <br>'.$toEmail.'
                    <br>'.$toAddress.'
                    ';
    $tr = '';
    $trTax = '';
    
    $trTax .= '
				<br>
			    <tr style="margin-top:50px;">
			    <td class="blanktotal" colspan="2" rowspan="6" style="width: 67.839%;">
			        <br>
			    </td>
			    <td class="totals" style="width: 14.5139%; background-color: rgb(239, 239, 239);">Subtotal</td>
			    <td class="totals cost" style="width: 14.5139%; background-color: rgb(239, 239, 239);">'.$subtotal.' </td>
			  </tr>
           
           ';
           $trTax .= '
           <tr>
				<td class="totals" style="width: 14.5139%; background-color: rgb(239, 239, 239);">Tax</td>
				<td class="totals cost" style="width: 14.5139%; background-color: rgb(239, 239, 239);">'.$tax_sum.'</td>
			</tr>
           
           ';
           $trTax .= '
           <tr>
				<td class="totals" style="width: 14.5139%; background-color: rgb(239, 239, 239);"><strong>TOTAL</strong></td>
				<td class="totals cost" style="width: 14.5139%; background-color: rgb(239, 239, 239);"><strong> '.$total_amount.' </strong></td>
			</tr>
           
           ';
   
    foreach($trArr as $row){
        $product  = $row['product'];
        $qty  = $row['qty'];
        $price  = $row['price'];
        $rowTotal  = $row['total'];
        $tr .= '
            <tr>
				<td align="center" style="width: 9.6759%;">'.$qty.'</td>
				<td style="width: 43.6492%;"> '.$product.'</td>
				<td class="cost" style="width: 14.5139%;">'.$price.'</td>
				<td class="cost" style="width: 14.5139%;">'.$rowTotal.'</td>
			</tr>
        
        ';
    }

	$html = htmlForPdf( $companyDetails , $ToDetails , $tr , $trTax , $toDueDate ,$companyName = '');
	$path = '../../../public/';
	$tempPath = $path . 'temp';
	$folderPath = $path . 'invoices/' . date( 'Y-m' ) . '/' . $rec . '/';
	$downloadPath = $folderPath . $toName . ' invoice' . '-' . date( 'm.d.y' ) . '.pdf';
	try {
		if ( !file_exists( $folderPath ) ) {
			if ( !mkdir( $concurrentDirectory = $folderPath , 0777 , TRUE ) && !is_dir( $concurrentDirectory ) ) {
				throw new \RuntimeException( sprintf( 'Directory "%s" was not created' , $concurrentDirectory ) );
			}
		}
		//$height_ = 290;
		$height_ = 842/2;
		//$width_ = 236;
		$width_ = 595/2;
		$mpdf = new \Mpdf\Mpdf( [ 'tempDir' => $tempPath , 'mode' => 'utf-8' ,
				'format' => [ $height_ , $width_ ] ,
				'orientation' => 'L' ,
				'margin_left' => 20 ,
				'margin_right' => 20 ,
				'margin_top' => 20 ,
				'margin_bottom' => 8 ,
				'margin_header' => 10 ,
				'margin_footer' => 10 ]

		);
		$mpdf->SetProtection( array( 'print' ) );
		$mpdf->SetTitle( ' Invoice' );
		//$mpdf->SetAuthor($userFullName);
		//$mpdf->SetWatermarkText("Document");
		$mpdf->showWatermarkText = TRUE;
		$mpdf->SetFooter('Invoice - ' .date('Y-m-d H:i:s'));
		$mpdf->WriteHTML( $html );
		$viewData[ 'result' ] = 'ok';
		$viewData[ 'path' ] = $downloadPath;
		$mpdf->Output( $downloadPath , 'F' );
	} catch( MpdfException $e ) {
		$viewData[ 'result' ] = 'fail';
		$viewData[ 'message' ] = $e->getMessage();
	}


    print json_encode( $viewData );
    exit;
}


function htmlForPdf($companyDetails,$ToDetails , $tr , $trTax , $toDueDate , $companyName):string{
    $html = '   
    
<div>
    <div style="text-align: center;">
    <span class="fr-img-caption fr-fic fr-dib" style="width: 230px;">
	    <span class="fr-img-wrap">
		    <img src="https://s3-eu-west-1.amazonaws.com/froala-eu/temp_files%2F1577428116736-logo3.png">
		    <br>
		    <span class="fr-inner">'.$companyName.'</span>
	    </span>
    </span>
    </div>
	<div style="text-align: left;"><span style="font-size: 30px;"><strong><u>INVOICE</u></strong></span><u><br></u></div>
	<div style="text-align: right;">Date: '.date('Y-m-d').'</div>

	<table cellpadding="10" style="font-family: serif;" width="100%">
		<tbody>
			<tr>
				<td style="border: 0.1mm solid #888888;" width="45%"><span style="font-size: 7pt; color: #555555; font-family: sans;">From:</span>
					'.$companyDetails.'
                </td>
				<td width="10%">&nbsp;</td>
				<td style="border: 0.1mm solid #888888;" width="45%"><span style="font-size: 7pt; color: #555555; font-family: sans;">TO:</span>
					'.$ToDetails.'
                </td>
			</tr>
		</tbody>
	</table>

	<p>
		<br>
	</p>

	<table cellpadding="8" class="items" style="font-size: 9pt; border-collapse: collapse;" width="100%">
		<thead>
			<tr>
				<td style="width: 9.6759%; background-color: rgb(239, 239, 239);" width="10%">Quantity</td>
				<td style="width: 43.6492%; background-color: rgb(239, 239, 239);" width="45%">Description</td>
				<td style="width: 14.5139%; background-color: rgb(239, 239, 239);" width="15%"> Price</td>
				<td style="width: 14.5139%; background-color: rgb(239, 239, 239);" width="15%">Amount</td>
			</tr>
		</thead>
		<tbody>
			<!-- ITEMS HERE -->
			'.$tr.'
			<!-- END ITEMS HERE -->
			'.$trTax.'
			
		</tbody>
    </table>
    <br>
    <hr>
	<div style="margin-top:40px;text-align: center; font-style: italic;">Due Date: '.$toDueDate.'</div>

	<p style="display:none;"><strong><u>Comments&nbsp;</u></strong>:</p>

	<ol style="display:none;">
		<li><span style="font-size: 12px;">xxxxxx</span></li>
		<li><span style="font-size: 12px;">yyyyyyy</span></li>
	</ol>

	
</div>

    
    ';
    return $html ;
}
