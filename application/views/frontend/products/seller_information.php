<style>
.clear20
{
    
    margin-top:10px;
}
.btn-class{
    float:right;
}
.heading{
  background-color:black;
  color:white;
}
#Tax_section{
    margin-top:50px;
}

input.btn.btn-info.btn-class {
    background: #bb9870 !important;
    border: 1px solid #bb9870 !important;
    border-radius:2px !important;
    color: #fff;
    margin-bottom: 30px;
}
input.btn.btn-info.btn-class:hover {
    background: #323232 !important;
    border: 1px solid #323232 !important;

}

</style>

<form action="<?php echo base_url('frontend/users/seller_information'); ?>" method="POST">
    <div class="col-xs-12">
    <div class="container">
    <div class="row no-padding  col-lg-offset-3">
      <h2>Seller Information</h2>
      <div class="clear30"></div>
       <div class="col-md-8 col-xs-12">
       <div class="form-group">
            <label class="seller_information">
            E-mail:
            </label>
            <input  class="form-control" type="text" name="email" value="<?php echo $user['email'];?>" />  
        </div>
       <div class="form-group ">
            <label class="seller_information">
                First Name: 
            </label>
            <input  class="form-control" type="text" name="first_name" value="<?php echo $user['first_name'];?>" />  
        </div>
       <div class="form-group ">
            <label class="seller_information">
                Last Name: 
            </label>
            <input  class="form-control" type="text" name="last_name" value="<?php echo $user['last_name'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Payee Name: 
            </label>
            <input  class="form-control" type="text" name="payee_name" value="<?php echo $user['payee_name'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                City Name: 
            </label>
            <input  class="form-control" type="text" name="city" value="<?php echo $user['city'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Zip Code: 
            </label>
            <input  class="form-control" type="text" name="postal_code" value="<?php echo $user['postal_code'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Address 2: 
            </label>
            <input  class="form-control" type="text" name="address2" value="<?php echo $store['address2'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Phone : 
            </label>
            <input  class="form-control" type="text" name="phone" value="<?php echo $user['phone'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Store Name: 
            </label>
            <input  class="form-control" type="text" name="name" value="<?php echo $store['name'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Store Address: 
            </label>
            <input  class="form-control" type="text" name="address" value="<?php echo $store['address'];?>" />  
        </div>
        <div class="form-group ">
            <label class="seller_information">
                Country: 
            </label>
            <select id="country" name="country" class="form-control"  onfocus="this.oldvalue = this.value;"  onchange="changeLabels()">
