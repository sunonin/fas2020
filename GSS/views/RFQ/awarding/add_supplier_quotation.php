<div class="box box-primary container" style="  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
    <div class="box-header with-border" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample" style="cursor: pointer;">
        <b>Add Supplier Quote</b>
        <div class="pull-right">
        </div>
    </div>
    <div>
        <div>
            <br>
            <div class="card card-body">
                <div class="document-track-search">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group field-documenttracklatestsearch-category">
                                <?= proc_group_select('Supplier', 'supplier', $supplier_award_opts, '', 'select2 supplier_list', '', false, '', true); ?>
                                <div class="help-block"></div>
                            </div>
                            <form id="supplier_quotation">
                                <?= proc_text_input('hidden', '', 'cform-rfq-no-awarded', 'cform-rfq-no-awarded', $required = false, $_GET['rfq_no']) ?>
                                <?= proc_text_input('hidden', '', 'cform-pr-no-awarded', 'cform-pr-no-awarded', $required = false, $_GET['pr_no']) ?>
                                <?= proc_text_input('hidden', '', 'cform-rfq-id', 'rfq_id', $required = false, $ids['id']) ?>
                                <div>
                                    <div class="box-body table-responsive">
                                        <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">

                                            <div id="w1" class="grid-view">
                                                <table class="table table-striped table-bordered" id="quotation_table" style="max-height: 500px;height: 210px !important;overflow: auto !important;">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count = ''; ?>
                                                        <?php foreach ($rfq_items as $key => $item) : ?>
                                                            <tr>
                                                                <td><?= $item['item']; ?></td>
                                                                <?php
                                                                if (count($pr_items) == 1) {
                                                                    echo '<td hidden><input type="text" name="rfq_item_id" value="' . $item['item_id'] . '" /></td>';
                                                                } else {
                                                                    echo '<td hidden><input type="text" name="rfq_item_id[]" value="' . $item['item_id'] . '" /></td>';
                                                                }
                                                                ?>
                                                            </tr>
                                                            <?php $count++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?= proc_action_btn('Back', '', 'btn_rfq_back', 'btn-style btn-2 icon-back btn-sep', '', '', '', '', '#'); ?>
                                <?= proc_action_btn('Select Supplier', '', 'append_supplier', 'btn-style btn-1 icon-choose btn-sep', '', '', '', '', '#'); ?>
                                <?= proc_action_btn('Save', '', 'btn_rfq_awarding', 'btn-style btn-1 icon-save btn-sep', '', '', '', '', '#'); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-book"></i> Edit Supplier Quotation</h5>
            </div>
            <form id="form-quotation">
                <div class="modal-body">
                    <div class="switchToggle pull-right">
                        <input type="checkbox" id="cform-dfunds" class="dfunds" name="dfunds"><label for="cform-dfunds">Assign Multiple PR's</label>
                        <span>&nbsp; <b>Winner Item?</b></span>
                    </div>
                <?=  proc_group_select('Supplier', 'ppu_supplier', $supplier_award_opts, '', 'select2 supplier_list', '', false, '', true) ?>

                    <?= proc_text_input('text', 'form-control', 'cform-ppu', 'cform-ppu', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'abstract_no', 'abstract_no', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'pr_no', 'pr_no', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'rfq_no', 'rfq_no', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'rfq_id', 'rfq_id', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'id', 'cform-id', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'sid', 'cform-sid', $required = false, '') ?>
                    <?= proc_text_input('hidden', 'form-control', 'is_winner', 'is_winner', $required = false, '') ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    
    .dropbox {
        box-shadow: 0 1px 2px rgb(0 0 0 / 50%);
    }

    .custom-tb-header {
        background-color: #a0cfea !important;
    }

    .delete_modal_header {
        text-align: center;
        background-color: #f15e5e;
        color: white;
        padding: 5% !important;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }

    * {
        box-sizing: border-box;
    }

    .fade-scale {
        transform: scale(0);
        opacity: 0;
        -webkit-transition: all .25s linear;
        -o-transition: all .25s linear;
        transition: all .25s linear;
    }

    .fade-scale.in {
        opacity: 1;
        transform: scale(1);
    }

    .switchToggle input[type=checkbox] {
        height: 0;
        width: 0;
        visibility: hidden;
        position: absolute;
    }

    .switchToggle label {
        cursor: pointer;
        text-indent: -99999px;
        width: 70px;
        max-width: 60px;
        height: 25px;
        background: #d1d1d1;
        /*display: block; */
        border-radius: 100px;
        position: relative;
    }

    .switchToggle label:after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: #fff;
        border-radius: 90px;
        transition: 0.3s;
    }

    .switchToggle input:checked+label,
    .switchToggle input:checked+input+label {
        background: #3e98d3;
    }

    .switchToggle input+label:before,
    .switchToggle input+input+label:before {
        content: 'No';
        position: absolute;
        top: 3px;
        left: 35px;
        width: 26px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }


    .switchToggle input:checked+label:before,
    .switchToggle input:checked+input+label:before {
        content: 'Yes';
        position: absolute;
        top: 3px;
        left: 10px;
        width: 26px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }

    .switchToggle input:checked+label:after,
    .switchToggle input:checked+input+label:after {
        left: calc(100% - 2px);
        transform: translateX(-100%);
    }

    .switchToggle label:active:after {
        width: 60px;
    }

    .toggle-switchArea {
        margin: 10px 0 10px 0;
    }

