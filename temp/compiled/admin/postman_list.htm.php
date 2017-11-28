<!-- $Id: postman_list.htm 14216 2015-02-07 02:27:21Z derel $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">
  <form action="javascript:searchUser()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    &nbsp;<?php echo $this->_var['lang']['label_mobile']; ?> <input type="text" name="mobile" size="20" value="<?php echo $this->_var['filter']['mobile']; ?>" />
	&nbsp;<?php echo $this->_var['lang']['label_postman']; ?><input type="text" name="postman_name" size="20" value="<?php echo $this->_var['filter']['postman_name']; ?>" />
	&nbsp;<?php echo $this->_var['lang']['label_region']; ?><select name="region_id" size=1>
	<option value="0">请选择</option>
	<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
	<option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['filter']['region_id'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?> ><?php echo $this->_var['district']['region_name']; ?></option>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
    &nbsp; <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button"/>
  </form>
</div>


<form method="POST" action="" name="listForm">
<!-- start postman list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
	<th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
      <a href="javascript:listTable.sort('user_id'); "><?php echo $this->_var['lang']['postman_id']; ?></a><?php echo $this->_var['sort_user_id']; ?>
    </th>
      <th><?php echo $this->_var['lang']['region_name']; ?></th>          
      <th><?php echo $this->_var['lang']['postman_name']; ?></th>
	  <th><?php echo $this->_var['lang']['mobile']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['postman_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'postman');if (count($_from)):
    foreach ($_from AS $this->_var['postman']):
?>
    <tr>
	<td><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['postman']['postman_id']; ?>" /><?php echo $this->_var['postman']['postman_id']; ?></td>
	<td align="center"><span><?php echo $this->_var['postman']['region_name']; ?></span></td>
      <td  align="center"><?php echo htmlspecialchars($this->_var['postman']['postman_name']); ?></td>
      <td align="center"><?php echo $this->_var['postman']['mobile']; ?></td>
      <td align="center">
        <a href="postman.php?act=edit&amp;postman_id=<?php echo $this->_var['postman']['postman_id']; ?>"><?php echo $this->_var['lang']['edit']; ?></a> |
        <a href="javascript:" onclick="listTable.remove(<?php echo $this->_var['postman']['postman_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')"><?php echo $this->_var['lang']['remove']; ?></a></td>
    </tr>
      <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>

  </table>
  <table id="page-table" cellspacing="0">
  <tr>
    <td>
      <input name="remove" type="submit" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" />
      <input name="act" type="hidden" value="remove" />
    </td>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end postman list -->
</form>


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
     // 开始检查订单
     startCheckOrder();
  }

  function searchUser()
{
    listTable.filter['postman_name'] = Utils.trim(document.forms['searchForm'].elements['postman_name'].value);
    listTable.filter['region_id'] = document.forms['searchForm'].elements['region_id'].value;
    listTable.filter['mobile'] = Utils.trim(document.forms['searchForm'].elements['mobile'].value);
    listTable.filter['page'] = 1;
    listTable.loadList();
}

  
//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>