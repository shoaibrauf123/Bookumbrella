<?
$option = '<select name="PaymentID" id="2016" class="body1 form-control">';

for($month=1;$month<=12;$month++){
    $list=array();

    $month_end = strtotime('last day of this month', strtotime($year.'-'.$month.'-'.'1'));
    $day = date('d', $month_end).'<br/>';


    $time=mktime(12, 0, 0, $month, 1, $year);
    if (date('m', $time)==$month)
        $a1=date('m/d/Y', $time);

    $time=mktime(12, 0, 0, $month, 15, $year);
    if (date('m', $time)==$month)
        $b1=date('m/d/Y', $time);
    $option .= '<option value="'.$a1.' - '.$b1.'">'.$a1.' - '.$b1.'</option>';
    $time=mktime(12, 0, 0, $month, 16, $year);
    if (date('m', $time)==$month)
        $a2=date('m/d/Y', $time);


    $time=mktime(12, 0, 0, $month, $day, $year);
    if (date('m', $time)==$month)
        $b2=date('m/d/Y', $time);


    $option .= '<option value="'.$a2.' - '.$b2.'">'.$a2.' - '.$b2.'</option>';

}
$option .= '</select>';
echo $option;
?>
<?php
exit;
?>

<select name="PaymentID" id="2016" class="body1 form-control">
    <option value="01/01/15 - 01/15/16">01/01/15 - 01/15/15</option>
    <option value="01/16/15 - 01/31/16">01/16/15 - 01/31/15</option>
    <option value="02/01/15 - 02/15/16">02/01/15 - 02/15/15</option>
    <option value="02/01/15 - 02/15/16">02/01/15 - 02/15/15</option>
    <option value="03/01/15 - 03/15/16">03/01/15 - 03/15/15</option>
    <option value="03/16/15 - 03/31/16">03/16/15 - 03/31/15</option>
    <option value="04/01/15 - 04/15/16">04/01/15 - 04/15/15</option>
    <option value="04/16/15 - 04/30/16">04/16/15 - 04/30/15</option>
    <option value="05/01/15 - 05/15/16">05/01/15 - 05/15/15</option>
    <option value="05/16/15 - 05/31/16">05/16/15 - 05/31/15</option>
    <option value="06/01/15 - 06/15/16">06/01/15 - 06/15/15</option>
    <option value="06/16/15 - 06/30/16">06/16/15 - 06/30/15</option>
    <option value="07/01/15 - 07/15/16">07/01/15 - 07/15/15</option>
    <option value="07/16/15 - 07/31/16">07/16/15 - 07/31/15</option>
    <option value="08/01/15 - 08/15/16">08/01/15 - 08/15/15</option>
    <option value="08/16/15 - 08/31/16">08/16/15 - 08/31/15</option>
    <option value="09/01/15 - 09/15/16">09/01/15 - 09/15/15</option>
    <option value="09/16/15 - 09/30/16">09/16/15 - 09/30/15</option>
    <option value="10/01/15 - 10/15/16">10/01/15 - 10/15/15</option>
    <option value="10/16/15 - 10/31/16">10/16/15 - 10/31/15</option>
    <option value="11/01/15 - 11/15/16">11/01/15 - 11/15/15</option>
    <option value="11/16/15 - 11/30/16">11/16/15 - 11/30/15</option>
    <option value="11/16/15 - 11/30/16">12/01/15 - 12/15/15</option>
    <option value="01/01/14 - 01/15/16">01/01/14 - 01/15/14</option>
    <option value="01/16/14 - 01/31/16">01/16/14 - 01/31/14</option>
    <option value="02/01/14 - 02/15/16">02/01/14 - 02/15/14</option>
    <option value="02/01/14 - 02/15/16">02/01/14 - 02/15/14</option>
    <option value="03/01/14 - 03/15/16">03/01/14 - 03/15/14</option>
    <option value="03/16/14 - 03/31/16">03/16/14 - 03/31/14</option>
    <option value="04/01/14 - 04/15/16">04/01/14 - 04/15/14</option>
    <option value="04/16/14 - 04/30/16">04/16/14 - 04/30/14</option>
    <option value="05/01/14 - 05/15/16">05/01/14 - 05/15/14</option>
    <option value="05/16/14 - 05/31/16">05/16/14 - 05/31/14</option>
    <option value="06/01/14 - 06/15/16">06/01/14 - 06/15/14</option>
    <option value="06/16/14 - 06/30/16">06/16/14 - 06/30/14</option>
    <option value="07/01/14 - 07/15/16">07/01/14 - 07/15/14</option>
    <option value="07/16/14 - 07/31/16">07/16/14 - 07/31/14</option>
    <option value="08/01/14 - 08/15/16">08/01/14 - 08/15/14</option>
    <option value="08/16/14 - 08/31/16">08/16/14 - 08/31/14</option>
    <option value="09/01/14 - 09/15/16">09/01/14 - 09/15/14</option>
    <option value="09/16/14 - 09/30/16">09/16/14 - 09/30/14</option>
    <option value="10/01/14 - 10/15/16">10/01/14 - 10/15/14</option>
    <option value="10/16/14 - 10/31/16">10/16/14 - 10/31/14</option>
    <option value="11/01/14 - 11/15/16">11/01/14 - 11/15/14</option>
    <option value="11/16/14 - 11/30/16">11/16/14 - 11/30/14</option>
    <option value="11/16/14 - 11/30/16">12/01/14 - 12/15/14</option>
    <option value="01/01/13 - 01/15/16">01/01/13 - 01/15/13</option>
    <option value="01/16/13 - 01/31/16">01/16/13 - 01/31/13</option>
    <option value="02/01/13 - 02/15/16">02/01/13 - 02/15/13</option>
    <option value="02/01/13 - 02/15/16">02/01/13 - 02/15/13</option>
    <option value="03/01/13 - 03/15/16">03/01/13 - 03/15/13</option>
    <option value="03/16/13 - 03/31/16">03/16/13 - 03/31/13</option>
    <option value="04/01/13 - 04/15/16">04/01/13 - 04/15/13</option>
    <option value="04/16/13 - 04/30/16">04/16/13 - 04/30/13</option>
    <option value="05/01/13 - 05/15/16">05/01/13 - 05/15/13</option>
    <option value="05/16/13 - 05/31/16">05/16/13 - 05/31/13</option>
    <option value="06/01/13 - 06/15/16">06/01/13 - 06/15/13</option>
    <option value="06/16/13 - 06/30/16">06/16/13 - 06/30/13</option>
    <option value="07/01/13 - 07/15/16">07/01/13 - 07/15/13</option>
    <option value="07/16/13 - 07/31/16">07/16/13 - 07/31/13</option>
    <option value="08/01/13 - 08/15/16">08/01/13 - 08/15/13</option>
    <option value="08/16/13 - 08/31/16">08/16/13 - 08/31/13</option>
    <option value="09/01/13 - 09/15/16">09/01/13 - 09/15/13</option>
    <option value="09/16/13 - 09/30/16">09/16/13 - 09/30/13</option>
    <option value="10/01/13 - 10/15/16">10/01/13 - 10/15/13</option>
    <option value="10/16/13 - 10/31/16">10/16/13 - 10/31/13</option>
    <option value="11/01/13 - 11/15/16">11/01/13 - 11/15/13</option>
    <option value="11/16/13 - 11/30/16">11/16/13 - 11/30/13</option>
    <option value="11/16/13 - 11/30/16">12/01/13 - 12/15/13</option>
    <option value="01/01/16 - 01/15/16">01/01/16 - 01/15/16</option>
    <option value="01/16/16 - 01/31/16">01/16/16 - 01/31/16</option>
    <option value="02/01/16 - 02/15/16">02/01/16 - 02/15/16</option>
    <option value="02/01/16 - 02/15/16">02/01/16 - 02/15/16</option>
    <option value="03/01/16 - 03/15/16">03/01/16 - 03/15/16</option>
    <option value="03/16/16 - 03/31/16">03/16/16 - 03/31/16</option>
    <option value="04/01/16 - 04/15/16">04/01/16 - 04/15/16</option>
    <option value="04/16/16 - 04/30/16">04/16/16 - 04/30/16</option>
    <option value="05/01/16 - 05/15/16">05/01/16 - 05/15/16</option>
    <option value="05/16/16 - 05/31/16">05/16/16 - 05/31/16</option>
    <option value="06/01/16 - 06/15/16">06/01/16 - 06/15/16</option>
    <option value="06/16/16 - 06/30/16">06/16/16 - 06/30/16</option>
    <option value="07/01/16 - 07/15/16">07/01/16 - 07/15/16</option>
    <option value="07/16/16 - 07/31/16">07/16/16 - 07/31/16</option>
    <option value="08/01/16 - 08/15/16">08/01/16 - 08/15/16</option>
    <option value="08/16/16 - 08/31/16">08/16/16 - 08/31/16</option>
    <option value="09/01/16 - 09/15/16">09/01/16 - 09/15/16</option>
    <option value="09/16/16 - 09/30/16">09/16/16 - 09/30/16</option>
    <option value="10/01/16 - 10/15/16">10/01/16 - 10/15/16</option>
    <option value="10/16/16 - 10/31/16">10/16/16 - 10/31/16</option>
    <option value="11/01/16 - 11/15/16">11/01/16 - 11/15/16</option>
    <option value="11/16/16 - 11/30/16">11/16/16 - 11/30/16</option>
    <option value="11/16/16 - 11/30/16">12/01/16 - 12/15/16</option>
    <option value="01/01/17 - 01/15/17">01/01/17 - 01/15/17</option>
    <option value="01/16/17 - 01/31/17">01/16/17 - 01/31/17</option>
    <option value="02/01/17 - 02/15/17">02/01/17 - 02/15/17</option>
    <option value="02/01/17 - 02/15/17">02/01/17 - 02/15/17</option>
    <option value="03/01/17 - 03/15/17">03/01/17 - 03/15/17</option>
    <option value="03/16/17 - 03/31/17">03/16/17 - 03/31/17</option>
    <option value="04/01/17 - 04/15/17">04/01/17 - 04/15/17</option>
    <option value="04/16/17 - 04/31/17">04/16/17 - 04/31/17</option>
    <option value="05/01/17 - 05/15/17">05/01/17 - 05/15/17</option>
    <option value="05/16/17 - 05/31/17">05/16/17 - 05/31/17</option>
    <option value="06/01/17 - 06/15/17">06/01/17 - 06/15/17</option>
    <option value="06/16/17 - 06/31/17">06/16/17 - 06/31/17</option>
    <option value="07/01/17 - 07/15/17">07/01/17 - 07/15/17</option>
    <option value="07/16/17 - 07/31/17">07/16/17 - 07/31/17</option>
</select>