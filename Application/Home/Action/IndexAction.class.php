<?php
namespace Home\Action;

class IndexAction extends BaseAction {
	/**
	 * 跳到首页
	 */
    public function index(){
        $this->display("/onePic");
    }
    public function multiPics(){
        $detail=htmlspecialchars_decode(I('detail'));//函数把一些预定义的 HTML 实体转换为字符
        $this->assign('detail',$detail);
        $this->display("/multiPics");
    }
}