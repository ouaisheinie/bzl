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
$exc = new exchange($ecs->table('voucher_order'), $db, 'vc_id', 'vc_name');
/*------------------------------------------------------ */
//-- 兑换券类型列表页面
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    
    $smarty->assign('ur_here',     $_LANG['voucher_type_list']);
    
    $smarty->assign('full_page',   1);

    $list = get_type_list();

    $smarty->assign('vco_list',    $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('voucher_order.htm');
}

/*------------------------------------------------------ */
//-- 翻页、排序
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'query')
{

    $list = get_order_comment_list();
    
    $smarty->assign('vco_list',    $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('voucher_order.htm'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
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
function get_voucher_order_list()//***********************************
{
    /* 获得所有兑换券类型的数据 */
    $filter['keyword']    = empty($_REQUEST['keyword']) ? 0 : trim($_REQUEST['keyword']);

    $sql = "SELECT vco_id, COUNT(*) AS sent_count".
            " FROM " .$GLOBALS['ecs']->table('voucher_order') .
            " GROUP BY vco_id";
    $res = $GLOBALS['db']->query($sql);

    $sent_arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $sent_arr[$row['vco_id']] = $row['sent_count'];
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
        
            $where.=" AND vco_id = ". $filter['keyword'];
        }
        
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'vco_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        //$where .= (!empty($filter['keywords'])) ? " AND price LIKE '%" . mysql_like_quote($filter['keywords']) . "%' " : '';
        $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('voucher_order').$where;

        
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('voucher_order'). " ORDER BY $filter[sort_by] $filter[sort_order]";

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

function get_order_comment_list()
{
    $supplier_id = $_SESSION['suppliers_id'];
    $where = " WHERE 1=1";
    /* 查询条件 */
    $filter['keyword']     = empty($_REQUEST['keyword']) ? 0 : trim($_REQUEST['keyword']);
    if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
    {
        $filter['keyword'] = json_str_iconv($filter['keyword']);
        
    }
    if ($filter['keyword'])
    {
    
        $where.=" AND vco_id = ". $filter['keyword'];
    }
    // $filter['sort_by']      = empty($_REQUEST['sort_by']) ? 'vc_addtime' : trim($_REQUEST['sort_by']);
    // $filter['sort_order']   = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
    
    //$where = (!empty($filter['keywords'])) ? " AND price LIKE '%" . mysql_like_quote($filter['keywords']) . "%' " : '';
    
    
    $sql = "SELECT count(*) FROM " .$GLOBALS['ecs']->table('voucher_order'). $where;
    
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    
    /* 分页大小 */
    $filter = page_and_size($filter);

    
    
    /* 获取评论数据 */
    $arr = array();
    $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('voucher_order'). $where . " ORDER BY vco_id DESC";
            
    $res  = $GLOBALS['db']->getall($sql);

    $filter['keywords'] = stripslashes($filter['keywords']);
    $arr = array('item' => $res, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
    

}

function get_type_list()
{
    /* 获得所有兑换券类型的发放数量 */
    $sql = "SELECT vco_id, COUNT(*) AS sent_count".
            " FROM " .$GLOBALS['ecs']->table('voucher_order') .
            " GROUP BY vco_id";
    $res = $GLOBALS['db']->query($sql);

    $sent_arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $sent_arr[$row['vco_id']] = $row['sent_count'];
    }

  

    $result = get_filter();
    if ($result === false)
    {
        /* 查询条件 */
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'vco_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('voucher_order');
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('voucher_order'). " ORDER BY $filter[sort_by] $filter[sort_order]";

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $arr = array();
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);
    

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $row['send_count'] = isset($sent_arr[$row['vco_id']]) ? $sent_arr[$row['vco_id']] : 0;
        $row['use_date_valid'] = ($row['use_start_date'] ? local_date('Y/m/d', $row['use_start_date']) : '').'--'.($row['use_end_date'] ? local_date('Y/m/d', $row['use_end_date']) : '');
        $row['type_money_all'] =  price_format($row['type_money'] * $row['type_money_count']);
        $row['type_money'] = price_format($row['type_money']);
        $arr[] = $row;
    }

    $arr = array('item' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

?>