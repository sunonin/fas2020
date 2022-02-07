<?php require_once 'Finance/controller/ObligationController.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Create Obligation</h1>
    
    <ol class="breadcrumb"> 
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li> 
      <li><a href="#">Finance</a></li>
      <li>Budget Section</li>
      <li>ORS/BURS</li>
      <li class="active">Create Obligation</li>
    </ol> 
  </section>
  <section class="content">
    <form method="POST" action="<?= $route ?>post_obligation.php">
      <div class="row">
        <?php include 'information.php'; ?>
      </div>
      <div class="row">
        <?php include 'entries.php'; ?>
      </div>
    </form>
  <section>
</div>

<style type="text/css">
  .dropbox {
    box-shadow: 0 1px 2px rgb(0 0 0 / 50%);
  }

  .custom-tb-header {
    background-color: #a0cfea !important;
  }
</style>


<script type="text/javascript">
  function format_number(n) {
    return parseFloat(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
  }

  function format_replace(n) {
    return n.replace(/,/g, '');
  }

  function generateObEntries() {
    let el = '<tr>';
    el += '<td>';
    el += '<?= group_customselect('Fund Source', 'fund_source[]', $fund_sources, '', 'fund_source', 0, 0); ?>';
    el += '</td>';
    el += '<td>';
    el += '<?= group_textnew('MFO/PPA', 'ppa[]', '', 'ppa', false, 0); ?>';
    el += '</td>';
    el += '<td>';
    el += '<?= group_select('UACS Object Code', 'uacs[]', '', '', 'uacs', 0); ?>';
    el += '</td>';
    el += '<td>';
    el += '<?= group_textnew('Amount', 'amount[]', '', 'amount', false, 0); ?>';
    el += '</td>';
    el += '<td>';
    el += '<button type="button" class="btn btn-danger btn-block btn-row_remove"><i class="fa fa-close"></i> Remove</button>';
    el += '</td>';
    el += '</tr>';

    $('#box-entries').prepend(el);
  }

  $('.info-dates').datepicker({
    autoclose: true
  })

  $(document).on('change', '.po_no', function(e){
    let amount = $(this).find(':selected').data('amount');
    let supp = $(this).find(':selected').data('supplier');

    $('.amount').val(amount);
    $('#cform-po_amount').val(amount);
    $('#cform-supplier').val(supp);
    $('#cform-supplier').trigger('change');

    $('.amount').attr('disabled', 'disabled');
  })

  $(document).on('change', '.supplier', function(e){
    let address = $(this).find(':selected').data('address');
    $('.address').val(address);
  })

  $(document).on('change', '.fund_source', function(e){
    let row = $(this).closest('tr');
    let fs = $(this).val();
    let ppa = $(this).find(':selected').data('ppa');
    row.find('.ppa').val(ppa);
    let field_uacs = row.find('.uacs');
    field_uacs.empty();

    let path = 'Finance/route/generate_uacs.php?fs='+fs;

    $.get(path, function(item, success){
      let $data = JSON.parse(item);

      let opt = '<option value="" selected disabled>-- Please select UACS Object Code ---</option>';
      $.each($data, function(i, b){
        opt += '<option value="'+i+'" data-amount="'+b.amount+'">'+b.code+'</option>';
      });

      field_uacs.append(opt);
    })
  })

  $(document).on('change', '.uacs', function(e){
    let uacs = $(this).find(':selected').data('amount');
    let row = $(this).closest('tr');

    row.find('.amount').val(format_number(uacs));
  });

  $(document).on('click', '.btn-generate', function(e){
    let obtype = $('.ob_type').val();
    let dfunds = $('.dfunds').is(':checked');

    if (obtype != null) {
      $('#box-entries').empty();
      generateObEntries();
      $('.btn-save').removeClass('hidden');
    } else {
      toastr.warning('Please select an <b>Obligation Type</b>.', 'Oops<i class="fa fa-exclamation"></i>');
    }

  });

  $(document).on('click', '.btn-row_remove', function(e){
    let row = $(this).closest('tr');
    row.remove();
  })

  $(document).on('click', '.dfunds', function(e){
    let dfund = $(this).is(':checked');
    if (dfund) {
      $('.btn-generate').removeClass('hidden');
    } else {
      $('.btn-generate').addClass('hidden');
      $('#box-entries').empty();
    }
  })

  // $(document).on('click', '.btn-generate', function(){
  //   let obtype = $('.ob_type').val();
  //   let dfunds = $('.dfunds').is(':checked');

  //   if (obtype != null) {
  //     if (obtype == 'burs') {
  //       obtype = 'BURS';
  //     } else {
  //       obtype = 'ORS';
  //     }

  //     if (counter == 0) {
  //       $('#box-entries').empty();
  //     }

  //     if (dfunds) {
  //       generateObligation(obtype + ' - Provincial Office', true);
  //     } else {
  //       generateObligation(obtype);
  //     }

  //     $('.btn-save').removeClass('hidden');

  //     $('.info-dates').datepicker({
  //       autoclose: true
  //     })

  //     counter = counter + 1;
  //   } else {
  //     toastr.warning('Please select an <b>Obligation Type</b>.', 'Oops<i class="fa fa-exclamation"></i>');
  //   }

  // })


</script>