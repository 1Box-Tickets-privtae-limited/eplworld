 
 @if($results['premium_data'] == "")
 <label>
<input type="checkbox"  id="booking_protect" name="booking_protect" value="{{$results['cart_id']}}">
<span>{{__('messages.use booking protect system (+7% free)')}}</span>
</label>
@endif
@if($results['premium_data'] !="")
<?php 
$premium_terms = $results['premium_terms'];
 ?>
<label>
<input type="checkbox" checked  id="booking_protect" name="booking_protect" value="{{$results['cart_id']}}">
<span>{{__('messages.use booking protect system (+7% free)')}}</span>
</label>
<div id="salesMessage"><?php echo html_entity_decode($protection_content, ENT_COMPAT, 'UTF-8');//html_entity_decode($results['premium_data'], ENT_COMPAT, 'UTF-8');?>
    <span>
    <b>Please see the <a style="color:red;cursor: pointer;" onclick="window.open('{{$premium_terms}}', '_blank', 'fullscreen=yes');" >Terms and Conditions</a></b></span>

</div>


@endif
