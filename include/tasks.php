<?php
/**
 * @calling : 概要、ユーザー機能
 * @purpose
 * @date
 * @argment
 * @return
 */
//
class Tasks {
	//
	function init(){
		global $mRequest, $mConfig, $mUser;
	}
    /* tasks */
    function index(){
		$cls = new Lib_common();
		$tpl['temp_html'] = 'tasks_index.html';
		$cls->write_html($tpl, "user_wrap.html");		
    }
    function api_index(){
		$db= new Lib_sqlite();
		$pdo = get_sqlitePDO();
		$sql = 'SELECT * FROM tasks ORDER BY id desc';
		$items = $db->find_array($pdo, $sql);
		//var_dump($items );
		echo(json_encode($items));
    }
    function create(){
		$cls = new Lib_common();
		$tpl['temp_html'] = 'tasks_create.html';
		$cls->write_html($tpl, "user_wrap.html");		
	}
    function api_create($req){
//		var_dump($req);
//		exit();
		$cls = new Lib_common();
		$db= new Lib_sqlite();
		$pdo = get_sqlitePDO();
		$sql = "insert into tasks(title, content)values('{$req['title']}', '{$req['content']}')";
		$db->exec($pdo, $sql);
//		echo(json_encode(['title' => 't1','content' => 'c1']));
		$tpl['msg']='登録が完了しました。';
		$tpl['temp_html'] = 'user_msg.html';
		$cls->write_sys_message($tpl, "user_wrap.html");
	}
	

}
