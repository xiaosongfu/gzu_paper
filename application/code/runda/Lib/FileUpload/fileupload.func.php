<?php
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
class FileUpLoad{
    /*
     * 单个文件上传
     * $inputName 上传文件的控件名
     * $fileRute  文件保存的位置
     * $data
     */
    public function fileUpLoad($inputName,$fileRute,$data = array()){
        //第一步：判断错误
        if($_FILES[$inputName]['error'] == 1 || $_FILES[$inputName]['error'] == 2){
            return Json::makeJson(400,'文件过大');
        }elseif ($_FILES[$inputName]['error'] > 2){
            return Json::makeJson(400,'服务器错误');
        }else{
            //正常
        //第二部：判断类型
            $ext = array_pop(explode(".", basename($_FILES[$inputName]["name"])));
            $allowExt = array("gif","png","jpeg","jpg");
            if(!in_array($ext, $allowExt)){
                return Json::makeJson(400,'不支持的文件类型');
            }
        //第三部：改文件名
            $upfile = $_FILES[$inputName]["tmp_name"];
            $newfile = $fileRute."/".date("Ymd")."/".date("YmdHis").rand(100,999).".".$ext;
        //第四部：保存文件
            if(move_uploaded_file($upfile, $newfile)){
                return Json::makeJson(200,'上传成功',array($data =>$newfile));
            }else{
                return Json::makeJson(400,'服务器错误');
            }
        }
    }
    /*
     * 多个文件上传
     */
    public function filesUpLoad(){
        
    }
}