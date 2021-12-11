
//cart add qty

function QtyAddCart(str,sl,ckname,id,lgid,url){
    var sl=parseFloat(sl);
    if (str=="Add"){
      if (sl==0){
          $("#"+id).val(parseInt($("#"+id).val())+parseInt(1));
      }else{
          if (parseInt($("#"+id).val())<sl){
              $("#"+id).val(parseInt($("#"+id).val())+parseInt(1));
          }else{
              $("#"+id).val(sl);
          }

      }

    }else{
      if (parseInt($("#"+id).val())>sl){
          $("#"+id).val(parseInt($("#"+id).val())-parseInt(1));
      }else{
          $("#"+id).val(sl);
      }
    }
     qty=$("#"+id).val();
     $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=WriteCk&lgid="+lgid+"&CkName="+ckname+"&Ckvalue="+qty,async:false}); 
     htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ReadCk&lgid="+lgid,async:false}); 
     $(".mycart").html(htmlobj.responseText);
     htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ViewCart&lgid="+lgid,async:false}); 
     $(".Ant_cart_view").html(htmlobj.responseText);    
  }

//Add to cart
function AddToCart(url,lgid){ 
  var err = 0;
  var attr=$('#canshu').val();
  var attrs = attr.split(',');
  $(attrs).each(function(index,value){
      if(!$('#' + value).val()){
          err = 1;
      }
  });
 if(err==1){
    alert('Please select specifications');
    return false;
  }else{
     $.ajax({
         type: "POST",
         url: url+"Core/Program/Ant_Aajx.php?Antype=WriteCk&lgid="+lgid,
         data:$("#cartform").serialize(),
         success: function(data){
                htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ReadCk&lgid="+lgid,async:false}); 
                $(".mycart").html(htmlobj.responseText);
                $(document.body).append('<div class="tck"><div class="tans"><div class="tan"></div></div></div>');
                $(".tan").html(data);
                $(".tck").fadeIn();
                $(".tck").fadeOut(4000);
              },
               error:function (err){ //失败回调函数
                  $(document.body).append('<div class="tck"> <div class="tans"><div class="tan"></div></div></div>');
            　　　 $(".tan").html("err");
                  $(".tck").fadeIn();
            　　}
        });
    return true;
  }
}

//clear cart
function CelarCart(name,url,lgid){
  $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ClearCart&lgid="+lgid+"&CkName="+name,async:false});
  htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ViewCart&lgid="+lgid,async:false}); 
  $(".Ant_cart_view").html(htmlobj.responseText);
  htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ReadCk&lgid="+lgid,async:false}); 
  $(".mycart").html(htmlobj.responseText);  
  HiddenDiv();
}

//View cart
function ViewCart(url,lgid){
   htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=CheckCart&lgid="+lgid,async:false}); 
  $(".Ant_user_content_right").html(htmlobj.responseText); 
}

//show confirm
function ConfimShow(name,url,words,lgid){ 
  strs=words.split(",");
  $(document.body).append('<div class="tck"> <div class="tans"><div class="tan"></div></div></div>');
  $(".tck").fadeIn();
  $(".tan").html('<span onclick="HiddenDiv();" class="cancel">'+strs[1]+'</span><span class="confirm" onclick="CelarCart(\''+name+'\',\''+url+'\',\''+lgid+'\');">'+strs[0]+'</span>');
}

function HiddenDiv(){
  $(".tck").fadeOut();
}

//login or regedit tab

function rl(str,lgid,url){
    htmls=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=Userlogin&lgid="+lgid+"&type="+str,async:false});
    $("#userlogin").hide();
    $("#userlogin").html(htmls.responseText).slideDown(1000);  
}

// address ajax add
function usersAddress(lgid,url){
  htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=UserAddress&lgid="+lgid+"&type=add",async:false}); 
  $("#useraddress").html(htmlobj.responseText);
}

// address ajax edit
function usersAddressedit(lgid,url,id){
  htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=UserAddress&lgid="+lgid+"&type=edit&id="+id,async:false}); 
  $("#useraddress").html(htmlobj.responseText);
}

