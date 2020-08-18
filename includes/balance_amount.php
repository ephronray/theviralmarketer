 <div class="row" >
     <div class="col-md-4 col-12"></div>
     <div class="col-md-4 col-12"></div>
     <div class="col-md-4 col-12">
         <div class="box box-body pull-up bg-success bg-deathstar-white" style="height: max-content">
             <div class="flexbox">
                 <span class="fa fa-money font-size-40"></span>
                 <span class="font-weight-200 font-size-26">

                        <?php
                        $balance = $newsifyObj->checkbalance($wallet_xpub);
                        echo (isset($balance) && is_array($balance)) ? number_format((float)$balance[0], 5, '.', '')."  BTC (~ $".number_format((float)$balance[1], 2, '.', '') .")" : "0.0000 BTC (~ $0)";


                        ?>
                </span>
             </div>
             <div class="text-right">Balance</div>
         </div>
     </div>

    </div>

 <hr>