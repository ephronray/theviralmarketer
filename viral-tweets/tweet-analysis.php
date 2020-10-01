<?php
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');


include_once './../includes/main-header.php';

//require_once (__DIR__.'/../_libs/twitterSetting.php');

//$twitter = new TwitterSetting();
//// add tweeter account
//if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){
//    $twitter->saveNewTwitterAccount();
//}
//// add tweeter account
//
////get all tweeter Accounts
//
//$alltwitterAccountDetail = $twitter->getAccountDetails();
//
////get all tweeter accounts
//
////get single tweeter account
//
//
//if(isset($_GET['id'])) {
//    $tweeterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
//
//}



//get single tweeter account
?>
<style>

    .icons_for_account {
        margin: 0 2px;
    }
    .icons_for_account i.fa-pencil {
        font-size: 1.4em;
        color: #57c7d4;
    }

    .icons_for_account i.fa-trash {
        font-size: 1.4em;
        color: #ff2f2f;
    }

    .icons_for_account i.fa-list-ul {
        font-size: 1.4em;
        color: #40e240;
    }
    /*.table-hover tbody tr:hover {*/
    /*    background-color: #fff;*/
    /*    box-shadow: 0 2px 30px #dee2e5;*/
    /*    -webkit-transform: translateY(-3px);*/
    /*    transform: translateY(-3px);*/
    /*    opacity: 1;*/
    /*}*/
    /*.bg-yellow th{*/
    /*  text-align: inherit;*/
    /*    color: #fff !important;*/
    /*    font-size: 1.1rem;*/
    /*}*/
    /*.table tbody tr td {*/
    /*    vertical-align: middle;*/
    /*} */
    .modal-header
    {
        background-color:#fff !important;
        color: #000 !important;
        padding-bottom: 0;
    }

    .panel-group .panel {

        border-radius: 0;

        box-shadow: none;

        border-color: #EEEEEE;

    }
    .panel-default > .panel-heading {

        padding: 0;

        border-radius: 0;

        color: #212121;

        background-color: #85ce36;
        border-color: #EEEEEE;
    }
    .panel-title {
        font-size: 14px;
    }
    .panel-title > a {
        display: block;
        padding: 15px;
        font-size: 17px;
        font-weight: bold;
        color: white;
        text-decoration: none
    }
    .panel-title > a :hover{

        text-decoration: none !important;

        color: #eaebe8 !important;

    }

    .card-block{

        padding: 0px !important;

    }

    @media only screen and (max-width: 600px) {
        .blnc_res {
            width: 60%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }

    @media only screen and (max-width: 320px) {
        .blnc_res {
            width: 80%;
            margin-left: 5%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }


    td{
        text-align: center;
    }

    /* thead tr th:not(:) */
</style>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Tweet Analysis
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Tweet Analysis</li>
        </ol>
    </section>


    <section class="content-body">
        <article class="content grid-page">

            <?php

//            $newsifyObj::pree($twitter->get_tweet_by_user());


            ?>

            <section class="section">

                <div class= row>

                    <div class="col-md-2  d-none mt-2">
                        <button class="btn btn-dark " ><</button>
                    </div>

                    <div class="col-md-5 d-none">
                        <div class="row">
                            <div class="col-5">
                                <input type="text" class="form-control flatpickr_field" name="" id="ta_from_date" placeholder="Date From">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control flatpickr_field" name="" id="ta_to_date" placeholder="Date To">
                            </div>
                            <div class="col-2 mt-2 p-0">
                                <button class="btn btn-dark filter">Filter</button>
                            </div>

                        </div>

                    </div>



                    <div class="col-md-3  mb-md-0 mb-10 mt-2 d-none filter_btn">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-dark btn_day days">Days</button>
                            <button type="button" class="btn btn-dark btn_day weeks">Weeks</button>
/* <!--                            <button type="button" class="btn btn-dark">Months</button>--> */
                        </div>
                    </div>

                    <div class="col-md-2" style="margin-top: 0.5rem">

                        <button type="button" class="btn btn-dark refresh_data">Refresh</button>
                        <button type="button" class="btn btn-dark" id="button-a">Download</button>

                    </div>



                    <div class="col-md-2 d-none ">

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-dark" ><</button>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-dark"> >  </button>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-2 text-right  d-none mt-2">
                        <button class="btn btn-dark"> >  </button>

                    </div>

<!--                    <div class="col-md-12" style="text-align:right;">-->
<!--                        <a href="action/createAccountProcess.php" class="btn btn-primary btn-lg">Authorize Twitter Account</a>-->
<!--                    </div>-->

                </div>
                <br/>
                <br/>
                <div class="box box-solid bg-black ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Analysis</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-striped no-margin " id="viral_analysis_table_4085">
                                <thead >
                                <tr class="type">

                                    <th>Type</th>
                                    <th class="text-center dummy">21-Aug-2019</th>
                                    <th class="text-center dummy">22-Aug-2019</th>
                                    <th class="text-center dummy">23-Aug-2019</th>
                                    <th class="text-center dummy">24-Aug-2019</th>
                                    <th class="text-center dummy">25-Aug-2019</th>


                                </tr>
                                </thead>

                                <tbody>
                                    <tr class="num_tweet">
                                        <th>Number of Tweets</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>

                                    <tr class="impression">
                                        <th>Impression</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>


                                    <tr class="profile_visits">
                                        <th>Profile Visits</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>


                                    <tr class="mentions">
                                        <th>Mentions</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>

<!--                                    <tr class="followers">-->
<!--                                        <th>New Followers</th>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!---->
<!---->
<!--                                    </tr>-->


                                    <tr class="replies">
                                        <th>Replies</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>

                                    <tr class="replies_rate">
                                        <th>Replies Rate</th>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>
                                        <td class="dummy">0</td>


                                    </tr>


<!--                                    <tr class="engagement_rate">-->
<!--                                        <th>Engagement Rate</th>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!--                                        <td class="dummy">0</td>-->
<!---->
<!--                                    </tr>-->

                                </tbody>





                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div style="border-radius:7px;" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Confirmed Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>  Do you Really want to Delete <strong class="accountName"></strong> Account? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="border-radius:4px;" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button"  onclick="confirmdeleteAccount(this)" style="border-radius:4px;" class="btn btn-danger confirmdelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </article>
    </section>

</div>

<div class="modal data_load_modal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document" style="width: max-content; margin: 50vh auto;">
        <div class="">
            <img src="../images/loader_2.gif" style="width: 100px; height: 100px;">
        </div>
    </div>
</div>



<?php include_once './../includes/main_footer.php'; ?>


<script>


    $(document).ready(function(){

        $(".flatpickr_field").flatpickr();

    });



</script>