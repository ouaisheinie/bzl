<!-- $Id: valuecard_list.htm 14216 2015-02-04 02:27:21Z derek $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchVc()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['tg_sn']; ?><input name="tg_sn" type="text" id="tg_sn" size="15">
    <?php echo $this->_var['lang']['is_used']; ?>
    <select name="is_used" id="is_used">
      <option value="-1"><?php echo $this->_var['lang']['select_please']; ?></option>
	  <option value="0">未使用</option>
	  <option value="1">已使用</option>
    </select>
	<input type="hidden" name="tg_type" id="tg_type" value="<?php echo $_GET['tg_type']; ?>" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="POST" action="takegoods.php?act=batch&tg_type=<?php echo $_GET['tg_type']; ?>" name="listForm">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
        <?php echo $this->_var['lang']['tg_id']; ?></th>
		<th><?php echo $this->_var['lang']['tg_sn']; ?></th>
      <th><?php echo $this->_var['lang']['tg_pwd']; ?></th>
	  <th><?php echo $this->_var['lang']['tg_type_name']; ?></th>
      <th><?php echo $this->_var['lang']['type_money']; ?></th>
      <th><?php echo $this->_var['lang']['type_money_count']; ?></th>
      <th><?php echo $this->_var['lang']['type_money_all']; ?></th>
      <th><?php echo $this->_var['lang']['use_date_valid']; ?></th>
	  <th><?php echo $this->_var['lang']['is_used']; ?></th>
	  <th><?php echo $this->_var['lang']['used_time_last']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['vc_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
    <tr>
      <td><span><input value="<?php echo $this->_var['bonus']['tg_id']; ?>" name="checkboxes[]" type="checkbox"><?php echo $this->_var['bonus']['tg_id']; ?></span></td>
	   <td><?php if ($this->_var['bonus']['goods_ids']): ?><font color=#ff3300><?php endif; ?><?php echo $this->_var['bonus']['tg_sn']; ?><?php if ($this->_var['bonus']['goods_ids']): ?></font><?php endif; ?></td>        
      <td><?php echo $this->_var['bonus']['tg_pwd']; ?></td>      
	  <td align=center><?php echo $this->_var['vctype']['type_name']; ?></td>  
      <td align=center><?php echo $this->_var['vctype']['type_money_format']; ?></td>
      <td align=center><?php echo $this->_var['vctype']['type_money_count_format']; ?></td>
      <td align=center><?php echo $this->_var['vctype']['type_money_all_format']; ?></td>
      <td align=center><?php echo $this->_var['vctype']['valid_time']; ?></td>
	  <td align=center><?php echo $this->_var['bonus']['is_used']; ?></td>
	  <td align=center><?php echo $this->_var['bonus']['used_time_format']; ?></td>
      <td align="center">
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['bonus']['tg_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>', 'remove_bonus')"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" />
      <input type="submit" name="add_goods" id="btnSubmit1" value="<?php echo $this->_var['lang']['addgoods']; ?>" class="button" disabled="true" /></td>
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
  listTable.query = "query_bonus";

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
		listTable.filter['tg_type'] = Utils.trim(document.forms['searchForm'].elements['tg_type'].value);
        listTable.filter['is_used'] = document.forms['searchForm'].elements['is_used'].value;
        listTable.filter['page'] = 1;
        listTable.loadList();
    }

  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>