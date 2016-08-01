<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		// $Data = M("Test");
		// $this->data = $Data->select();
		$this->display();
    }
    public function add(){
        echo ($this->_post("title"));
    }
}