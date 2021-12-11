$(document).ready(function(){
      //up
      $(window).scroll(function(){
        var top=$(window).scrollTop();
        if(top>200){
          $("#rightTop").fadeIn();
        }else{
          $("#rightTop").fadeOut();
        }
      });
        $("#rightTop").click(function(){
           $("html,body").animate({scrollTop:0});
      });

   //table lab
    function tabs(tabTit,on,tabCon){
          $(tabTit).children().click(function(){
          var index = $(tabTit).children().index(this);
          $(this).addClass(on).siblings().removeClass(on);
          $(tabCon).children().eq(index).fadeIn(500).siblings().hide();
        });
    };

    tabs(".Ant_Proltab","Ant_select",".action");

    //fen lei

    $(".Ant_Cat ul li").click(function(){
            if($(this).find("ul").css("display")==="none"){
                $(this).find("ul").slideDown();
                $(this).find("i").removeClass("fa-angle-right").addClass("fa-angle-down");
            }else{
                $(this).find("ul").slideUp();
                $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-right");
            }
        });

     $(".Ant_top_3_cat p").click(function(){
            if($(".Ant_Cat").css("display")==="none"){
                $(".Ant_Cat").slideDown(0);
                $("#sright").removeClass("fa-angle-down").addClass("fa-angle-up");
            }else{
                $(".Ant_Cat").slideUp(0);
                $("#sright").removeClass("fa-angle-up").addClass("fa-angle-down");
            }
        });

      //search
      $("#Asbutton").click(function(){
            if($(".Ant_top_3_ser").css("display")==="none"){
                $(".Ant_top_3_ser").fadeIn();
                $(this).find("i").removeClass("fa-search").addClass("fa-times");
            }else{
                $(".Ant_top_3_ser").fadeOut();
               $(this).find("i").removeClass("fa-times").addClass("fa-search");
            }
        });

      //nav
      $("#Anbutton").click(function(){
            if($(".Ant_top_nav").css("display")==="none"){
                $(".Ant_top_nav").fadeIn();
                $(this).find("i").removeClass("fa-bars").addClass("fa-times");
            }else{
                $(".Ant_top_nav").fadeOut();
               $(this).find("i").removeClass("fa-times").addClass("fa-bars");
            }
        });



    //product focus

    $(".vimg li img").click(function(){
      $(".vimg li img").css("border","1px solid #efefef");
      $(this).css("border","1px solid #33b35a");
      $(".Ant_view_1_left_bimg img").attr("src",$(this).attr("src").replace("small/",""));
    });

    $(".Ant_sx_select,.Ant_select_border").click(function(){
      var spans=$(this).attr("data");
      $("#"+spans+" span").removeClass("Ant_sx_select").addClass("Ant_select_border");
      $(this).addClass("Ant_sx_select");
      var sxid=spans.replace("sp","sx");
      $("#"+sxid).val($(this).attr("id"));
      //get suxin id (2021-07-15)
     if ($("#canshu").val()!="qty"){ // check shi fo you sux xin
              var sxids=$("#canshu").val().replace(",qty","");
              var fh = $("#canshu").attr("fh");

                 sxids=sxids.split(",");
                 var suxprice=0;
         
                for (var i=0;i<sxids.length;i++)
                {

                   var vs=$("#"+sxids[i]).val();

                   var suxprice=suxprice+$("#"+vs).attr("titles")*1;

                   //alert($("#"+vs).attr("titles"));
                }

                if (suxprice>0){ //check sunxin zhi shi fo > 0

                 $("#spriced").html(fh+(suxprice).toFixed(2));
                  zk  = $("#sczk").attr("zk");
                  if (zk.length>0){
                      wdpric =  (suxprice).toFixed(2);
                      
                      Url =  $("#sczk").attr("url");
                      htmlobj=$.ajax({url:Url+"?Antype=ZKAjax&wdpric="+wdpric+"&zeke="+zk,async:false});
                      $("#sczk").html(htmlobj.responseText);
                 }

                }
     }

    });

    $("#subsearch").click(function(){
        if($("#search").val()===""){
           $("#search").addClass('inputborder');
           return false;
        }else{
           $("#search").removeClass('inputborder');
           return true;
        }
    });

});

 
// var cot=0;
// function nex(i){  
//  if(cot<=i){ 
//   $('.vimg li').eq(cot).animate({'margin-left':'-140px'},500);   
//    $('.Ant_view_1_left_bimg img').attr("src",$('.vimg li img').eq(cot+1).attr('src').replace("small/",""));
//     $('.vimg li img').css("border","1px solid #efefef");
//     $('.vimg li img').eq(cot+1).css("border","1px solid #33b35a");
//   cot++;
//   $("#leftl").removeClass('Ant_ccc');
//  }else{
//   $("#rightr").addClass('Ant_ccc');
//  }
// }
// function pre(){  
//  if(cot>0){    
//   cot--;    
//   $('.vimg li').eq(cot).animate({'margin-left':'10px'},500);
//   $('.Ant_view_1_left_bimg img').attr("src",$('.vimg li img').eq(cot).attr('src').replace("small/",""));
//     $('.vimg li img').css("border","1px solid #efefef");
//     $('.vimg li img').eq(cot).css("border","1px solid #33b35a");  
//    $("#rightr").removeClass('Ant_ccc');
//  }else{
//    $("#leftl").addClass('Ant_ccc');
//  }
// }

 
var cot=0;
function nex(i){  
 if(cot<=i){ 
  $('.vimg li').eq(cot).animate({'margin-top':'-120px'},500);   
   $('.Ant_view_1_left_bimg img').attr("src",$('.vimg li img').eq(cot+1).attr('src').replace("small/",""));
    $('.vimg li img').css("border","1px solid #efefef");
    $('.vimg li img').eq(cot+1).css("border","1px solid #33b35a");
  cot++;
  $("#leftl").removeClass('Ant_ccc');
 }else{
  $("#rightr").addClass('Ant_ccc');
 }
}
function pre(){  
 if(cot>0){    
  cot--;    
  $('.vimg li').eq(cot).animate({'margin-top':'0'},500);
  $('.Ant_view_1_left_bimg img').attr("src",$('.vimg li img').eq(cot).attr('src').replace("small/",""));
    $('.vimg li img').css("border","1px solid #efefef");
    $('.vimg li img').eq(cot).css("border","1px solid #33b35a");  
   $("#rightr").removeClass('Ant_ccc');
 }else{
   $("#leftl").addClass('Ant_ccc');
 }
}

 //Currency tab
 function ChangeCur(ID,Url){
  $.ajax({url:Url+"?Antype=Cur&Antvalue="+ID,async:false}); 
  window.location.reload();
}

