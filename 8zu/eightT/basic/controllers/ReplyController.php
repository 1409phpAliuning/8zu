<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\up\Up;
use app\models\We_pictures;
use app\models\We_voices;
class ReplyController extends Controller
{
	public $layout="menu.php";
    public $enableCsrfValidation = false;

   
    //文字回复展示列表
    public function actionWords(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        $sql="select * from we_words join we_account on we_words.aid=we_account.aid where we_words.status=1";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        return $this->render('words',['arr'=>$arr]);
    }
    //文字添加回复列表
    public function actionAddwords(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        return $this->render('addwords');
    }
    //文字添加接值
    public function actionAddwords_do(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       if($_POST){          
            $connection=\Yii::$app->db;
            $arr=\Yii::$app->request->post();
            $w_content=htmlspecialchars($arr['w_content']);
            $arr['w_content']=$w_content;
            //print_r($arr);die;
            $connection->createCommand()->insert('we_words', [
                'aid' => $arr['aid'],
                'w_name' => $arr['w_name'],
                'w_keywords' => $arr['w_keywords'],
                'w_content' => $arr['w_content'],
            ])->execute();
            $this->redirect('index.php?r=reply/words');
        }else{
            return $this->render('addwords');
        }
    }
     //文字删除
    public function actionDelwords(){
        $db = Yii::$app->db->createCommand();
        $bool=$db->delete('we_words',['wid' => $_GET['wid']] )->execute();
        if($bool){
           return $this->redirect('index.php?r=reply/words');
        }else{
            echo "删除失败";
        }
    }
    //图片回复列表
    public function actionPictures(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        $sql="select * from we_pictures join we_account on we_pictures.aid=we_account.aid where we_pictures.status=1";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        return $this->render('pictures',['arr'=>$arr]);
    }
    //图片添加回复列表
    public function actionAddpictures(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        return $this->render('addpictures');
    }
    //图片添加接值
    public function actionAddpictures_do(){
      header('content-type:text/html;charset=utf-8');
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       
       if($_POST){

            $connection=\Yii::$app->db;
            $arr=\Yii::$app->request->post();

            include('../Upload.class.php');       
            $p_content=htmlspecialchars($arr['p_content']);    
            $arr['p_content']=$p_content;
            $p_file=$_FILES['p_file'];
            $p_path = Up::image($p_file);
            //print_r($p_path);
            
            $aid=$arr['aid'];
            $uid=\Yii::$app->session['u_id'];
            $sql="select * from we_account join we_user on we_account.u_id=we_user.uid where we_account.u_id='$uid' and we_account.aid='$aid'";
            $connection=\Yii::$app->db->createCommand($sql);
            $arr1=$connection->queryAll();
            $appid = $arr1[0]['appid'];
            $appsecret = $arr1[0]['appsecret'];
            if(@!$memaccess_token) {
                //获取Access_token
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
                $json = file_get_contents($url);
                $str = json_decode($json,true);
                $accesstoken = $str['access_token'];
                $memcache = \Yii::$app->cache;//开启memcache 缓存
                $memcache->set($appid,$accesstoken,7100);//存储token
            }
            $memcache = \Yii::$app->cache;//开启memcache 缓存

            $memaccess_token = $memcache->get($appid);

            $url="https://api.weixin.qq.com/cgi-bin/media/upload?type=image&access_token=".$memaccess_token;
            $data=array(
              "file"=>"@$p_path"  
            );
            $method="POST"; 
            $file=$this->curlPost($url,$data,$method);          
            $a=json_decode($file,true);
            $media_id=$a['media_id'];
            //print_r($media_id);die;

            /*$connection->createCommand()->insert('we_pictures', [
                'aid' => $arr['aid'],
                'p_name' => $arr['p_name'],
                'p_keywords' => $arr['p_keywords'],
                'p_content' => $arr['p_content'],
                'p_url' => $p_path,
                //'mediaid' => $media_id,
            ])->execute();*/
            $We_pictures = new We_pictures();
            $We_pictures->aid=$arr['aid'];
            $We_pictures->p_name=$arr['p_name'];
            $We_pictures->p_keywords=$arr['p_keywords'];
            $We_pictures->p_content=$arr['p_content'];
            $We_pictures->p_url=$p_path;
            $We_pictures->mediaid=$media_id;
            $We_pictures->save();
            $this->redirect('index.php?r=reply/pictures');
        }else{
            return $this->render('addpictures');
        }
    }
     //图片删除
    public function actionDelpictures(){
        $db = Yii::$app->db->createCommand();
        $bool=$db->delete('we_pictures',['pid' => $_GET['pid']] )->execute();
        if($bool){
           return $this->redirect('index.php?r=reply/pictures');
        }else{
            echo "删除失败";
        }
    }
    //语音回复列表
    public function actionVoices(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        $sql="select * from we_voices join we_account on we_voices.aid=we_account.aid where we_voices.status=1";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        return $this->render('voices',['arr'=>$arr]);
    }
    //语音添加回复列表
    public function actionAddvoices(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        return $this->render('addvoices');
    }
     //语音添加接值
    public function actionAddvoices_do(){
      header('content-type:text/html;charset=utf-8');
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       
       if($_POST){          
            $connection=\Yii::$app->db;
            $arr=\Yii::$app->request->post();

            include('../Upload.class.php');       
            $v_content=htmlspecialchars($arr['v_content']);    
            $arr['v_content']=$v_content;
            $v_file=$_FILES['v_file'];
            $v_path = Up::image($v_file);
            //print_r($v_path);
            
            $aid=$arr['aid'];
            $uid=\Yii::$app->session['u_id'];
            $sql="select * from we_account join we_user on we_account.u_id=we_user.uid where we_account.u_id='$uid' and we_account.aid='$aid'";
            $connection=\Yii::$app->db->createCommand($sql);
            $arr1=$connection->queryAll();
            $appid = $arr1[0]['appid'];
            $appsecret = $arr1[0]['appsecret'];
           if(@!$memaccess_token) {
                //获取Access_token
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
                $json = file_get_contents($url);
                $str = json_decode($json,true);
                $accesstoken = $str['access_token'];
                $memcache = \Yii::$app->cache;//开启memcache 缓存
                $memcache->set($appid,$accesstoken,7100);//存储token
            }
            $memcache = \Yii::$app->cache;//开启memcache 缓存

            $memaccess_token = $memcache->get($appid);
            
            $url="https://api.weixin.qq.com/cgi-bin/media/upload?type=voice&access_token=".$memaccess_token;
            $data=array(
              "file"=>"@$v_path"  
            );
            $method="POST"; 
            $file=$this->curlPost($url,$data,$method);          
            $a=json_decode($file,true);
            $media_id=$a['media_id'];
            //print_r($media_id);die;

            $We_voices = new We_voices();
            $We_voices->aid=$arr['aid'];
            $We_voices->v_name=$arr['v_name'];
            $We_voices->v_keywords=$arr['v_keywords'];
            $We_voices->v_content=$arr['v_content'];
            $We_voices->v_url=$v_path;
            $We_voices->mediaid=$media_id;
            $We_voices->save();
            $this->redirect('index.php?r=reply/voices');
        }else{
            return $this->render('addvoices');
        }
    }
     //语音删除
    public function actionDelvoices(){
        $db = Yii::$app->db->createCommand();
        $bool=$db->delete('we_voices',['vid' => $_GET['vid']] )->execute();
        if($bool){
           return $this->redirect('index.php?r=reply/voices');
        }else{
            echo "删除失败";
        }
    }
    //视频回复列表
    public function actionVideos(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
        return $this->render('videos');
    }

    public function curlPost($url,$data,$method){
            $ch = curl_init();   //1.初始化
            curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
            //4.参数如下
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
              
            if($method=="POST"){//5.post方式的时候添加数据
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tmpInfo = curl_exec($ch);//6.执行

            if (curl_errno($ch)) {//7.如果出错
              return curl_error($ch);
            }
            curl_close($ch);//8.关闭
            return $tmpInfo;
      }
    
}