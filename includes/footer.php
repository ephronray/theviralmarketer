<?php 
require_once (__DIR__.'/../_libs/dbConnect.php');
$newsifyObj = new  dbConnect();
$base_url = $newsifyObj->base_url;
?>
<style type="text/css">
    @media only screen and (max-width: 600px) {
        .mob-res {
            text-align: center;
        }
    }

    @media only screen and (max-width: 320px) {
        .mob-res {
            text-align: center;
        }
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">
                <p>
                    <a href="./faq.php">FAQ</a>&nbsp;&nbsp;&nbsp;
                
                    <a href="./income-disclaimer.php">Income Disclaimer</a>&nbsp;&nbsp;&nbsp;
                
                    <a href="./terms-and-conditions.php">Terms and Conditions</a>&nbsp;&nbsp;&nbsp;
                
                    <a href="./contact-us.php">Contact Us</a>&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-6">
                <p class="mob-res" style="float: right;">
                    <b>All Rights reserved</b>
                </p>
            </div>

        </div>
        
    </div>
</section>

<!-- /.modal -->
<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to do this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
</div>

<script>
    $(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});
</script>
<script src="<?= $base_url ?>/js/vendor.js"></script>
<script src="<?= $base_url ?>/js/app.js"></script>
<script type="text/javascript" src="<?= $base_url ?>/js/tagsinput.js"></script>  
<script type="text/javascript" src="<?= $base_url ?>/js/jquery.doubleScroll.js"></script> 

<script type="text/javascript" src="<?= $base_url ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?= $base_url ?>/js/util.js"></script>
<script type="text/javascript" src="<?= $base_url ?>/js/corner-popup.min.js"></script>
<script type="text/javascript" src="<?= $base_url ?>/js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?= $base_url ?>/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


</script>
<script type="text/javascript" src="<?= $base_url ?>/js/form-file-uploads.js"></script>
  
    
</body>

</html>