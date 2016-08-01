<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Account;

class IndexController extends Controller
{
    public $layout="menu.php";
    public $enableCsrfValidation = false;
    public function actionLsts(){
		 if(!file_exists('../assets/install.txt')){
			header("location:../web/index.php");
			die;
		}
        //查询他是否有登录
        $session = \Yii::$app->session;
        $session->open();
        $re=$session->get('uname');
        if($re){
            //操作系统
            $system = php_uname();
            //php版本
            $php_edition = phpversion();
            //ip
               /* if (isset($_SERVER)){
                   if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                       $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                   } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                       $realip = $_SERVER["HTTP_CLIENT_IP"];
                   } else {
                       $realip = $_SERVER["REMOTE_ADDR"];
                   }
               } else {
                   if (getenv("HTTP_X_FORWARDED_FOR")){
                       $realip = getenv("HTTP_X_FORWARDED_FOR");
                   } else if (getenv("HTTP_CLIENT_IP")) {
                       $realip = getenv("HTTP_CLIENT_IP");
                   } else {
                       $realip = getenv("REMOTE_ADDR");
                   }
               }*/
            //$realip = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            $realip = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER["REMOTE_ADDR"]);
            $data = array(
                'php_edition' => $php_edition,
                'system' => $system,
                'realip' => $realip
            );
            return $this->render("lsts", ['arr' => $data]);
        }else{
            return $this->redirect("index.php?r=login/index");
        }

    }
    //IP展示
    public function actionIp(){
		 if(!file_exists('../assets/install.txt')){
			header("location:../web/index.php");
			die;
		}
        $arr=\Yii::$app->db->createCommand("select * from we_ip")->queryAll();
        return $this->render("ip",['arr'=>$arr]);
    }
    //ip删除
    public function actionDel(){
        $id=\Yii::$app->request->get("id");
        $arr=\Yii::$app->db->createCommand()->delete("we_ip",['iid'=>$id])->execute();
        if($arr){
            return $this->redirect("index.php?r=index/ip");
        }else{
            echo "删除失败";
        }
    }
    public function actionRemove(){
        $session = Yii::$app->session;
        $session->open();
        $session->remove('uname');
        $session->remove('u_id');
        //unset($_SEESION['u_name']);
        return $this->redirect("index.php?r=index/lsts");
    }
    //ip展示
    public function actionAdd(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        if(empty($_POST)){
            return $this->render("insert");
        }else{
            $session = \Yii::$app->session;
            $session->open();
            $re=$session->get('uname');
            $ip=\Yii::$app->request->post("ip");
            $res=\Yii::$app->db->createCommand("select * from we_ip where iip='$ip' and iuser='$re'")->queryAll();
            if($res){
                echo 1;
            }else{
                $arr=\Yii::$app->db->createCommand()->insert("we_ip",['iip'=>$ip,"iuser"=>$re])->execute();
                if($arr){
                    echo 2;
                }
            }
        }
    }
    
     //公众号展示
    public function actionLists_account(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        /*$sql="select * from we_account join we_user on we_account.u_id=we_user.uid where we_account.u_id='$uid'";*/      
        /*$connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        $num=count($arr);
        return $this->render('lists_account',['arr'=>$arr,'num'=>$num]);*/
         $query = Account::find();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        //print_r($pagination);die;
        $countries = $query
            ->select('we_user.*,we_account.*')
            ->join('INNER JOIN','we_user','we_account.u_id = we_user.uid')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
        return $this->render('lists_account', [
            'arr' => $countries,
            'pagination' => $pagination,
        ]);
        
    }
   
     //公众号增加列表
    public function actionAdd_account(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        return $this->render('add_account');
    }
      /*
     *生成atok
     * */
    public function actionRands($length){
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        $len = strlen($str)-1;
        for($i = 0;$i < $length;$i ++)
        {
            $num = mt_rand(0, $len); $randString .= $str[$num];
        }
        return $randString ;
    }
    //公众号添加
    public function actionAccount_add(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        if($_POST){
            $atok=$this->actionRands(5);

            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url=$protocol.$_SERVER['HTTP_HOST'].'/8zu/weixin.php?str='.$atok;

            /*$url=substr('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],0,strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'we'))."8zu/weixin.php?str=".$atok;*/
            //验证账户唯一
            $appid=\Yii::$app->request->post("appid");
            $res=\Yii::$app->db->createCommand("select * from we_account where appid='$appid'")->queryOne();
            if($res){
                echo 1;
            }else{
                $connection=\Yii::$app->db;
                $arr=\Yii::$app->request->post();
                $arr['atoken']=md5($atok);
                $connection->createCommand()->insert('we_account', [
                    'appid' => $arr['appid'],
                    'aname' => $arr['aname'],
                    'account' => $arr['account'],
                    'appsecret' => $arr['appsecret'],
                    'aurl' => $url,
                    'atok'=> $atok,
                    'u_id'=> \Yii::$app->session['u_id'],
                    'atoken'=>$arr['atoken'],

                ])->execute();
                echo 2;
                //$this->redirect('index.php?r=index/lists_account');
            }
        }else{
            return $this->render('account_add');
        }
    }
    //公众号修改列表
    public function actionSave_account(){
		 if(!file_exists('../assets/install.txt')){
			header("location:../web/index.php");
			die;
		}
        $id=$_GET['aid'];
        $sql="select * from we_account where aid ='$id'";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        return $this->render("save_account",['arr'=>$arr['0']]);
    }
     //公众号修改
    public function actionEdit(){
            $arr=Yii::$app->request->post();
            $db = Yii::$app->db->createCommand()->update('we_account',['aname'=>$arr['aname'],'appsecret'=>$arr['appsecret'],'appid'=>$arr['appid'],'account'=>$arr['account']],'aid=:aid',[':aid'=>$arr['aid']])->execute();
            if($db){
                $this->redirect('index.php?r=index/lists_account');
            }else{
                header("refresh:2;url=index.php?r=index/lists_account");
                die("<h1>修改失败，请联系管理员!</h1>") ;
            }
    }
     //公众号删除
    public function actionDell(){
        $db = Yii::$app->db->createCommand();
        $bool=$db->delete('we_account',['aid' => $_GET['aid']] )->execute();
        if($bool){
           return $this->redirect('index.php?r=index/lists_account');
        }else{
            echo "删除失败";
        }
    }


    public function actionQuan(){
        $aid = $_GET['aid'];
        $session = \Yii::$app->session;
        $session->open();
        $session->set("aid",$aid);
        echo 1;

    }
   
    public function actionMoren(){
        $session = \Yii::$app->session;
        $session->open();
        echo $session->get("aid");
    }
}
