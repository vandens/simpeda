//============================================================ START FUNCTION ================================================================================================================= //
function expor(){
	var a = $('#list_data').val();
	var x = $('#datax').val(a);
}

function limit(xuri,xdata){
    loading(true);
    $.ajax({
    url     : xuri,
    type    : 'post',
    data    : "lim="+xdata,
    success : function(param){
            $("#list").html(param);
            loading(false);
        },
	error       : function(param){
			
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
                //loading(false);
                //alert('Maaf, terjadi kesalahan');
        } 
    })
}
function load(){
	var img = $('#load').html();
	$('#modal').html('');
	$('#modal').html('<center><img src='+img+' width="50px" style="margin:100px"></center>');
}

function JTD(xuri,xdata,div){ // digunakan untuk tambah dan detail
    //$('#'+div).hide();
//	loading(true); 
//	load();
	$.ajax({ 
            url     : xuri,
            type    : "get",
            data    : xdata,
            success : function(param){
				//$('#'+div).hide();
                $("#"+div).html(param).show();
                loading(false);
            },
            error   : function(){
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
                //loading(false);
            }
        });
}

function JEdit(xuri,xdata,div){
//  loading(true);
//  $('#'+div).html('');
  load();
  $.ajax({
      url     : xuri,
      type    : "post",
      cache   : false,
      data    : xdata,
      success:    function(param)
             {   
                $("#"+div).html(param);
//                 loading(false);
          },
      error   : function(){
			show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
          //alert('Maaf Terjadi kesalahan');
         // loading(false);
          }
      })
  
}

function JCONF(xuri,xdata,div){ // digunakan untuk tambah dan detail
    //$('#'+div).hide();
	//loading(true); 
	$.ajax({ 
            url     : xuri,
            type    : "post",
            data    : xdata,
            success : function(param){
                loading(false);                
        //        var obj = eval('('+param+')');
        //        if(obj.error == 1 || obj.status == 'danger'){
	    //            $("#"+div).html(param).show();
        //        }else{
		//			show_alert('.alert-modal',obj.status,obj.msg);
        //        }
                $("#"+div).html(param).show();
            },
            error   : function(){
				show_alert('.alert-modal','danger','Exception : Maaf, terjadi kesalahan!');
                //loading(false);
            }
        });
}

function JPaging(xuri,xdata,div){
	loading(true); 
	$.ajax({ 
            url     : xuri,
            type    : "post",
            data    : xdata,
            success : function(param){
                $("#"+div).html(param).fadeIn(50);
                loading(false);
                
            },
            error   : function(){
            	show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
            }
        });
}



function JHapus(xuri, xdata,id){
    loading(true);
           var r =  confirm('Anda yakin ingin menghapus data!?');
           if(r == true){
                $.ajax({
                    url     : xuri,
                   // dataType: 'json',
                    type    : "post",
                    cache   : false,
                    data        : xdata,
                    success:    function(param)
                    {   
                	var obj = eval('('+param+')');
                        if(obj.error == 1 || obj.status == 'danger'){
							show_alert('.alert',obj.status,obj.msg);
                        }else{
							$('.selected').fadeOut('slow');
                            $("#"+id).fadeOut('slow');
							show_alert('.alert',obj.status,obj.msg);
                        }
                    },
                    error : function(){
						show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan');
						//loading(false);
                        //$(".alert").addClass("alert-danger");
                        //$(".alert").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Exception</strong> : Mohon Maaf, Terjadi kesalahan").fadeIn(1000);
                    }
                });

            }else{ loading(false);  return false; }
}

function JHapusByCheck(xuri,xdata,redirectto){
        if(xdata.length == 0){
            //alert('Tidak ada data yang dipilih');
			show_alert('.alert','danger','Tidak ada data yang dipilih!');
            
        }else if(confirm('Anda yakin ingin menghapus data terpilih??')){
            
            loading(true);
            $.ajax({
                url : xuri,
                type : "post",
                cache : false,
                data : xdata,
                success : function(param){
                    var result = eval('('+param+')');
							//$(".alert").addClass("alert-"+result.status);
                            //$(".alert").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>BERHASIL</strong><br>"+result.msg).fadeIn(1000);
					show_alert('.alert',result.status,'Data berhasil dihapus');
					//$("#list").html(param);
                    setTimeout(function(){  window.location.href = redirectto; },1200);
                    //loading(false);
                },
                error   : function(){
					show_alert('.alert','danger','Maaf, terjadi kesalahan!');
					//loading(false);
                    //$(".alert").addClass("alert-danger");
                    //$(".alert").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Maaf Terjadi kesalahan</strong>").fadeIn(2000);
                    
                }
            });
        }else{ return false; }
}




function JSimpan(xuri, xdata,id,clear){
    //loading(true);
                $.ajax({
                    url     : xuri,
                    type    : "post",
                    cache   : false,
                    data    : xdata,
                    success:    function(param)
                    {   
                        if(id == 1){ // id = 1 untuk alert base on template, other utk alert on Modal

    						var result = eval('('+param+')');	
							show_alert('.alert',result.status,result.msg);
                            setTimeout(function(){ $("#list").load(result.load+'#list').fadeIn(3000); },2500);
    					   

                        }else{
                            var result = eval('('+param+')');    
							show_alert('#AlertModal',result.status,result.msg);
							
                            if(result.red == 1) // if red = 1 then redirect to current page
                            setTimeout(function(){ window.location.href=result.red; },2500);
                            else
                            setTimeout(function(){ $("#konten").load(result.load+'#konten').fadeIn(3000); },2500);

                        }

                        
                        loading(false);
                    },
                    error : function(){
                        if(id == 1){
							show_alert('.alert','danger','Exception : Mohon maaf, terjadi kesalahan!');
                            //$(".alert").addClass("alert-danger");
                            //$(".alert").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Exception</strong> : Mohon Maaf, Terjadi kesalahan").fadeIn(1000);
                        }else{
							show_alert('#AlertModal','danger','Exception : Mohon maaf, terjadi kesalahan!');
                            //$("#AlertModal").addClass("alert-danger");
                            //$("#AlertModal").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Exception</strong> : Mohon Maaf, Terjadi kesalahan").fadeIn(1000);
                        
                        }
                    }
                });
}


