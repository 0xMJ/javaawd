<?php include_once 'Ant_Inc.php';
  $Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);
  ?>
<?php
$image_array="";
//判段是否为空字符！
if (!empty($_FILES["AntImg"])){
  $files=$_FILES["AntImg"]; 
  //文档类型
  if (isset($_POST["doument"])){
    $doument_type = CheckStr($_POST["doument"]);
  }else{
    $doument_type = "";
  }
  //保存路径
  if (isset($_POST['save_url'])){
    $save_url = CheckStr($_POST['save_url']);
  }else{
    $save_url = "";
  }
  //自定文件名
  if (isset($_POST["imgname"])){
    $new_name = CheckStr($_POST["imgname"]);
  }else{
    $new_name = "";
  }

  foreach ($files['tmp_name'] as $index=>$file){
    // 如果是图像文件 检测文件格式
    $file_name = $files['name'][$index];
    //扩展名
    $kzm=explode(".",$file_name);
    //全部转换为小写
    $kzm=strtolower(end($kzm));
    //图片大小
    $img_size=$files['size'][$index];

    if (in_array($kzm,array('gif', 'jpg', 'jpeg', 'bmp', 'png','xlsx','xls','doc','docx','pdf','ppt','rar','zip','ico'))){
      if($doument_type=="Image"){
         $info = getimagesize($file); //获取图片信息
      }else{
         $info = true;
      }
      if (false === $info) {

           echo "不是有效图片,请重新选择";
        //   exit;
      }else{  
              //图片大小控制在 500 K以内
              if ($img_size > 1 && $img_size < 1024000){
                  //自定义文件名
                  if ($new_name!==""){ 
                     //新的文件名 
                      $new_names=$new_name.'_'.rand(100,9999).".".$kzm; 
                      $date = date("ymdhis").'_'.rand(100,9999); //
                  }else{
                       //随机数
                       $rand=rand(10,10000);
                       //文件名：时间+随机数
                       $date = date("ymdhis").'_'.$rand;
                       //新的文件名
                       $new_names=$date.".".$kzm; 
                  } //文件写入文件夹
                    move_uploaded_file($file,$save_url.$new_names);
              }else{
                  echo "1.请检查文件上传类型.\n 允许格式:jpe,gif,png,jpeg,bmp \n 2.上传大小500K之内.";
                  exit;
              }
              $imgUrl=str_replace("../../", "../", $save_url.$new_names);
              if($doument_type=="Image"){
                  $image_array.='<span id="Img'.$date.'"><img src="'.$imgUrl.'" /><input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.$imgUrl.'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br></span>';
                    if(strpos($imgUrl,'product/') !== false){//只针对产品图片生成小图 
                      $smallUrl=str_replace("product/","product/small/",$imgUrl);
                      $resizeimages = new resizeimages();
                      $resizeimage = $resizeimages->resizeimage("$imgUrl", "480", "480", "0","$smallUrl");
                    }                        
               }else if($doument_type=="Globals"){//logo与icon
                   $image_array=$imgUrl;               
               }else{ //下载文件上传
                    $image_array.='<input type="text" name="ant_img[]" size="70" style="float:left;" class="ant_input25" value="'.$imgUrl.'">';                  
               }

              echo $image_array;

           }
    }else{

        echo $file_name."\n 上传失败,重新选择 允许格式:jpe,gif,png,jpeg,bmp \n";
        //exit;
    }
    $image_array="";
  }
}else{
    echo "请选图片";
}


//使用如下类就可以生成图片缩略图,
class resizeimages{
    //图片类型
    var $type;
    //实际宽度
    var $width;
    //实际高度
    var $height;
    //改变后的宽度
    var $resize_width;
    //改变后的高度
    var $resize_height;
    //是否裁图
    var $cut;
    //源图象
    var $srcimg;
    //目标图象地址
    var $dstimg;
    //临时创建的图象
    var $im;
 
    function resizeimage($img, $wid, $hei,$c,$dstpath){
        $this->srcimg = $img;
        $this->resize_width = $wid;
        $this->resize_height = $hei;
        $this->cut = $c;
        //图片的类型
        $this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
        //初始化图象
        $this->initi_img();
        //目标图象地址
        $this -> dst_img($dstpath);
        //--
        $this->width = imagesx($this->im);
        $this->height = imagesy($this->im);
        //生成图象
        $this->newimg();
        ImageDestroy ($this->im);
    }
    function newimg(){
        //改变后的图象的比例
        $resize_ratio = ($this->resize_width)/($this->resize_height);
        //实际图象的比例
        $ratio = ($this->width)/($this->height);
        if(($this->cut)=="1"){//裁图
            if($ratio>=$resize_ratio){//高度优先
                  $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
              /* --- 用以处理缩放png图透明背景变黑色问题 开始 --- */ 
              if(strtolower($this->type)=='png'){
                  $color = imagecolorallocate($newimg,255,255,255); 
                  imagecolortransparent($newimg,$color); 
                  imagefill($newimg,0,0,$color); 
             }
               /* --- 用以处理缩放png图透明背景变黑色问题 结束 --- */ 

                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio){//宽度优先
                   $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
              /* --- 用以处理缩放png图透明背景变黑色问题 开始 --- */ 
              if(strtolower($this->type)=='png'){
                   $color = imagecolorallocate($newimg,255,255,255); 
                   imagecolortransparent($newimg,$color); 
                   imagefill($newimg,0,0,$color); 
             }
               /* --- 用以处理缩放png图透明背景变黑色问题 结束 --- */ 
                  imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                  ImageJpeg ($newimg,$this->dstimg);
            }
        }else{//不裁图

            if($ratio>=$resize_ratio){
                $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
              /* --- 用以处理缩放png图透明背景变黑色问题 开始 --- */ 
              if(strtolower($this->type)=='png'){
                 $color = imagecolorallocate($newimg,255,255,255); 
                 imagecolortransparent($newimg,$color); 
                 imagefill($newimg,0,0,$color); 
             }
               /* --- 用以处理缩放png图透明背景变黑色问题 结束 --- */ 
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio){
                 $newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
               /* --- 用以处理缩放png图透明背景变黑色问题 开始 --- */ 
              if(strtolower($this->type)=='png'){
                 $color = imagecolorallocate($newimg,255,255,255); 
                 imagecolortransparent($newimg,$color); 
                 imagefill($newimg,0,0,$color); 
             }
               /* --- 用以处理缩放png图透明背景变黑色问题 结束 --- */ 
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
    }
    //初始化图象
    function initi_img(){
        if($this->type=="jpg"){
            $this->im = imagecreatefromjpeg($this->srcimg);
        }
        if($this->type=="gif"){
            $this->im = imagecreatefromgif($this->srcimg);
        }
        if($this->type=="png"){
            $this->im = imagecreatefrompng($this->srcimg);
        }
    }
    //图象目标地址
    function dst_img($dstpath){
        $full_length  = strlen($this->srcimg);
        $type_length  = strlen($this->type);
        $name_length  = $full_length-$type_length;
        $name         = substr($this->srcimg,0,$name_length-1);
        $this->dstimg = $dstpath;
        //echo $this->dstimg;
    }
}
