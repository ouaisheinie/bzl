<!-- $Id: user_rank_info.htm 15053 2008-10-25 03:07:46Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>

<div class="main-div">
<form action="user_rank.php" method="post" name="theForm" onsubmit="return validate()">
<table width="100%">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['rank_name']; ?>: </td>
    <td><input type="text" name="rank_name" value="<?php echo $this->_var['rank']['rank_name']; ?>" maxlength="20" /><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['integral_min']; ?>: </td>
    <td><input type="text" name="min_points" value="<?php echo $this->_var['rank']['min_points']; ?>" size="10" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['integral_max']; ?>: </td>
    <td><input type="text" name="max_points" value="<?php echo $this->_var['rank']['max_points']; ?>" size="10" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="label"></td>
    <td>
    <input type="checkbox" name="show_price" value="1" <?php if ($this->_var['rank']['show_price'] == 1): ?> checked="true"<?php endif; ?> /> <?php echo $this->_var['lang']['show_price']; ?></td>
  </tr>
  <tr>
    <td class="label"></td>
    <td>
    <input type="checkbox" name="special_rank" value="1" <?php if ($this->_var['rank']['special_rank'] == 1): ?> checked="true"<?php endif; ?> onClick="javascript:doSpecial()" /> <?php echo $this->_var['lang']['special_rank']; ?> <a href="javascript:showNotice('notice_special');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>
    <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="notice_special"><?php echo $this->_var['lang']['notice_special']; ?></span></td>
  </tr>
  <tr>
  <td class="label" >是否参与分成</td>
  <td><select id="recomm" name="recomm">
	<option value="0">否</option><option value="1" >是</option>
	</select>
    <br /><span class="notice-span"><?php echo $this->_var['lang']['notice_fencheng']; ?></span></td></tr>
  </td>
  </tr>
  <tr>
    <td class="label"><a href="javascript:showNotice('notice_discount');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['discount']; ?>: </td>
    <td><input type="text" name="discount" value="<?php echo $this->_var['rank']['discount']; ?>" size="10" maxlength="20" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="notice_discount"><?php echo $this->_var['lang']['notice_discount']; ?></span>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
      <input type="hidden" name="id" value="<?php echo $this->_var['rank']['rank_id']; ?>" />
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </td>
  </tr>
</table>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
document.forms['theForm'].elements['rank_name'].focus();

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

/**
 * 检查表单输入的数据
 */
function validate()
{
    if (!document.forms['theForm'].elements['special_rank'].checked)
    {
        if (Utils.trim(document.forms['theForm'].elements['min_points'].value) == '' ||
            !Utils.isInt(document.forms['theForm'].elements['min_points'].value))
        {
            alert(integral_min_invalid);
            return false;
        }

        if (Utils.trim(document.forms['theForm'].elements['max_points'].value) == '' ||
            !Utils.isInt(document.forms['theForm'].elements['max_points'].value))
        {
            alert(integral_max_invalid);
            return false;
        }

        if (!document.forms['theForm'].elements['special_rank'].checked &&
            (parseInt(document.forms['theForm'].elements['max_points'].value) <=
            parseInt(document.forms['theForm'].elements['min_points'].value)))
        {
            alert(integral_max_small);
            return false;
        }
        if (parseInt(document.forms['theForm'].elements['discount'].value) < 1 ||
          parseInt(document.forms['theForm'].elements['discount'].value) > 100)
        {
          alert(discount_invalid);
          return false;
        }
    }

    validator = new Validator("theForm");
    validator.required('rank_name', rank_name_empty);
    validator.isInt('discount', discount_invalid, true);
    return validator.passed();
}

function doSpecial()
{
  if(document.forms['theForm'].elements['special_rank'].checked)
  {
      document.forms['theForm'].elements['max_points'].disabled = "true";
      document.forms['theForm'].elements['min_points'].disabled = "true";
  }
  else
  {
      document.forms['theForm'].elements['max_points'].disabled = "";
      document.forms['theForm'].elements['min_points'].disabled = "";
  }
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>