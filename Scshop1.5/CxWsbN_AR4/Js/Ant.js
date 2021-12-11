 $(document).ready(function(){


   $("#zeke").change(function(){
    var opt=$("#zeke").val();
     htmlobj=$.ajax({url:"Ant_Ajax.php?sortID="+opt+"&sort=zeke",async:false}); 
     $("#zekelist").html(htmlobj.responseText);
   }); 


    var files=[];    
    var that = this;
    $("#uploads").click(function(){
        $("#file").trigger("change"); //原来是 click 更换成 change

    })

    $("#file").change(function(){     

        $("#viewImg").html('');
        $("#viewImg").show();       
        var img=document.getElementById("file").files; 
        var div=document.createElement("div"); 
        $("#imgurl").val($('#file').val());
        for(var i=0;i<img.length;i++){            
            var file=img[i]; 
            var url=URL.createObjectURL(file); 
            var box=document.createElement("img"); 
            box.setAttribute("src",url); 
            box.className='img';            
            var imgBox=document.createElement("div");
            imgBox.style.display='inline-block';
            imgBox.className='img-item';            
            var deleteIcon = document.createElement("span");
            deleteIcon.className = 'delete';
            deleteIcon.innerText = 'x';
            deleteIcon.dataset.filename = img[i].name;
            imgBox.appendChild(deleteIcon);
            imgBox.appendChild(box);            
            var body=document.getElementsByClassName("viewImg")[0]; 
            body.appendChild(imgBox);
            that.files = img;
            $(deleteIcon).click(function () {                
                var filename = $(this).data("filename");
                $(this).parent().remove();              
                var fileList = Array.from(that.files); 
                for(var j=0;j<fileList.length;j++){                    
                    if(fileList[j].name = filename){
                        fileList.splice(j,1);                        
                        break;
                    }
                }
                that.files = fileList;
                $("#imgurl").val('');

            })
        }
    })

    $(".ops").click(function(){//图片上传

    var ImageIds=$('#imgval').html();
        
    if ($("#file").val()===""){alert('请选择图片');return false;}
    var f = that.files;
    if (f.length>20){alert('一次只能上传20张');return false;}
    $('.yesshow span').html("图片正在上传中,请耐心等待");
    $('.yesshow').fadeIn();
    
    var uploadFile = new FormData($("#UpFile")[0]);    

    for(var i=0;i<f.length;i++){
                uploadFile.append('AntImg[]',f[i]);

        }
        if("undefined" != typeof(uploadFile) && uploadFile != null && uploadFile != ""){
        $.ajax({
            type: "POST",
            url: "Ant_upfile.php",
            data:uploadFile,
            async: false,                        
            cache: false,                        
            contentType: false, //不设置内容类型
            processData: false, //不处理数据                     
            success: function(data){
                           closed($('.antask').hide(), $('.antess'));
                                if(data.indexOf("Images") >= 0){//判断上传成功
                                   
                                     if (ImageIds=="Aimg"){ //产品图片
                                        $('#showimage').append(data);  
                                        $('#showimage').show();
                                        $("#rvimg").remove();
                                      }else if(ImageIds=="CAimg"){ //分类图片
                                        $('#showimage').html(data);
                                        $('#showimage').show();     
                                      }else if(ImageIds=="web_logo" || ImageIds=="web_ico"){ //logo与icon 
                                        $('#'+ImageIds).html('<input type="text" value="'+data+'" class="ant_input25" name="'+ImageIds+'">'); 
                                        $('#'+ImageIds).show();
                                      }else{
                                        $('#'+ImageIds).html(data); //属性图片
                                        $('#'+ImageIds).show();  
                                      }

                                }else{
                                 
                                    alert(data);
                                    $('.yesshow').fadeOut();
                                    return false;
                                }
                                $("#file").val('');
                                $("#imgname").val('');
                                $('.yesshow').fadeOut();
                              },
                               error:function (err){ //失败回调函数
                            　　　 $(".tan").html("err");
                                  $(".tck").fadeIn();
                                  $('.yesshow').fadeOut();
                            　　}
                        });
                 }else{
                 }
    });

 //点击显示商品目录

 $("#products_categorys").click(function(){
    $(".listcat").fadeIn();
 });

// 点击隐商品目录

 $("#an_cenl").click(function(){
    $(".listcat").fadeOut();
 });

//点击提交商品目录

 $("#an_save").click(function(){
  var str=''; var sid='';
  $("input[name='products_category[]']:checked").each(function(){
  if(this.checked)
  //alert($(this).attr("datavalue"));
   str+=$(this).attr("datavalue")+',';
  // sid+=$(this).val()+',';

});
  str=str.substring(0,str.length-1);
  $("#products_categorys").val(str);
  //$("#products_category").val(","+sid);
  if (str!=""){$(".listcat").fadeOut();}else{alert('请选择商品分类!')}
});


  $("body tr").mousemove(function(){
    $(this).addClass("bgon").siblings().removeClass("bgon").end();
  });     

 //table lab
  function tabs(tabTit,on,tabCon){
        $(tabTit).children().click(function(){
        var index = $(tabTit).children().index(this);
        $(this).addClass(on).siblings().removeClass(on);
        $(tabCon).children().eq(index).fadeIn(500).siblings().hide();
      });
  };
  tabs(".antit","ant_cat_tab_select",".antcon");

  $('.ant_left_c li').click(function() { //左菜单显示
        $('.ant_left_c li').find("ol").fadeOut();
      //if ($(this).find("ol").css('display')=="none"){
         $(this).find("ol").fadeIn();
      //} 
  });

  $('#imagebtn').click(function() {//显示遮罩
 
        $('.antask').css({'display': 'block'});
        $('#imgval').html($(this).attr("dataname"));
        center($('.antess'));
        //check($(this).parent(),$('.ops'), $('.cls'));
  });

 $(document).on('click','.imagebtn',function(){ //弹出框JQ 重新邦定
        $('.antask').css({'display': 'block'});
        $('#imgval').html($(this).attr("dataname"));
        center($('.antess'));
      });

  $('.addspan').click(function() {//显示遮罩
        //alert($(this).attr("dataID"));
        $('.antask').css({'display': 'block'});
        $('#suxin_id').val($(this).attr("dataID"));
        $('#suxname').html($(this).attr("dataName"));
        center($('.asuxin'));
        //check($(this).parent(),$('.ops'), $('.cls'));
  });



  function center(obj) {// 居中
        var screenWidth = $(window).width();
        screenHeight = $(window).height(); //当前浏览器窗口的 宽高
        var scrolltop = $(document).scrollTop();//获取当前窗口距离页面顶部高度
        var objLeft = (screenWidth - obj.width())/2 ;
        var objTop = (screenHeight - obj.height())/2 + scrolltop;
        obj.css({left: objLeft + 'px', top: objTop + 'px','display': 'block'});

    $(window).resize(function(){ //浏览器窗口大小改变时
        screenWidth = $(window).width();
        screenHeight = $(window).height();
        scrolltop = $(document).scrollTop();
        objLeft = (screenWidth - obj.width())/2 ;
        objTop = (screenHeight - obj.height())/2 + scrolltop;
        if ($(".antess").is(':visible')){
          obj.css({left: objLeft + 'px', top: objTop + 'px','display': 'block'});
        }else{
          obj.css({left: objLeft + 'px', top: objTop + 'px','display': 'none'});
        }
    });

    $(window).scroll(function(){//浏览器有滚动条时的操作
            screenWidth = $(window).width();
            screenHeight = $(window).height();
            scrolltop = $(document).scrollTop();
            objLeft = (screenWidth - obj.width())/2 ;
            objTop = (screenHeight - obj.height())/2 + scrolltop;
            if ($(".antess").is(':visible')){
              obj.css({left: objLeft + 'px', top: objTop + 'px','display': 'block'});
            }else{
              obj.css({left: objLeft + 'px', top: objTop + 'px','display': 'none'});
            }
        });
    }


   $(".cls").click(function(){ //关闭
        closed($('.antask'), $('.antess'));
  });

   $(".clss").click(function(){ //关闭
        closed($('.antask'), $('.asuxin'));
  });

  $("#wdshow").click(function(){ //开关显示

      open=$(this).attr("dataid");

      if(!$(this).hasClass("off")){
        $("#wdshow").removeClass('on'); 
        $("#wdshow").addClass('off');
        $("#"+open).val("0");
      }else {
        $("#wdshow").removeClass('off'); 
        $("#wdshow").addClass('on');
        $("#"+open).val("1");
      }
  });

  function closed(obj1, obj2){ // 隐藏的操作
        obj1.hide();
        obj2.hide();
        $("#imgurl").val('');
        $("#viewImg").hide();
         $("#file").val('');
    }
});

