<!-- $Id: valuecard_list.htm 14216 2015-02-04 02:27:21Z derek $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchComment()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['vco_id']; ?><input type="text" name="keywords" /> <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_search']; ?>" />
  </form>
</div>

<form method="POST" action="voucher.php?act=remove_order" name="listForm" onsubmit="javascript:return batch_removeorder();">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <!-- <th>
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
        <?php echo $this->_var['lang']['vco_id']; ?></th> -->
		<th><?php echo $this->_var['lang']['vco_id']; ?></th>
    <th>购买者</th>
	  <th>兑换券类型</th>
    <th>支付方式</th>
    <th>支付金额</th>
    <th>支付状态</th>
    <th>使用状态</th>
	  <th>激活状态</th>
	  <th>已激活次数</th>
    <th>下单时间</th>
    <th>支付时间</th>
    <th>父级订单ID</th>
    <!-- <th><?php echo $this->_var['lang']['handler']; ?></th> -->
    </tr>
    <?php $_from = $this->_var['vco_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
    <tr>
      <!-- <td><span><input value="<?php echo $this->_var['order']['vco_id']; ?>" name="checkboxes[]" type="checkbox"><?php echo $this->_var['order']['vco_id']; ?></span></td> -->
	  <!-- <td><?php if ($this->_var['order']['goods_ids']): ?><font color=#ff3300><?php endif; ?><?php echo $this->_var['order']['tg_sn']; ?><?php if ($this->_var['order']['goods_ids']): ?></font><?php endif; ?></td>     -->    
      <td><?php echo $this->_var['order']['vco_id']; ?></td>      
	  <td align=center><?php echo $this->_var['order']['vco_user_id']; ?></td>  
      <td align=center><?php echo $this->_var['order']['vco_voucher_id']; ?></td>
      <td align=center><?php echo $this->_var['order']['vco_payment_type']; ?></td>
	  <td align=center><?php echo $this->_var['order']['vco_payment_money']; ?></td>
	  <td align=center><?php echo $this->_var['order']['vco_pay_status']; ?></td>
	  <!-- <td align=center><?php if ($this->_var['order']['shipping_id']): ?><img src="images/yes.gif" ><?php else: ?><img src="images/no.gif" ><?php endif; ?></td> 图标-->
	  <td align=center><?php echo $this->_var['order']['vco_used_status']; ?></td>
    <td align=center><?php echo $this->_var['order']['vco_activation_status']; ?></td>
    <td align=center><?php echo $this->_var['order']['vco_activation_count']; ?></td>
    <td align=center><?php echo $this->_var['order']['vco_addtime']; ?></td>
    <td align=center><?php echo $this->_var['order']['vco_payment_time']; ?></td>
    <td align=center><?php echo $this->_var['order']['vco_porder_id']; ?></td>
    <!-- <td align="center"> -->
      <!-- <?php if ($_GET['tgid']): ?> -->
	  <!-- <a href="takegoods.php?act=order_view&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>&id=<?php echo $this->_var['order']['rec_id']; ?>">查看</a> | <a href="takegoods.php?act=order_view&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>&id=<?php echo $this->_var['order']['rec_id']; ?>">去发货</a> |  <a href="?act=remove_order&id=<?php echo $this->_var['order']['rec_id']; ?>&tg_type=<?php echo $_GET['tg_type']; ?>&is_used=<?php echo $_GET['is_used']; ?>&tgid=<?php echo $_GET['tgid']; ?>">移除</a> -->
      <!-- <?php else: ?> -->
	  <!-- <a href="takegoods.php?act=order_view&id=<?php echo $this->_var['order']['rec_id']; ?>">查看</a> | <a href="takegoods.php?act=order_view&id=<?php echo $this->_var['order']['rec_id']; ?>">去发货</a> |  <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['order']['rec_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>', 'remove_order',)">移除</a> -->
      <!-- <?php endif; ?> -->
        <!-- </td> -->
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <!-- <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" /></td> -->
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end user_bonus list -->
</form>

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<script type="text/javascript" language="JavaScript">
  
  onload = function()
  {
      document.forms['searchForm'].elements['keywords'].focus();
      // 开始检查订单
      startCheckOrder();
  }
  /**
   * 搜索评论
   */
  function searchComment()
  {
      var keyword = Utils.trim(document.forms['searchForm'].elements['keywords'].value);
        listTable.filter['keyword'] = keyword;
        listTable.filter.page = 1;
        listTable.loadList();
  }
  

  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?> 