// address ajax list
function usersAddresslist(lgid,url){
  list=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=UserAddressShow&lgid="+lgid,async:false}); 
  $("#addresslist").html(list.responseText);
  if (list.responseText.length<1){
    usersAddress(lgid,url);
  }
}
// address ajax del
function userAddressclose(lgid,url,id){
  $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
  $('.tck').fadeIn();
  data=$.ajax({url:url+"Core/Program/Ant_Rponse.php?actions=UserAddress&lgid="+lgid+"&type=close&id="+id,async:false}); 
  $('.tck').hide();
  $('.tan').html('');
  $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data.responseText+'</div></div></div>'); 
  $('.tck').fadeIn();
  $('.tck').fadeOut(3000,function(){
        usersAddresslist(lgid,url); //lodding address list
        $("#ant_addressID").val('');//clear address ID
     });   
}

//address cancel
function cancelAddress(){
  $("#useraddress").html('');
  $(".tck").remove();

}

//EXPRESS LODDING
function expresloding(lgid,url,ExpID){
   express=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=CheckExpress&lgid="+lgid+"&ExpID="+ExpID,async:false}); 
  $("#expressloding").html(express.responseText);
}
//check hide or show
function checkhideshow(ipt,next,lable,id1,id2){

  if ($("#"+ipt).val()!=""){
      $(".Ant_user_div").fadeOut();
      $("#"+next).fadeIn();
      if (id1=="mem_3"){
         ExpID=$("#ant_expressID").val();
         lgid=$("#lgid").val();
         lurl=$("#murl").val();
         expresloding(lgid,lurl,ExpID); //loadding express
      }
      $(".Ant_user_1_title span").removeClass('Ant_user_1_title_span').addClass('Ant_user_1_title_s');
      $("#"+id1+" span").removeClass('Ant_user_1_title_s').addClass('Ant_user_1_title_span');
      if(id2!==""){
         $("#"+id2+" i").removeClass('fa-pencil-square-o').addClass('fa-check-square-o');
      }
  }else{
    alert(lable);
  }
}

