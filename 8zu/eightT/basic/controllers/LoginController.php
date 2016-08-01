<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class LoginController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
        if(!file_exists('../assets/install.txt')){
			header("location:../web/index.php");
			die;
		}
        return $this->renderPartial("index");
    }
    public function actionLst(){
        $arr=\Yii::$app->request->post();
        /*$ip_addr = $_SERVER['REMOTE_ADDR'];
        if($ip_addr="::1"){
            $ip_addr="127.0.0.1";
        }
        $sql="select *  from we_ip where iip='$ip_addr' and `iuser`='$arr[name]'";
        $data=\Yii::$app->db->createCommand($sql)->queryAll();*/
        $uname=$arr['name'];
        $upwd=md5($arr['pwd']);
        //if($data){
            $sql="SELECT * FROM `we_user` WHERE uname=:uname AND upwd=:upwd";
            $res=\Yii::$app->db->createCommand($sql)->bindValues([':uname'=>$uname,':upwd'=>$upwd])->queryOne();
            //print_r($res);die;
            if($res){
//                $session = \Yii::$app->session;
//                $session->open();
//                $session->set("uname",$uname);
//                $session->set("u_id",$res['uid']);
                //$_SESSION['u_name']=$uname;
                \Yii::$app->session['uname']=$uname;
                \Yii::$app->session['u_id']=$res['uid'];
                return $this->redirect("index.php?r=index/lsts");die;
            }else{
                echo "账号或密码错误";
            }
//        }else{
//            echo "拒绝该IP地址登录";
//        }
    }
}