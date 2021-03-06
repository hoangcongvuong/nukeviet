<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 28 Dec 2013 12:56:09 GMT
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$count = $db->query( "select count(*) from all_tables where table_name='" . strtoupper( $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows" ) . "'" )->fetchColumn();
if( $count )
{
	$sql_drop_module[] = 'drop table ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_rows cascade constraints PURGE';
	$sql_drop_module[] = 'drop SEQUENCE SNV_' . strtoupper( $lang . '_' . $module_data ) . '_ROWS';

	$sql_drop_module[] = 'drop table ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_menu cascade constraints PURGE';
	$sql_drop_module[] = 'drop SEQUENCE SNV_' . strtoupper( $lang . '_' . $module_data ) . '_MENU';
}

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config["prefix"] . "_" . $lang . "_" . $module_data . "_rows (
 id NUMBER(8,0) DEFAULT NULL,
 parentid NUMBER(8,0) DEFAULT 0 NOT NULL ENABLE,
 mid NUMBER(5,0) DEFAULT 0 NOT NULL ENABLE,
 title VARCHAR2(255 CHAR) DEFAULT '' NOT NULL ENABLE,
 link VARCHAR2(4000 CHAR) NOT NULL ENABLE,
 note VARCHAR2(255 CHAR) DEFAULT '',
 weight NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE,
 sort NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE,
 lev NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE,
 subitem VARCHAR2(4000 CHAR) DEFAULT '',
 who_view NUMBER(3,0) DEFAULT 0 NOT NULL ENABLE,
 groups_view VARCHAR2(255 CHAR) DEFAULT '',
 module_name VARCHAR2(255 CHAR) DEFAULT '',
 op VARCHAR2(255 CHAR) DEFAULT '',
 target NUMBER(3,0) DEFAULT 0 NOT NULL ENABLE,
 css VARCHAR2(255 CHAR) DEFAULT '',
 active_type NUMBER(3,0) DEFAULT 0 NOT NULL ENABLE,
 status NUMBER(3,0) DEFAULT 0 NOT NULL ENABLE,
 primary key (id)
)";

//Tạo TRIGGER cho bảng nv3_vi_module_rows
$sql_create_module[] = 'create sequence SNV_' . strtoupper( $lang . '_' . $module_data ) . '_ROWS';

$sql_create_module[] = 'CREATE OR REPLACE TRIGGER TNV_' . strtoupper( $lang . '_' . $module_data ) . '_ROWS
 BEFORE INSERT ON ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_rows
 FOR EACH ROW WHEN (new.id is null)
	BEGIN
	 SELECT SNV_' . strtoupper( $lang . '_' . $module_data ) . '_ROWS.nextval INTO :new.id FROM DUAL;
	END TNV_' . strtoupper( $lang . '_' . $module_data ) . '_ROWS;';

$sql_create_module[] = "CREATE TABLE " . $db_config["prefix"] . "_" . $lang . "_" . $module_data . "_menu (
 id NUMBER(5,0) DEFAULT NULL,
 title VARCHAR2(50 CHAR) DEFAULT '' NOT NULL ENABLE,
 menu_item VARCHAR2(4000 CHAR) DEFAULT '',
 description VARCHAR2(255 CHAR) DEFAULT '',
 primary key (id),
 CONSTRAINT cnv_" . $lang . "_" . $module_data . "_title UNIQUE (title)
)";

$sql_create_module[] = 'create sequence SNV_' . strtoupper( $lang . '_' . $module_data ) . '_MENU';

$sql_create_module[] = 'CREATE OR REPLACE TRIGGER TNV_' . strtoupper( $lang . '_' . $module_data ) . '_MENU
 BEFORE INSERT ON ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_menu
 FOR EACH ROW WHEN (new.id is null)
	BEGIN
	 SELECT SNV_' . strtoupper( $lang . '_' . $module_data ) . '_MENU.nextval INTO :new.id FROM DUAL;
	END TNV_' . strtoupper( $lang . '_' . $module_data ) . '_MENU;';
?>