function clear(){
    $("#key").val('');
    $("#param").val('');
    $("#param2").val('');
    $("#param3").val('');
    $("#param4").val('');
    $("#param5").val('');
    $("#param6").val('');
    $("#param7").val('');
    
    $('.input-sm').val('');
}

//============================================================ START LOADING FUNCTION ================================================================================================================= //



function loading(is_show){
    if(is_show == true){
        $("#loading").html("<center><img src=\"media/images/loading.gif\" width='50px' style='margin:100px' /></center>").fadeIn();
		}
    if(is_show == false){
        $("#loading").html("<center><img src=\"media/images/loading.gif\" width='50px' style='margin:100px' /></center>").fadeOut();
		
		}

}

function show_alert(div,status,msg){

		loading(false);
    	$(div).removeClass("alert-danger");
    	$(div).removeClass("alert-success");
    	$(div).addClass("alert-"+status);
    	if(status != 'danger')	
    		var span = '<span class="ace-icon fa fa-check-square-o bigger-120"></span> BERHASIL!!!<br>';
       	else	
    		var span = '<span class="ace-icon fa fa-exclamation-triangle bigger-120"></span> PERHATIAN!!!<br>';
    	
    	 //$(div).html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+"<b>"+msg+"</b>").show(500);
        $(div).html(span+msg).slideDown();//slideDown(500);
   // 	$(div).removeClass('hide');
        //$(div).slideUp();
		setTimeout(function(){ $(div).slideUp(500); },5500);
}

function CheckAll(){
    $(".selecAll").change(function(){
        var status = $(this).attr("checked") ? "checked" : false;
        $(".allbox").attr("checked",status);
    //    if(status == 'checked'){
     //       $(".ket option[value='1']").attr("selected","selected");
      //  }else{
       //     $(".ket option[value='']").attr("selected","selected");
		//}
    });
}


function CheckAllAbs(){
    $(".selecAll").change(function(){
        var status = $(this).attr("checked") ? "checked" : false;
        $(".allabs").attr("checked",status);
        if(status == 'checked'){
            $(".ket option[value='1']").attr("selected","selected");
        }else{
            $(".ket option[value='']").attr("selected","selected");
        }
    });
}

function checkSelected(id){
    var status = $("#param"+id).attr("checked") ? "checked" : false;
    $("#param"+id).attr("checked",status);
    if(status == 'checked'){
        $("#"+id+" option[value='1']").attr("selected","selected");
    }else{
        $("#"+id+" option[value='']").attr("selected","selected");
    }
}

function selectedCheck(id,key){
    if (id == ''){
        $("#param"+key).attr('checked',false);
    }else{
        $("#param"+key).attr('checked','checked');
    }
}


// =============================================== Use for Frontend Menu =================================================== //
function loadpage(xuri,xdata,div){ // digunakan untuk tambah dan detail
    loading(true); 
	$.ajax({ 
            url     : xuri,
            type    : "post",
            data    : xdata,
            success : function(param){
				$('#'+div).hide();
                $("#"+div).html(param).fadeIn(100);
                loading(false);
            },
            error   : function(){
                //alert('Maaf, terjadi kesalahan');
				show_alert('#alert','danger','Exception : Maaf, terjadi kesalahan!');
                loading(false);
            }
        })
    
}

function prosave(xuri,xdata,div){
    loading(true); 
	$.ajax({ 
            url     : xuri,
            type    : "post",
            data    : xdata,
            success : function(param){
				var obj = JSON.parse(param);
				if(obj.status == 'success'){
					window.location.href=obj.redirectto
				}else{
					show_alert('.alert',obj.status,obj.msg);
				}
				
            },
            error   : function(){
                loading(false);
				show_alert('.alert','danger','Exception : Maaf, terjadi kesalahan!');
            }
        })
    
}

function btn_switch(div1,div2,fild,value){
	if(value == 1){
		$('#'+div1).removeClass('btn-default');
		$('#'+div2).removeClass('btn-success');
		$('#'+div2).removeClass('btn-danger');
		$('#'+div1).addClass('btn-success');
		$('#'+div2).addClass('btn-default');
		$('#'+fild).val(value);
	}else{
		$('#'+div1).removeClass('btn-success');
		$('#'+div1).removeClass('btn-danger');
		$('#'+div2).removeClass('btn-default');
		$('#'+div1).addClass('btn-default');
		$('#'+div2).addClass('btn-danger');
		$('#'+fild).val(value);
	}
}

function popupWindow(url, title, w, h) {
  var win;
  var left 	= (screen.width/2)-(w/2);
  var top	= (screen.height/2)-(h/2);
   win 		=  window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left).focus();
   return win;
}

function closeIt(url){
	opener.location.href = url ;
	close();
}