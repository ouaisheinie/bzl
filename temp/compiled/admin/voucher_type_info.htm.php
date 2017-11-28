<!-- $Id: bonus_type_info.htm 14216 2015-02-04 02:27:21Z derek $ -->

<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<div class="main-div">
<form action="voucher.php" method="post" name="theForm"  onsubmit="return validate()">
<table width="100%">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_name']; ?></td>
    <td>
      <input type='text' name='vc_name' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_name']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_nickname']; ?></td>
    <td>
      <input type='text' name='vc_nickname' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_nickname']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_activation_count']; ?></td>
    <td>
      <input type='text' name='vc_activation_count' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_activation_count']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_price']; ?></td>
    <td>
      <input type='text' name='vc_price' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_price']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_saleprice']; ?></td>
    <td>
      <input type='text' name='vc_saleprice' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_saleprice']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_limit_buycount']; ?></td>
    <td>
      <input type='text' name='vc_limit_buycount' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_limit_buycount']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_limit_storecount']; ?></td>
    <td>
      <input type='text' name='vc_limit_storecount' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_limit_storecount']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_sort']; ?></td>
    <td>
      <input type='text' name='vc_sort' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_sort']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['vc_status']; ?></td>
    <td>
      <input type='text' name='vc_status' maxlength="30" value="<?php echo $this->_var['vtype_arr']['vc_status']; ?>" size='20' />    </td>
  </tr>
  <tr>
    <td class="label">
	  <a href="javascript:showNotice('Use_start_a');" title="<?php echo $this->_var['lang']['form_notice']; ?>">
      <img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>
	<?php echo $this->_var['lang']['use_startdate']; ?></td>
    <td>
      <input name="use_start_date" type="text" id="use_start_date" size="22" value='<?php echo $this->_var['vtype_arr']['vc_starttime']; ?>' readonly="readonly" /><input name="selbtn3" type="button" id="selbtn3" onclick="return showCalendar('use_start_date', '%Y-%m-%d', false, false, 'selbtn3');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
	  <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="Use_start_a"><?php echo $this->_var['lang']['use_startdate_notic']; ?></span>    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['use_enddate']; ?></td>
    <td>
      <input name="use_end_date" type="text" id="use_end_date" size="22" value='<?php echo $this->_var['vtype_arr']['vc_endtime']; ?>' readonly="readonly" /><input name="selbtn4" type="button" id="selbtn4" onclick="return showCalendar('use_end_date', '%Y-%m-%d', false, false, 'selbtn4');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>    </td>
  </tr>
  <tr>
    <td class="label">&nbsp;</td>
    <td>
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
      <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
      <input type="hidden" name="vc_id" value="<?php echo $this->_var['vtype_arr']['vc_id']; ?>" />    </td>
  </tr>
</table>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="javascript">
<!--
document.forms['theForm'].elements['vc_name'].focus();
/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("type_name",      type_name_empty);
  validator.required("type_money",     type_money_empty);
  validator.isNumber("type_money",     type_money_isnumber, true);
  validator.required("use_start_date",      use_start_date_empty);
  validator.required("use_end_date",      use_end_date_empty);
  validator.islt('use_start_date', 'use_end_date', use_start_lt_end);
  
  return validator.passed();
}
onload = function()
{
  
  get_value = '<?php echo $this->_var['bonus_arr']['send_type']; ?>';
  

  showunit(get_value)
  // 开始检查订单
  startCheckOrder();
}
/* 红包类型按订单金额发放时才填写 */
function gObj(obj)
{
  var theObj;
  if (document.getElementById)
  {
    if (typeof obj=="string") {
      return document.getElementById(obj);
    } else {
      return obj.style;
    }
  }
  return null;
}

function showunit(get_value)
{
  gObj("1").style.display =  (get_value == 2) ? "" : "none";
  document.forms['theForm'].elements['selbtn1'].disabled  = (get_value != 1 && get_value != 2);
  document.forms['theForm'].elements['selbtn2'].disabled  = (get_value != 1 && get_value != 2);

  return;
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
