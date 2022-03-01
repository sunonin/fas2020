<?php require_once 'GSS/controller/RFQController.php'; ?>
<?php require_once 'GSS/controller/PurchaseRequestController.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Request for Quotation</h1>

        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Request for Quotation</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <?php include('_panel/box.html.php'); ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="w3-panel w3-pale-red w3-border w3-leftbar w3-border-red">
                    <h3>REMINDER!</h3>
                    <div><label class="label label-danger">URGENT</label> - the status of this purchase request is urgent and must be processed on the date submitted by the user. </div><br>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="tab">
                    <ul role="tablist" class="nav nav-tabs bs-adaptive-tabs" id="myTab">
                        <li class="active">
                            <a href="procurement_request_for_quotation.php">
                                <i class="fa fa-archive"></i>
                                <label>Request for Quotation</label>
                            </a>
                        </li>
                        <li>
                            <a href="procurement_supplier_awarding.php">
                                <i class="fa fa-calendar"></i>
                                <label>For Awarding</label>
                            </a>
                        </li>
                        <li>
                            <a href="procurement_purchase_order_create.php">
                                <i class="fa fa-cog"></i> <label>Purchase Order</label>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            
                        </div>
                    </div>

                    <div class="box-body">
                      
                        <div class="col-md-3">
                            <?php include 'GSS/views/RFQ/_panel/pending_pr.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <?php include 'GSS/views/RFQ/_panel/rfq_entries.php'; ?>
                            <?php include 'GSS/views/RFQ/_panel/rfq_create.php';
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
</div>
</section>
</div>
<script>
    $('#tbl_rfq_panel').hide();
    $('#pos_panel').hide();
    $(document).ready(function(){
        $('#rfq_table').DataTable({
        "lengthChange": false,
        "dom": '<"pull-left"f><"pull-right"l>tip',
        "lengthMenu": [4, 40, 60, 80, 100],

    });
    })

    $(document).on('click', '#btn_create_rfq', function() {
        $('#tbl_pr_entries').hide();
        $('#tbl_rfq_panel').show();
        $('#pos_panel').show();

        let pr = $(this).val();
        let path = 'GSS/route/post_rfq.php';
        let data = {
            pr_no: pr,
        };

        $.post(path, data, function(data, status) {
            let lists = JSON.parse(data);
            sample(lists);
            appendAPPItems(lists);
        });

        function sample($data) {
            $.each($data, function(key, item) {
                $('#pr_no').val(item.pr_no);
                $('#abc').val(item.abc);
                $('#qty').val(item.qty);
                $('#items').val(item.items);
                $('#description').val(item.description);
                $('#unit').val(item.unit);
                $('#create').val(item.pr_no);
                $('#purpose').val(item.purpose);
                $('#mode').val(item.mode);
                $('#pr_date').val(item.pr_date);
                $('#target_date').val(item.target_date);
                $('#cform-total_amount').val(item.amount);
                $('#office').val(item.office);
                $('#amount').val(item.amount);
            });

            return $data;
        }

        function appendAPPItems($data) {
            $.each($data, function(key, item) {
                let tr = '<tr>';
                tr += '<td> <input type="hidden" value="' + item['items'] + '" name="app_id[]" /></td>';
                tr += '</tr>';
                $('#app_items').append(tr);
            });
            return $data;
        }
    })
    $(document).on('click', '.btn-create-rfq', function () {
        let form = $('#rfq_form').serialize();
        let path = 'GSS/route/post_create_rfq.php?' + form;
        let pr = $(this).val();
        let division = $('#division').val();
        update(path);

        function update(path) {
            $.get({
                url: path,
                data: {
                    pr_no: pr,
                    rfq_no: $('#rfq_no').val()
                },
                success: function (data) {
                    window.location = "procurement_request_for_quotation.php?division=" + division + "";

                }
            })
        }
    })
</script>

<!-- <script src="GSS/views/backend/js/rfq_custom_button.js"></script>

