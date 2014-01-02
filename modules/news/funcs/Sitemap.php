<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 4/12/2010, 1:27
 */

if( ! defined( 'NV_IS_MOD_NEWS' ) ) die( 'Stop!!!' );

$url = array();
$cacheFile = NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . NV_LANG_DATA . '_' . $module_data . '_Sitemap_' . NV_CACHE_PREFIX . '.cache';
$pa = NV_CURRENTTIME - 7200;

if( ( $cache = nv_get_cache( $cacheFile ) ) != false and filemtime( $cacheFile ) >= $pa )
{
	$url = unserialize( $cache );
}
else
{
	$db->sqlreset()
		->select( 'id, catid, publtime, alias' )
		->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
		->where( 'status=1' )
		->order( 'publtime DESC' )
		->limit( 1000 );
	$result = $db->query( $db->sql() );

	$url = array();

	while( list( $id, $catid_i, $publtime, $alias ) = $result->fetch( 3 ) )
	{
		$catalias = $global_array_cat[$catid_i]['alias'];
		$url[] = array(
			'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $catalias . '/' . $alias . '-' . $id . $global_config['rewrite_exturl'],
			'publtime' => $publtime
		);
	}

	$cache = serialize( $url );
	nv_set_cache( $cacheFile, $cache );
}

nv_xmlSitemap_generate( $url );
die();

?>