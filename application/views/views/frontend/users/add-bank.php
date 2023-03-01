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
                                <form method="post" action="<?php echo base_url('payment_method').'/'.encode_url($user_id) ?>">
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
                        </div>

                        <button class="accordion" title="Bank">Bank</button>
                        <div class="panel">
                            <div class="inner-content">
                                <form method="post" action="<?php echo base_url('payment_method').'/'.encode_url($user_id) ?>">
                                    <div class="col-lg-12 co-md-12 col-sm-12 margin-top-20">
                                        <div class="form-group">
                                            <label for="account-no">Account Number *</label>
                                            <input id="account-no" class="form-control" name="account_no" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="account-title">Account Title *</label>
                                            <input id="account-title" class="form-control" name="account_title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="swift-code">Swift Code *</label>
                                            <input id="swift-code" class="form-control" name="swift_code" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank-name">Bank Name *</label>
                                            <input id="bank-name" class="form-control" name="bank_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="branch-name">Bank Branch Name *</label>
                                            <input id="branch-name" class="form-control" name="bank_branch" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="billing-address">Billing Address</label>
                                            <input id="billing-address" class="form-control" name="billing_address" type="text">
                                        </div>
                                        <div class="form-group text-right">
                                            <input name="pm" value="bank" type="hidden">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="bottom-note-txt"><i><strong>Note:</strong>&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, delectus dolor earum illum ipsum sunt veritatis! Architecto culpa cumque cupiditate delectus ea, eos fugit molestias, nam officia quas quidem reiciendis!</i></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>