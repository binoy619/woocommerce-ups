<?php
// Shipping Calculation is done here. Make necessary changes..
foreach ( $woocommerce->cart->get_cart() as $item_id => $values ) {

            $_product = $values['data'];
            $weight1+ = $_product->weight;
			$width1+ = $_product->width;
			$height1+ = $_product->height;
			$length1+ = $_product->length;
			
            }
			
$from_zip='682018';
$destination_zip=get_user_meta( $current_user->ID, 'shipping_postcode', true );
$services='02';
$length=$length1;
$width=$width1;
$height=$height1;
$weight=$weight1;

require_once("ups.php");
$ups = new upsRate();
$ups->setCredentials(UPS_ACCOUNT_API_KEY,ACCOUNT_NAME,ACCOUNT_PASSWORD,ACCOUNT_NUMBER);
$result    = $ups->getRate($from_zip,$destination_zip,$services,$length,$width,$height,$weight);

echo "Price".$result;
 
?>
