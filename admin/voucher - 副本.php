<?php

/**
 * 鸿宇多用户商城 提货券的处理
 * ============================================================================
 * * 版权所有 2005-2015 鸿宇多用户商城科技有限公司，并保留所有权利。
 * 网站地址: http://bbs.hongyuvip.com；
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买正版版权。鸿宇不承担任何法律责任。
 * 踏踏实实做事，堂堂正正做人。
 * ============================================================================
 * $Author: derek $
 * $Id: voucher.php 17217 2015-02-04 06:29:08Z derek $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php');



/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}

/* 初始化$exc对象 */
$exc = new exchange($ecs->table('voucher'), $db, 'vc_id', 'vc_name');
/*------------------------------------------------------ */
//-- 兑换券类型列表页面
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')//获取信息列表
{
    
    $smarty->assign('ur_here',     $_LANG['voucher_type_list']);
    $smarty->assign('action_link', array('text' => $_LANG['voucher_type_add'], 'href' => 'voucher.php?act=add'));
    $smarty->assign('full_page',   1);

    $list = get_voucher_list();
    

    $smarty->assign('type_list',    $list['item']);//数据
    $smarty->assign('filter',       $list['filter']);//[sort_by] => vc_id，[sort_order] => DESC，[record_count] => 8，[page_size] => 15，[page] => 1，[page_count] => 1，[start] => 0
         
    $smarty->assign('record_count', $list['record_count']);//[page_count] => 1
    $smarty->assign('page_count',   $list['page_count']);//[record_count] => 8

    $sort_flag  = sort_flag($list['filter']);

    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('voucher_type.htm');//后台页面
}

/*------------------------------------------------------ */
//-- 分页、排序
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'query')
{
    $list = get_voucher_list();
    
    $smarty->assign('type_list',    $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('voucher_type.htm'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}



/*------------------------------------------------------ */
//-- 删除兑换券类型
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'remove')
{
    check_authz_json('voucher');
    $vc_id = intval($_GET['id']);
    $exc->drop($vc_id);
    $url = 'voucher.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/*------------------------------------------------------ */
//-- 兑换券类型添加页面
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'add')
{
    admin_priv('voucher_list');

    $smarty->assign('lang',         $_LANG);
    $smarty->assign('ur_here',      $_LANG['voucher_type_add']);
    $smarty->assign('action_link',  array('href' => 'voucher.php?act=list', 'text' => $_LANG['voucher_type_list']));
    $smarty->assign('action',       'add');

    $smarty->assign('form_act',     'insert');
    $smarty->assign('cfg_lang',     $_CFG['lang']);

    $next_month = local_strtotime('+1 months');
    $bonus_arr['send_start_date']   = date('Y-m-d H:i:s');
    $bonus_arr['use_start_date']    = date('Y-m-d H:i:s');
    $bonus_arr['send_end_date']     = date('Y-m-d H:i:s', $next_month);
    $bonus_arr['use_end_date']      = date('Y-m-d H:i:s', $next_month);

    assign_query_info();
    $smarty->display('voucher_type_info.htm');
}

/*------------------------------------------------------ */
//-- 兑换券类型添加的处理
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'insert')
{  
    /* 初始化变量 */
	$vc_name   = !empty($_POST['vc_name']) ? trim($_POST['vc_name']) : '';
    $vc_nickname   = !empty($_POST['vc_nickname']) ? trim($_POST['vc_nickname']) : '';
    $vc_activation_count   = !empty($_POST['vc_activation_count']) ? trim($_POST['vc_activation_count']) : '';
    $vc_price   = !empty($_POST['vc_price']) ? trim($_POST['vc_price']) : '';
    $vc_saleprice   = !empty($_POST['vc_saleprice']) ? trim($_POST['vc_saleprice']) : '';
    $vc_limit_buycount   = !empty($_POST['vc_limit_buycount']) ? trim($_POST['vc_limit_buycount']) : '';
    $vc_limit_storecount   = !empty($_POST['vc_limit_storecount']) ? trim($_POST['vc_limit_storecount']) : '';
    $vc_sort   = !empty($_POST['vc_sort']) ? trim($_POST['vc_sort']) : '';
    $vc_status   = !empty($_POST['vc_status']) ? trim($_POST['vc_status']) : '';

    
    /* 获得日期信息 */
    $use_startdate  = $_POST['use_start_date'];
    $use_enddate    = $_POST['use_end_date'];
    $vc_addtime = date('Y-m-d H:i:s');
    $vc_updatetime = date('Y-m-d H:i:s');

    /* 插入数据库。 */
    $sql = "INSERT INTO ".$ecs->table('voucher')." (vc_name, vc_nickname, vc_activation_count, vc_price, vc_saleprice, vc_limit_buycount, vc_limit_storecount, vc_status, vc_sort, vc_addtime, vc_updatetime, vc_starttime, vc_endtime)
    VALUES ('$vc_name', '$vc_nickname', '$vc_activation_count', '$vc_price', '$vc_saleprice', '$vc_limit_buycount', '$vc_limit_storecount', '$vc_status', '$vc_sort', '$vc_addtime', '$vc_updatetime', '$use_startdate', '$use_enddate')";

    $db->query($sql);

    /* 清除缓存 */
    clear_cache_files();

    /* 提示信息 */
    $link[0]['text'] = $_LANG['continus_add'];
    $link[0]['href'] = 'voucher.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'voucher.php?act=list';

    sys_msg($_LANG['add'] . "&nbsp;" .$_POST['vc_name'] . "&nbsp;" . $_LANG['attradd_succed'],0, $link);

}

