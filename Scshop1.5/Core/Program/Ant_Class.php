<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
class WD_Data_Process{// add update del

        public function AntAdd($table,$field,$val,$db){// 增
                if($db->query("INSERT INTO  $table ($field) VALUES $val")){
                  return true;
                }else{
                  return false;
                }
            }

        public function AntEdit($table,$val,$id,$db){// 改       
            if($db->query("UPDATE $table set $val WHERE ID=$id")){
                  return true;
                }else{
                  return false;
                }              
            }
         public function AntEditAddress($table,$val,$id,$uid,$db){// 改 地址      
            if($db->query("UPDATE $table set $val WHERE ID=$id and userID=$uid")){
                  return true;
                }else{
                  return false;
                }              
            }
         public function AntEditGen($table,$val,$where,$db){// 通用修改  
            if($db->query("UPDATE $table set $val WHERE $where")){
                  return true;
                }else{
                  return false;
                }              
            }          
        public function AntDel($table,$id,$db){// 删          
            if($db->query("DELETE FROM  $table WHERE ID in ($id)")){
                  return true;
                }else{
                  return false;
                }
            }
        public function AntDelother($table,$id,$db){// 删          
            if($db->query("DELETE FROM  $table WHERE ID =$id")){
                  return true;
                }else{
                  return false;
                }
            }
         public function AntDelAddress($table,$id,$uid,$db){// 删 地址         
            if($db->query("DELETE FROM  $table WHERE ID =$id and userID=$uid")){
                  return true;
                }else{
                  return false;
                }
            }                          
        public function AntDelCat($table,$id,$db){// 删 -> 产品分类         
            if($db->query("DELETE FROM  $table WHERE  LOCATE(',".$id.",', category_path)>0")){
                  return true;
                }else{
                  return false;
                }
            }
        public function CheckData($table,$field,$str,$db){//数据查询
              if (mysqli_num_rows($db->query("SELECT * FROM $table WHERE $field='".$str."'"))>0){
                  $havedata="1";
              }else{
                  $havedata="0";
              }
              return $havedata;
            }
        public function CheckDatas($table,$str,$db){//通用数据查询
              if (mysqli_num_rows($db->query("SELECT * FROM $table WHERE $str"))>0){
                  $havedata="1";
              }else{
                  $havedata="0";
              }
              return $havedata;
            }

}
