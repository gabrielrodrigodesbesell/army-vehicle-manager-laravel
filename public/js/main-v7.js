$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  moment.updateLocale('en', {
    week: {dow: 1} // Monday is the first day of the week
  })

  $('.date').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: 'en',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.datetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm:ss',
    locale: 'en',
    sideBySide: true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.timepicker').datetimepicker({
    format: 'HH:mm:ss',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })

  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })

  $('.c-header-toggler.mfs-3.d-md-down-none').click(function (e) {
    $('#sidebar').toggleClass('c-sidebar-lg-show');

    setTimeout(function () {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 400);
  });

  $(document).on('click','.btn-io',function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var type = $(this).data('type');
    if(type=='io-veiculos'){
      var icone  = '<i class="fa-fw fas fa-truck-moving icon-modal"></i>';
      var typeLabel = "veículos";
    }else{
      var icone  = '<i class="fa-fw fas fa-users icon-modal"></i>';
      var typeLabel = "pessoas";
    }
    
    var urlNewRegister = location.protocol + '//' + location.host+"/admin/"+type+"/create";
    Swal.fire({
      title: '',
      showDenyButton: false,
      showCancelButton: false,
      showConfirmButton:false,
      html: icone+"<br><strong>O que deseja fazer?</strong><br><br><a href='"+urlNewRegister+"?acao=1' class='btn btn-success btn-100'>Registrar entrada de "+typeLabel+"</a><br><a href='"+urlNewRegister+"?acao=0' class='btn btn-danger btn-100'>Registrar saída de "+typeLabel+"</a><br><a href='"+url+"' class='btn btn-default btn-100'>Listar entradas e saídas de "+typeLabel+"</a>",
    }).then((result) => {
      
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    });
  });

  $(document).on('change','.confirm-veiculo',function (e) {
    var checado = $(document).find(".confirm-veiculo:checked").length>=3;
    if(checado){
      if(parseInt($("#secao_id").val())>0 && $('input[name="operacao"]').val()=='1'){
        $('#btn-submit-veiculo').removeAttr('disabled');
      }else if($('input[name="operacao"]').val()=='0'){
        $('#btn-submit-veiculo').removeAttr('disabled');
      }
    }else{
      $('#btn-submit-veiculo').attr('disabled','disabled');
    }
  });
  $(document).on('click','#btn-submit-veiculo',function (e) {
    e.preventDefault();
    $('#frm-save-io-veiculo').submit();
  });
  
  $(document).on('change','#veiculo_id',function (e) {
    e.preventDefault();
    $("#veiculo_id option[value='']").remove();
    activeBtnSaveIOVeiculo();
  });
  $(document).on('keyup','input[name="missao"]',function (e) {
    e.preventDefault();    
    activeBtnSaveIOVeiculo();
  });
  
  function activeBtnSaveIOVeiculo(){
    if($("#veiculo_id").val()!="" && $('input[name="missao"]').val()!=""){
      $('.btn-io-veiculos-save').removeAttr('disabled');
    }else{
      $('.btn-io-veiculos-save').attr('disabled','disabled');
    }
  }

  $(document).on('click','.btn-io-veiculos-save',function (e) {
    e.preventDefault();
    var select = $('#veiculo_id').find(":selected");
    var ioType = ($('input[name="operacao"]').val()=="1"?"entrada":"saída");
    var html = "<div class='modal-veiculo'>";
    html +='<div class="modal-center">';
    html +='<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br><b>Registro de '+ioType+'</b>';
    html +='<hr>'
    html += "<img src='"+select.attr('data-foto')+"'><hr>";
    html +='</div>';
    html += "<strong>"+select.attr('data-descricao')+"</strong><br>";
    html += "<span><strong>Placa:</strong> "+select.attr('data-placa')+"</span><br>";
    if($('input[name="operacao"]').val()=='1'){
      html += "<span style='"+($('#secao_id option:selected').text()=="Selecione por favor"?"color:red":null)+"'><strong>Destino:</strong> "+($('#secao_id option:selected').text())+"</span><br>";
    }
    
    html += "<span><strong>Data:</strong> "+$('#data_hora').val()+"</span><br>";
    html += "<span><strong>Missão/Condutor:</strong> "+$('#missao').val()+"</span><br>";
    html += "<hr>";
    html += "<p>";
    html += "<input type='checkbox' id='confirm_1' value='1' class='confirm-veiculo'> inspecionei o veículo<br>";
    html += "</p>";
    html += "<p>";
    html += "<input type='checkbox' id='confirm_2' value='1' class='confirm-veiculo'> conferi a ficha de acidente<br>";
    html += "</p>";
    html += "<p>";
    html += "<input type='checkbox' id='confirm_3' value='1' class='confirm-veiculo'> recolhi o canhoto da ficha<br>";
    html += "</p>";
    html += "</td>";
    html += "</tr>";
    html +='<div class="modal-center">';
    html += "<hr><button id='btn-submit-veiculo' class='btn btn-success' disabled><i class='fa fa-save'></i> Finalizar registro</button>";
    html += "</div>";
    html += "</div>";
    Swal.fire({
      title: '',
      showDenyButton: false,
      showCancelButton: false,
      showConfirmButton:false,
      html: html,
    }).then((result) => {
      
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    });
  });

  $("input[name='cpf']").mask('000.000.000-00', {reverse: true});
  
})