<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
        <div id="messages">
        <?php
      $message = '';
      $status= '';
      $action = 'hide-elm';
      if (isset($_SESSION['message-fail-uid'])) 
      {
        $status = 'danger';
        $message =  MyFunction::get_message('message-fail-uid');
        $action = 'show-elm';
      }

      if(isset($_SESSION['message-success-uid']))
      {
        $status = 'success';
        $message =  MyFunction::get_message('message-success-uid');
        $action = 'show-elm';
      }




      ?>
        <div class="alert alert-<?= $status ?> alert-dismissible <?= $action ?>" role="alert" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button
        ><strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong><?= $message; ?></div>
      </div>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Company Information</h3>
            </div>
            <form role="form" action="?controller=company&action=update&type=admin" method="post" onsubmit = "return validate();">
              <div class="box-body">

              <input type="hidden" class="form-control" id="id_company" name="id_company" placeholder="Enter company name" value="<?= $data[0]->id?>" autocomplete="off">

                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?= $data[0]->company_name?>" autocomplete="off">
                  <p id="err_company_name" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                <div class="form-group">
                  <label for="service_charge_value">Charge Amount (%)</label>
                  <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Enter charge amount %" value="<?= $data[0]->service_charge_value?>" autocomplete="off">
                  <p id="err_service_charge_value" class="hide-elm text-danger">The Store name field is required.</p>
                </div>
                <div class="form-group">
                  <label for="vat_charge_value">Vat Charge (%)</label>
                  <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Enter vat charge %" value="<?= $data[0]->vat_charge_value?>" autocomplete="off">
                  <p id="err_vat_charge_value" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?= $data[0]->address?>" autocomplete="off">
                  <p id="err_address" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="<?= $data[0]->phone?>" autocomplete="off">
                  <p id="err_phone" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="<?= $data[0]->country?>" autocomplete="off">
                  <p id="err_country" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                <div class="form-group">
                  <label for="permission">Message</label>
                  <textarea class="form-control" id="message"  name="message"><?= $data[0]->message?></textarea>
                </div>
                <div class="form-group">
                  <label for="currency">Currency</label>
                                    <select class="form-control" id="currency" value="<?= $data[0]->currency?>" name="currency">
                    <option value="">~~SELECT~~</option>

                                          <option value="AED" >AED</option>
                                          <option value="AFN" >AFN</option>
                                          <option value="ALL" >ALL</option>
                                          <option value="ANG" >ANG</option>
                                          <option value="AOA" >AOA</option>
                                          <option value="ARS" >ARS</option>
                                          <option value="AUD" >AUD</option>
                                          <option value="AWG" >AWG</option>
                                          <option value="AZN" >AZN</option>
                                          <option value="BAM" >BAM</option>
                                          <option value="BBD" >BBD</option>
                                          <option value="BDT" >BDT</option>
                                          <option value="BGN" >BGN</option>
                                          <option value="BHD" >BHD</option>
                                          <option value="BIF" >BIF</option>
                                          <option value="BMD" >BMD</option>
                                          <option value="BND" >BND</option>
                                          <option value="BOB" >BOB</option>
                                          <option value="BRL" >BRL</option>
                                          <option value="BSD" >BSD</option>
                                          <option value="BTN" >BTN</option>
                                          <option value="BWP" >BWP</option>
                                          <option value="BYR" >BYR</option>
                                          <option value="BZD" >BZD</option>
                                          <option value="CAD" >CAD</option>
                                          <option value="CDF" >CDF</option>
                                          <option value="CHF" >CHF</option>
                                          <option value="CLP" >CLP</option>
                                          <option value="CNY" >CNY</option>
                                          <option value="COP" >COP</option>
                                          <option value="CRC" >CRC</option>
                                          <option value="CUP" >CUP</option>
                                          <option value="CVE" >CVE</option>
                                          <option value="CZK" >CZK</option>
                                          <option value="DJF" >DJF</option>
                                          <option value="DKK" >DKK</option>
                                          <option value="DOP" >DOP</option>
                                          <option value="DZD" >DZD</option>
                                          <option value="EGP" >EGP</option>
                                          <option value="ETB" >ETB</option>
                                          <option value="EUR" >EUR</option>
                                          <option value="FJD" >FJD</option>
                                          <option value="FKP" >FKP</option>
                                          <option value="GBP" >GBP</option>
                                          <option value="GEL" >GEL</option>
                                          <option value="GHS" >GHS</option>
                                          <option value="GIP" >GIP</option>
                                          <option value="GMD" >GMD</option>
                                          <option value="GNF" >GNF</option>
                                          <option value="GTQ" >GTQ</option>
                                          <option value="GYD" >GYD</option>
                                          <option value="HKD" >HKD</option>
                                          <option value="HNL" >HNL</option>
                                          <option value="HRK" >HRK</option>
                                          <option value="HTG" >HTG</option>
                                          <option value="HUF" >HUF</option>
                                          <option value="IDR" >IDR</option>
                                          <option value="ILS" >ILS</option>
                                          <option value="INR" >INR</option>
                                          <option value="IQD" >IQD</option>
                                          <option value="IRR" >IRR</option>
                                          <option value="ISK" >ISK</option>
                                          <option value="JEP" >JEP</option>
                                          <option value="JMD" >JMD</option>
                                          <option value="JOD" >JOD</option>
                                          <option value="JPY" >JPY</option>
                                          <option value="KES" >KES</option>
                                          <option value="KGS" >KGS</option>
                                          <option value="KHR" >KHR</option>
                                          <option value="KMF" >KMF</option>
                                          <option value="KPW" >KPW</option>
                                          <option value="KRW" >KRW</option>
                                          <option value="KWD" >KWD</option>
                                          <option value="KYD" >KYD</option>
                                          <option value="KZT" >KZT</option>
                                          <option value="LAK" >LAK</option>
                                          <option value="LBP" >LBP</option>
                                          <option value="LKR" >LKR</option>
                                          <option value="LRD" >LRD</option>
                                          <option value="LSL" >LSL</option>
                                          <option value="LTL" >LTL</option>
                                          <option value="LVL" >LVL</option>
                                          <option value="LYD" >LYD</option>
                                          <option value="MAD" >MAD</option>
                                          <option value="MDL" >MDL</option>
                                          <option value="MGA" >MGA</option>
                                          <option value="MKD" >MKD</option>
                                          <option value="MMK" >MMK</option>
                                          <option value="MNT" >MNT</option>
                                          <option value="MOP" >MOP</option>
                                          <option value="MRO" >MRO</option>
                                          <option value="MUR" >MUR</option>
                                          <option value="MVR" >MVR</option>
                                          <option value="MWK" >MWK</option>
                                          <option value="MXN" >MXN</option>
                                          <option value="MYR" >MYR</option>
                                          <option value="MZN" >MZN</option>
                                          <option value="NAD" >NAD</option>
                                          <option value="NGN" >NGN</option>
                                          <option value="NIO" >NIO</option>
                                          <option value="NOK" >NOK</option>
                                          <option value="NPR" >NPR</option>
                                          <option value="NZD" >NZD</option>
                                          <option value="OMR" >OMR</option>
                                          <option value="PAB" >PAB</option>
                                          <option value="PEN" >PEN</option>
                                          <option value="PGK" >PGK</option>
                                          <option value="PHP" >PHP</option>
                                          <option value="PKR" >PKR</option>
                                          <option value="PLN" >PLN</option>
                                          <option value="PYG" >PYG</option>
                                          <option value="QAR" >QAR</option>
                                          <option value="RON" >RON</option>
                                          <option value="RSD" >RSD</option>
                                          <option value="RUB" >RUB</option>
                                          <option value="RWF" >RWF</option>
                                          <option value="SAR" >SAR</option>
                                          <option value="SBD" >SBD</option>
                                          <option value="SCR" >SCR</option>
                                          <option value="SDG" >SDG</option>
                                          <option value="SEK" >SEK</option>
                                          <option value="SGD" >SGD</option>
                                          <option value="SHP" >SHP</option>
                                          <option value="SLL" >SLL</option>
                                          <option value="SOS" >SOS</option>
                                          <option value="SRD" >SRD</option>
                                          <option value="STD" >STD</option>
                                          <option value="SVC" >SVC</option>
                                          <option value="SYP" >SYP</option>
                                          <option value="SZL" >SZL</option>
                                          <option value="THB" >THB</option>
                                          <option value="TJS" >TJS</option>
                                          <option value="TMT" >TMT</option>
                                          <option value="TND" >TND</option>
                                          <option value="TOP" >TOP</option>
                                          <option value="TRY" >TRY</option>
                                          <option value="TTD" >TTD</option>
                                          <option value="TWD" >TWD</option>
                                          <option value="UAH" >UAH</option>
                                          <option value="UGX" >UGX</option>
                                          <option value="USD" selected>USD</option>
                                          <option value="UYU" >UYU</option>
                                          <option value="UZS" >UZS</option>
                                          <option value="VEF" >VEF</option>
                                          <option value="VND" >VND</option>
                                          <option value="VUV" >VUV</option>
                                          <option value="WST" >WST</option>
                                          <option value="XAF" >XAF</option>
                                          <option value="XCD" >XCD</option>
                                          <option value="XPF" >XPF</option>
                                          <option value="YER" >YER</option>
                                          <option value="ZAR" >ZAR</option>
                                          <option value="ZMK" >ZMK</option>
                                          <option value="ZWL" >ZWL</option>
                                      </select>
                                      <p id="err_currency" class="hide-elm text-danger">The Store name field is required.</p>

                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary <?= $access['update'] ?>">Save Changes</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <script src="assets/admin/dist/js/company.js"></script>