<script>
    $("#tab").tabs();
    $('#btn_rfq_awarding').hide();
    $('#btn_rfq_back').hide();
    $('#quotation').hide();
    $('#multiple_assigning').hide();
    $('#rfq').addClass('active');
    $('#datepicker1').datepicker({
        autoclose: true
    })
    $('#rfq_date').datepicker({
        autoclose: true
    })
    
    $('#datepicker2').datepicker({
        autoclose: true
    })
    $('#cform-rfqdate').datepicker({
        autoclose: true
    })

    let maxAppend = 0
    $(document).on('click', '#btn-multiple', function() {
        $('#pos_panel').hide();
        $('#tbl_pr_entries').hide();
        $('#multiple_assigning').show();
        $('#pr_item_list').show();
        $('#tbl_rfq_panel').hide();

        
    })
    $('document').ready(function() {
        $('textarea').each(function() {
            $(this).val($(this).val().trim());
        });
    });
    $(document).ready(function() {
        $('.select2').select2();
        $('#tbl_rfq_panel').hide();
        $('#tbl_view_rfq_info').hide();
        $('#pos_panel').hide();

    })

    $(document).on('change', '.select2', function() {

        let path = 'GSS/route/fetch_multiple_pr_info.php';
        let pr = $(this).val();
        $.get({
            url: path,
            data: {
                pr_no: pr
            },
            success: function(result) {
                var data = jQuery.parseJSON(result);
                jQ_append('purpose1', data.purpose);
                function jQ_append(id_of_input, text) {
                    var input_id = '#' + id_of_input;
                    $(input_id).val($(input_id).val() + text +'\n');
                }
             
            }
        })
    });
    $(document).on('click', '#btn_create_rfq', function() {
        $('#tbl_pr_entries').hide();
        $('#pos_panel').hide();
        $('#multiple_assigning').hide();

        $('#tbl_rfq_panel').show();
    })

   

    $(document).on('click', '.btn-back', function() {
        $('#tbl_pr_entries').show();
        $('#tbl_rfq_panel').hide();
        $('#pos_panel').hide();
        $('#tbl_view_rfq_info').hide();


    })

    $(document).on('click', '#award', function() {
        $("#tab").tabs("option", "active", 1);
        $("#award").addClass('active');
        $("#rfq").removeClass('active');

        //  fetch data 
        let path = 'GSS/route/fetch_rfq_items.php';
        let path_details = 'GSS/route/fetch_rfq_details.php';
        let data = {
            pr_no: $(this).val()
        };

        $.get(path, data, function(data, status) {
            let lists = JSON.parse(data);
            $('#rfq_items').dataTable().fnClearTable();
            $('#rfq_items').dataTable().fnDestroy();
            appendRFQItems(lists);
        });

        $.get(path, data, function(data, status) {
            let lists = JSON.parse(data);
            $('#quotation_table').find('tbody').empty();
            appendQuatation(lists);
        });

        $.get(path_details, data, function(data, status) {
            let lists = JSON.parse(data);
            details(lists);
        });
    })

    $(document).on('click', '#back', function() {
        $("#tab").tabs("option", "active", 0);
        $("#award").removeClass('active');
        $("#rfq").addClass('active');
    })


    $(document).on('click', '#append_supplier', function() {
        let supplier_id = $(".supplier_list").find(':selected').attr('data-id');
        let supplier_value = $(".supplier_list").find(':selected').attr('data-value');
        let isExists = false;


        // if (maxAppend >= ) {
        //     toastr.error("You have reached  the number of maximum suppliers!");
        // } else {
        $('#btn_rfq_awarding').show();
        // var val = $('#selected_supplier').val();
        // if (val == supplier_id) {
        //     toastr.info("Supplier already exist!");

        // } else {
        //     isExists = false;
        let tr = '<th>';
        tr += supplier_id;
        tr += '<th hidden><input type="hidden" value="' + supplier_value + '" id="selected_supplier[]" name="selected_supplier" />';
        tr += '</th>';

        let row = '';
        row += '<td><div id="cgroup-total_amount" class="input-group col-lg-12"> <span class="input-group-addon"><strong>₱</strong></span> ';
        row += '<input type="number" class="form-control" name="supplier_price[]">';
        row += '</div></td>';
        $("#quotation_table>thead>tr").append(tr);
        $("#quotation_table>tbody>tr").append(row);
        $('#append_supplier').hide();
        $('#append_supplier').hide();
        $('#btn_rfq_back').show();
        // }

        // }
        // maxAppend++;

    })


    $(document).on('click', '#btn_rfq_back', function() {
        location.reload();
    })
    // FUNCTIONS

    function appendRFQItems($data) {
        $.each($data, function(key, item) {
            let tr = '<tr>';
            tr += '<td>' + item['id'] + '</td>';
            tr += '<td>' + item['item'] + '</td>';
            tr += '<td>' + item['desc'] + '</td>';
            tr += '<td>' + item['qty'] + '</td>';
            tr += '<td>' + item['cost'] + '</td>';
            tr += '<td>' + item['unit'] + '</td>';
            tr += '<td>' + item['total'] + '</td>';
            tr += '</tr>';
            $('#rfq_items').append(tr);
        });


        return $data;
    }

    function appendQuatation($data) {
        $.each($data, function(key, item) {
            let tr = '<tr>';
            tr += '<td>' + item['item'] + '</td>';
            tr += '<td hidden><input type="hidden" name="rfq_item_id[]" value="' + item['item_id'] + '" /></td>';
            tr += '</tr>';
            $("#quotation_table>tbody").append(tr);
            $('#cform-rfq-no-awarded').val(item['rfq_no']);
            $('#cform-pr-no-awarded').val(item['pr_no']);
        });


        return $data;
    }

    function details($data) {
        $.each($data, function(key, item) {
            $('#cform-rfq-purpose').text(item['purpose']);
            $('#cform-rfq-no').text(item['rfq_no']);
            $('#rfq_no').text(item['rfq_no']);
            $('#cform-rfq-rfq_date').text(item['rfq_date']);
            $('#cform-rfq-office').text(item['office']);
            $('#cform-rfq-pr-no').text(item['pr_no']);
            $('#cform-rfq-status').text(item['status']);
        });


        return $data;
    }
</script> -->