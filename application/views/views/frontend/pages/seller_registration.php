<style>
  .list-group-item .seller a {
    padding: 10px 20px;
    color: #fff !important;
    background: #bb9870;
    text-decoration: none;
    transition: all 0.3s;
    border-radius: 3px !important;
  }
.form-control
{
	background: #f3f3f3;
    border: solid 1px #ccc;
    box-shadow: none;
	height:35px;
}
.heading{
  background-color:black;
  color:white;
}
.reg_hdg
{
	font-weight:bold;
	font-size:25px;
}

.form-control:focus
{
	border-color: #e77600;
    box-shadow: 0 0 3px 2px rgba(228,121,17,.5);
    border:1px solid #323232 !important;
    border-radius: 3px !important ;
    transition:all 0.3s !important;
}
.btn:hover, .btn:focus, .btn-success:hover, .btn-success:focus, .btn-warning:hover, .btn-cart:hover
{
	background:#323232 !important;
	color:#fff !important;
}
.seller
{
  margin-top:10px;
  float:right;
}
input[type=checkbox], input[type=radio] {
    margin: 4px 0 0;
    accent-color: #bb9870 !important;
    margin-top: 1px\9;
    line-height: normal;
}
</style>
<div class="col-md-12 col-lg-12 col-sm-12-col-xs-12 " style="margin-top:30px; margin-bottom:30px;">
  <div class="login_form"  style="box-shadow: 3px 3px 5px #ccc">
    <form action="<?php echo base_url('registration'); ?>" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate>
      <div class="">
        <div class="">
          <div class="list-group-item">
            <h4 class="reg_hdg"> Bookumbrella Seller Registration</h4>
            <div class="clear20"></div>
            <?php if(isset($errors)){?>
            <div class="alert alert-danger" style="font-size:16px; margin-top:10px;"> <?php print_r($errors); ?></div>
            <?php }?>
            <?php if(isset($success)){?>
            <div class="alert alert-success" style="font-size:16px; margin-top:10px;"> <?php print_r($success); ?></div>
            <?php }?>
           
            <div class="form-group">
              <label>First Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo set_value('first_name');?>" required>
            </div>

            <div class="form-group">
              <label>Last Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo set_value('last_name');?>" required>
            </div>

<div class="form-group">
              <label>Payee Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Payee Name" name="payee_name" value="<?php echo set_value('payee_name');?>" required>
            </div>


            <div class="form-group">
              <label>Username <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="User Name" name="user_name" value="<?php echo set_value('user_name');?>" required>
            </div>
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email');?>" required>
            </div>
             <div class="form-group">
              <label>Store Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Store Name" name="store_name" value="<?php echo set_value('store_name');?>" required>
            </div>
             <div class="form-group">
              <label>Store Address <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Store Addreess" name="store_address" value="<?php echo set_value('store_address');?>" required>
            </div>
            <div class="form-group">
              <label> Address 2<span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Address 2" name="address2" value="<?php echo set_value('address2');?>" required>
            </div>

<div class="form-group">
              <label>phone <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Phone" name="phone" value="<?php echo set_value('phone');?>" required>
            </div>
            
          
            <div class="form-group">
              <label>City <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="City Name" name="city" value="<?php echo set_value('city');?>" required>
            </div>
            <input type="hidden" name="user_type" value="seller">          
            <div class="form-group">
              <label>Select Country</label>
              <?php
              $countries = $this->comman_model->get('countries');
			  ?>
              <div class="form-group">
<label title=""><?php echo getlanguage('country');?> <span class="text-danger">*</span></label>
<select id="country" name="country" class="form-control" onfocus="this.oldvalue = this.value;"  onchange="changeLabels()">
<option value="select">Select</option>
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
              
            </div>
            
            <div class="form-group">
              <label>State/Province <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="State Name" name="state_name" value="<?php echo set_value('state_name');?>" required>
            </div>
            
            <div class="form-group">
              <label>Zip/postal code<span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Zip/Postal Code" name="zip_code" value="<?php echo set_value('zip_code');?>" required>
            </div>
            <div id="Tax_section">
            <h1 class="heading">Tax Information</h1>
            <p>Internal Revenue Service (IRS) regulations require that US payment processors, including 
              Alibris, file Form 1099-K with the IRS for US-based sellers that exceed US $600 in gross 
              sales in a calendar year. The regulations also require that US-based sellers (regardless
              of account status or sales volume) have taxpayer identification information on file 
              Alibris. This information is encrypted and stored securely. See our Policies & Procedures
              page for more details.</p>
            <div class="form-group" id="tax_id_type" >
              <label>Tax ID Type<span class="text-danger">*</span></label>
              <select class="form-control" name="tax_id_type" id="idtype" onfocus="this.oldvalue = this.value;" onblur="doGATracking('20', this.name, this.oldvalue, this.value)" >
              <option value="">(select)</option>
              <option value="S">Social Security Number</option>
              <option value="I">Individual Taxpayer ID (ITIN)</option>
              <option value="E">Employer ID (EIN)</option>
               </select>            
            </div>
            <div class="form-group" id="tax_id" >
              <label>Tax ID<span class="text-danger">*</span></label>
              <input type="number" class="form-control" placeholder="Enter Zip/Postal Code" name="tax_id" value="<?php echo set_value('tax_id');?>">
            </div>
            </div>
            <div class="form-group">
              <label>Password <span class="text-danger">*</span></label>
              <input type="password" class="form-control" placeholder="Choose a Password" data-parsley-required="true" name="password"  required="required">
              <span style="font-size:8; color:#999;">Min:6 Max:32</span>
            </div>

            <div class="form-group">
              <label>Confirm Password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" placeholder="Confirm Password" data-parsley-required="true" name="confirm_password" required>
            </div>

            <div class="seller_address">
              <div class="form-group">
                <label>Address<span class="text-danger">*</span></label>
                <textarea style="overflow:auto;resize:none;" rows='2' class="form-control" placeholder="Address" name="seller_address"></textarea>
              </div>
            </div>
            
            <div class="form-group">

           
            <label id="div_seller">

                <input type="checkbox"  data-parsley-required="true" name="terms_and_conditions" >
                <a href="<?php echo base_url("pages/seller-terms");?>" target="_blank">Terms and Conditions (Yearly Fee: $99.99)</a>
                <span class="text-danger">*</span>
            </label>

            <label id="div_buyer">

                <input type="checkbox"  data-parsley-required="true" name="terms_and_conditions" >
                <a href="<?php echo base_url("pages/buyer-terms");?>" target="_blank">Terms and Conditions</a>
                <span class="text-danger">*</span>
            </label>


            

            
            
            </div>
            
            
            
          </div>
        </div>
        <footer class="panel-footer text-right">
          <button type="submit" class="btn btn-success">Register</button>
        </footer>
      </div>
    </form>
  </div>
</div>
<script>
  ControlTerms();
    function ControlTerms(){
        var user_type = $("#user_type").val();
        if(user_type == 'Seller'){
            $("#div_buyer").hide();
            $(".seller_address").show();
            $("#div_seller").show();
        }else{
            $("#div_seller").hide();
            $(".seller_address").hide();
            $("#div_buyer").show();

        }
    }
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