$(document).ready(function(){

  $(".Ant_user_left_nav").click(function(){

    if ($(".Ant_user_left").css("display")=="none"){
          $(".Ant_user_left").fadeIn();
          $(this).find("i").removeClass("fa-bars").addClass("fa-times");
    }else{
         $(".Ant_user_left").fadeOut();
         $(this).find("i").removeClass("fa-times").addClass("fa-bars");
    }

  });

    //wishlist add
    $(".wishlist").click(function(){
        url   = $(this).attr("url");
        value = $(this).attr("value");
        lgid  = $(this).attr("lgid");
        if($(this).find("i").attr('class')=="fa fa-heart-o"){
           $(this).find("i").removeClass("fa-heart-o").addClass("fa-heart");
            $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=WriteCkWh&lgid="+lgid+"&value="+value,async:false}); 
        }else{
          $(this).find("i").removeClass("fa-heart").addClass("fa-heart-o");
          $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ClearCkWh&lgid="+lgid+"&value="+value,async:false}); 
        }
         data=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ReadCkWh&lgid="+lgid+"&value="+value,async:false});
         $("#wishlists").html(data.responseText);
      });

    //clear wishlist
    $(".clwishlist").click(function(){
      r=confirm("True");
      if (r==true){
        url   = $(this).attr("url");
        value = $(this).attr("value");
        lgid  = $(this).attr("lgid");
        $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ClearCkWh&lgid="+lgid+"&value="+value,async:false}); 
        window.location.reload();
      }
    });

   var emreg = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;

    //newsletter submit
   
     $('#nelsub').click(function() {
       err=0;
       url=$(this).attr('url');
       var data=$('#neleter').serializeArray();
      // console.log(data);
        $(data).each(function(i){
          if (this.name=="e_ml"){
            if(!emreg.test(this.value)){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;             
            }else{
             $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;                 
            }
          }
        });

        if (err==1){
        $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
        $('.tck').fadeIn();
  setTimeout(function(){
          $.ajax({ 
                         type: "POST",
                         url: url,
                         data:$("#neleter").serialize(),
                         async: false,
                         success: function(data){
                          $('.tck').hide();
                          $('.tan').html('');
                          $("#e_ml").val('');
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000);                                 
                         },
                         error:function (err){ //失败回调函数
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'+err+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             }); 
                      　　}
                  });  
             },1000); 
        }

        return false;  
 
     });  

  //Add reviews
  
  $('#Wrevievws').click(function() {
     url   = $(this).attr("url");
     value = $(this).attr("value");
     lgid  = $(this).attr("lgid");
     data=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=Reviews&lgid="+lgid+"&value="+value,async:false});
     $(document.body).append('<div class="tck"><div class="tanrves"><div class="tanrve">'+data.responseText+'</div></div></div>');
     $('.tck').fadeIn();
  });

  //rating click
 
  $(document).on('click',".rerating i",function(){
    //alert($(this).attr("val"));
    rat = $(this).attr("val");
    $(".rerating i").addClass("fa-star-o").removeClass("fa-star");
    for (var i = 1; i <= rat; i++) {
       $("#r_"+i).addClass("fa-star").removeClass("fa-star-o");
    }
    $("#msg_rating").val(rat);
   });

   //revievew add

  $(document).on('click',"#reviews",function(){
    //return false;
       err=0;
       url=$(this).attr('url');
       var data=$('#previews').serializeArray();
      // console.log(data);
        $(data).each(function(i){
          if (this.name=="msg_email"){
            if(!emreg.test(this.value)){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;             
            }else{
             $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;                 
            }
          }
          if (this.value==""){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;
          }else{
            $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;
          }
        });
        if (err==1){
        $("#reviews").html('<i class="fa fa-spinner fa-spin  fa-fw" aria-hidden="true"></i> Loadding...'); 
         
setTimeout(function(){
          $.ajax({
                         type: "POST",
                         url: url,
                         data:$("#previews").serialize(),
                         async: false,
                         success: function(data){
                          $("#reshow").fadeIn();
                          $("#reshow").html(data); 
                          $('.tck').fadeOut(5000,function(){
                                $('.tck').remove(); 
                             });                           
                          setTimeout(function(){ window.location.reload();},3000);
                         },
                         error:function (err){ //失败回调函数
                          $("#reshow").fadeIn();
                          $("#reshow").html(err); 
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             }); 
                      　　}
                  });
        },1000);
                return false; 
        }

   });

   //user edit

    $('#useredit').click(function() {
       err=0;
       url=$(this).attr('url');
       des =$(this).attr('data');
       if ($("#me_firstname").val()==""){
          $("#me_firstname").addClass('inputborder');
          return false;
       }else{
           $("#me_firstname").removeClass('inputborder');
       }
       if ($("#me_lastname").val()==""){
          $("#me_lastname").addClass('inputborder');
          return false;
       }else{
           $("#me_lastname").removeClass('inputborder');
       }
       if ($("#me_paswd").val()==""){
          $("#me_paswd").addClass('inputborder');
          return false;
       }else{
           $("#me_paswd").removeClass('inputborder');
       }

       if($("#ne_paswd").val()!=""){
        if ($("#ne_paswd").val().length<8){
           alert(des);
           $("#ne_paswd").addClass('inputborder');
           return false;
        }else{
           $("#ne_paswd").removeClass('inputborder');
        }
       }

        $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
        $('.tck').fadeIn();
  setTimeout(function(){
          $.ajax({
                         type: "POST",
                         url: url,
                         data:$("#useredits").serialize(),
                         async: false,
                         success: function(data){
                          $('.tck').hide();
                          $('.tan').html('');
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             });                                 
                         },
                         error:function (err){ //失败回调函数
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'+err+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             }); 
                      　　}
                  });
        },1000);
                return false; 
        

    });

    //user regedit and user login

 $(document).on('click',"#userloginR",function(){
       //return false;
       err=0;
       url=$(this).attr('url');
       des =$(this).attr('data');
       var data=$('#userform').serializeArray();
      // console.log(data);
        $(data).each(function(i){
          if (this.name=="me_email"){
            if(!emreg.test(this.value)){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;             
            }else{
             $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;                 
            }
          }

          if (this.name=="me_paswd"){
            if (this.value.length<8){
             $('#' + this.name).addClass('inputborder');
             alert(des);
             err=0;
             return false;             
            }else{
             $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;                 
            }
          }

          if (this.value==""){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;
          }else{
            $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;
          }
        });
        if (err==1){
        $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
        $('.tck').fadeIn();
       setTimeout(function(){
          $.ajax({
                         type: "POST",
                         url: url,
                         data:$("#userform").serialize(),
                         async: false,
                         success: function(data){
                          $('.tck').hide();
                          $('.tan').html('');
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             });                                 
                         },
                         error:function (err){ //失败回调函数
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'+err+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                                window.location.reload();
                             }); 
                      　　}
                  });
        },1000);
                return false; 
        }
    });

