<?php
$menu = array('tab' => 8, 'option' => null);
include_once 'includes/header.php';
require_once(__DIR__ . '/_libs/dbConnect.php');
require_once(__DIR__ . '/_libs/bitcoinSetting.php');
$db = new dbConnect();
$bitcoinSetting = new bitcoinSetting();
?>
<div class="sidebar-overlay" id="sidebar-overlay"></div>
<article class="content grid-page">
    <div class="title-block">
        <h3 class="title">Success Message </h3>
    </div>

    <?php
    if (isset($_GET['token'])) {
        $latestRecord = $db->getSinglePayPalTransaction($_GET['token']);
        $uid = $uid = $_SESSION['user']["u_id"];
        if ($latestRecord['user_id'] == $uid) {
            $walletAddress = updateWallet($bitcoinSetting, $db, $_SESSION['user']['wallet_number'], $_SESSION['user']['wallet_xpub'], true);
            $amount = $latestRecord['amount'];
            $amountWithTex = $latestRecord['amount_with_tax'];
            $mainWalletBalnce = $bitcoinSetting->getSingleMainAccount();

            $userAmountInSatoshi = $payment->getSatoshiFromUSD($amount); //amount in satoshi
            $makePayment = $bitcoinSetting->sendFromOneWalletToOnether($walletAddress, $userAmountInSatoshi, $mainWalletBalnce['index']);

            if ($makePayment['success'] == true) {

                $miner_fee = $db->getFee($amount) / 2;
                $tvm_fee = $db->getFee($amount) / 2;
                $historyData = array(
                    'description' => 'Wallet Funded by Credit Card',
                    'transaction_id' =>  $makePayment['tx'],
                    'receiver_wallet_address' => $walletAddress,
                    'receiver_ibm' => $stripeRequest['ibm'],
                    'amount' => $_POST['user_amount'],
                    'status' =>  'Successfull',
                    'miner_fee' => $miner_fee,
                    'tvm_fee' => $tvm_fee
                );

                $responses =  $db->transectionHistoryforBuyBitcoin($historyData);
    ?>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content grid-page">
                    <div class="title-block">
                        <h3 class="title">Success Message! </h3>
                        <p>Your payment is successfully done!</p>

                    </div>
        <?php


            }
        }
    }


    function updateWallet($bitcoinSetting, $db, $memberWallet, $memberWalletXPublic, $is_session)
    {
        $walletAccountDetail = $bitcoinSetting->getSingleAccount($memberWalletXPublic);
        if ($walletAccountDetail['receiveAddress'] != $memberWallet) {
            $response = $db->updateWalletAddress($walletAccountDetail['receiveAddress'], $memberWalletXPublic);
            if ($response['success'] == true) {
                if ($is_session) {
                    $_SESSION['user']['wallet_number'] = $walletAccountDetail['receiveAddress'];
                    return $walletAccountDetail['receiveAddress'];
                } else {
                    return $walletAccountDetail['receiveAddress'];
                }
            } else {
                return $walletAccountDetail['receiveAddress'];
            }
        } else {
            return $memberWallet;
        }
    }


    include_once 'includes/footer.php'; ?>