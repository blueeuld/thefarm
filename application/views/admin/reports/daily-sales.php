<html>
<head>
    <style>
        body, td, span, th{
            font-family: Calibri,Arial,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<body>
<table width="100%">
	<tr>
		<td>THE FARM AT SAN BENITO <br />DAILY SALES REPORT <br /><?php echo $location_name;?></td>
		<td align="right">DATE : <b><?php echo $date;?></b></td>
	</tr>
</table>	
<table style="border-collapse: collapse; padding: 5px; border: 1px;" border="1" width="100%" cellpadding="2">
    <thead>
	<tr>
        <th style="border-top: 2px solid #000; border-left: 2px solid #000;">&nbsp;</th>
        <th style="border-top: 2px solid #000;">&nbsp;</th>
        <th style="border-top: 2px solid #000;" colspan="2">OS No</th>
        <th style="border-top: 2px solid #000;">&nbsp;</th>
        <th style="border-top: 2px solid #000;">&nbsp;</th>
        <th style="border-top: 2px solid #000; border-right: 2px solid #000;" align="center" colspan="3">CHARGES</th>
    </tr>
    <tr>
        <th style="border-left: 2px solid #000;">Guest</th>
        <th>ROOM</th>
        <th>SI</th>
        <th>SN</th>
        <th>Treatments/Service</th>
        <th>Products/Supplement</th>
		<th align="center">Included on Packages</th>
        <th align="center">Excluded / A-la-carte</th>
        <th style="border-right: 2px solid #000;" align="center">FOC</th>
    </tr>
    </thead>
    <tbody>
	<tr>
		<td style="border-bottom: 2px solid #000; border-left: 2px solid #000;">&nbsp;</td>
		<td style="border-bottom: 2px solid #000;">&nbsp;</td>
        <td style="border-bottom: 2px solid #000;">&nbsp;</td>
        <td style="border-bottom: 2px solid #000;">&nbsp;</td>
        <td style="border-bottom: 2px solid #000;">&nbsp;</td>
        <th align="center" style="border-bottom: 2px solid #000;" ></th>
		<td style="border-bottom: 2px solid #000;" align="center">Php</td>
		<td style="border-bottom: 2px solid #000;" align="center">Php</td>
		<td style="border-bottom: 2px solid #000; border-right: 2px solid #000;" align="center">Php</td>
	</tr>
	<?php $total_includes = 0; ?>
	<?php $total_foc = 0; ?>
	<?php $total_upsell = 0; ?>
    <?php $prev = 0; ?>
    <?php foreach ($events as $event) : ?>
    <?php if ($event['ItemId'] !== NULL) : ?>
            <?php
            if ($prev === $event['BookingId']) {
                $guestName = '';
            }
            else {
                $guestName = $event['Booking']['Guest']['FirstName'] . ' ' . $event['Booking']['Guest']['LastName'];
            }

            $prev = $event['BookingId'];
            ?>
    <tr>
	    <td style="border-bottom: 1px solid #000; border-left:1px solid #000;"><?php echo $guestName; ?></td>
	    <td style="border-bottom: 1px solid #000;" align="center"><?php if (isset($event['Room'])){ echo $event['Room']['Abbr'] ? $event['Room']['Abbr'] : $event['Room']['Title']; } ?></td>
        <td style="border-bottom: 1px solid #000;" align="center"><?php echo $event['InclOsDoneNumber']; ?></td>
        <td style="border-bottom: 1px solid #000;" align="center"><?php echo $event['NotInclOsDoneNumber']; ?></td>
        <td style="border-bottom: 1px solid #000;" align="center"><?php echo $event['Item']['Title']; ?></td>
        <td style="border-bottom: 1px solid #000;" align="center"><?php echo $event['Notes']; ?></td>
	    <td style="border-bottom: 1px solid #000;" align="right" width="10%"><?php if ($event['InclOsDoneNumber'] > 0) : ?>&#8369; <?php $total_includes+= $event['InclOsDoneAmount']; echo $event['InclOsDoneAmount'];?><?php endif;?></td>
	    <td style="border-bottom: 1px solid #000;" align="right" width="10%"><?php if ($event['NotInclOsDoneNumber'] > 0) : ?>&#8369; <?php $total_upsell+= $event['NotInclOsDoneAmount']; echo $event['NotInclOsDoneAmount'];?><?php endif;?></td>
	    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000;" align="right" width="10%"><?php if ($event['FocOsDoneNumber'] > 0) : ?>&#8369; <?php $total_foc+= $event['FocOsDoneAmount']; echo $event['FocOsDoneAmount'];?><?php endif;?></td>
    </tr>
    <?php endif ?>
    <?php endforeach; ?>
    </tbody>
    <tfoot> 
	<tr style="border: 2px solid #000;">
		<td><b>Total</b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><?php echo $total_includes > 0 ? '&#8369; '.$total_includes : ''?></td>
		<td align="right"><?php echo $total_upsell > 0 ? '&#8369; '.$total_upsell : ''?></td>
		<td align="right"><?php echo $total_foc > 0 ? '&#8369; '.$total_foc : ''?></td>
	</tr>
    </tfoot>
</table>
<p>Total Upsell : <?php echo '&#8369; '.$total_upsell?></p>
</body>
</html>