<option value="<?php echo $user['country'];?>"><?php echo $user['country'];?></option>
<option value="USA" >UNITED STATES</option>
<option value="ALB">ALBANIA</option>
<option value="ASM">AMERICAN SAMOA</option>
<option value="AND">ANDORRA</option>
<option value="AGO">ANGOLA</option>
<option value="AIA">ANGUILLA</option>
<option value="ATA">ANTARCTICA</option>
<option value="ATG">ANTIGUA AND BARBUDA</option>
<option value="ARG">ARGENTINA</option>
<option value="ARM">ARMENIA</option>
<option value="ABW">ARUBA</option>
<option value="AUS">AUSTRALIA</option>
<option value="AUT">AUSTRIA</option>
<option value="AZE">AZERBAIJAN</option>
<option value="BHS">BAHAMAS</option>
<option value="BHR">BAHRAIN</option>
<option value="BRB">BARBADOS</option>
<option value="BLR">BELARUS</option>
<option value="BEL">BELGIUM</option>
<option value="BLZ">BELIZE</option>
<option value="BEN">BENIN</option>
<option value="BMU">BERMUDA</option>
<option value="BTN">BHUTAN</option>
<option value="BOL">BOLIVIA</option>
<option value="BIH">BOSNIA AND HERZEGOWINA</option>
<option value="BWA">BOTSWANA</option>
<option value="BVT">BOUVET ISLAND</option>
<option value="IOT">BRITISH INDIAN OCEAN TERRITORY</option>
<option value="BRN">BRUNEI DARUSSALAM</option>
<option value="BGR">BULGARIA</option>
<option value="BFA">BURKINA FASO</option>
<option value="BDI">BURUNDI</option>
<option value="KHM">CAMBODIA</option>
<option value="CMR">CAMEROON</option>
<option value="CAN">CANADA</option>
<option value="CPV">CAPE VERDE</option>
<option value="CYM">CAYMAN ISLANDS</option>
<option value="CAF">CENTRAL AFRICAN REPUBLIC</option>
<option value="TCD">CHAD</option>
<option value="CHL">CHILE</option>
<option value="CHN">CHINA</option>
<option value="CXR">CHRISTMAS ISLAND</option>
<option value="CCK">COCOS (KEELING) ISLANDS</option>
<option value="COL">COLOMBIA</option>
<option value="COM">COMOROS</option>
<option value="COG">CONGO</option>
<option value="CO">CONGO, THE DEMOCRATIC REPUBLI</option>
<option value="COK">COOK ISLANDS</option>
<option value="CRI">COSTA RICA</option>
<option value="CIV">COTE D'IVOIRE</option>
<option value="HRV">CROATIA (LOCAL NAME: HRVATSKA)</option>
<option value="CYP">CYPRUS</option>
<option value="CZE">CZECH REPUBLIC</option>
<option value="DNK">DENMARK</option>
<option value="DJI">DJIBOUTI</option>
<option value="DMA">DOMINICA</option>
<option value="DOM">DOMINICAN REPUBLIC</option>
<option value="TMP">EAST TIMOR</option>
<option value="ECU">ECUADOR</option>
<option value="EGY">EGYPT</option>
<option value="SLV">EL SALVADOR</option>
<option value="GNQ">EQUATORIAL GUINEA</option>
<option value="ERI">ERITREA</option>
<option value="EST">ESTONIA</option>
<option value="ETH">ETHIOPIA</option>
<option value="FLK">FALKLAND ISLANDS (MALVINAS)</option>
<option value="FRO">FAROE ISLANDS</option>
<option value="FJI">FIJI</option>
<option value="FIN">FINLAND</option>
<option value="FRA">FRANCE</option>
<option value="GUF">FRENCH GUIANA</option>
<option value="PYF">FRENCH POLYNESIA</option>
<option value="ATF">FRENCH SOUTHERN TERRITORIES</option>
<option value="GAB">GABON</option>
<option value="GMB">GAMBIA</option>
<option value="GEO">GEORGIA</option>
<option value="DEU">GERMANY</option>
<option value="GHA">GHANA</option>
<option value="GIB">GIBRALTAR</option>
<option value="GRC">GREECE</option>
<option value="GRL">GREENLAND</option>
<option value="GRD">GRENADA</option>
<option value="GLP">GUADELOUPE</option>
<option value="GUM">GUAM</option>
<option value="GTM">GUATEMALA</option>
<option value="GIN">GUINEA</option>
<option value="GUY">GUYANA</option>
<option value="HTI">HAITI</option>
<option value="HMD">HEARD AND MC DONALD ISLANDS</option>
<option value="VAT">HOLY SEE (VATICAN CITY STATE)</option>
<option value="HND">HONDURAS</option>
<option value="HKG">HONG KONG</option>
<option value="HUN">HUNGARY</option>
<option value="ISL">ICELAND</option>
<option value="IND">INDIA</option>
<option value="IDN">INDONESIA</option>
<option value="IRL">IRELAND</option>
<option value="ISR">ISRAEL</option>
<option value="ITA">ITALY</option>
<option value="JAM">JAMAICA</option>
<option value="JPN">JAPAN</option>
<option value="JOR">JORDAN</option>
<option value="KAZ">KAZAKHSTAN</option>
<option value="KEN">KENYA</option>
<option value="KIR">KIRIBATI</option>
<option value="PR">KOREA, DEMOCRATIC PEOPLE'S RE</option>
<option value="KO">KOREA, REPUBLIC OF</option>
<option value="KWT">KUWAIT</option>
<option value="KGZ">KYRGYZSTAN</option>
<option value="LAO">LAO PEOPLE'S DEMOCRATIC REPUBL</option>
<option value="LVA">LATVIA</option>
<option value="LBN">LEBANON</option>
<option value="LSO">LESOTHO</option>
<option value="LIE">LIECHTENSTEIN</option>
<option value="LTU">LITHUANIA</option>
<option value="LUX">LUXEMBOURG</option>
<option value="MAC">MACAU</option>
<option value="MK">MACEDONIA, THE FORMER YUGOSLA</option>
<option value="MDG">MADAGASCAR</option>
<option value="MWI">MALAWI</option>
<option value="MDV">MALDIVES</option>
<option value="MLI">MALI</option>
<option value="MLT">MALTA</option>
<option value="MHL">MARSHALL ISLANDS</option>
<option value="MTQ">MARTINIQUE</option>
<option value="MRT">MAURITANIA</option>
<option value="MUS">MAURITIUS</option>
<option value="MYT">MAYOTTE</option>
<option value="MEX">MEXICO</option>
<option value="FS">MICRONESIA, FEDERATED STATES</option>
<option value="MD">MOLDOVA, REPUBLIC OF</option>
<option value="MCO">MONACO</option>
<option value="MNG">MONGOLIA</option>
<option value="MNE">MONTENEGRO</option>
<option value="MSR">MONTSERRAT</option>
<option value="MAR">MOROCCO</option>
<option value="MOZ">MOZAMBIQUE</option>
<option value="NAM">NAMIBIA</option>
<option value="NRU">NAURU</option>
<option value="NPL">NEPAL</option>
<option value="NLD">NETHERLANDS</option>
<option value="ANT">NETHERLANDS ANTILLES</option>
<option value="NCL">NEW CALEDONIA</option>
<option value="NZL">NEW ZEALAND</option>
<option value="NIC">NICARAGUA</option>
<option value="NER">NIGER</option>
<option value="NIU">NIUE</option>
<option value="NFK">NORFOLK ISLAND</option>
<option value="MNP">NORTHERN MARIANA ISLANDS</option>
<option value="NOR">NORWAY</option>
<option value="OMN">OMAN</option>
<option value="PAK">PAKISTAN</option>
<option value="PLW">PALAU</option>
<option value="PAN">PANAMA</option>
<option value="PNG">PAPUA NEW GUINEA</option>
<option value="PRY">PARAGUAY</option>
<option value="PER">PERU</option>
<option value="PHL">PHILIPPINES</option>
<option value="PCN">PITCAIRN</option>
<option value="POL">POLAND</option>
<option value="PRT">PORTUGAL</option>
<option value="QAT">QATAR</option>
<option value="REU">REUNION</option>
<option value="ROM">ROMANIA</option>
<option value="RUS">RUSSIAN FEDERATION</option>
<option value="RWA">RWANDA</option>
<option value="KNA">SAINT KITTS AND NEVIS</option>
<option value="LCA">SAINT LUCIA</option>
<option value="VCT">SAINT VINCENT AND THE GRENADIN</option>
<option value="WSM">SAMOA</option>
<option value="SMR">SAN MARINO</option>
<option value="STP">SAO TOME AND PRINCIPE</option>
<option value="SAU">SAUDI ARABIA</option>
<option value="SEN">SENEGAL</option>
<option value="SRB">SERBIA</option>
<option value="SYC">SEYCHELLES</option>
<option value="SLE">SIERRA LEONE</option>
<option value="SGP">SINGAPORE</option>
<option value="SVK">SLOVAKIA (SLOVAK REPUBLIC)</option>
<option value="SVN">SLOVENIA</option>
<option value="SLB">SOLOMON ISLANDS</option>
<option value="SOM">SOMALIA</option>
<option value="ZAF">SOUTH AFRICA</option>
<option value="SGS">SOUTH GEORGIA AND THE SOUTH SA</option>
<option value="ESP">SPAIN</option>
<option value="LKA">SRI LANKA</option>
<option value="SHN">ST. HELENA</option>
<option value="SPM">ST. PIERRE AND MIQUELON</option>
<option value="SUR">SURINAME</option>
<option value="SJM">SVALBARD AND JAN MAYEN ISLANDS</option>
<option value="SWZ">SWAZILAND</option>
<option value="SWE">SWEDEN</option>
<option value="CHE">SWITZERLAND</option> 
<option value="SYR">SYRIAN ARAB REPUBLIC</option>
<option value="TW">TAIWAN, REPUBLIC OF CHINA</option>
<option value="TJK">TAJIKISTAN</option>
<option value="TZ">TANZANIA, UNITED REPUBLIC OF</option>
<option value="THA">THAILAND</option>
<option value="TGO">TOGO</option>
<option value="TKL">TOKELAU</option>
<option value="TON">TONGA</option>
<option value="TTO">TRINIDAD AND TOBAGO</option>
<option value="TUN">TUNISIA</option>
<option value="TUR">TURKEY</option>
<option value="TKM">TURKMENISTAN</option>
<option value="TCA">TURKS AND CAICOS ISLANDS</option>
<option value="TUV">TUVALU</option>
<option value="UGA">UGANDA</option>
<option value="UKR">UKRAINE</option>
<option value="ARE">UNITED ARAB EMIRATES</option>
<option value="GBR">UNITED KINGDOM</option>
<option value="UMI">UNITED STATES MINOR OUTLYING I</option>
<option value="URY">URUGUAY</option>
<option value="UZB">UZBEKISTAN</option>
<option value="VUT">VANUATU</option>
<option value="VEN">VENEZUELA</option>
<option value="VNM">VIET NAM</option>
<option value="VGB">VIRGIN ISLANDS (BRITISH)</option>
<option value="VIR">VIRGIN ISLANDS (U.S.)</option>
<option value="WLF">WALLIS AND FUTUNA ISLANDS</option>
<option value="ESH">WESTERN SAHARA</option>
<option value="YEM">YEMEN</option>
<option value="ZMB">ZAMBIA</option>
<option value="ZWE">ZIMBABWE</option>
</select> 
        </div>
        
    <div id="Tax_section" <?php if( $user['country']=="USA"){ ?>  <?php } else{ ?> style="display:none;" <?php } ?>>
        <h1 class="heading">Tax Information</h1>
        <p>Internal Revenue Service (IRS) regulations require that US payment processors, including             Alibris, file Form 1099-K with the IRS for US-based sellers that exceed US $600 in gross 
        sales in a calendar year. The regulations also require that US-based sellers (regardless
        of account status or sales volume) have taxpayer identification information on file 
        Alibris. This information is encrypted and stored securely. See our Policies & Procedures
        page for more details.</p>
        <div class="form_group" id="tax_id">
            <label class="seller_information">
                Tax ID:
            </label>
            <input class="form-control" type="text" name="tax_id" value="<?php echo $user['tax_id'];?>" />  
        </div>
        <div class="form-group" id="tax_id_type">
               <label class="seller_information">
                Tax Type:
               </label>
              <select class="form-control" name="tax_id_type" id="idtype" onfocus="this.oldvalue = this.value;" onblur="doGATracking('20', this.name, this.oldvalue, this.value)" >
              <option value="<?php echo $user['tax_type'];?>"><?php echo $user['tax_type'];?></option>
              <option value="Social_Security_Number">Social Security Number</option>
              <option value="Individual_Taxpayer_ID_(ITIN)">Individual Taxpayer ID (ITIN)</option>
              <option value="Employer_ID_(EIN)">Employer ID (EIN)</option>
               </select>       
        </div>
</div>

      </div>
        
    </div><input type="submit" class="btn btn-info btn-class"></div>
</div>
</form>
<script>
    function changeLabels()   
    {
      var country = $("#country").val();
      if(country!="USA")
      {
        $("#tax_id_type").hide();
        $("#tax_id").hide();
        $("#Tax_section").hide();
      }
      else
      {
        $("#tax_id_type").show();
        $("#tax_id").show();
        $("#Tax_section").show();
      }
    }
</script>