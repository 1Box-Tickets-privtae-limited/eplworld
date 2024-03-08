<?php 
 $out_acsurl = $acsUrl;
 $out_acspareq = $PaReq;
 $out_acsmd = $MD;
 $out_acsterm = $TermUrl;

 $in_acspares = "";
 $in_acsmd = "";
?>

<html>

 <head>


 </head>

    @if(!empty($acsUrl))
<br>

   <form action="{{$out_acsurl}}" method="POST" enctype="application/x-www-form-urlencoded" id="form_submit">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <!-- PaReq:  --><input type="hidden" id="PaReq" name="PaReq" value="{{$out_acspareq}}"><br>
      <input type="hidden" id="booking_id" name="booking_id" value="{{$booking_id}}">
     <!-- TermUrl:  --><input type="hidden" id="TermUrl" name="TermUrl" value="{{url(app()->getLocale().'/networkPaRes/'.base64_encode($current_res).'/'.$booking_id)}}"><br>
     <!-- MD:  --><input type="hidden" id="MD" name="MD" value="{{$out_acsmd}}"><br>

     <!-- <input type="submit"> -->

   </form>

    @elseif(!empty($_POST))
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
     PaRes: <input type="hidden" id="PaRes" name="PaRes" value="{{$in_acspares}}"><br>
     <input type="hidden" id="access_token" name="booking_id" value="{{$booking_id}}">
     MD: <input type="hidden" id="MDRes" name="MDRes" value="{{$in_acsmd}}"><br>

    @else

      <center>[ Awaiting 3DS ]</center>

   @endif

 </body>
<script type="text/javascript">
  document.getElementById("form_submit").submit();
</script>
</html>