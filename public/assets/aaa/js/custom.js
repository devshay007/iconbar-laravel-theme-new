(function (global, factory) {
  var mod = {
    exports: {}
  };
  factory(global.jQuery, global.Site);
})(this, function (_jquery, _Site) {
  'use strict';

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  (0, _jquery2.default)(document).ready(function () {
    (0, _Site.run)();
  });
});
/**********Select2 ***************/
$('.select-all').click(function () {
	let $select2 = $(this).parent().siblings('.select2')
	$select2.find('option').prop('selected', 'selected')
	$select2.trigger('change')
})
$('.deselect-all').click(function () {
	let $select2 = $(this).parent().siblings('.select2')
	$select2.find('option').prop('selected', '')
	$select2.trigger('change')
});
/********** END Select2 ***************/
var toastr_opt={
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
function toastrSuccess(msg,title){
  toastr.success(msg,title,toastr_opt);
}
function toastrErrors(msg,title){
  toastr.error(msg,title,toastr_opt);
}
function toastrError(msg,title){
  toastr.error(msg,title,toastr_opt);
}
$('.us_phone_number').keydown(function (e) {
   var key = e.charCode || e.keyCode || 0;
   $text = $(this); 
   if (key !== 8 && key !== 9) {
       if ($text.val().length === 3) {
           $text.val($text.val() + '-');
       }
       if ($text.val().length === 7) {
           $text.val($text.val() + '-');
       }
   }
   return ((event.shiftKey && event.keyCode == 9) || (!e.shiftKey && (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))));
});

$(document).on("input",".allow_decimal",function(evt) {
   var beforedecimal=$(this).data('beforedecimal');
   var afterdecimal=$(this).data('afterdecimal');

   this.value = this.value
      .replace(/[^\d.]/g, '')            
      .replace(new RegExp("(^[\\d]{" + beforedecimal + "})[\\d]", "g"), '$1') 
      .replace(/(\..*)\./g, '$1')         
      .replace(new RegExp("(\\.[\\d]{" + afterdecimal + "}).", "g"), '$1'); 
 });

$(document).on("input", ".allow_pincode",function(evt) {
  var totaldigits=$(this).data('totaldigits');
  this.value = this.value
      .replace(/[^0-9]/g, '')            
      .replace(new RegExp("(^[\\d]{" + totaldigits + "})[\\d]", "g"), '$1');
});

$(document).on("input", ".allow_number",function(evt) {
  var totaldigits=$(this).data('totaldigits');
  this.value = this.value
      .replace(/[^0-9]/g, '')            
      .replace(new RegExp("(^[\\d]{" + totaldigits + "})[\\d]", "g"), '$1');
});

$('.allow_alphanumeric_dash').keydown(function (e) {
  var k = e.keyCode || e.which;
    var ok = k >= 65 && k <= 90 || // A-Z
      k >= 96 && k <= 105 || // a-z
      k >= 35 && k <= 40 || // arrows
      k == 9 || //tab
      k == 46 || //del
      k == 8 || // backspaces
      k == 189 || // dash
      (!e.shiftKey && k >= 48 && k <= 57); // only 0-9 (ignore SHIFT options)

    if(!ok || (e.ctrlKey && e.altKey)){
      e.preventDefault();
    }
});

function getSingleSelect2List(obj)
{
  var allowClear=false;
  var dropdownParent=false;
  if(obj.hasOwnProperty("allowClear")){
    allowClear=true;
  }
  if(obj.hasOwnProperty("dropdownParent")){
    dropdownParent=$(obj.dropdownParent);
  }
  $(obj.selector).select2({
    dropdownParent:dropdownParent,
    allowClear:allowClear,
    placeholder: obj.placeholder,
    width: '100%',
    ajax: {
      url:base_url+'/admin/select2_find',
      type:"POST",
      dataType:'json',
      delay:250,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: function (params) {
        return {
          term: $.trim(params.term),
          model:obj.model,
          field_id_name:obj.field_id_name,
          field_name:obj.field_name,
          status:obj.status,
          keyname:obj.keyname,
          country:obj.country,
          isvaccine:obj.isvaccine,
          country_field_name:obj.country_field_name,
          is_admin:obj.is_admin,
          nonehospid:obj.nonehospid,
          page: params.page || 1,
          deleted_at:obj.deleted_at,
          multicolumns:obj.multicolumns,
        };
      },
      cache: true
    }
  })
}

function country_state(countryid,state_field_name)
{
  $('#'+state_field_name).html('');
  getSingleSelect2List({
      selector:document.getElementById(state_field_name),
      placeholder:'Select State...',
      model:'m_state',
      field_id_name:'stateid',
      field_name:'statename',
      country:countryid,
      country_field_name: 'countryid',
      status:1,
      nonehospid:true
  });
}

function getAge(birthdate,dayfieldname,monthfieldname,yearfieldname) 
{
  var now = new Date();

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(birthdate.substring(6,10),
      birthdate.substring(0,2)-1,                   
      birthdate.substring(3,5)                  
  );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = yearString = monthString = dayString = "";
  
  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
      var monthAge = monthNow - monthDob;
  else {
      yearAge--;
      var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
      var dateAge = dateNow - dateDob;
  else 
  {
      monthAge--;
      var dateAge = 31 + dateNow - dateDob;
      if (monthAge < 0) {
          monthAge = 11;
          yearAge--;
      }
  }
  
  $('#'+dayfieldname).val(dateAge);
  $('#'+monthfieldname).val(monthAge);
  $('#'+yearfieldname).val(yearAge);
}