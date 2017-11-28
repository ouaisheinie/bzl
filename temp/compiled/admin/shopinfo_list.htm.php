<!-- $Id: shopinfo_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start cat list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table'>
  <tr>
    <th><?php echo $this->_var['lang']['id']; ?></th>
    <th><?php echo $this->_var['lang']['title']; ?></th>
    <th><?php echo $this->_var['lang']['add_time']; ?></th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
  <tr>
    <td align="center" width="40px"><?php echo $this->_var['item']['article_id']; ?></td>
    <td  class="first-cell"><span onclick="javascript:listTable.edit(this, 'edit_title', <?php echo $this->_var['item']['article_id']; ?>)"><?php echo htmlspecialchars($this->_var['item']['title']); ?></span></td>
    <td align="center"><?php echo $this->_var['item']['add_time']; ?></td>
    <td align="center">
      <a href="shopinfo.php?act=edit&id=<?php echo $this->_var['item']['article_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>&nbsp;&nbsp;
     <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['item']['article_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
    </td>
   </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end cat list -->
<script language="JavaScript">

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>