function counum(zd,js){ //计数
      var nub=$('#'+zd).val().split('');
      var cous=nub.length;
      if (cous<=js){
        $('#'+zd+'s').text(cous);
      }else{
        alert('数字不能超过'+js);
      }
    }

function datas(arry,action,sort,lgid,local,form){// 验证表单
    var err = 0;
    var arrys = arry.split(',');
     $(arrys).each(function(index, value){      
      if(!$('#' + value).val()){       
            $('#' + value).addClass('inpborder');
          //  alert('#' + value);
            err=1;
          }else{          
            $('#' + value).removeClass('inpborder'); 
           }          
         }); 
        if(err===1){
            if (sort=="pro"){
                 alert('商品目录,商品名称,商品价格,详细描述,商品重量\n必填');
                }else{
                  alert('*带星号的必填');
                }
            return false;
          }else{
               $('.yesshow span').html('数据正在保存中...');
               $('.yesshow').fadeIn();
               //return false;
               $.ajax({ //数据提交
                     type: "POST",
                     url: "Ant_Inc.php?action="+action+"&sort="+sort+"&lgid="+lgid,
                     data:$("#"+form).serialize(),
                     async: false,
                     success: function(data){
                            if (form=="formproperty"){ // 属性 ajax list
                              var loadid=$("#suxin_id").val();
                              var itemnb=$("#itemnbs").val();
                               htmlobj=$.ajax({url:"Ant_Ajax.php?suxin_id="+loadid+"&itemnb="+itemnb+"&sort="+sort,async:false});
                               $("#s"+loadid).html(htmlobj.responseText);
                               $("#addsx").html('');$("#pt_name").val('');$("#pt_price").val('');$("#pt_kc").val('');$("#sxx1").html('');
                               $('.antask').hide();$('.asuxin').hide();
                               $('.yesshow span').html(data);
                               $('.yesshow').fadeIn();
                               $('.yesshow').fadeOut(3000);

                            }else{
                              $('.yesshow span').html(data);
                              $('.yesshow').fadeIn();
                              $('.yesshow').fadeOut(3000,function(){
                               location.href=local;
                             });
                            }   
                     },
                     error:function (err){ //失败回调函数
                          $('.yesshow').fadeOut();
                          $('.errshow').fadeIn();
                    　　　 $('.errshow span').html("出错,请联系管理员");
                          $('.errshow').fadeOut(30000);
                  　　}
              });
  
               return false;
          }
    }

