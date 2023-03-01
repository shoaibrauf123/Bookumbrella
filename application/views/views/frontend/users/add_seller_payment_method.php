<?php
    $user_id = decode_uri($this->uri->segment(2));
?>

<div class="add-payment-method-cont col-xs-12">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 co-md-12 col-sm-12">

                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger"> <?php print_r($errors); ?></div><?php } ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success"> <?php print_r($success); ?></div><?php } ?>

                <div>

                    <h3>Payment Method</h3>
                    
               <p>Receive payments by selecting any of given <strong>Payment Methods</strong>, just fill its required information and hit <i>submit</i>, and you are good to go !</p>    

                    <div class="accordian-cont margin-tb-40">
                    
                    
                    
                    
                        <button class="accordion" title="Paypal">Paypal</button>
                        <div class="panel">
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('seller_payment_method').'/'.getCurrentUserId() ?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="paypal-email">Paypal Email *</label>
                                            <input id="paypal-email" class="form-control" name="email" type="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="billing-address">Billing Address</label>
                                            <input id="billing-address" class="form-control" name="billing_address" type="text">
                                        </div>
                                        <div class="form-group text-right">
                                            <input name="pm" value="paypal" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            
                                                   <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Paypal Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="padding-right-20">
                                                    
                                                    <tr>
                                                        <th style="width:5%">Serial#</th>
                                                        <th class="col-xs-1 col-sm-1 col-md-5">Email</th>
                                                         <th class="col-xs-1 col-sm-1 col-md-5">Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($paypal_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($paypal_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td style="width:5%"><?php echo $i; ?></td>

<td class="col-xs-1 col-sm-1 col-md-5"><?php echo $row['email']; ?></td>
                                                                               
                                                                                <td class="col-xs-1 col-sm-1 col-md-5">
                                                                                    <a class="del_btn" href="javascript:;" onClick="confirmDelte('pm_paypal','<?php echo $row['id']; ?>')">Delete</a>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                        </div>

<?php
           
            ?>  
                        <button class="accordion" title="Bank">Bank</button>
                        <div class="panel">
                            <div class="inner-content">
                                
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="region">Region *</label>
                                            <select id="region" class="form-control" name="region" onchange="setFields()" >
                                                <option value="" selected>Select</option>
                                                <option value="India" >India</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Canada">Canada</option>

                                                <option value="Germany">Germany</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="CzechRepublic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="Greece">Greece</option>

                                                <option value="Hungry">Hungry</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Spain">Spain</option>




                                                <option value="HongKong">Hong Kong</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="UnitedKingdom">United Kingdom</option>
                                                <option value="UnitedStates">United States</option>
                                            </select>
                                        </div>
                                       <div id="India" style="display:none;" class="all">
                                        <form method="post" id="IndiaForm" action="">
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        <div class="form-group">
                                            <label for="swift-code">Indian Financial System Code(IFSC) *</label>
                                            <input id="ifsc" class="form-control" name="ifsc" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="account_type">Account Type *</label>
                                            <select name="account_type" class="form-control">
                                            <option value="Current">Current</option>
                                            <option value="Saving">Saving</option>
                                            </select>
                                        </div>
                                       </form>
                                        </div>
                                <div id="Pakistan" style="display:none;" class="all">
                                         <form method="post" id="PakistanForm" action="">
                                        <div class="form-group">
                                            <label for="account_no">Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="account-title">Account Title *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        <div class="form-group">
                                            <label for="swift-code">Swift Code *</label>
                                            <input id="swift-code" class="form-control" name="swift_code" >
                                        </div>
                                        <div class="form-group">
                                            <label for="bank-name">Bank Name *</label>
                                            <input id="bank-name" class="form-control" name="bank_name" >
                                        </div>
                                        <div class="form-group" id="bank_branch">
                                            <label for="branch-name">Bank Branch Name *</label>
                                            <input id="branch-name" class="form-control" name="bank_branch">
                                        </div>
                                        <div class="form-group" id="billing_address">
                                            <label for="billing-address">Billing Address</label>
                                            <input id="billing-address" class="form-control" name="billing_address" type="text">
                                        </div>
                                        </form>
                                        </div>
                                        <div id="Australia" style="display:none;" class="all">
                                        <form method="post" id="AustraliaForm" action="">
                                        <div class="form-group">
                                            <label for="bank_branch">Bank State Branch Code *</label>
                                            <input id="bank_branch" class="form-control" name="bank_branch" >
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        
                                        <div id="Canada" style="display:none;" class="all">
                                        <form method="post" id="CanadaForm" action="">
                                       <div class="form-group">
                                            <label for="account_type">Account Type *</label>
                                            <select name="account_type" class="form-control">
                                            <option value="Current">Current</option>
                                            <option value="Saving">Saving</option>
                                            </select>
                                        </div>
                                       
                                       
                                        <div class="form-group">
                                            <label for="institution_number">Institution Number *</label>
                                            <input id="institution_number" class="form-control" name="institution_number" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="transit_number">Transit Number *</label>
                                            <input id="transit_number" class="form-control" name="transit_number" >
                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        
                                        <div id="Germany" style="display:none;" class="all">
                                        <form method="post" id="GermanyForm" action="">
                                        <div class="form-group">
                                            <label for="bic">BIC *</label>
                                            <input id="bic" class="form-control" name="bic" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="iban">IBAN *</label>
                                            <input id="iban" class="form-control" name="iban" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re-iban">Re-type IBAN *</label>
                                            <input id="re-iban" class="form-control" name="re_iban" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        <div id="Austria" style="display:none;" class="all">
                                            <form method="post" id="AustriaForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>

                                        <div id="Belgium" style="display:none;" class="all">
                                            <form method="post" id="BelgiumForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Bulgaria" style="display:none;" class="all">
                                            <form method="post" id="BulgariaForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Croatia" style="display:none;" class="all">
                                            <form method="post" id="CroatiaForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Cyprus" style="display:none;" class="all">
                                            <form method="post" id="CyprusForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="CzechRepublic" style="display:none;" class="all">
                                            <form method="post" id="CzechRepublicForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Denmark" style="display:none;" class="all">
                                            <form method="post" id="DenmarkForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Estonia" style="display:none;" class="all">
                                            <form method="post" id="EstoniaForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Finland" style="display:none;" class="all">
                                            <form method="post" id="FinlandForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="France" style="display:none;" class="all">
                                            <form method="post" id="FranceForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>

                                        <div id="Greece" style="display:none;" class="all">
                                            <form method="post" id="GreeceForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Hungry" style="display:none;" class="all">
                                            <form method="post" id="HungryForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Ireland" style="display:none;" class="all">
                                            <form method="post" id="IrelandForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Italy" style="display:none;" class="all">
                                            <form method="post" id="ItalyForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Poland" style="display:none;" class="all">
                                            <form method="post" id="PolandForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Romania" style="display:none;" class="all">
                                            <form method="post" id="RomaniaForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Portugal" style="display:none;" class="all">
                                            <form method="post" id="PortugalForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>
                                        <div id="Spain" style="display:none;" class="all">
                                            <form method="post" id="SpainForm" action="">
                                                <div class="form-group">
                                                    <label for="bic">BIC *</label>
                                                    <input id="bic" class="form-control" name="bic" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="iban">IBAN *</label>
                                                    <input id="iban" class="form-control" name="iban" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="re-iban">Re-type IBAN *</label>
                                                    <input id="re-iban" class="form-control" name="re_iban" >
                                                </div>


                                                <div class="form-group">
                                                    <label for="account-title">Account Holder Name *</label>
                                                    <input id="account-title" class="form-control" name="account_title" >
                                                </div>
                                            </form>
                                        </div>



                                        <div id="HongKong" style="display:none;" class="all">
                                        
                                       <form method="post" id="HongKongForm" action="">
                                       
                                       
                                        <div class="form-group">
                                            <label for="clearing_code">Clearing Code *</label>
                                            <input id="clearing_code" class="form-control" name="clearing_code" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="branch_code">Branch Code *</label>
                                            <input id="bank_branch" class="form-control" name="bank_branch" >
                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        <div id="Singapore" style="display:none;" class="all">
                                        
                                       <form method="post" id="SingaporeForm" action="">
                                       
                                       
                                        <div class="form-group">
                                            <label for="bank_code">Bank Code *</label>
                                            <input id="clearing_code" class="form-control" name="clearing_code" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="branch_code">Branch Code *</label>
                                            <input id="bank_branch" class="form-control" name="bank_branch" >
                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        <div id="UnitedKingdom" style="display:none;" class="all">
                                        
                                        <form method="post" id="UnitedKingdomForm" action="">
                                       
                                       
                                        <div class="form-group">
                                            <label for="bank_sort_code">Bank Sort Code *</label>
                                            <input id="bank_sort_code1" style="width:50px;" name="bank_sort_code1" > -
                                            <input id="bank_sort_code2" style="width:50px;" name="bank_sort_code2" > -
                                            <input id="bank_sort_code3" style="width:50px;" name="bank_sort_code3" >
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        
                                        <div id="UnitedStates" style="display:none;" class="all">
                                        
                                        <form method="post" id="UnitedStatesForm" action="">
                                       
                                       
                                        <div class="form-group">
                                            <label for="9-digit_routing_number">9 Digit Routing Number*</label>
                                            <input id="9_digit_routing_number" class="form-control" name="9_digit_routing_number" >
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label for="account_no">Bank Account Number *</label>
                                            <input id="account_no" class="form-control" name="account_no" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_account_no">Re-type Bank Account Number *</label>
                                            <input id="re_account_no" class="form-control" name="re_account_no" >
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="account-title">Account Holder Name *</label>
                                            <input id="account-title" class="form-control" name="account_title" >
                                        </div>
                                        </form>
                                        </div>
                                        
                                        <div class="form-group text-right">
                                            <input name="pm" value="bank" type="hidden">
                                            <input class="btn btn-primary" onClick="SaveBank()" type="button" value="Submit">
                                        </div>
                                        </form>
                                    </div>
                                
                            </div>
                            
                            
                            
                            
                            
                            
                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-lg-12 co-md-12 col-sm-12">
                                    <div class="order_table">
                                        <h2>Previous Bank Accounts<?php //echo getlanguage('cash_outs'); ?></h2>
                                        <div class="order_content">
                                            <div class="col-lg-12 co-md-12 col-sm-12">
                                                <table class="table history-table scrollable-table-head margin0">
                                                    <thead class="">
                                                    
                                                    <tr>
                                                        <th>Country</th>
                                                        <th>Title</th>
                                                       
                                                        <th>Account#</th>
                                                         <th>Type</th>
                                                        <th>Swift Code</th>
                                                        <th>Bank Name</th>
                                                        <th>Bank Branch</th>
                                                        <th>IFSC</th>
                                                        <th>Institution#</th>
                                                        <th>Transit#</th>
                                                        <th>IBAN</th>
                                                        <th>BIC</th>
                                                        <th>Clearing Code</th>
                                                       
                                                         <th>Action</th>
                                                    </tr>
                                                    
                                                    
                                                    </thead>
                                                </table>
                                                <?php if($bank_accounts) { 
												$i=0;
												?>
                                                    <div class="scrollable-table-body-cont margin-bottom-20">
                                                        <table class="table history-table scrollable-table-body">
                                                            <tbody>
                                                                <?php foreach ($bank_accounts as $row) {
																	$i++;
																	
																	 ?>
                                                                 <tr>
<td><?php echo $row['country']; ?></td>

<td><?php echo $row['account_title']; ?></td>
<td><?php echo $row['account_no']; ?></td>
<td><?php echo $row['account_type']; ?></td>
<td><?php echo $row['swift_code']; ?></td>
<td><?php echo $row['bank_name']; ?></td>
<td><?php echo $row['bank_branch']; ?></td>
<td><?php echo $row['ifsc']; ?></td>
<td><?php echo $row['institution_number']; ?></td>
<td><?php echo $row['transit_number']; ?></td>
<td><?php echo $row['iban']; ?></td>
<td><?php echo $row['bic']; ?></td>
<td><?php echo $row['clearing_code']; ?></td>

                                                                               
                                                                                <td>
                                                                                    <a class="del_btn" href="javascript:;" onClick="confirmDelte('pm_bank','<?php echo $row['id']; ?>')">Delete</a>
                                                                                </td>
                                                                                
                                                                            </tr>  
                                                                   
                                                                <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php echo adminRecordNotFoundMsg(); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
            
			<?php
			
			?>              
                        
                        
                    </div>
                    <div>
                        <p class="bottom-note-txt"><i><strong>Note:</strong>&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, delectus dolor earum illum ipsum sunt veritatis! Architecto culpa cumque cupiditate delectus ea, eos fugit molestias, nam officia quas quidem reiciendis!</i></p>
                    </div>
                    
                    
                    


                </div>
            </div>
        </div>
    </div>
</div>
<script>
function SaveBank(){
	
	//alert($('#re_account_no').val());
	
	var form_name = $("#country").val();
	//alert(form_name);return false;
	if($("#re_account_no").val() != $("#account_no").val()){
	//	alert("Account Number and Re-type must match.");return false;
		}
	if(form_name == ''){
		alert("Please select some country.");
		return false;
		}
			
	

	var formdata = jQuery("#"+form_name+"Form").serialize()+ "&country=" + form_name+ "&pm=bank";
	 jQuery.ajax({
            type: "POST",
            url: '<?php echo base_url('payment_method'); ?>',
            data: formdata,
			
            
            success: function (response) {

		if (response=='success') {
                    alert('Payment method saved successfully.');
					location.reload();
          }else{
                    $('.alert-success').html(response);
                }
            }
        });//End ajax
		
		
	
	
	}
function confirmDelte(account_type,id){
	

	var r = confirm("Are you sure you want to delete?");
	if (r == true) {
		
		location.href="<?php echo base_url("seller_payment_method");?>/delete/"+account_type+"/"+id;
		
	} else {
		
	}
}
function setFields(){
    var region = $('#region').val();
	
	$('#country').val(region);
	
	$('.all').hide();
	$('#'+region).show();
    
}

</script>
<style>
th
{
	width:7%
}
td
{
	width:7%
}
.del_btn{
    color:white;
    background: #323232;
    text-decoration: none !important;
    border-radius: 2px;
    padding: 5px 10px;
    transition:.5s;
}
.del_btn:hover {
    color: white;
    background:#bb9870;
}
</style>


<input type="hidden" id="country" value="" >	