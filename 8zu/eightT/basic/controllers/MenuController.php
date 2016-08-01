<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class MenuController extends Controller
{
	public $layout="menu.php";
    public $enableCsrfValidation = false;

    //文字回复列表
    public function actionSelfmenu(){
        if(!file_exists('../assets/install.txt')){
               header("location:../web/index.php");
               die;
       }
       $uid=\Yii::$app->session['u_id'];
        if(!isset($uid)){
            return $this->redirect("index.php?r=login/index");
        }
        
        return $this->render('selfmenu');
    }

   public function actionAdd(){
    header('content-type:text/html;charset=utf-8');
      $session = Yii::$app->session;
        $request = \Yii::$app->request;
        /*$ar = \Yii::$app->request->post();
        $aid=$ar['aid'];*/
        $aid  =  $request->post('aid');
        //echo $aid;die;
        $uid=\Yii::$app->session['u_id'];
        $sql="select * from we_account join we_user on we_account.u_id=we_user.uid where we_account.u_id='$uid' and we_account.aid='$aid'";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        $appid = $arr[0]['appid'];
        $appsecret = $arr[0]['appsecret'];

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

       /* $data=' {
     "button":[
     {
          "type":"click",
          "name":"'.$ar['lefts'].'",
          "key":"V1001_TODAY_MUSIC"
      },
      {
          "type":"click",
          "name":"'.$ar['middles'].'",
          "key":"V1001_TODAY_MUSIC"
      },

            {
               "type":"click",
               "name":"'.$ar['rights'].'",
               "key":"V1001_GOOD"
            }]

      }';
*/


      $arr_left_name  =  $request->post('left');       //左name值
           $arr_left_count = count($arr_left_name);       //左name值长度
           $arr_left_type  =  $request->post('leftgenre');  //左type值
           $arr_left_key   =  $request->post('leftmold');   //左key值或者url值
           $arr_left   = array(); //左
           $arr_centre = array(); //中
           $arr_right  = array(); //右 
           $pid = 0;
           if($arr_left_count==1){
               foreach($arr_left_name as $k=>$v){
                        $arr_left[$k]['type'] = $arr_left_type[$k];
                        $arr_left[$k]['name'] = $v;
                        $arr_left[$k]['pid']  = $pid;
                           if($arr_left_type[$k]=='click'){
                               $arr_left[$k]['key'] = $arr_left_key[$k];  
                           }else{
                               $arr_left[$k]['url'] = $arr_left_key[$k];  
                           }
               }
           }else{
               $kk = 0;
               $i  = 0;
               foreach($arr_left_name as $k=>$v){
                    $kk = $k-1;
                    if($kk<0){
                      $arr_left[$k]['name'] = $v;
                      $arr_left[$k]['pid']  = $i;
                      $i +=1;
                      $session->set('left', $i);
                    }else{
                        $pid = $session->get('left');
                        $i +=1;
                        $arr_left[$k]['type'] = $arr_left_type[$kk];
                        $arr_left[$k]['name'] = $v;
                        $arr_left[$k]['pid']  = $pid;
                           if($arr_left_type[$kk]=='click'){
                               $arr_left[$k]['key'] = $arr_left_key[$kk];  
                           }else{
                               $arr_left[$k]['url'] = $arr_left_key[$kk];  
                           }
                    }
               } 
           }           
          //中
           $arr_centre_name  =  $request->post('centre');       //中name值
           $arr_centre_count = count($arr_centre_name);         //中name值长度
           $arr_centre_type  =  $request->post('centregenre');  //中type值
           $arr_centre_key   =  $request->post('centremold');   //中key值或者url值
            $pid = 0;
            if($arr_centre_count==1){
                foreach($arr_centre_name as $k=>$v){
                         $arr_centre[$k]['type'] = $arr_centre_type[$k];
                         $arr_centre[$k]['name'] = $v;
                         $arr_centre[$k]['pid']  = $pid;
                            if($arr_centre_type[$k]=='click'){
                                $arr_centre[$k]['key'] = $arr_centre_key[$k];  
                            }else{
                                $arr_centre[$k]['url'] = $arr_centre_key[$k];  
                      }
                }
            }else{
                $kk = 0;
                $i  = 0;
                foreach($arr_centre_name as $k=>$v){
                     $kk = $k-1;
                     if($kk<0){
                       $arr_centre[$k]['name'] = $v;
                       $arr_centre[$k]['pid']  = $i;
                       $i +=1;
                       $session->set('centre', $i);
                     }else{
                         $pid = $session->get('centre');
                         $i +=1;
                         $arr_centre[$k]['type'] = $arr_centre_type[$kk];
                         $arr_centre[$k]['name'] = $v;
                         $arr_centre[$k]['pid']  = $pid;
                            if($arr_centre_type[$kk]=='click'){
                                $arr_centre[$k]['key'] = $arr_centre_key[$kk];  
                            }else{
                                $arr_centre[$k]['url'] = $arr_centre_key[$kk];  
                          }
                     }
                } 
            }
             //右
           $arr_right_name  =  $request->post('right');       //右name值
           $arr_right_count = count($arr_right_name);         //右name值长度
           $arr_right_type  =  $request->post('rightgenre');  //右type值
           $arr_right_key   =  $request->post('rightmold');   //右key值或者url值
         // print_r($dat);die;
         $pid = 0;
         if($arr_right_count==1){
           //  echo 1;die;
                foreach($arr_right_name as $k=>$v){
                         $arr_right[$k]['type'] = $arr_right_type[$k];
                         
                            $arr_right[$k]['name'] = $v;
                            $arr_right[$k]['pid']  = $pid;
                            if($arr_right_type[$k]=='click'){
                                $arr_right[$k]['key'] = $arr_right_key[$k];  
                            }else{
                                $arr_right[$k]['url'] = $arr_right_key[$k];  
                      }         
                }
            }else{
              //  echo 2;die;
                $kk = 0;
                $i  = 0;
                foreach($arr_right_name as $k=>$v){
                     $kk = $k-1;
                     if($kk<0){
                       $arr_right[$k]['name'] = $v;
                       $arr_right[$k]['pid']  = $i;
                       $i +=1;
                      
                     }else{
                         $pid = $session->get('right');
                         $i +=1;
                         $arr_right[$k]['type'] = $arr_right_type[$kk];
                         $arr_right[$k]['name'] = $v;
                         $arr_right[$k]['pid']  = $pid;
                            if($arr_right_type[$kk]=='click'){
                                $arr_right[$k]['key'] = $arr_right_key[$kk];  
                            }else{
                                $arr_right[$k]['url'] = $arr_right_key[$kk];  
                          }
                     }
                } 
            }
          //  print_r($arr_right);die;
            $arr_11 = array();//指明数组(去子父级pid)
            $arr_2 = array();//指明数组
            //左边
            if($arr_left){
              $arr_left_k = array();
            //  $arr_left_parent = array();
              foreach ($arr_left as $k=>$v){
                $arr_left_k[$k+1] = $v;      
              }
              //获取父类
             $ii = 0;
             $ll = 0;
            foreach($arr_left_k as $k=>$v){
                $arr_left_1 = array();
                if($v['pid']==0){
                        $ii += 1;
                        $arr_left_1[$ii-1] = $v;
                 unset($arr_left_1[$ii-1]['pid']);
                  $session->set('left_name', $v['name']);
                }
              }
            //取得子类
        foreach($arr_left_k as $k=>$v){
                if($v['pid']==1){
                    $left_name = $session->get('left_name');
                    $arr_left_1[$ii - 1]['name'] = $left_name;
                    $arr_left_1[$ii - 1]['sub_button'][$ll] = $v; 
                    $ll ++;
                }
        }
            //去除子父级关系pid
                    foreach($arr_left_1 as $k=>$v){
                        if(count($v)==2){
                        foreach($v['sub_button'] as $kk=>$vv){
                          //   print_r($vv);//输出查看 
                           unset($vv['pid']);
                           $v['sub_button'][$kk] = $vv;
                        }
                        $arr_11[]=$v;
                        $arr_2[] = $arr_11;
                    }else{
                         $arr_2[] = $arr_left_1;
                    }
                  }  
            }
           //  print_r($arr_1);die;//输出查看
            //中间
           if($arr_centre){
            $arr_centre_k = array();
            $arr_centre_parent = array();
            foreach ($arr_centre as $k=>$v){
                   $arr_centre_k[$k+1] = $v;
              }  
             $ii = 0;
             $ll = 0;
             foreach($arr_centre_k as $k=>$v){
                $arr_centre_1 = array();
                if($v['pid']==0){
                    $ii += 1;
                    $arr_centre_1[$ii-1] = $v;
                 unset($arr_centre_1[$ii-1]['pid']);
                  $session->set('centre_name', $v['name']);
                }
            }
            //获取子集
            foreach($arr_centre_k as $k=>$v){
                if($v['pid']==1){
                    $centre_name =  $session->get('centre_name');
                    $arr_centre_1[$ii - 1]['name'] = $centre_name;
                    $arr_centre_1[$ii - 1]['sub_button'][$ll] = $v;  
                    $ll ++;
                }
             }
            
            //去除子父级关系pid(中间)
                    foreach($arr_centre_1 as $k=>$v){
                        if(count($v)==2){
                        foreach($v['sub_button'] as $kk=>$vv){
                           //   print_r($vv);//输出查看 
                           unset($vv['pid']);
                           $v['sub_button'][$kk] = $vv;
                        }
                        $arr_11[]=$v;
                         $arr_2[] = $arr_11;
                    }else{
                         $arr_2[] = $arr_centre_1;
                    }
                  }
            }
            //右面
           if($arr_right){
              // print_r($arr_right);die;
           $arr_right_k = array();
           $arr_right_parent = array();
            foreach ($arr_right as $k=>$v){
                   $arr_right_k[$k+1] = $v;
              }
            $ii = 0;
            $ll = 0;
             foreach($arr_right_k as $k=>$v){
                $arr_right_1 = array();
                if($v['pid']==0){
                    $ii += 1;
                    $arr_right_1[$ii-1] = $v;
                 unset($arr_right_1[$ii-1]['pid']);
                  $session->set('right_name', $v['name']);
                }
            }
            foreach($arr_right_k as $k=>$v){
                if($v['pid']==1){
                    $right_name =  $session->get('right_name');
                    $arr_right_1[$ii - 1]['name'] = $right_name;
                    $arr_right_1[$ii - 1]['sub_button'][$ll] = $v;    
                    $ll ++;
                }
             }
            //去除子父级关系pid
                       foreach($arr_right_1 as $k=>$v){
                        if(count($v)==2){
                        foreach($v['sub_button'] as $kk=>$vv){
                           //   print_r($vv);//输出查看 
                           unset($vv['pid']);
                           $v['sub_button'][$kk] = $vv;
                        }
                      }
                     $arr_11 = $v;
                  }
                    $arr_2[] = $arr_right_1;
            }   
           //数组转换想要的四维数组
            $arr_3 = array();
            $arr_4 = array();
             //  print_r($arr_2);die;
            foreach ($arr_2 as $k=>$v){
                foreach($v as $kk=>$vv){
                } 
              $arr_3[$k] = $vv;  
            }
        //    print_r($arr_3);die;
            //去除未设定值得菜单栏
            foreach($arr_3 as $k=>$v){
                    if(array_key_exists('type',$v) && $v['type']=='0'){
                    unset($arr_3[$k]);
                 }   
            }
            //将只设置父级的菜单转化成二维数组
//           foreach($arr_3 as $k=>$v){
//                if(array_key_exists('name',$v) && $v['name']==''){
//                  foreach($v['sub_button'] as $kk=>$vv){
//                   $arr_3[$k] = $vv;
//                 }   
//                }
//              }
          //print_r($arr_3);die;//输出查看
            $arr_4['button'] = $arr_3;
          //  print_r($arr_4);die;
            $data = json_encode($arr_4,JSON_UNESCAPED_UNICODE);

            //print_r($data);die;
      $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$memaccess_token;
      $method="POST";
      
      $file=$this->curlPost($url,$data,$method);
      
      $a=json_decode($file,true);
      //print_r($a);die;
      if($a['errmsg']=='ok'){
        return $this->redirect('index.php?r=index/lsts');
      }else{
        return $this->redirect('index.php?r=menu/sefmenu');
      }
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