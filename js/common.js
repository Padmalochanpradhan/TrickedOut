$(document).ready(function () {
  var oTable =$('#table-dsp').DataTable( { "ordering": false,"responsive": true,"pageLength": 50});
});

$(document).ready(function(){
   setTimeout(function(){
  $("#myAlert").alert("close");
}, 10000);

   
});


//Ajax calling
var  ajaxFunc = function(url, data, successFun){
  //alert(1);
     $.ajax({
       type: "POST",
        url: url,
        data:JSON.stringify(data),
        contentType: 'application/json',       
        async: false ,
        success: successFun
      }).fail(function (jqXHR, textStatus, errorThrown){         
         alert('Error in data')
      });
}



// A function to determine if the pressed key is an integer
function numberPressed(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 36 || charCode > 40)){
          return false;
  }
  return true;
}
// A function to format text to look like a phone number
function phoneFormat(input){
  // Strip all characters from the input except digits
  input = input.replace(/\D/g,'');
  
  // Trim the remaining input to ten characters, to preserve phone number format
  input = input.substring(0,10);

  // Based upon the length of the string, we add formatting as necessary
  var size = input.length;
  if(size == 0){
          input = input;
  }else if(size < 4){
          input = '('+input;
  }else if(size < 7){
          input = '('+input.substring(0,3)+') '+input.substring(3,6);
  }else{
          input = '('+input.substring(0,3)+') '+input.substring(3,6)+'-'+input.substring(6,10);
  }
  return input; 
}
function FormatPhoneString(value){
    return value.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
}
/*Phone number format end*/
function addUpdatePropInInput(fielsId,prop,value){
    $("#"+fielsId).prop(prop, value);
}
function FormatDateUsingMoment(date,format){
   return moment(date).format(format);
}

jQuery.validator.addMethod("greaterThan", function(value, element, params) {
  if (!/Invalid|NaN/.test(new Date(value))) {
      return new Date(value) > new Date($(params[0]).val());
  }
  console.log(value);
  return isNaN(value) && isNaN($(params[0]).val()) 
      || (Number(value) > Number($(params[0]).val())); 
},'Must be greater than {1}.');

jQuery.validator.addMethod("lessThan", function(value, element, params) {
  if (!/Invalid|NaN/.test(new Date(value))) {
      return new Date(value) < new Date($(params[0]).val());
  }
  console.log(value);
  return isNaN(value) && isNaN($(params[0]).val()) 
      || (Number(value) < Number($(params[0]).val())); 
},'Must be less than {1}.');
  /* JQuery validator for date range */
  jQuery.validator.addMethod("dateRange", function(value, element, params) {
      var date1 = moment(value);
      var date2 = moment($(params[0]).val());
      var days = date1.diff(date2, 'days');
      if (!/Invalid|NaN/.test(new Date(value))) {
          return days<params[1];
      }
      return isNaN(value) && isNaN($(params[0]).val()) 
          || (days<params[1]); 
  },'Date range within {1} days.');

  jQuery.extend(jQuery.validator.messages, {
  required: "This field is required.",
  remote: "Please fix this field.",
  email: "Please enter a valid email address.",
  url: "Please enter a valid URL.",
  date: "Please enter a valid date.",
  dateISO: "Please enter a valid date (ISO).",
  number: "Please enter a valid number.",
  digits: "Please enter only digits.",
  creditcard: "Please enter a valid credit card number.",
  equalTo: "Please enter the same value again.",
  accept: "Please select a file with a valid extension.",
  maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
  minlength: jQuery.validator.format("Please enter at least {0} characters."),
  rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
  range: jQuery.validator.format("Please enter a value between {0} and {1}."),
  max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
  min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});


jQuery.validator.addMethod("validate_email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");

$.validator.addMethod("pwcheck",
function(value, element) {
   return /^[A-Za-z0-9\d=!\-@._*]+$/.test(value);
});
jQuery.validator.addMethod("DateGreaterThan", function(value,params) {
  console.log(value);

  if ($(params[0]).val() != '' &&  $(params[1]).val() != '') {    
    if (!/Invalid|NaN/.test(new Date(value))) {
      return new Date(value) > new Date($(params[0]).val());
    }    
    return isNaN(value) && isNaN($(params[0]).val()) || (Number(value) > Number($(params[0]).val()));
  };
  return true; 
  },'Must be greater than {1}.');
  
jQuery.validator.addMethod("DateLessThan", function(value,params) {
  console.log(value);
  if ($(params[0]).val() != '' &&  $(params[1]).val() != '') {    
    if (!/Invalid|NaN/.test(new Date(value))) {
      return new Date(value) < new Date($(params[0]).val());
    }    
    return isNaN(value) && isNaN($(params[0]).val()) || (Number(value) < Number($(params[0]).val()));
  };
  return true; 
  },'Must be less than {1}.');


  //Method to add days to date
function addDays(date, days) {
  var dat = date;
  dat.setDate(dat.getDate() + days);
  return dat;
}
  //Method to substract days to date
function substractDays(date, days) {
  var dat = date;
  dat.setDate(dat.getDate() - days);
  return dat;
}