//user address 

 $(document).on('click',"#adduseraddress",function(){

       //return false;
       lgid=$("#lgid").val();
       lurl=$("#murl").val();
       url=$(this).attr('url');
       var data=$('#AddressForm').serializeArray();
        //console.log(data);
        $(data).each(function(i){
          if (this.value=="" && this.name!="add_company"){
             $('#' + this.name).addClass('inputborder');
             err=0;
             return false;
          }else{
            $('#' + this.name).removeClass('inputborder');
             err=1;
             return true;
          }
        });
        if (err==1){
        $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
        $('.tck').fadeIn();
    setTimeout(function(){
          $.ajax({  
                         type: "POST",
                         url: url,
                         data:$("#AddressForm").serialize(),
                         async: false,
                         success: function(data){
                          $('.tck').hide();
                          $('.tan').html('');
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                             usersAddresslist(lgid,lurl);
                             $("#useraddress").html('');
                             });
                                                         
                         },
                         error:function (err){ //失败回调函数
                          $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'+err+'</div></div></div>'); 
                          $('.tck').fadeIn();
                          $('.tck').fadeOut(3000,function(){
                             usersAddresslist(lgid,lurl);
                             $("#useraddress").html('');
                             }); 
                      　　}
                  });
        },1000);
                return false; 
        }
    });

    //user out
    $(document).on('click',"#userout",function(){
         url=$(this).attr('url');
         $.ajax({url:url,async:false});
         window.location.reload();
     });

    //select address
    $(document).on('click',".Ant_member_address",function(){
        lgid = $("#lgid").val();
        url  = $("#murl").val();
        $(".Ant_member_address").removeClass("Ant_member_addressbd");
        $(this).find('input').prop('checked',true);
        counid=$(this).find('input').val();
        $("#ant_addressID").val(counid);
        $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=CountrySession&counid="+counid+"&lgid="+lgid,async:false}); 
        $(this).addClass("Ant_member_addressbd");
     });

    // express select
    $(document).on('click',".Ant_express li",function(){
        lgid = $("#lgid").val();
        url  = $("#murl").val();
        discode =$("#Ant_discounpon").html();
        $(".Ant_express li").removeClass("Ant_member_addressbd");
        $(this).find('input').prop('checked',true);
        expressid=$(this).find('input').val();
        price=$(this).find('input').attr("price");
        $("#ant_expressID").val(expressid);
        $(this).addClass("Ant_member_addressbd");
        prices=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=freightSession&price="+price+"&lgid="+lgid,async:false});//freight price
        $('#Ant_freight').html(prices.responseText);
        total=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=totalSession&price="+price+"&lgid="+lgid+"&discoderprice="+discode,async:false});  //total price
        $('#Ant_totals').html(total.responseText);
        $(".Ant_hide").fadeIn();
        $(".discountcode").fadeIn();

     });

    // payment select

    $(document).on('click',"#ant_payment li",function(){
        $("#ant_payment li").removeClass("Ant_member_addressbd");
        $(this).find('input').prop('checked',true);
        paymentid=$(this).find('input').val();
        price=$(this).find('input').attr("price");
        $("#ant_paymentID").val(paymentid);
        $(this).addClass("Ant_member_addressbd");
        $("#mem_4 i").removeClass('fa-pencil-square-o').addClass('fa-check-square-o');
     }); 

 
    //Check Out
     $('#CkeckOutPayment').click(function() {
        if($("#ant_paymentID").val()==""){
          alert($(this).attr('lable'));
          return false;
        }else{
          $(".Ant_user_top_right span").removeClass("slet");
          $("#splcorde").addClass("slet");
        $(document.body).append('<div class="tck"><div class="tans"><div class="tan"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i><br>Loadding...</div></div></div>'); 
        $('.tck').fadeIn();
         $("#Antcheckout").submit();

        }
     });

  //apply discountcode
     
     $('#discodeapp').click(aa=function() {
        discode=$("#discode").val();
        if (discode!=""){
            couponprice = $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=Counpon&discoupon="+discode+"&lgid="+lgid,async:false});//coupon price
            if (couponprice.responseText!=""){
              price = couponprice.responseText;
              $(".Ant_hides").fadeIn();
              $("#Ant_discounpon").html("-"+price);
              toprice = $("#Ant_totals").html();
              allptice = $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=couponprice&price="+price+"&lgid="+lgid+"&taol="+toprice,async:false}); 
              $("#Ant_totals").html(allptice.responseText);
              $("#discode").removeClass("inputborder"); 
              $("#discodeapp").css({"background":"#efefef","cursor":"not-allowed"});
              $(this).unbind('click');
              $("#couponID").val(discode);
              $("#discode").val('');
            }else{
              alert($("#discodeapp").attr('title'));
            }        
         }else{
          $("#discode").addClass("inputborder");
        }
     });

  // cancel discountcode
  $('#closediscp').click(function() {
      $(".Ant_hides").fadeOut();
      discounprice = $("#Ant_discounpon").html();
      toprice = $("#Ant_totals").html();
      allptice = $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=cancelcoupon&price="+discounprice+"&lgid="+lgid+"&taol="+toprice,async:false}); 
      $("#Ant_totals").html(allptice.responseText);
      $("#discodeapp").css({"background":"#3b3b3b","cursor":"pointer"});
      $("#discodeapp").bind('click',aa);
      $("#Ant_discounpon").html('');
      $("#couponID").val('');
  });
  // product list add to cart
  $('.Addcart').click(function() {
     ckname=$(this).attr("cookiename");
     lgid = $(this).attr("lgid");
     url = $(this).attr("url"); 
     $.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=WriteCk&lgid="+lgid+"&CkName="+ckname+"&Ckvalue=1",async:false}); 
     htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ReadCk&lgid="+lgid,async:false}); 
     $(".mycart").html(htmlobj.responseText);
     $(this).append(' <i class="fa fa-check" aria-hidden="true"></i>');
   });

  //view order

    $('.vieworder').click(function() {
         lgid = $("#lgid").val();
         url  = $("#murl").val();
         ordernb = $(this).attr("url");
          htmlobj=$.ajax({url:url+"Core/Program/Ant_Aajx.php?Antype=ViewOrder&lgid="+lgid+"&orderno="+ordernb,async:false}); 
         $(document.body).append('<div class="tck"><div class="tanviews"><div class="tanview">'+htmlobj.responseText+'<i class="fa fa-times-circle-o viewclose"  aria-hidden="true"></i></div></div></div>'); 
         $(".tck").fadeIn();

     });

    //close order
    $(document).on('click',".viewclose",function(){

      $(".tck").remove();

    });

});


  // del order

  function ConfimShowod(id,url,words,lgid){
  
    strs=words.split(",");
    $(document.body).append('<div class="tck"> <div class="tans"><div class="tan"></div></div></div>');
    $(".tck").fadeIn();
    $(".tan").html('<span onclick="HiddenDiv();" class="cancel">'+strs[1]+'</span><span class="confirm" onclick="CelarOrder(\''+id+'\',\''+url+'\',\''+lgid+'\');">'+strs[0]+'</span>');
  }

  function CelarOrder(id,url,lgid){
       data=$.ajax({url:url+"Core/Program/Ant_Rponse.php?actions=ClearOrder&lgid="+lgid+"&id="+id,async:false}); 
       $(document.body).append('<div class="tck"><div class="tans"><div class="tan">'+data.responseText+'</div></div></div>'); 
       $('.tck').fadeIn();
       $('.tck').fadeOut(3000,function(){
                window.location.reload();
            });                                 
          
  }



