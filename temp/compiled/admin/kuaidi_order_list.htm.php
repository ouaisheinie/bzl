<!-- $Id: bonus_type.htm 14216 2015-02-07 02:27:21Z derek $ -->
<style>
.mydiv{
background:#fff;
border:1px solid #bbb;
position: absolute;      /*绝对定位*/    
top: 50%;                  /* 距顶部50%*/    
left: 50%;                  /* 距左边50%*/    
height: 400px; margin-top: -200px;   /*margin-top为height一半的负值*/    
width: 650px; margin-left: -325px;    /*margin-left为width一半的负值*/
text-align: center;
line-height: 40px;
font-size: 12px;
font-weight: bold;
z-index:99999;
}
.mydiv2 {
float:left;
display:inline;
background:#fff;
border:1px solid #bbb;
text-align: center;
line-height: 40px;
font-size: 12px;
font-weight: bold;
z-index:99999;
width: 650px;
height: auto;
left:50%;/*FF IE7*/
top:53%;/*FF IE7*/
margin-left:-325px!important;/*FF IE7 该值为本身宽的一半 150 *2 =300 */
margin-top:-200px!important;/*FF IE7 该值为本身高的一半 60*2=120 */
margin-top:0px;
position:fixed!important;/*FF IE7*/
position:relative;/*IE6*/
_top:   expression(eval(document.compatMode &&
            document.compatMode=='CSS1Compat') ?
            documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
            document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);/*IE5 IE5.5*/

}
.mydiv-l{float:left;width:80%;border-bottom:1px solid #eee;background:#80bdcb;text-indent:20px;
font-family:"微软雅黑";font-size:16px;font-weight:normal;height:40px;line-height:40px;text-align:left;color:#fff;}
.mydiv-r{float:right;width:20%;background:#80bdcb url(images/cart_pop_close.png) no-repeat 90px 8px;
top:7px;right:-5px;height:40px;line-height:40px;cursor:pointer;}
.mydiv table{padding:10px;margin:0;}
.mydiv table td{line-height:130%;text-align:left;font-weight:normal;}
#PopAddressCon{clear:both;font-size:12px;}
</style>

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">
  <form action="javascript:searchUser()"  name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    &nbsp;<?php echo $this->_var['lang']['label_order_sn']; ?> <input type="text" name="order_sn" size="20" value="<?php echo $this->_var['filter']['order_sn']; ?>" />
	&nbsp;<?php echo $this->_var['lang']['label_postman']; ?><input type="text" name="postman_name" size="20" value="<?php echo $this->_var['filter']['postman_name']; ?>" />
	&nbsp;<?php echo $this->_var['lang']['label_region']; ?><select name="to_region_id" size=1>
	<option value="0">请选择</option>
	<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
	<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['filter']['to_region_id'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?> ><?php echo $this->_var['district']['region_name']; ?></option>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
	<?php if ($this->_var['filter']['is_finish'] == '1'): ?>
	<input type="hidden" name="order_status" value="4">
	<?php else: ?>
	&nbsp;<?php echo $this->_var['lang']['label_order_status']; ?>
	<select name="order_status" size=1>
	<option value="0">请选择</option>
	<?php $_from = $this->_var['orderstatus_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('statuskey', 'orderstatus');if (count($_from)):
    foreach ($_from AS $this->_var['statuskey'] => $this->_var['orderstatus']):
?>
	<option value="<?php echo $this->_var['statuskey']; ?>" <?php if ($this->_var['filter']['order_status'] == $this->_var['statuskey']): ?>selected<?php endif; ?> ><?php echo $this->_var['orderstatus']['name']; ?></option>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
	<?php endif; ?>
    &nbsp; <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button"/>
  </form>
</div>

<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
	<th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
      <a href="javascript:listTable.sort('order_id'); "><?php echo $this->_var['lang']['label_order_id']; ?></a><?php echo $this->_var['sort_order_id']; ?>
    </th>
      <th><?php echo $this->_var['lang']['label_order_sn']; ?></th>   
      <th><?php echo $this->_var['lang']['add_time']; ?></th>   
	  <th><?php echo $this->_var['lang']['send_name']; ?></th>
	  <th><?php echo $this->_var['lang']['to_name']; ?></th>
	   <th><?php if ($this->_var['filter']['is_finish'] == 1): ?>完成时间<?php else: ?><?php echo $this->_var['lang']['send_time']; ?><?php endif; ?></th>
	  <th><?php echo $this->_var['lang']['money']; ?></th>
	  <th><?php echo $this->_var['lang']['order_status']; ?></th>
      <th><?php echo $this->_var['lang']['label_postman']; ?></th>	  
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['kuaidi_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'kuaidi');if (count($_from)):
    foreach ($_from AS $this->_var['kuaidi']):
?>
    <tr>
	<td>
    <input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['kuaidi']['order_id']; ?>" /><?php echo $this->_var['kuaidi']['order_id']; ?>
    <!-- <?php if (! empty ( $this->_var['kuaidi']['deli'] )): ?> -->
    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ 网购订单 ]
    <!-- <?php endif; ?> -->
    </td>
	<td align="center"><?php echo $this->_var['kuaidi']['order_sn']; ?></td>
    <td align="center"><span><?php echo $this->_var['kuaidi']['user_name']; ?><br><?php echo $this->_var['kuaidi']['add_time']; ?></span></td>
	<td align="center"><?php echo $this->_var['kuaidi']['send_name']; ?><br /><font style="font-size:12px">[TEL：<?php echo $this->_var['kuaidi']['send_tel']; ?>]</font><br><?php echo $this->_var['kuaidi']['send_region_name']; ?></td>
	<td align="center"><?php echo $this->_var['kuaidi']['to_name']; ?><br /><font style="font-size:12px">[TEL：<?php echo $this->_var['kuaidi']['to_tel']; ?>]</font><br><?php echo $this->_var['kuaidi']['to_region_name']; ?></td>
	<td align="center"><?php if ($this->_var['filter']['is_finish']): ?><?php echo $this->_var['kuaidi']['finish_time']; ?><?php else: ?><?php echo $this->_var['kuaidi']['send_time']; ?><?php endif; ?></td>
	<td align="center"><?php echo $this->_var['kuaidi']['money']; ?></td>
    <td  align="center"><?php echo $this->_var['kuaidi']['order_status']; ?></td>
    <td align="center"><?php echo $this->_var['kuaidi']['postman_name']; ?></td>
    <td align="center">
        <?php if ($this->_var['filter']['is_finish'] != 1): ?><a href="javascript:void(0);" onclick="set_postman(<?php echo $this->_var['kuaidi']['order_id']; ?>)" >指定快递员</a> | <?php endif; ?><a href="kuaidi_order.php?act=view&order_id=<?php echo $this->_var['kuaidi']['order_id']; ?>" >查看</a></td>
    </tr>
      <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>

  </table>
  <table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
  <div>
  <?php if ($this->_var['filter']['is_finish'] != 1): ?>
    <input name="cancel" type="submit" id="btnSubmit" value="取消" class="button" disabled="true" />
	<?php endif; ?>
	<input name="remove" type="submit" id="btnSubmit1" value="移除" class="button" disabled="true" />
	<input name="export" type="submit" id="btnSubmit2" value="导出快递单" class="button" disabled="true" />
	<?php if ($this->_var['filter']['is_finish'] != 1): ?>
	批量修改快递单状态：
    <select  name="order_status" size=1>
	<option value="3">已揽收</option>
	<option value="4">已签收</option>
	</select>	
	<input name="update_status" type="submit" id="btnSubmit3" value="确定" class="button" disabled="true" />
	<?php endif; ?>
	<input name="act" type="hidden" value="batch" />

  </div> 

</form>

<form action="" id="postmanForm"  name="postmanForm" method="post" onsubmit="return validate()">
 <div id="popDiv" class="mydiv" style="display:none;">
		<div class="mydiv-l" id="PopAddressTitle">快递单处理</div>
		<div class="mydiv-r" onclick="javascript:closePopDiv()" ></div>
		<div id="PopAddressCon"></div>
  </div>
</form>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js')); ?>
<script type="text/javascript" language="JavaScript">
<!--
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  

  onload = function()
  {
    document.forms['listForm'].reset();
  }
  function searchUser()
{
    listTable.filter['postman_name'] = Utils.trim(document.forms['searchForm'].elements['postman_name'].value);
    listTable.filter['to_region_id'] = document.forms['searchForm'].elements['to_region_id'].value;
    listTable.filter['order_sn'] = Utils.trim(document.forms['searchForm'].elements['order_sn'].value);
	listTable.filter['order_status'] = Utils.trim(document.forms['searchForm'].elements['order_status'].value);
    listTable.filter['page'] = 1;
    listTable.loadList();
}


function set_postman(order_id)
{		
		Ajax.call('kuaidi_order.php?act=set_postman', 'order_id=' + order_id, set_postman_Response, 'GET', 'JSON');
}
function set_postman_Response(result)
{
		var PopAddressCon=document.getElementById('PopAddressCon');
		PopAddressCon.innerHTML= result.content;
		document.getElementById('popDiv').style.display='block';
		change_PostmanBox(result.send_region_id);
}
function closePopDiv()
{
		document.getElementById('popDiv').style.display='none';
}

//根据区域查找快递员  AJAX
function change_PostmanBox(region_id)
{
	Ajax.call('kuaidi_order.php?act=change_PostmanBox', 'region_id=' + region_id, change_PostmanBox_Response, 'GET', 'JSON');
}
function change_PostmanBox_Response(result)
{
	document.postmanForm.postman_box.options[0]=new Option("-请选择-","0"); 
	document.postmanForm.postman_box.length = 1; 
	var postman_one=new Array();
	var postman = result['content'];
	var i; 
	for (i=0;i < postman.length ; i++) 
	{		
			var postman_one= postman[i];
			document.postmanForm.postman_box.options[document.postmanForm.postman_box.length] = new Option(postman_one.postman_name, postman_one.postman_id); 		
	}
}

function validate()
{
  validator = new Validator("postmanForm");
  if (document.forms['postmanForm'].elements['postman'].value == 0)
  {
          validator.addErrorMsg('请选择快递员！');
 }
  
  return validator.passed();
}

  
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
