<script type="text/javascript">
var functionSecurity = '<?php echo json_encode($_SESSION["function_security"])?>'
var functionSecurityArray = $.parseJSON(functionSecurity); //convert to javascript array

function CreateActionButtonHTML(data, actionListArray){
    var actionString = '<button type="button" style="--bs-btn-line-height: 1rem!important; padding-bottom: 5px!important;" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon m-0" data-toggle="dropdown" aria-expanded="false" style="font-size:.8rem!important!">Action<span class="sr-only">Toggle Dropdown</span></button><div style="background-color:rgb(206,226,255) !important; min-width:8rem !important;padding:0rem 0rem !important;" class="dropdown-menu" role="menu">';
        $.each(actionListArray,function(key,value){
            if(functionSecurityArray[value.action_code] || value.action_code==0){
                var parameters = value.parameters
                var parametersArray = parameters.split(",")
                var parameterString = "";
                $.each(data,function(key1,value1){ 
                    $.each(parametersArray,function(key2,value2){
                        if(key1==value2){

                            if (typeof value1 === 'string') 
                            {
                                value1=value1.replace(/'/g, "\\'");  
                            }
                            
                            if(value.action_type == 'function'){
                                parameterString += "'"+value1+"',";
                            }else if(value.action_type == 'link'){
                                parameterString += value1+"/";
                            }
                        }
                    });
                });
                if(value.action_type == 'function'){

                    parameterString = parameterString.replace(/,\s*$/, "");

                    
                    actionString +='<div class="dropdown-divider" style="margin: 0rem 0rem !important;"></div><a style="padding:0.25rem 0.5rem !important;" class="dropdown-item edit_data" href="javascript:void(0)" onclick="'+value.action_function+'('+parameterString+');" data-id="2" title="'+value.link_title+'"><span  class="fa '+value.icon_class+' "></span> '+value.display_text+'</a>';

                }else if(value.action_type == 'link'){
                //parameterString = parameterString.replace(//\s*$/, "");
                actionString +='<div class="dropdown-divider" style="margin: 0rem 0rem !important;"></div><a target="_blank" style="padding:0.25rem 0.5rem !important;" class="dropdown-item edit_data" href="<?= base_url()?>/'+value.action_function+'/'+parameterString+'"  data-id="2" title="'+value.link_title+'"><span  class="fa '+value.icon_class+' "></span> '+value.display_text+'</a>';

                }

            }
        });
            actionString += '</div>';
    return actionString;
}
</script>