/*------------------------------------------------------ */
//-- 兑换券类型编辑页面
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'edit')
{
    admin_priv('voucher_list');

    /* 获取兑换券类型数据 */
    $vc_id = !empty($_GET['vc_id']) ? intval($_GET['vc_id']) : 0;
    $vtype_arr = $db->getRow("SELECT * FROM " .$ecs->table('voucher'). " WHERE vc_id = '$vc_id'");
    $smarty->assign('lang',        $_LANG);
    $smarty->assign('ur_here',     $_LANG['bonustype_edit']);
    $smarty->assign('action_link', array('href' => 'voucher.php?act=list&' . list_link_postfix(), 'text' => $_LANG['voucher_type_list']));
    $smarty->assign('form_act',    'update');
    $smarty->assign('vtype_arr',   $vtype_arr);

    assign_query_info();
    $smarty->display('voucher_type_info.htm');
}

/*------------------------------------------------------ */
//-- 兑换券类型编辑的处理
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'update')
{
    /* 获得日期信息 */
    $use_startdate  = $_POST['use_start_date'];
    $use_enddate    = $_POST['use_end_date'];

    /* 对数据的处理 */
    // $type_name   = !empty($_POST['type_name'])  ? trim($_POST['type_name'])    : '';
    $vc_id = !empty($_POST['vc_id']) ? intval($_POST['vc_id']) : 0;
    $updatetime = date('Y-m-d H:i:s');
    $sql = "UPDATE " .$ecs->table('voucher'). " SET ".
           "vc_name             = '{$_POST[vc_name]}', ".    
           "vc_nickname         = '{$_POST[vc_nickname]}', ". 
           "vc_activation_count = '{$_POST[vc_activation_count]}', ". 
           "vc_price            = '{$_POST[vc_price]}', ". 
           "vc_saleprice        = '{$_POST[vc_saleprice]}', ". 
           "vc_limit_buycount   = '{$_POST[vc_limit_buycount]}', ". 
           "vc_limit_storecount = '{$_POST[vc_limit_storecount]}', ". 
           "vc_sort             = '{$_POST[vc_sort]}', ". 
           "vc_updatetime       = '{$updatetime}', ".
           "vc_starttime        = '{$use_startdate}', ".
           "vc_endtime          = '{$use_enddate}', ".
           "vc_status           = '{$_POST[vc_status]}' ".  
           "WHERE vc_id         = '{$vc_id}'";

   $db->query($sql);

   /* 清除缓存 */
   clear_cache_files();

   /* 提示信息 */
   $link[] = array('text' => $_LANG['back_list'], 'href' => 'voucher.php?act=list&' . list_link_postfix());
   sys_msg($_LANG['edit'] .' '.$_POST['type_name'].' '. $_LANG['attradd_succed'], 0, $link);

}


/*------------------------------------------------------ */
//-- 兑换券订单列表  
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'order_list')
{
    $smarty->assign('full_page',    1);
    $smarty->assign('ur_here',      $_LANG['voucher_order_list']);
    
    $list = get_voucher_order_list();//获取订单信息
    $smarty->assign('vco_list',   $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);
	
	assign_query_info();
    $smarty->display('voucher_order.htm');

}




/**
 * 获取兑换券类型列表
 * @access  public
 * @return void
 */
function get_voucher_list()//***********************************
{
    /* 获得所有兑换券类型的数据 */
    $filter['keyword']    = empty($_REQUEST['keyword']) ? 0 : trim($_REQUEST['keyword']);

    $sql = "SELECT vc_id, COUNT(*) AS sent_count".
            " FROM " .$GLOBALS['ecs']->table('voucher') .
            " GROUP BY vc_id";
    $res = $GLOBALS['db']->query($sql);

    $sent_arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $sent_arr[$row['vc_id']] = $row['sent_count'];
    }

    $result = get_filter();
    

    if ($result === false)
    {
        /* 查询条件 */
        $where = "WHERE 1=1";

        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {

            $filter['keyword'] = json_str_iconv($filter['keyword']);
            
        }
        if ($filter['keyword'])
        {
        
            $where.=" AND price = ". $filter['keyword'];
        }
        
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'vc_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        //$where .= (!empty($filter['keywords'])) ? " AND price LIKE '%" . mysql_like_quote($filter['keywords']) . "%' " : '';
        $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('voucher').$where;

        
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('voucher'). " ORDER BY $filter[sort_by] $filter[sort_order]";

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
        
    }
    $arr = array();

    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);//按条件查询出对应的数据集
    

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $arr[] = $row;
    }
    
    $arr = array('item' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
    
    return $arr;
}


/**
 * 获取兑换券订单列表数据
 * @param   int     $bonus_type_id  红包类型id
 * @return  array
 */




?>