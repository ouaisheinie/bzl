<!-- $Id: bonus_type.htm 14216 2015-02-04 02:27:21Z derek $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start bonus_type list -->
<!-- 兑换券搜索 -->

<div class="form-div">
  <form action="javascript:searchComment()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['prices']; ?><input type="text" name="keywords" /> <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_search']; ?>" />
  </form>
</div>

<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th><?php echo $this->_var['lang']['vc_id']; ?></th>
      <th><?php echo $this->_var['lang']['vc_name']; ?></th>          
      <th><?php echo $this->_var['lang']['vc_nickname']; ?></th>
  	  <th><?php echo $this->_var['lang']['vc_activation_count']; ?></th>  
  	  <th><?php echo $this->_var['lang']['vc_price']; ?></th>
  	  <th><?php echo $this->_var['lang']['vc_saleprice']; ?></th>
  	  <th><?php echo $this->_var['lang']['vc_limit_buycount']; ?></th>
      <th><?php echo $this->_var['lang']['vc_limit_storecount']; ?></th>
      <th><?php echo $this->_var['lang']['vc_sort']; ?></th>
      <th><?php echo $this->_var['lang']['vc_status']; ?></th>
      <th><?php echo $this->_var['lang']['vc_addtime']; ?></th>
      <th><?php echo $this->_var['lang']['vc_updatetime']; ?></th>
      <th><?php echo $this->_var['lang']['vc_starttime']; ?></th>
      <th><?php echo $this->_var['lang']['vc_endtime']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'type');if (count($_from)):
    foreach ($_from AS $this->_var['type']):
?>
    <tr>
      <td align="center"><?php echo $this->_var['type']['vc_id']; ?></td>
      <td class="first-cell"><?php echo htmlspecialchars($this->_var['type']['vc_name']); ?></td>      
      <td align="center"><span><?php echo $this->_var['type']['vc_nickname']; ?></span></td>
      <td align="center"><?php echo $this->_var['type']['vc_activation_count']; ?></td>
  	  <td align="center"><?php echo $this->_var['type']['vc_price']; ?></td>
  	  <td align="center"><?php echo $this->_var['type']['vc_saleprice']; ?></td>
  	  <td align="center"><?php echo $this->_var['type']['vc_limit_buycount']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_limit_storecount']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_sort']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_status']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_addtime']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_updatetime']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_starttime']; ?></td>
      <td align="center"><?php echo $this->_var['type']['vc_endtime']; ?></td>
      <td align="center">
	    <!-- <a href="voucher.php?act=send&amp;id=<?php echo $this->_var['type']['vc_id']; ?>&amp;send_by=<?php echo $this->_var['type']['send_type']; ?>"><?php echo $this->_var['lang']['send']; ?></a> |
        <a href="voucher.php?act=tg_list&amp;tg_type=<?php echo $this->_var['type']['type_id']; ?>&amp;is_used=-1"><?php echo $this->_var['lang']['view']; ?></a> | -->
        <a href="voucher.php?act=edit&amp;vc_id=<?php echo $this->_var['type']['vc_id']; ?>"><?php echo $this->_var['lang']['edit']; ?></a> |
		<!-- <a href="voucher.php?act=add_goods&amp;type_id=<?php echo $this->_var['type']['type_id']; ?>"><?php echo $this->_var['lang']['addgoods']; ?></a> | -->
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['type']['vc_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')"><?php echo $this->_var['lang']['remove']; ?></a></span></td>
        
    </tr>
      <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="15"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <tr>
      <td align="right" nowrap="true" colspan="15"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>
<!-- end bonus_type list -->
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