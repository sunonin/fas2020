<?php require_once 'GSS/controller/PurchaseRequestController.php'; ?>
<?php require_once 'GSS/controller/APPController.php'; ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Purchase Request</h1>

        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Purchase No <?= $pr_data['pr_no']; ?></li>
        </ol>
    </section>
    <section class="content">
    <form id="pr_edit_form" class="form-vertical" method="post" role="form">

        <div class="row">

            <div class="col-lg-12">
                <p>
                    <button type="button"  class="btn btn-flat bg-orange" value=""><a href="procurement_purchase_request_view.php?division=<?= $_GET['division']; ?>&id=<?= $_GET['id']; ?>" style="color: #fff;"><i class=" fa fa-arrow-circle-left"></i> RETURN</a></button>
                    <button type="button"  class="btn btn-flat bg-green " id="btn_edit_pr" value="<?= $_GET['id'];?>"> <i class=" fa fa-save"></i> SAVE</a></button>
                    <button type="button"  class="btn btn-flat bg-purple pull-right " value="/documentroute/createreject?routeno=1751014&amp;docno=R4A-2021-07-27-001&amp;receivedfrom=1551&amp;userid=8516"><i class="fa fa-file-excel-o"></i><a style="color:#fff;" href="export_pr.php?pr_no=<?= $_GET['id']; ?>"> EXPORT PR</a></button>
                </p>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <b>Purchase Request Information</b>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                            <input type="hidden" name="_csrf" value="">
                            <?= proc_text_input('hidden', '', 'pr_no', 'pr_no', $required = false, $pr_data['pr_no']) ?>
                            <?= proc_text_input('hidden', '', 'division', 'division', $required = false, $_GET['division']) ?>
                            <div id="w1-container" class="kv-view-mode">
                                <div class="kv-detail-view">
                                    <table id="w1" class="table table-bordered table-striped detail-view" data-krajee-kvdetailview="kvDetailView_4eb2b924">
                                        <tbody>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Purchase No.</th>
                                                                <td>
                                                                    <div class="kv-attribute">
                                                                        <?= $pr_data['pr_no']; ?>
                                                                    </div>
                                                                 
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Office/Province:</th>
                                                                <td>
                                                                    <div class="kv-attribute"><?= $pr_data['office']; ?></div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-doc_no required">
                                                                            <div><input type="text" id="documentroute-doc_no" class="form-control" name="Documentroute[DOC_NO]" value="R4A-2021-07-27-001" aria-required="true">
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">PR Date</th>
                                                                <td>
                                                                    <div class="kv-attribute">
                                                                        <div class="form-group">
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                                <?= proc_text_input("text", "form-control pull-right info-dates", "datepicker2", "pr_date", true, $pr_data['pr_date']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-route_date">
                                                                            <div><input type="text" id="documentroute-route_date" class="form-control" name="Documentroute[ROUTE_DATE]" value="2021-07-27 12:03:00">
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Target Date</th>
                                                                <td>
                                                                    <div class="kv-attribute">
                                                                        <div class="form-group">
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                                <?= proc_text_input("text", "form-control pull-right info-dates", "datepicker1", "target_date", true, $pr_data['target_date']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-route_date">
                                                                            <div><input type="text" id="documentroute-route_date" class="form-control" name="Documentroute[ROUTE_DATE]" value="2021-07-27 12:03:00">
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Type</th>
                                                                <td>
                                                                    <div class="kv-attribute"><span class="text-justify">
                                                                       
                                                                                <?= group_select('Item', 'type', $app_type, 'type', '', '', false, '', true); ?>
                                                                        
                                                                    </div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-docsubject">
                                                                            <div><textarea id="documentroute-docsubject" class="form-control" name="Documentroute[docSubject]" rows="4">RSAKM IMPLAN: GUIDE FOR PREPARATION OF RSAKM ACCOMPLISHMENT PRESENTATION IN THE ERIC CALABARZON AND MIMAROPA MEETINGS ON 28 JULY 2021</textarea>
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Purpose</th>
                                                                <td>
                                                                    <div class="kv-attribute"><textarea style="width: 971px; height: 68px;resize:none;" name="purpose"><?= $pr_data['purpose']; ?></textarea></div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-docdesc">
                                                                            <div><textarea id="documentroute-docdesc" class="form-control" name="" rows="2">RSAKM IMPLAN: GUIDE FOR PREPARATION OF RSAKM ACCOMPLISHMENT PRESENTATION IN THE ERIC CALABARZON AND MIMAROPA MEETINGS ON 28 JULY 2021</textarea>
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr></tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">ABC</th>
                                                                <td>
                                                                    <div class="kv-attribute">₱ <?= number_format($pr_data['abc'], 2); ?></div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-actionname">
                                                                            <div><input type="text" id="documentroute-actionname" class="form-control" name="Documentroute[actionName]" value="APPROPRIATE STAFF ACTION">
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width: 20%; text-align: LEFT; vertical-align: MIDDLE;">Current Status</th>
                                                                <td>
                                                                    <div class="kv-attribute"><b><?= $pr_data['status']; ?></b></div>
                                                                    <div class="kv-form-attribute" style="display:none">
                                                                        <div class="form-group highlight-addon field-documentroute-route_remarks">
                                                                            <div><textarea id="documentroute-route_remarks" class="form-control" name="Documentroute[ROUTE_REMARKS]" rows="4"></textarea>
                                                                                <div class="help-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="kv-child-table-row">
                                                <td class="kv-child-table-cell" colspan="2">
                                                    <table class="kv-child-table">
                                                        <tbody>
                                                            <tr></tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>


                        <!-- All attached files -->
                        <!-- <p><span class="fa fa-info-circle fa-fw"></span><i>There are <b class="text-danger">5 ITEMS</b> in this Purchase Request.</i></p> -->
                        <hr>
                        <p><a class="btn btn-sm btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">PR ITEM <i class="fa fa-angle-double-down fa-fw"></i></a></p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                    <div class="card card-body">
                                        <p><b><i>Here is the list of the other recipients in this routed document:</i></b></p>
                                        <table class="table table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Item Description</th>
                                                    <th>Unit</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total Cost</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php foreach ($pr_items as $key => $data) : ?>
                                                    <tr>
                                                        <td hidden><input type="hidden" value="<?= $data['id']; ?>" id="id" /></td>
                                                        <td><?= $data['items']; ?></td>
                                                        <td><?= $data['description']; ?></td>
                                                        <td><?= $data['unit']; ?></td>
                                                        <td><?= $data['qty']; ?></td>
                                                        <td>₱ <?= number_format($data['abc'], 2); ?></td>
                                                        <td>₱ <?= $data['total']; ?></td>
                                                        <td><button type ="button" class="btn btn-flat bg-blue col-lg-12" id="btn_pr_edit" value="<?= $data['id']; ?>"><i class="fa fa-edit"></i> Edit</button></td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

</section>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1000px;">
        <div class="modal-content">

            <div class="modal-body box item-list-table box-primary box-solid dropbox" style="height:600px;" id="list">

            </div>
        </div>
    </div>
</div>

<style>
    /*!
 * @package   yii2-detail-view
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2020
 * @version   1.8.3
 *
 * Styles for yii2-detail-view extension 
 * 
 * Author: Kartik Visweswaran
 * Copyright: 2014 - 2020, Kartik Visweswaran, Krajee.com
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
    .kv-container-bs4 .form-group:not(.has-error),
    .kv-container-bs4 .table {
        margin: 0
    }

    .kv-container-bs4 .table-bordered .kv-child-table-cell td,
    .kv-container-bs4 .table-bordered .kv-child-table-cell th {
        border-top: none;
        border-bottom: none
    }

    .kv-container-bs4 .card>.kv-detail-view>.table-bordered>tbody>tr>td:first-child,
    .panel>.kv-detail-view>.table-bordered>tbody>tr>td:first-child {
        border-left: 0
    }

    .kv-container-bs4 .card>.kv-detail-view>.table-bordered>tbody>tr>td:last-child,
    .panel>.kv-detail-view>.table-bordered>tbody>tr>td:last-child {
        border-right: 0
    }

    .kv-flat-b .card>.kv-detail-view:last-child,
    .kv-flat-b .panel>.kv-detail-view:last-child {
        border-bottom-right-radius: .25rem;
        border-bottom-left-radius: .25rem
    }

    .kv-form-attribute .help-block {
        margin-bottom: -15px
    }

    .kv-edit-mode .kv-edit-hidden,
    .kv-view-mode .kv-view-hidden {
        display: none
    }

    .kv-edit-mode .kv-view-hidden,
    .kv-view-mode .kv-edit-hidden {
        display: table-row
    }

    .kv-edit-hidden.kv-view-hidden {
        display: none
    }

    .kv-detail-loading {
        opacity: .3;
        background: url(../img/loading.gif) top 15px right 15px no-repeat #fff
    }

    .kv-detail-loading * {
        background: 0 0 !important
    }

    .kv-detail-loading td {
        border-color: #efefef !important
    }

    .kv-edit-mode .kv-detail-view {
        overflow-y: hidden
    }

    .kv-form-attribute .row {
        margin-bottom: -5px
    }

    .kv-edit-mode table {
        overflow: hidden
    }

    .kv-child-table {
        width: 100%
    }

    .kv-child-table-row,
    .kv-child-table-row>td {
        vertical-align: middle;
        padding: 0 !important;
        margin: 0 !important
    }

    .kv-child-table-cell {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow: hidden
    }

    .kv-child-table-row th {
        border-left: 1px #ddd solid;
        border-right: 1px #ddd solid
    }

    .kv-child-table td,
    .kv-child-table th {
        margin: 0;
        background: 0 0
    }

    .table .kv-child-table>tbody>tr>td,
    .table .kv-child-table>tbody>tr>th {
        padding: 8px
    }

    .table-condensed .kv-child-table>tbody>tr>td,
    .table-condensed .kv-child-table>tbody>tr>th {
        padding: 5px
    }

    .kv-action-btn {
        margin: 0 2px;
        padding: 0 5px;
        background: 0 0;
        border: none;
        font-size: 16px;
        cursor: pointer
    }

    .kv-action-btn:focus {
        outline: 0
    }

    .kv-action-btn.disabled,
    .kv-action-btn[disabled] {
        cursor: not-allowed
    }

    .card .kv-action-btn {
        color: #fff
    }

    .card .kv-action-btn:focus,
    .card .kv-action-btn:hover {
        color: #fff;
        outline: 0;
        opacity: .8
    }

    .card.border-default .kv-action-btn,
    .card.border-default .kv-action-btn:focus,
    .card.border-default .kv-action-btn:hover,
    .panel-default .kv-action-btn {
        color: #333
    }

    .panel-primary .kv-action-btn:hover {
        color: #c4e3f3
    }

    .panel-info .kv-action-btn {
        color: #31708f
    }

    .panel-info .kv-action-btn:hover {
        color: #245269
    }

    .panel-warning .kv-action-btn {
        color: #8a6d3b
    }

    .panel-warning .kv-action-btn:hover {
        color: #66512c
    }

    .panel-danger .kv-action-btn {
        color: #a94442
    }

    .panel-danger .kv-action-btn:hover {
        color: #843534
    }

    .panel-success .kv-action-btn {
        color: #3c763d
    }

    .panel-success .kv-action-btn:hover {
        color: #2b542c
    }
</style>
<script>
    $(document).ready(function() {
        $(".select2").select2();

    })
    $(document).on('click', '#btn_pr_edit', function() {
        let item_id = $(this).val();
        let path = 'GSS/route/post_item_list.php';
        let data = {
            id: item_id,
            pr_no: $('#pr_no').val()
        };

        $.post(path, data, function(data, status) {
            //$('#app_table').empty();
            let lists = JSON.parse(data);
            sample(lists);
            $('#exampleModal').modal();
            $(".select2").select2({
                dropdownParent: $("#exampleModal")
            });


        });

        function sample($data) {
            $.each($data, function(key, item) {
                let row = '<form id="item_form"><div class="box-header with-border bg-blue">PR NO.' + item['pr_no'] + ' </div><div class="box-body box-emp">';
                row += '<div class="box-header with-border">';
                row += '<div class="row" class="box-body box-emp">';
                row += '<div class="col-lg-12">';
                row += '<label>APP Item <font style="color: Red;">*</font> </label>';

                row += '<?= group_select('Item', 'unit', $app_item_list, '', 'select2', '', false, '', true); ?>';
                row += '</div>';
                row += '<div class="col-lg-12">';
                row += '<div hidden>';
                row += '<input type="text" id="app_items" class="form-control"  />';
                row += '</div>';
                row += '<div hidden>';
                row += '<input type="text" id="item_title" class="form-control" />';
                row += '</div>';
                row += '<br>';
                row += '<label>Stock/Property No. <font style="color: Red;">*</font> </label>';
                row += '<input type="text" id="stocknumber" class="form-control" readonly  value=' + item['sn'] + '>';
                row += '<br>';
                row += '<label>Quantity <font style="color: Red;">*</font></label>';
                row += '<br>';
                row += '<input class="form-control" type="number" id="qty" value=' + item['qty'] + '>';

                row += '<label>Unit <font style="color: Red;">*</font></label>';
                row += '<?= group_select('Item', 'unit', $unit_opts, '', 'select2', '', false, '', true); ?>';
                row += '<input type="hidden" id="unit" class="form-control" value = ' + item['unit'] + '>';
                row += '<br>';
                row += '<label>Description/Specification </label>';
                row += '<textarea id="desc" rows="1" cols="50" class="form-control" style="resize:none;outline:none;">' + item['description'] + '</textarea>';


                row += '<label>Unit Cost <font style="color: Red;">*</font></label>';
                row += '<br>';
                row += '<input class="form-control" type="text" id="abc" readonly value = ' + item['abc'] + '>';
                row += '<input input type="hidden" class="form-control" type="text" id="total_cost" value = ' + item['total'] + ' readonly>';
                row += '<input input type="hidden" class="form-control" type="text" id="items1" readonly>';

                row += '</div>';

                row += '</div>';
                row += '</div>';
                row += '</div>';
                row += '<div class="col-lg-3">';

                row += '<button type="button" id="btn_update_item" class="btn btn-flat bg-green col-lg-12"> Update Item </button>';
                row += '</div>';
                row += '</div></div>';
                $('#list').append(row);
            });

            return $data;
        }
        $("#list").html("");

    })

    $(document).on('click', '#btn_update_item', function() {
        let path = 'GSS/route/post_edit_pr_item.php';
        update(path);

        function update(path) {
            $.post({
                url: path,
                data: {
                    'id': $('#id').val(),
                    'pr_no': $('#pr_no').val(),
                    'app_item': $('#app_items').val(),
                    'procurement': $('#item_title').val(),
                    'qty': $('#qty').val(),
                    'unit': $('#unit').val(),
                    'description': $('#desc').val(),
                    'unit_cost': $('#abc').val()
                },
                success: function(data) {
                    //window.location = "procurement_app.php?division="+$('#office_id').val() ;

                }
            })
        }
    })
</script>