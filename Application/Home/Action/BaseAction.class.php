<?php
namespace Home\Action;

use Think\Controller;
class BaseAction extends Controller {
    /**
     * 上传图片
     */
    public function uploadPic(){
       $config = array(
                'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
                'thumb '       =>  false, 
                'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
                'rootPath'      =>  './Upload/', //保存根路径
                'driver'        =>  'LOCAL', // 文件上传驱动
                'subName'       =>  array('date', 'Y-m'),
                'savePath'      =>  I('dir','uploads')."/"
        );
        $upload = new \Think\Upload($config);
        $rs = $upload->upload($_FILES);
        if(!$rs){
            $this->error($upload->getError());
        }else{
            $images = new \Think\Image();
            //生成缩略图，并修改文件名
            $images->open('./Upload/'.$rs['Filedata']['savepath'].$rs['Filedata']['savename']);
            $newsavename = str_replace('.','_thumb.',$rs['Filedata']['savename']);
            $vv = $images->thumb(I('width',100), I('height',100),I('thumb_type',1))->save('./Upload/'.$rs['Filedata']['savepath'].$newsavename);
            $rs['Filedata']['savepath'] = "Upload/".$rs['Filedata']['savepath'];
            $rs['Filedata']['savethumbname'] = $newsavename;
            $rs['status'] = 1;
            echo json_encode($rs);
        }   
    }
    /**
     * 多图片上传
     */
    public function multiUploadPic(){
        $typeArr = array("jpg", "png", "gif");//允许上传文件格式
        $path = "Upload/pics/";//上传路径
        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                echo json_encode(array("error"=>"您还未选择图片"));
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
            
            if (!in_array($type, $typeArr)) {
                echo json_encode(array("error"=>"清上传jpg,png或gif类型的图片！"));
                exit;
            }
            if ($size > (500 * 1024)) {
                echo json_encode(array("error"=>"图片大小已超过500KB！"));
                exit;
            }
            
            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
                echo json_encode(array("error"=>"0","pic"=>$pic_url,"name"=>$pic_name));
            } else {
                echo json_encode(array("error"=>"上传有误，请检查服务器配置！"));
            }
        }
    }
}