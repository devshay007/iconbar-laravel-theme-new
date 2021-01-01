$(function(){
    let csvButtonTrans = 'CSV'
    let excelButtonTrans = 'Excel'
    let pdfButtonTrans = 'PDF'
    let printButtonTrans = 'Print'
    let selectAllButtonTrans = 'Select All'
    let selectNoneButtonTrans = 'Deselect All'
    let checkboxclassName ='';
    var buttons_arr=[ ];

   if(logged_user_email==developer_admin_email){
       var columns_settings=[':visible :not(:last-child)'];
    }else{
        if($(".per_delete").length>=1){
           var columns_settings=[':visible :not(:first-child,:last-child)'];
        }else{
            var columns_settings=[':visible :not(:last-child)'];
        }
    }

    if($(".per_delete").length){
      checkboxclassName ='select-checkbox';
      buttons_arr.push({
          extend: 'selectAll',
          className: 'btn-primary',
          text: selectAllButtonTrans,
          exportOptions: {
            columns: columns_settings
          }
        },
        {
          extend: 'selectNone',
          className: 'btn-primary',
          text: selectNoneButtonTrans,
          exportOptions: {
            columns: columns_settings
          }
        });
    }

  if($(".per_export").length){
      buttons_arr.push({
          extend: 'csv',
          className: 'btn-default',
          text: csvButtonTrans,
          exportOptions: {
            columns: columns_settings
          },
          title:$(".page-title").html()
        },
        {
          extend: 'excel',
          className: 'btn-default',
          text: excelButtonTrans,
          exportOptions: {
            columns: columns_settings
          },
          title:$(".page-title").html()
        },
        {
          extend: 'pdf',
          className: 'btn-default',
          text: pdfButtonTrans,
          exportOptions: {
            columns: columns_settings
          },
          title:$(".page-title").html()
        });
    }

    if($(".per_print").length){
      buttons_arr.push({
          extend: 'print',
          className: 'btn-default',
          text: printButtonTrans,
          exportOptions: {
            columns: columns_settings
          },
          title:$(".page-title").html()
        });
    }

    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
    $.extend(true, $.fn.dataTable.defaults, {
      responsive: true,
      language: {
        sSearchPlaceholder: 'Search..',
        lengthMenu: '_MENU_',
        search: '_INPUT_',
        "processing":'<div class="datatable_processing" ><div class="loader vertical-align-middle loader-circle"></div><br><span>Loading. Please wait...</span></div>'
      },
      columnDefs: [{
          orderable: false,
          className: checkboxclassName,
          targets: 0
      }, {
          orderable: false,
          searchable: false,
          targets: -1
      }],
      select: {
        style:    'multi+shift',
        selector: 'td:first-child'
      },
      order: [],
      scrollX: true,
      pageLength: 100,
      dom: 'lBfrtip<"actions">',
      buttons:buttons_arr,
    });
    $.fn.dataTable.ext.classes.sPageButton = '';
  });
