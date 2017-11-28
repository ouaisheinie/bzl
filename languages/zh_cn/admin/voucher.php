<?php

/**
 * 鸿宇多用户商城 兑换券类型管理程序
 * ============================================================================
 * * 版权所有 2005-2015 鸿宇多用户商城科技有限公司，并保留所有权利。
 * 网站地址: http://bbs.hongyuvip.com；
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买正版版权。鸿宇不承担任何法律责任。
 * 踏踏实实做事，堂堂正正做人。
 * ============================================================================
 * $Author: derek $
 * $Id: bonus.php 17217 2015-02-04 06:29:08Z derek $
*/
/* 红包类型字段信息 */
$_LANG['voucher_type_list'] = '兑换券类型列表';
$_LANG['voucher_type_add'] = '添加兑换券类型';
$_LANG['type_money'] = '兑换券单品金额';
$_LANG['type_money_count'] = '可用次数';
$_LANG['vc_nickname'] = '兑换券别称';
$_LANG['vc_activation_count'] = '激活所需次数';
$_LANG['vc_price'] = '券价值';
$_LANG['vc_saleprice'] = '券售价';
$_LANG['vc_limit_storecount'] = '发放数量';
$_LANG['vc_limit_buycount'] = '限制购买次数';
$_LANG['vc_sort'] = '排序';
$_LANG['vc_status'] = '兑换券状态';
$_LANG['vc_addtime'] = '兑换券发放时间';
$_LANG['vc_updatetime'] = '兑换券更新时间';
$_LANG['vc_starttime'] = '活动开始时间';
$_LANG['vc_endtime'] = '活动结束时间';
$_LANG['vc_id'] = '编号';
$_LANG['vco_id'] = '订单号';

$_LANG['vco_payment_id'] = '支付回执号';



$_LANG['type_money_c'] = '次';
$_LANG['type_money_all'] = '兑换券总金额';
$_LANG['send_count'] = '发放数量';
$_LANG['use_startdate_notic'] = '只有当前时间介于起始日期和截止日期之间时，此类型的兑换券才可以使用';
$_LANG['type_name_exist'] = '此类型的名称已经存在!';
$_LANG['continus_add'] = '继续添加兑换券类型';
$_LANG['back_list'] = '返回兑换券类型列表';
$_LANG['attradd_succed'] = '操作成功!';
$_LANG['use_date_valid'] ='有效日期';
$_LANG['add_time'] ='添加时间';
$_LANG['is_used'] ='已使用次数';
$_LANG['user_name'] ='使用者';
$_LANG['used_time_last'] ='最后使用时间';
$_LANG['js_languages']['send_count_empty'] = '请输入发放数量!';
$_LANG['js_languages']['send_count_isnumber'] = '发放数量必须为数字格式!';
$_LANG['js_languages']['type_name_empty'] = '请输入兑换券类型名称!';
$_LANG['js_languages']['type_money_empty'] = '请输入兑换券金额!';
$_LANG['js_languages']['type_money_isnumber'] = '兑换券金额必须为数字格式!';
$_LANG['js_languages']['use_start_date_empty'] = '使用起始日期不能为空';
$_LANG['js_languages']['use_end_date_empty'] = '使用结束日期不能为空';
$_LANG['js_languages']['use_start_lt_end'] = '使用开始日期不能大于结束日期';

$_LANG['send_voucher'] = '发放兑换券';
$_LANG['send_valucard_count'] ='本次发放数量';
$_LANG['valuecard_sn_notic'] = '提示:兑换券号码由“8位随机数字或字母 + 4位数字序号”组成';
$_LANG['bonustype_edit'] = '编辑储值卡类型';
$_LANG['valuecard_have'] = '该类型下已经发放了大量储值卡，不能删除！';
$_LANG['continue_add'] = '继续添加储值卡';
$_LANG['back_voucher_list'] = '返回兑换券列表';

$_LANG['creat_voucher'] = '生成了 ';
$_LANG['creat_voucher_num'] = ' 个兑换券号码';
$_LANG['voucher_sn_error'] = '兑换券号码必须是数字!';
$_LANG['voucher_list'] = '兑换券列表';
$_LANG['no_use'] = '未使用';
$_LANG['bonus_sn'] = '兑换券号码';
$_LANG['tg_pwd'] = '密码';
$_LANG['batch_drop_success'] = '成功删除了 %d 个兑换券';
$_LANG['gen_excel'] = '导出EXCEL';
$_LANG['tg_sn'] = '兑换券号码';
$_LANG['prices'] = '兑换券价值';

$_LANG['addgoods'] = '配置商品';
$_LANG['custom_goods_cat'] = '所有分类';
$_LANG['custom_goods_brand'] = '所有品牌';
$_LANG['custom_keyword'] = '关键词';
$_LANG['goods_search'] = '搜索';
$_LANG['select_from'] = '可选商品';
$_LANG['select_action'] = '操作';
$_LANG['select_to'] = '配置商品';

$_LANG['tg_type_name'] = '兑换券类型';

$_LANG['voucher_order_info'] = '提货详情';
$_LANG['prev'] = '上一个提货单';
$_LANG['next'] = '下一个提货单';

$_LANG['vc_name'] = '兑换券名称';

$_LANG['voucher_order_list'] = '提货列表';
$_LANG['voucher_order_list_all'] = '全部提货列表';

$_LANG['min_goods_amount'] = '最小订单金额';
$_LANG['notice_min_goods_amount'] = '只有商品总金额达到这个数的订单才能使用这种红包';
$_LANG['min_amount'] = '订单下限';
$_LANG['max_amount'] = '订单上限';
$_LANG['send_startdate'] = '发放起始日期';
$_LANG['send_enddate'] = '发放结束日期';

