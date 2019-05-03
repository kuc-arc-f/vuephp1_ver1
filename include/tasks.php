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
		$cls = new Lib_common();
		$db= new Lib_sqlite();
		$pdo = get_sqlitePDO();
		$sql = "insert into tasks(title, content)values('{$req['title']}', '{$req['content']}')";
		$db->exec($pdo, $sql);
//		$cls->send_xhrHeader();
		echo(json_encode(['title' => $req['title'],'content' => $req['content'] ]));
    }
    function show($req){
//        var_dump($req);
		$cls = new Lib_common();
		$tpl['temp_html'] = 'tasks_show.html';
		$tpl['id'] = $req["id"];
		$cls->write_html($tpl, "user_wrap.html");		
    }   
    function api_show($req){
		$db= new Lib_sqlite();
        $pdo = get_sqlitePDO();
        $sql = "SELECT * FROM tasks where id={$req['id']}";
		$items = $db->find_array($pdo, $sql);        
		echo(json_encode($items) );        
    }   
    function test(){
		$cls = new Lib_common();
		$tpl['temp_html'] = 'test.html';
		$cls->write_html($tpl, "user_wrap.html");		
    }	
	

}
