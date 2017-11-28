<!-- $Id: valuecard_list.htm 14216 2015-02-04 02:27:21Z derek $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchVc()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['tg_sn']; ?><input name="tg_sn" type="text" id="tg_sn" size="15">
	<input type="hidden" name="tg_type" id="tg_type" value="<?php echo $_GET['tg_type']; ?>" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="POST" action="takegoods.php?act=remove_order" name="listForm" onsubmit="javascript:return batch_removeorder();">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
        <?php echo $this->_var['lang']['tg_id']; ?></th>
		<th><?php echo $this->_var['lang']['tg_sn']; ?></th>
      <th>联系人</th>
	  <th>联系电话</th>
      <th>使用会员</th>
      <th>提货商品</th>
	  <th>使用时间</th>
	  <th>快递单号</th>
	  <th>发货状态</th>
	  <th>提货状态</th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['vc_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
    <tr>
      <td><span><input value="<?php echo $this->_var['order']['rec_id']; ?>" name="checkboxes[]" type="checkbox"><?php echo $this->_var['order']['rec_id']; ?></span></td>
	  <td><?php if ($this->_var['order']['goods_ids']): ?><font color=#ff3300><?php endif; ?><?php echo $this->_var['order']['tg_sn']; ?><?php if ($this->_var['order']['goods_ids']): ?></font><?php endif; ?></td>        
      <td><?php echo $this->_var['order']['consignee']; ?></td>      
	  <td align=center><?php echo $this->_var['order']['mobile']; ?></td>  
      <td align=center><?php echo $this->_var['order']['user_name']; ?></td>
      <td align=center><?php echo $this->_var['order']['goods_name']; ?></td>
	  <td align=center><?php echo $this->_var['order']['add_time_format']; ?></td>
	  <td align=center><?php echo $this->_var['order']['shipping_id']; ?></td>
	  <td align=center><?php if ($this->_var['order']['shipping_id']): ?><img src="images/yes.gif" ><?php else: ?><img src="images/no.gif" ><?php endif; ?></td>
	  <td align=center><?php echo $this->_var['order']['order_status_name']; ?></td>
      <td align="center">
      <!-- <?php if ($_GET['tgid']): ?> -->
	  <a href="takegoods.php?act=order_view&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>&id=<?php echo $this->_var['order']['rec_id']; ?>">查看</a> | <a href="takegoods.php?act=order_view&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>&id=<?php echo $this->_var['order']['rec_id']; ?>">去发货</a> |  <a href="?act=remove_order&id=<?php echo $this->_var['order']['rec_id']; ?>&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>">移除</a>
      <!-- <?php else: ?> -->
	  <a href="takegoods.php?act=order_view&id=<?php echo $this->_var['order']['rec_id']; ?>">查看</a> | <a href="takegoods.php?act=order_view&id=<?php echo $this->_var['order']['rec_id']; ?>">去发货</a> |  <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['order']['rec_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>', 'remove_order',)">移除</a>
      <!-- <?php endif; ?> -->
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" /></td>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end user_bonus list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query_order";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['listForm'].reset();
  }

    function searchVc()
    {
        listTable.filter['tg_sn'] = Utils.trim(document.forms['searchForm'].elements['tg_sn'].value);
        listTable.filter['page'] = 1;
        listTable.loadList();
    }

	function batch_removeorder()
	{
	   if (confirm('您确认要删除吗？'))
	   {
		   return true;
	   }
	   return false;
	}

  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>