</style>

<script>
    generateQuotationTable();
    $(document).on('change', '#cform-supplier', function() {
        let supplier_id = $(".supplier_list").find(':selected').attr('data-id');
        let supplier_value = $(".supplier_list").find(':selected').attr('data-value');
        let isExists = false;

        $('#btn_rfq_awarding').show();

        let tr = '<th>';
        tr += supplier_id;
        tr += '<th hidden><input type="hidden" value="' + supplier_value + '" id="selected_supplier" name="selected_supplier" />';
        tr += '</th>';

        let row = '';
        row += '<td><div id="cgroup-total_amount" class="input-group col-lg-12"> <span class="input-group-addon"><strong>₱</strong></span> ';
        row += '<input type="number" class="form-control" id="supplier_price"  name="supplier_price[]">';
        row += '</div></td>';
        $("#quotation_table>thead>tr").append(tr);
        $("#quotation_table>tbody>tr").append(row);
        $('#append_supplier').hide();
        $('#append_supplier').hide();
        $('#btn_rfq_back').show();
        $(this).prop('disabled', true);
    })
    $(document).on('change', '.switchToggle input', function(e) {
        const isOn = e.currentTarget.checked;
        if (isOn) {
            $('#is_winner').val('1')
        } else {
            $('#is_winner').val('')


        }
    })
    $(document).on('click', '#btn_rfq_awarding', function() {
        let form = $('#supplier_quotation').serialize();
        $.get({
            url: 'GSS/route/post_awarding.php?' + form,
            success: function(data) {
                generateQuotationTable();
                $('#cform-supplier').prop('disabled', false);
                loadItems();
                location.reload(true);

            }
        })
    })
    $(document).on('click', '#btn_edit_ppu', function() {
        let ppu = $(this).val();
        let id = $('#sq_id').val();
        $('#cform-ppu').val(ppu);
        $('#cform-id').val(id);
    })
    $(document).on('click', '#btn_delete_ppu', function() {
        $.post({
            url: 'GSS/route/post_delete_ppu.php',
            data: {
                id: $(this).val()
            },
            success: function(data) {
                toastr.success("Successfully removed this quote");
                setTimeout(
                    function() {
                        location.reload(true);
                    },
                    1000);
            }
        })
    })
    $(document).on('click','#submit',function(){
        let form = $('#form-quotation').serialize();
        $.get({
            url: 'GSS/route/post_edit_quotation.php?'+form,
            
            success: function(data) {
                toastr.success("Successfully removed this quote");
                setTimeout(
                    function() {
                        location.reload(true);
                    },
                    1000);
            }
        })
    })



    function generateQuotationTable() {
        $.post({
            url: 'GSS/views/RFQ/form/quotation.php',
            data: {
                rfq_id: '<?= $_GET['rfq_id']; ?>',
                rfq_no: '<?= $_GET['rfq_no']; ?>'
            },
            success: function(data) {
                $('#quotation').html(data);
            }
        })

    }

    function loadItems() {
        $.post({
            url: 'GSS/views/RFQ/form/items.php',
            data: {
                pr_no: '<?= $_GET['pr_no']; ?>'
            },
            success: function(data) {
                $('#quotation_table').html(data);
            }
        })

    }


    $(document).on('click', '#ppu', function() {
        let sid = $(this).data('sid');
        let id = $(this).data('id');
        let supplier = $(this).data('title');
        $('#cform-ppu').val($(this).data('value'));
        $('#id').val(id);
        $('#sid').val(sid);
        $('#cform-ppu_supplier').append($("<option selected />").val(sid).text(supplier));


    })
</script>