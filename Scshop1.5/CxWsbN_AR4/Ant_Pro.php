<?php include_once 'Ant_head.php';?>
<?php $table="sc_products";?>
<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 商品管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">商品添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab">附属信息</div>
				<div class="ant_cat_tab">属性设置</div>
				<div class="ant_cat_tab">运输设置</div>
				<div class="ant_cat_tab">SEO功能</div>
				<div class="ant_cat_tab">功能显示</div>
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">商品目录:</span> <div class="sdiv"><input type="text" id="products_categorys" readonly="readonly" class="ant_input"> <br><font class="note">* 商品目录,可多选</font>
							
						<div class="listcat">
							<ul class="listcatd"><li><span class="note">*选择商品目录,可多选</span> <span class="an_save" id="an_save">保存</span> <span class="an_cenl" id="an_cenl">取消</span></li></ul>
							<ul id="pcat">
							<?php echo get_strs("0",$lgid,"p",$db_conn,"0"); ?>
								
							</ul>

						</div>

						</div></li>
						<li><span class="aspn">产品名称:</span> <div class="sdiv"><input type="text" name="products_name" id="products_name" class="ant_input">  <br><font class="note">* 产品名称</font></div></li>
						<li><span class="aspn">标识图:<br>拖动图片可排序 </span><div class="sdiv"><span class="an_submit_up trans" dataname="Aimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage"></div> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 800px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span class="aspn">商城价格:</span> <div class="sdiv"><input type="text" onblur="value=value.replace(/[^\d\.]/g,'')" name="products_sprice" id="products_sprice" class="ant_input26">  <br><font class="note">* 只能输入数字</font></div></li>
						<li><span class="aspn">市场价格:</span> <div class="sdiv"><input type="text" onblur="value=value.replace(/[^\d\.]/g,'')" name="products_oprice" id="products_oprice" class="ant_input26">  <br><font class="note">只能输入数字</font></div></li>						
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="products_guige"></textarea> <br><font class="note">可加入html代码 如 br</font> </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"></textarea>  <br><font class="note"> * 商品详细描述,支持图文上传,自由编辑。</font></div></li>
						<li><span class="aspn">相关产品:</span> <div class="sdiv"><input type="text" name="products_similar" id="products_similar" class="ant_input29"> <span class="an_submit_up trans" onclick="window.open('Ant_Plist.php?lgid=<?php echo $lgid;?>','','status=no,scrollbars=yes,top=150,left=400,width=900,height=600')">选择产品</span> <br><font class="note">可输入产品ID号,ID与ID之间用英文逗号隔开.或者选择产品</font></div></li>							

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">供应商:</span> <div class="sdiv"><input type="text" name="products_parner" id="products_parner" class="ant_input26"  >   </div></li>
						<li><span class="aspn">起订量: </span><div class="sdiv"><input type="text" name="products_m" value="1" onblur="value=value.replace(/[^\d]/g,'')" class="ant_input26"> 最小起订量 <input type="text" name="products_b" value="0" onblur="value=value.replace(/[^\d]/g,'')" class="ant_input26"> 最大起订量 (0为最大)  </div></li>							
						<li><span class="aspn">产品型号: </span><div class="sdiv"><input type="text" name="products_model" class="ant_input">  </div></li>	
						<li><span class="aspn">SKU: </span><div class="sdiv"><input type="text" name="products_sku" class="ant_input">   </div></li>	
						<li><span class="aspn">库存: </span><div class="sdiv"><input type="text" value="1000" name="products_kucun" class="ant_input" onblur="value=value.replace(/[^\d]/g,'')" >  <br><font class="note">只能输入数字,默认 1000</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">属性设置:</span> 
							<div class="sdiv" id="suxins">
							 
                            <?php echo Suxin($db_conn);?> 
						   </div>
						</li>
 						<li><span class="aspn">折扣设置:</span> 
							<div class="sdiv" >
							  <select id="zeke" name="products_zk">
						      <option value="0">请选择折扣</option> 
						        <?php Zeke($db_conn);?>    
						      </select> <br><font class="note">折扣内容的数量及价格可调整</font>
						      <dd id="zekelist"></dd>
						   </div>
						</li>


					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">产品重量:</span> <div class="sdiv"><input type="text" onblur="value=value.replace(/[^\d]/g,'')" name="products_weight" id="products_weight"   class="ant_input26"> <input type="radio" checked="checked" name="products_dw" value="g"> 克(g)  <input type="radio" name="products_dw" value="kg"> 千克(kg) <br><font class="note">* 说明:重量选择克或者千克. 首重运费+(重量(公斤)×2-1)×续重运费</font> </div></li>
 
						<li><span class="aspn">包装体积:<br>单位(CM)</span> <div class="sdiv">长: <input type="text" onblur="value=value.replace(/[^\d.]/g,'')" name="products_l" id="products_l" class="ant_input26"> 宽: <input type="text" onblur="value=value.replace(/[^\d.]/g,'')" name="products_w" id="products_w" class="ant_input26"> 高: <input type="text" onblur="value=value.replace(/[^\d.]/g,'')" name="products_h" id="products_h" class="ant_input26">  <br><font class="note">说明:体积重=长cm×宽cm×高cm/5000 仅供参考</font> </div></li>
					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" name="products_meta" id="products_meta" class="ant_input" onkeyup="counum('products_meta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="products_metas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="products_key" class="ant_input">  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="products_des" onkeyup="counum('description','200');" maxlength="200"></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="products_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="products_zt" id="wdshow"></i> <input type="hidden" value="1" name="products_zt" id="products_zt">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv">  <input type="checkbox" id="products_index" onclick="selects('products_index');" ><input type="hidden" name="products_index" id="sproducts_index" value="0"> 推荐 <input type="checkbox" id="products_new" onclick="selects('products_new');"><input type="hidden" name="products_new" id="sproducts_new" value="0"> 最新 <input type="checkbox" id="products_hot" onclick="selects('products_hot');"><input type="hidden" name="products_hot" id="sproducts_hot" value="0"> 人气 <input type="checkbox"  id="products_tejia" onclick="selects('products_tejia');"><input type="hidden" name="products_tejia" id="sproducts_tejia" value="0"> 打折 <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">产品等级: </span><div class="sdiv"><input type="text" name="products_start" id="products_start" class="ant_input26" value="<?php echo(mt_rand(0,5));?>" onblur="value=value.replace(/[^\d]/g,'')"   maxlength="6">  <br><font class="note">* 最大5,只能填 0-5数字 0 为 无等级,此处随机自动填入,也可手动输入 </font></div></li>						
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="products_paixu" id="products_paixu" class="ant_input" value="1000" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font><input type="hidden" name="Itemnb" id="itemnbs" value="<?php echo $itemnb;?>"></div></li>

						

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('products_categorys,products_name,products_sprice,contents,products_weight','Add','pro','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
 $itemnb=$row['Itemnb'];
?>

 <div class="ant">
		<div class="ant_title">商品编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab">附属信息</div>
				<div class="ant_cat_tab">属性设置</div>
				<div class="ant_cat_tab">运输设置</div>
				<div class="ant_cat_tab">SEO功能</div>
				<div class="ant_cat_tab">功能显示</div>
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">商品目录:</span> <div class="sdiv"><input type="text" id="products_categorys" readonly="readonly" class="ant_input" value="<?php echo ReadCatName($db_conn,trim($row['products_category'],","));?>"> <br><font class="note">* 商品目录,可多选</font>
							
						<div class="listcat">
							<ul class="listcatd"><li><span class="note">*选择商品目录,可多选</span> <span class="an_save" id="an_save">保存</span> <span class="an_cenl" id="an_cenl">取消</span></li></ul>
							<ul id="pcat">
							<?php echo get_strs("0",$lgid,"p",$db_conn,$row['products_category']); ?>
								
							</ul>

						</div>

						</div></li>
						<li><span class="aspn">产品名称:</span> <div class="sdiv"><input type="text" value="<?php echo $row['products_name']; ?>" name="products_name" id="products_name" class="ant_input">  <br><font class="note">* 产品名称</font></div></li>
						<li><span class="aspn">标识图:<br>拖动图片可排序 </span><div class="sdiv"><span class="an_submit_up trans" dataname="Aimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">
							<?php
							$ant_img=trim($row['ant_img'],",");
						    if (!empty($ant_img)){
								$img=explode(",",rtrim($row['ant_img'],",")); 
								foreach ($img as $value) {
									$date = date("ymdhis").'_'.rand(100,9999);
				                    echo '<span id="Img'.$date.'"><img src="'.$value.'" /><input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.$value.'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br></span>';
				                     }
			                  }
			                ?>
						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 800px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span class="aspn">商城价格:</span> <div class="sdiv"><input type="text" value="<?php echo $row['products_sprice']; ?>" onblur="value=value.replace(/[^\d\.]/g,'')" name="products_sprice" id="products_sprice" class="ant_input26">  <br><font class="note">* 只能输入数字</font></div></li>
						<li><span class="aspn">市场价格:</span> <div class="sdiv"><input type="text" value="<?php echo $row['products_oprice']; ?>" onblur="value=value.replace(/[^\d\.]/g,'')" name="products_oprice" id="products_oprice" class="ant_input26">  <br><font class="note">只能输入数字</font></div></li>						
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="products_guige"><?php echo $row['products_guige']; ?></textarea> <br><font class="note">可加入html代码 如 br</font> </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo $row['contents']; ?></textarea>  <br><font class="note"> * 商品详细描述,支持图文上传,自由编辑。</font></div></li>
						<li><span class="aspn">相关产品:</span> <div class="sdiv"><input type="text" name="products_similar" id="products_similar" value="<?php echo $row['products_similar'];?>" class="ant_input29"> <span class="an_submit_up trans" onclick="window.open('Ant_Plist.php?lgid=<?php echo $lgid;?>','','status=no,scrollbars=yes,top=150,left=400,width=900,height=600')">选择产品</span> <br><font class="note">可输入产品ID号,ID与ID之间用英文逗号隔开.或者选择产品</font></div></li>							

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">供应商:</span> <div class="sdiv"><input class="ant_input26"  type="text" value="<?php echo $row['products_parner'];?>" name="products_parner" id="products_parner"   >   </div></li>
						<li><span class="aspn">起订量: </span><div class="sdiv"><input type="text" name="products_m" value="<?php echo $row['products_m'];?>" onblur="value=value.replace(/[^\d]/g,'')" class="ant_input26"> 最小起订量 <input type="text" value="<?php echo $row['products_b'];?>" name="products_b" value="0" onblur="value=value.replace(/[^\d]/g,'')" class="ant_input26"> 最大起订量 (0为最大)  </div></li>							
						<li><span class="aspn">产品型号: </span><div class="sdiv"><input class="ant_input26" type="text" value="<?php echo $row['products_model'];?>" name="products_model">  </div></li>	
						<li><span class="aspn">SKU: </span><div class="sdiv"><input class="ant_input26" type="text" value="<?php echo $row['products_sku'];?>" name="products_sku">   </div></li>	
						<li><span class="aspn">库存: </span><div class="sdiv"><input class="ant_input26" type="text" value="<?php echo $row['products_kucun'];?>" name="products_kucun"  onblur="value=value.replace(/[^\d]/g,'')" >  <br><font class="note">只能输入数字,默认 1000</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">属性设置:</span> 
							<div class="sdiv" id="suxins">
							 
                            <?php echo Suxin($db_conn,$row['Itemnb']);?> 
						   </div>
						</li>
 						<li><span class="aspn">折扣设置:</span> 
							<div class="sdiv" >
							  <select id="zeke" name="products_zk">
						      <option value="0">请选择折扣</option> 
						        <?php Zeke($db_conn,$row['products_zk']);?>    
						      </select> <br><font class="note">折扣内容的数量及价格可调整</font>
						      <dd id="zekelist">
						      	
							      <?php
							        $i=1;

							       if (!empty($row['products_zk'])){
							            $products_zeke=explode(",", $row['products_zeke']);
							            foreach ($products_zeke as  $value) {
							              echo '<input type="text" name="products_zeke[]" class="ant_input26" value="'.$value.'"> ';
							              if($i%2==0){ echo '<br><br>';}
							              $i=$i+1;
							            }
							        }

							       ?>

						      </dd>
						   </div>
						</li>


					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">产品重量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['products_weight'];?>"  onblur="value=value.replace(/[^\d]/g,'')" name="products_weight" id="products_weight"   class="ant_input26"> <input type="radio" <?php if($row['products_dw']=="g"){ echo 'checked="checked"';}?> name="products_dw" value="g"> 克(g)  <input type="radio" name="products_dw" value="kg" <?php if($row['products_dw']=="kg"){ echo 'checked="checked"';}?>> 千克(kg) <br><font class="note">* 说明:重量选择克或者千克. 首重运费+(重量(公斤)×2-1)×续重运费</font> </div></li>
 
						<li><span class="aspn">包装体积:<br>单位(CM)</span> <div class="sdiv">长: <input type="text" value="<?php echo $row['products_l'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="products_l" id="products_l" class="ant_input26"> 宽: <input type="text" value="<?php echo $row['products_w'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="products_w" id="products_w" class="ant_input26"> 高: <input type="text" value="<?php echo $row['products_h'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="products_h" id="products_h" class="ant_input26">  <br><font class="note">说明:体积重=长cm×宽cm×高cm/5000 仅供参考</font> </div></li>
					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" value="<?php echo $row['products_meta'];?>" name="products_meta" id="products_meta" class="ant_input" onkeyup="counum('products_meta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="products_metas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" value="<?php echo $row['products_key'];?>"  name="products_key" class="ant_input">  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="products_des" onkeyup="counum('description','200');" maxlength="200"><?php echo $row['products_des'];?></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" value="<?php echo $row['products_url'];?>" name="products_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if ($row['products_zt']==1){echo "on";}else{echo"off";}?>"  aria-hidden="true" dataid="products_zt" id="wdshow"></i> <input type="hidden" value="<?php echo $row['products_zt'];?>" name="products_zt" id="products_zt">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv">  <input type="checkbox" onclick="selects('products_index');" id="products_index" <?php if($row['products_index']==1){echo "checked";}?> > <input type="hidden" name="products_index" id="sproducts_index" value="<?php echo $row['products_index'];?>" > 推荐 <input type="checkbox" id="products_new" onclick="selects('products_new');" <?php if($row['products_new']==1){echo "checked";}?> ><input type="hidden" name="products_new" id="sproducts_new" value="<?php echo $row['products_new'];?>" > 最新 <input type="checkbox"  id="products_hot" onclick="selects('products_hot');" <?php if($row['products_hot']==1){echo "checked";}?> > <input type="hidden" name="products_hot" id="sproducts_hot" value="<?php echo $row['products_hot'];?>"> 人气 <input type="checkbox"  id="products_tejia" onclick="selects('products_tejia');" <?php if($row['products_tejia']==1){echo "checked";}?> ><input type="hidden" name="products_tejia" id="sproducts_tejia"  value="<?php echo $row['products_tejia'];?>"  > 打折 <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">产品等级: </span><div class="sdiv"><input type="text" name="products_start" id="products_start" class="ant_input26" value="<?php echo $row['products_start'];?>" onblur="value=value.replace(/[^\d]/g,'')"   maxlength="6">  <br><font class="note">* 最大5,只能填 0-5数字 0 为 无等级,此处随机自动填入,也可手动输入 </font></div></li>						
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" class="ant_input26" value="<?php echo $row['products_paixu'];?>" name="products_paixu" id="products_paixu"  onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font><input type="hidden" name="Itemnb" id="itemnbs" value="<?php echo $row['Itemnb'];?>"></div></li>

					</ul>
				</div>
		    </div>


			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('products_categorys,products_name,products_sprice,contents,products_weight','Edit','pro','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_REQUEST["scat"])){$scat=$_REQUEST["scat"];}else{$scat="";} 
if (isset($_REQUEST["skey"])){$skey=$_REQUEST["skey"];}else{$skey="";} 

if ($scat!="" && $skey!=""){
		$pfy="&scat=".$scat."&skey=".$skey."";
	    $where=" and ".ProCatId($scat,$db_conn)." and (products_name like '%".$skey."%' or products_key like '%".$skey."%' or products_model like '%".$skey."%' or contents like '%".$skey."%' )";
}elseif($scat=="" && $skey!=""){
        $pfy="&skey=".$skey."";
		$where=" and (products_name like '%".$skey."%' or products_key like '%".$skey."%' or products_model like '%".$skey."%' or contents like '%".$skey."%' )";
}elseif ($scat!="" && $skey=="") {
        $pfy="&scat=".$scat."";
	    $where=" and ".ProCatId($scat,$db_conn);
}else{
        $pfy="";
	    $where="";
}

 ?>

<div class="ant">
	<div class="ant_title" style="position: relative;">商品管理<font class="cl">（带星*的必填）</font>
		<div style="width: 60%; position: absolute; left: 28%; top: 23%;">
		<form name="sform" method="post" action="?lgid=<?php echo $lgid;?>">
			<select name="scat" ><option value="">请选择</option><?php echo get_strs("0",$lgid,"list",$db_conn,$scat);?></select> 
			<input type="text" name="skey" class="ant_input29" placeholder="输入产品名称,型号,关键词查询" value="<?php echo $skey;?>"> 
			<input type="submit" class="an_submit_up trans" value="搜索">
	    </form>
	  </div>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加商品</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>标识图 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击图片放大"></i></th><th>型号</th><th width="30%">名称</th><th>价格 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></th><th>重量 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></th><th>推荐<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>最新<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>人气<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>打折<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>显示<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th width="70">排序 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table where languageID=".$lgid.$where."");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table where languageID=".$lgid.$where." order by products_paixu, ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 	$Image=explode(",", $row['ant_img']);
	 	$Image=$Image[0];
	 	if (empty($Image)){$mg='<i class="fa fa-file-image-o" aria-hidden="true"></i>';}else{ $mg='<img src="'.$Image.'" width="60" title="点击可放大" id="simg'.$row['ID'].'"><div id="img'.$row['ID'].'" style="position:absolute;left:5px; display:none; z-index:10;top:2px;padding:5px;border:1px solid #efefef; background:#fff;"><img src="'.$Image.'"" width="300"></div>';} 
	 	if($row['products_index']==1){$of="on";$tj=1;}else{$of="off";$tj=0;}
	 	if($row['products_new']==1){$nof="on";$new=1;}else{$nof="off";$new=0;}
	 	if($row['products_hot']==1){$hof="on";$hot=1;}else{$hof="off";$hot=0;}
	 	if($row['products_tejia']==1){$tof="on";$te=1;}else{$tof="off";$te=0;}
	 	if($row['products_tejia']==1){$tof="on";$te=1;}else{$tof="off";$te=0;}
	 	if($row['products_zt']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
	 	if (!empty(trim($row['products_url']))){
	 		$ulink = "../".trim($row['products_url']).".html";
	 	}else{
	 		$ulink = "../".trim($row['ID']).".html";
	 	}
?>	 
		<tr>
			<td ><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td bgcolor="#fafafa" onclick="imgzooms('img<?php echo $row['ID'];?>');" onmouseleave="imgzoom('img<?php echo $row['ID'];?>');" style='position:relative;'><?php echo $mg;?></td>
			<td><?php echo $row['products_model'] ;?></td>
			<td bgcolor="#fafafa"><?php echo $row['products_name'];?> <a href='<?php echo $ulink;?>' target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> 预览</a></td>
			<td onclick="px('jg<?php echo $row["ID"];?>');" id='jg<?php echo $row["ID"];?>'><?php echo $row['products_sprice']; ?></td>
			<td bgcolor="#fafafa"><span onclick="px('zl<?php echo $row["ID"];?>');" id='zl<?php echo $row["ID"];?>'><?php echo $row['products_weight'];?></span><?php echo $row['products_dw']; ?></td>
			<td><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','pro','products_index','<?php echo $tj;?>','tj');" class="fa fa-toggle-on fa-2x <?php echo $of;?>"  aria-hidden="true" id="'tj<?php echo $row["ID"];?>'" ></i></td>
			<td bgcolor="#fafafa"><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','pro','products_new','<?php echo $new;?>','new');" class="fa fa-toggle-on fa-2x <?php echo $nof;?>"  aria-hidden="true" id="'new<?php echo $row["ID"];?>'" ></i></td>
			<td><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','pro','products_hot','<?php echo $hot;?>','hot');" class="fa fa-toggle-on fa-2x <?php echo $hof;?>"  aria-hidden="true" id="'hot<?php echo $row["ID"];?>'" ></i></td>
			<td bgcolor="#fafafa"><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','pro','products_tejia','<?php echo $te;?>','te');" class="fa fa-toggle-on fa-2x <?php echo $tof;?>"  aria-hidden="true" id="'te<?php echo $row["ID"];?>'" ></i></td>
			<td  ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','pro','products_zt','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
		   <td bgcolor="#fafafa" onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['products_paixu'];?></td>
		   <td>
		   	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=pro&f=products_paixu</span> 
<span id='cjg<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=pro&f=products_sprice</span>
<span id='czl<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=pro&f=products_weight</span>
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid; ?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> <span class="an_1 trans" onclick="location.href='?action=Copy&sort=pro&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid; ?>'"> <i class="fa fa-file-text-o" aria-hidden="true"></i> 复制</span></td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=pro&lgid=<?php echo $lgid;?>','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back",$pfy);?></span></td></tr>
	</table>
</form>
</div>

<?php }?>

<div class="antask"></div>
<div class="antess">
	<div class="antitle">文件(一次最多上传20张)按Ctrl点选图片<span class="cls"><i class="fa fa-times" aria-hidden="true"></i></span></div>
	<form id="UpFile" onsubmit="return false"  action="#" method="post" enctype="multipart/form-data">
    <div class="imgcontent" >
    	
    	<ul>
    		<li><label class="labal">自定文件名：</label><input type="text" name="imgname" id="imgname" class="imginput" onblur="value=value.replace(/[^\d\w-]/g,'')"><br></li>
    		<li class="cl">可不填,填写格式 a-b-c-d 词之间用-链接,不能有空格,不能有重名,只能数字与字母</li>
    		<li><label class="labal">上传文件：</label><input type="hidden" name="imgurl" id="imgurl" class="imginput" readonly><span class="uploads" id="uploads">浏览..<input  type="file" id="file" multiple> </span> <span class="cls">取消</span><span class="ops">确定</span></li>
    		<li><div id="viewImg" class="viewImg"></div> <span id="imgval"></span> <input type="hidden" name="doument" value="Image"><input type="hidden" name="save_url" value="../Images/product/"></li>
    	</ul>
       

    </div>
    </form>
</div>

<div class="asuxin">
	<form method="post" id="formproperty" action="#">
	<div class="antitle"><b><font id="suxname" color="#33b35a"></font>规格添加</b> PS:价格,数量,库存,图片可为空 点击+号可新增选项。<span class="clss"><i class="fa fa-times" aria-hidden="true"></i></span></div>
	<div><input type="hidden" name="suxin_id" id="suxin_id"><input type="hidden" name="itemnb" id="itemnb"  value="<?php echo $itemnb;?>" ></div>
	<div class="sx"><span>名称 * </span><span>价格</span> <span>库存</span><span>图</span> <span><i title="点击新增" class="fa fa-plus-square" aria-hidden="true" onclick="javascript:Addsx();"></i></span></div>
	<div class="sx" id="sx1"><span><input type="text"  class="ant_input28" name="pt_name[]" id="pt_name"></span><span><input type="text"  class="ant_input28 " name="pt_price[]" onblur="value=value.replace(/[^\d.]/g,'')" id="pt_price"></span> <span><input type="text" onblur="value=value.replace(/[^\d]/g,'')"  class="ant_input28" name="pt_kc[]" id="pt_kc"></span><span><p id="sxx1"></p><font dataname="sxx1" class="an_submit_up trans imagebtn" ><i class="fa fa-plus" aria-hidden="true"></i></font></span> <span style="padding-top: 10px;"><i class="fa fa-minus-square" aria-hidden="true" onclick="javascript:delImg('sx1');"></i></span></div>
	<div id="addsx"></div>

 			<div class="an"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('pt_name','Add','property','<?php echo $lgid;?>','<?php echo $FileSelf;?>','formproperty');"></div>
 </form>
</div>
<div style="clear:both"></div>
 <div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 