function delCheck(action,id,sort,local,suxinid,itemnb){ //删除
        var suxinid=suxinid||"";
        var itemnb =itemnb||"";
        if (!confirm("确认要删除?不可恢复,相关信息都会删除")){
            return false;
        }else{
            returninfo=$.ajax({url:"Ant_Inc.php?action="+action+"&sortID="+id+"&sort="+sort,async:false});
            if (sort=="property"){
                      var itemnb=$("#itemnbs").val();
                      htmlobj=$.ajax({url:"Ant_Ajax.php?suxin_id="+suxinid+"&itemnb="+itemnb+"&sort="+sort,async:false});
                      $("#s"+suxinid).html(htmlobj.responseText);
                      $('.yesshow').fadeIn();
                      $('.yesshow span').html(returninfo.responseText);
                      $('.yesshow').fadeOut(3000);
            }else{
                       $('.yesshow').fadeIn();
                       $('.yesshow span').html(returninfo.responseText);
                       $('.yesshow').fadeOut(3000,function(){
                       location.href=local;
                        });
            }

        }
}
 
function OnOff(action,id,sort,field,value,style,suxinid){ //显示与推荐
        var suxinid=suxinid||"";
        returninfo=$.ajax({url:"Ant_Inc.php?action="+action+"&sortID="+id+"&sort="+sort+"&f="+field+"&v="+value,async:false});
        if ((returninfo.responseText).length<2){
            if (sort=="property"){

                      var itemnb=$("#itemnbs").val();
                      htmlobj=$.ajax({url:"Ant_Ajax.php?suxin_id="+suxinid+"&itemnb="+itemnb+"&sort="+sort,async:false});
                      $("#s"+suxinid).html(htmlobj.responseText);
                      $('.yesshow').fadeIn();
                      $('.yesshow span').html('操作成功');
                      $('.yesshow').fadeOut(3000);
            }else{

                 $('.yesshow').fadeIn();
                 $('.yesshow span').html('操作成功');
                 $('.yesshow').fadeOut(2000,function(){
                    location.reload();
                  });
              }        
        }else{
           $('.errshow').fadeIn();
           $('.errshow').append(returninfo.responseText);
           $('.errshow').fadeOut(3000,function(){
           location.reload();
            });
        }
 }