$_LANG['use_startdate'] = '活动开始日期';
$_LANG['use_enddate'] = '活动结束日期';
$_LANG['send_count'] = '发放数量';
$_LANG['use_count'] = '使用数量';
$_LANG['send_method'] = '如何发放此类型红包';
$_LANG['send_type'] = '发放类型';
$_LANG['param'] = '参数';

$_LANG['yuan'] = '元';
$_LANG['user_list'] = '会员列表';
$_LANG['type_name_empty'] = '红包类型名称不能为空！';
$_LANG['type_money_empty'] = '红包金额不能为空！';
$_LANG['min_amount_empty'] = '红包类型的订单下限不能为空！';
$_LANG['max_amount_empty'] = '红包类型的订单上限不能为空！';
$_LANG['send_count_empty'] = '红包类型的发放数量不能为空！';

$_LANG['send_by'][SEND_BY_USER] = '按用户发放';
$_LANG['send_by'][SEND_BY_GOODS] = '按商品发放';
$_LANG['send_by'][SEND_BY_ORDER] = '按订单金额发放';
$_LANG['send_by'][SEND_BY_PRINT] = '线下发放的红包';
$_LANG['send_by'][SEND_BY_ONLINE] = '线上发放的红包';
$_LANG['report_form'] = '报表';
$_LANG['send'] = '发放';
$_LANG['bonus_excel_file'] = '线下红包信息列表';

$_LANG['goods_cat'] = '选择商品分类';
$_LANG['goods_brand'] = '商品品牌';
$_LANG['goods_key'] = '商品关键字';
$_LANG['all_goods'] = '可选商品';
$_LANG['send_bouns_goods'] = '发放此类型红包的商品';
$_LANG['remove_bouns'] = '移除红包';
$_LANG['all_remove_bouns'] = '全部移除';
$_LANG['goods_already_bouns'] = '该商品已经发放过其它类型的红包了!';
$_LANG['send_user_empty'] = '您没有选择需要发放红包的会员，请返回!';

$_LANG['sendbonus_count'] = '共发送了 %d 个红包。';
$_LANG['send_bouns_error'] = '发送会员红包出错, 请返回重试！';
$_LANG['no_select_bonus'] = '您没有选择需要删除的用户红包';

$_LANG['bonustype_view'] = '查看详情';
$_LANG['drop_bonus'] = '删除红包';



$_LANG['validated_email'] = '只给通过邮件验证的用户发放红包';

/* 提示信息 */


$_LANG['js_languages']['order_money_isnumber'] = '订单金额必须为数字格式!';
$_LANG['js_languages']['bonus_sn_empty'] = '请输入红包的序列号!';
$_LANG['js_languages']['bonus_sn_number'] = '红包的序列号必须是数字!';
$_LANG['send_count_error'] = '红包的发放数量必须是一个整数!';
$_LANG['js_languages']['bonus_sum_empty'] = '请输入您要发放的红包数量!';
$_LANG['js_languages']['bonus_sum_number'] = '红包的发放数量必须是一个整数!';
$_LANG['js_languages']['bonus_type_empty'] = '请选择红包的类型金额!';
$_LANG['js_languages']['user_rank_empty'] = '您没有指定会员等级!';
$_LANG['js_languages']['user_name_empty'] = '您至少需要选择一个会员!';
$_LANG['js_languages']['invalid_min_amount'] = '请输入订单下限（大于0的数字）';
$_LANG['js_languages']['send_start_lt_end'] = '红包发放开始日期不能大于结束日期';





$_LANG['order_money_notic'] = '只要订单金额达到该数值，就会发放红包给用户';
$_LANG['type_money_notic'] = '此类型的红包可以抵销的金额';
$_LANG['send_startdate_notic'] = '只有当前时间介于起始日期和截止日期之间时，此类型的红包才可以发放';


$_LANG['type_money_error'] = '金额必须是数字并且不能小于 0 !';


$_LANG['send_user_notice'] = '给指定的用户发放红包时,请在此输入用户名, 多个用户之间请用逗号(,)分隔开<br />如:liry, wjz, zwj';

/* 红包信息字段 */
$_LANG['tg_id'] = '编号';
$_LANG['bonus_type_id'] = '类型金额';
$_LANG['send_bonus_count'] = '红包数量';
$_LANG['start_bonus_sn'] = '起始序列号';

$_LANG['user_id'] = '使用会员';
$_LANG['used_time'] = '使用时间';
$_LANG['order_id'] = '订单号';
$_LANG['send_mail'] = '发邮件';
$_LANG['emailed'] = '邮件通知';
$_LANG['mail_status'][BONUS_NOT_MAIL] = '未发';
$_LANG['mail_status'][BONUS_MAIL_FAIL] = '已发失败';
$_LANG['mail_status'][BONUS_MAIL_SUCCEED] = '已发成功';

$_LANG['sendtouser'] = '给指定用户发放红包';
$_LANG['senduserrank'] = '按用户等级发放红包';
$_LANG['userrank'] = '用户等级';
$_LANG['select_rank'] = '选择会员等级...';
$_LANG['keywords'] = '关键字：';
$_LANG['userlist'] = '会员列表：';
$_LANG['send_to_user'] = '给下列用户发放红包';
$_LANG['search_users'] = '搜索会员';
$_LANG['confirm_send_bonus'] = '确定发送红包';
$_LANG['bonus_not_exist'] = '该红包不存在';
$_LANG['success_send_mail'] = '%d 封邮件已被加入邮件列表';
$_LANG['send_continue'] = '继续发放红包';
?>