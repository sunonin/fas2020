<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-info-sign"></span> Please provide the needed information below. Fill out all the required fields (<i style="color: red;">*</i>).
    </div>
    <form role="form" id="app_form">
        <div class="box-body">
            <div class="col-md-6">
                <?= proc_form_control('Stock No', 'text', 'form-control', 'stock_number', 'stockNo', false, 'S' . $app_stockn, '') ?>
                <?= proc_form_control('', 'hidden', 'form-control', 'division', 'division', false, 'S' . $_GET['division'], '') ?>
                <?= proc_form_control('Code', 'text', 'form-control', 'code', 'code', true, '', ''); ?>
                <?= proc_form_control('Item Title', 'text', 'form-control', 'itemTitle', 'itemTitle', true, '', ''); ?>
                <label for="Unit">Unit</label>

                <select id="cform-unit" name="unit" class="form-control" data-placeholder="-- Select Unit --" required="1" style="width: 100%;" data-select2-id="cform-category" tabindex="-1" aria-hidden="true">
                        <?php foreach ($app_unit as $key => $item) : ?>
                            <option value="<?= $item['id']; ?>"><?= $item['unit']; ?></option>
                        <?php endforeach; ?>
                    </select>
                <div class="form-group">
                    <fieldset>
                        <legend style="size:10px;">Source of Fund </legend>
                    </fieldset>
                    <?= proc_form_control('Regular, Local and Trust Fund', 'checkbox', 'minimal form-check-input check-funds', 'sf', 'sf[]', false, '3', '12'); ?>
                    <?= proc_form_control('Local Fund', 'checkbox', 'minimal form-check-input check-funds', 'sf', 'sf[]', true, '1', '12'); ?>
                    <?= proc_form_control('Regular Fund', 'checkbox', 'minimal form-check-input check-funds', 'sf', 'sf[]', true, '2', '12'); ?>
                </div>

                <?= proc_form_control('Remarks', 'text', 'form-control', 'stockNo', 'remarks', true, '', ''); ?>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="itemTitle">Category <i style="color: red;">*</i></label>
                    <select id="cform-category" name="category" class="form-control" data-placeholder="-- Select Category --" required="1" style="width: 100%;" data-select2-id="cform-category" tabindex="-1" aria-hidden="true">
                        <?php foreach ($app_category as $key => $item) : ?>
                            <option value="<?= $item['id']; ?>"><?= $item['category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="itemTitle">Office <i style="color: red;">*</i></label>
                    <select id="cform-office" name="office" class="form-control" data-placeholder="-- Select Office --" required="1" style="width: 100%;" data-select2-id="cform-category" tabindex="-1" aria-hidden="true">
                        <?php foreach ($pmo_list as $key => $item) : ?>
                            <option value="<?= $item['id']; ?>"><?= $item['office']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= proc_form_control('Quantity', 'number', 'form-control', 'qty', 'qty', true, '', ''); ?>
                <?= proc_form_control('APP Price', 'text', 'form-control', '', 'app_price', true, '', ''); ?>
                <div class="form-group">
                    <fieldset>
                        <legend>Mode of Procurement</legend>
                        <?= proc_form_control('Shopping', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '2', '4'); ?>
                        <?= proc_form_control('NP Lease of Venue', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '4', '4'); ?>
                        <?= proc_form_control('Direct Contracting', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '5', '4'); ?>
                        <?= proc_form_control('Agency to Agency', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '6', '4'); ?>
                        <?= proc_form_control('Public Bidding', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '7', '4'); ?>
                        <?= proc_form_control('Not Applicable', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '8', '4'); ?>
                        <?= proc_form_control('Small Value Procurement', 'checkbox', 'minimal form-check-input check-mode', 'stockNo', 'mode[]', true, '1', '12'); ?>
                    </fieldset>
                </div>


            </div>
            <hr>
            <div class="col-md-12 ">
                <div class="form-group">
                    <button type="button" id="btnsubmit" class="btn btn-success"><i class="fa fa-save"></i> Save Record</button>
                </div>
            </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>