function ApplyTm(url){ //模版应用
      htmlobj=$.ajax({url:url,async:false});
      $('.yesshow').fadeIn();
      $('.yesshow span').html(htmlobj.responseText);
      $('.yesshow').fadeOut(3000,function(){
                    location.reload();
      });
}

function imgzooms(id){ //图片显示
    imgurl=$("#s"+id).attr("src");
    $("#"+id).empty();
    $("#"+id).append('<img src="'+imgurl+'" width="300">');
    $("#"+id).fadeIn();
}
function imgzoom(id){ //图片隐掉
    $("#"+id).fadeOut();
    $("#"+id).empty();
    
}

 

// function imgurls() { //图片预览
//   $("#viewImg").html('');
 
//  var that = this;
//   $("#imgurl").val($('#file').val());
//     img = document.getElementById('file').files;
//      that.files = img;
//     for(var i=0;i<img.length;i++){
 
//           Imgul=URL.createObjectURL(img[i]);
     
//           $('#viewImg').append('<img src="'+Imgul+'" width="50">');
  
//         } 
//       $("#viewImg").show();       
// }

function px(str,suxinid){ //更改排序
        var suxinid=suxinid||"";
        var td = $("#"+str+"");
        var txt = td.text();
        var input = $("<input type='text' value='" + txt + "' class='pxinput' />");
        td.html(input);
        input.click(function() { return false; });
        //获取焦点
        input.trigger("focus");
        //文本框失去焦点后提交内容，重新变为文本
        input.blur(function() {
              var newtxt = $(this).val();
              //alert(newtxt);
              //判断输入的是否数字 
              var ex = /^\d+(\.\d+)?$/;
              if (!ex.test(newtxt) && str.indexOf("pn")<0) {
                 alert('请输入有效数字!');
                 return false;
              }
              //获取需要执行的链接
              var actionurl=$("#c"+str+"").text();
              //判断文本有没有修改
              if (newtxt != txt){  
              td.html(newtxt);
                      returninfo=$.ajax({url:"Ant_Inc.php?"+actionurl+"&v="+newtxt,async:false});
                      if ((returninfo.responseText).length<2){

                        if (actionurl.indexOf("property")>0){ //属性列表操作
                                  var itemnb=$("#itemnbs").val();
                                  htmlobj=$.ajax({url:"Ant_Ajax.php?suxin_id="+suxinid+"&itemnb="+itemnb+"&sort=property",async:false});
                                  $("#s"+suxinid).html(htmlobj.responseText);
                                  $('.yesshow').fadeIn();
                                  $('.yesshow span').html('操作成功');
                                  $('.yesshow').fadeOut(3000);
                        }else{
                           $('.yesshow').fadeIn();
                           $('.yesshow').append('操作成功');
                           $('.yesshow').fadeOut(2000,function(){
                              location.reload();
                            });
                         }

                      }else{
                         $('.errshow').fadeIn();
                         $('.errshow').append(returninfo.responseText);
                         $('.errshow').fadeOut(3000,function(){
                         location.reload();
                          });
                      }
              }
              else{
                td.html(newtxt);
              }
        });
}