//proudct des qty

function changeqty(sl,slb,qty){
  var qty=qty||"qty";
  var sl= parseInt(sl);
  var slb= parseInt(slb);
  var re=/^[1-9]+[0-9]*]*$/;
 if(!re.test($("#"+qty).val())){ //输入非数字的默认为起订量数字
       $("#"+qty).val(sl);
    }
  if (slb!==0){
       if (parseInt($("#"+qty).val())<sl || parseInt($("#"+qty).val())>slb){ //控制输入内容 默认为 起订量
       $("#"+qty).val(sl);
       }
   }else{
    if (parseInt($("#"+qty).val())<sl){
        $("#"+qty).val(sl);
    }
   }
}

//Add qty contrl
function QtyAdd(str,sl){
    var sl=parseFloat(sl);
    if (str=="Add"){
      if (sl==0){ //最大订量控制 0 属于无限制
          $("#qty").val(parseInt($("#qty").val())+parseInt(1));
      }else{
          if (parseInt($("#qty").val())<sl){
                $("#qty").val(parseInt($("#qty").val())+parseInt(1));
          }else{
                $("#qty").val(sl);
          }
      }
    }else{
      if (parseInt($("#qty").val())>sl){
                  $("#qty").val(parseInt($("#qty").val())-parseInt(1));
             }else{
                  $("#qty").val(sl);
             }
    }
  var wholeprice=$("#wholeprice").val();
if(wholeprice !== "" || wholeprice !== null || wholeprice !== undefined){ //切换批发价格高亮
    var qtysl=parseInt($("#qty").val());
    var strs = new Array();
        str = wholeprice; 
        strs = str.split(",");
        var j=2;
    for (i=0; i<strs.length; i++ ){
    　    var nb=strs[i].replace("+","");
          if (strs[i].indexOf("-")!= -1){
              nbs = nb.split("-");
             if (qtysl>=parseInt(nbs[0]) && qtysl<=parseInt(nbs[1])){
                tab=j;
                //console.log(j);
             } 
           }else{
              if(qtysl>=parseInt(nb)){
                tab=j;
              }
           }
           j=j+1;
      }
        $(".table td").removeClass("tabgreen");
        $(".table td:nth-child("+tab+")").addClass("tabgreen");
      }
  }
  