function delImg(id){ //移除项目
  $("#"+id).remove();
  var inputqty=$("input[name='ant_img[]']").length;
  if(inputqty<1){ //当图片删除为空时 fu 空值
    $("#showimage").html('<p id="rvimg"><input type="hidden" name="ant_img[]" class="ant_input_slow"></p>');
  }else{// 不为空时清除
    $("#rvimg").remove();
  }
}


var aNumber = 999;
function Addzk(){  //折扣
        aNumber++;
        $("#addzk").append("<dd class=\"zeke\" id=\"zk"+aNumber+"\"><span><input type=\"text\" class=\"ant_input27\"   name=\"di_qty[]\"></span><span><input type=\"text\"  class=\"ant_input27\" name=\"di_price[]\"   > </span><span><i title=\"删除\" class=\"fa fa-minus-square\" aria-hidden=\"true\" onclick=\"javascript:delImg('zk"+aNumber+"');\"></i></span></dd>");
}  

 
function Addsx(){  //属性
        aNumber++;
        $("#addsx").append("<div class=\"sx\" id=\"sx"+aNumber+"\"><span><input type=\"text\"  class=\"ant_input28\" name=\"pt_name[]\"  ></span><span><input type=\"text\" onblur=\"value=value.replace(/[^\\d.]/g,'')\"  class=\"ant_input28\" name=\"pt_price[]\"  ></span> <span><input type=\"text\" onblur=\"value=value.replace(/[^\\d]/g,'')\"  class=\"ant_input28\" name=\"pt_kc[]\"  ></span><span><p id=\"sxx"+aNumber+"\"></p><font dataname=\"sxx"+aNumber+"\" class=\"an_submit_up trans imagebtn\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></font></span> <span style=\"padding-top: 10px;\"><i class=\"fa fa-minus-square\" aria-hidden=\"true\" onclick=\"javascript:delImg('sx"+aNumber+"');\"></i></span></div>");
}  
//<input type=\"hidden\" name=\"ant_img[]\">
//判断是否选中
function selects(id){

  if($("#"+id).is(":checked")==true){
    $("#s"+id).val(1);
  }else{
    $("#s"+id).val(0);
  }
}
 //全选 与全清
function checkAll(name) { 
    var el = document.getElementsByTagName('input'); 
    var len = el.length; 
      for(var i=0; i<len; i++) { 
          if((el[i].type=="checkbox") && (el[i].name==name)) { 
          el[i].checked = true; 
          } 
        } 
} 
function clearAll(name) {
    var el = document.getElementsByTagName('input'); 
    var len = el.length; 
        for(var i=0; i<len; i++) { 
              if((el[i].type=="checkbox") && (el[i].name==name)) { 
              el[i].checked = false; 
              } 
        } 
} 

//产品列表操作

function chgpro(newUrl,type,local){
    if (type=="del"){
        if (!confirm("确认要删除?不可恢复!")) {
            //window.event.returnValue = false;
            return false;
        }
      }
      //用 ajax
      $.ajax({ //数据提交
                     type: "POST",
                     url: newUrl,
                     data:$("#pform").serialize(),
                     async: false,
                     success: function(data){
                          if (data=="err"){
                              $('.yesshow').fadeOut();
                              $('.errshow').fadeIn();
                    　　　     $('.errshow span').html("请选择需要操作的内容");
                              $('.errshow').fadeOut(3000);
                          }else{
                              $('.yesshow span').html(data);
                              $('.yesshow').fadeIn();
                              $('.yesshow').fadeOut(3000,function(){
                               location.href=local;
                             });
                            }
                              
                     },
                     error:function (err){ //失败回调函数
                          $('.yesshow').fadeOut();
                          $('.errshow').fadeIn();
                    　　　 $('.errshow span').html("出错,请联系管理员");
                          $('.errshow').fadeOut(30000);
                  　　}
              });

            return false;
}

function login(arry,sort,form,local){ //login

 var err = 0;
    var arrys = arry.split(',');
     $(arrys).each(function(index, value){      
      if(!$('#' + value).val()){       
            $('#' + value).addClass('inpborder');
          //  alert('#' + value);
            err=1;
          }else{          
            $('#' + value).removeClass('inpborder'); 
           }          
         }); 
        if(err===1){
            alert('账号密码必填');
            return false;
          }else{
               $('.yesshow span').html('正在登陆...');
               $('.yesshow').fadeIn();
               //return false;
               $.ajax({ //数据提交
                     type: "POST",
                     url: "Ant_Ajax.php?sort="+sort,
                     data:$("#"+form).serialize(),
                     async: false,
                     success: function(data){
                            if (data=="3"){ // 属性 ajax list
                               location.href=local;
                             }else{
                              $('.yesshow').fadeOut();
                              $('.errshow').fadeIn();
                        　　　 $('.errshow span').html(data);
                              $('.errshow').fadeOut(3000);
                             }
                           
                     },
                     error:function (err){ //失败回调函数
                          $('.yesshow').fadeOut();
                          $('.errshow').fadeIn();
                    　　　 $('.errshow span').html("出错,请联系管理员");
                          $('.errshow').fadeOut(30000);
                  　　}
              });
  
               return false;
          }
}

//运费方式选择

function Frees(id){

    if (id=="1"){
        $("#freeot").fadeOut();
        $("#freef").fadeOut();
    }else if(id=="2" || id=="3"){
        $("#freeot").fadeIn();
        $("#freef").fadeOut();
    }else if(id=="4"){
        $("#freeot").fadeOut();
        $("#freef").fadeIn();      
    }

}

var checkflag = "false";
function check(field) {
if (checkflag == "false") {
  for (i = 0; i < field.length; i++) {
    field[i].checked = true;
  }
  checkflag = "true";
  }else {
for (i = 0; i < field.length; i++) {
    field[i].checked = false; 
}
checkflag = "false";
 }
}
//JS Cookies 操作

function setCookie(name,value){
var Days = 30;
var exp = new Date(); 
exp.setTime(exp.getTime() + Days*24*60*60*1000);
document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

//读取cookies
function getCookie(name){
var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
if(arr=document.cookie.match(reg)) return unescape(arr[2]);
else return null;
}

//删除cookies
function delCookie(arry){
 if (!confirm("确定退出?")) {return false;} 

 $.ajax({url:"Ant_Ajax.php?sort=Lgot",async:false});
   // var exp = new Date();
   // exp.setTime(exp.getTime() - 1);
   // var arrys = arry.split(',');
   // $(arrys).each(function(index,value){
   //    var cval=getCookie(value);
   //    if(cval!=null) document.cookie= value + "="+cval+";path=/;expires="+exp.toGMTString();
   //  });
   top.location.href='index.php';
}

//生成 Google地图
 
function Gsitemap(arry){
 if (!confirm("确定生成?")) {return false;} 

 $.ajax({url:"Ant_Ajax.php?sort=Sitemap",async:false});
  alert('成功生成!');
}

 
 