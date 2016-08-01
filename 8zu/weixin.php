<?php
/**
  * wechat php test
  */
header('content-type:text/html;charset=utf-8');
include('./eightT/basic/assets/web.php');

//define your token
$token = md5($_GET['str']);
$to = $_GET['str'];
$sql = "select * from we_account where atok='$to'";
$a = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
// print_r($a);die;
$aid=$a['aid'];
define("TOKEN", $token);
define("AID", $aid);
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($pdo);

class wechatCallbackapiTest
{
	public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
		$this->responseMsg($pdo);
        	exit;
        }
    }

    public function responseMsg($pdo)
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
                $imgTpl ="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
                $voiceTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Voice>
							<MediaId><![CDATA[%s]]></MediaId>
							</Voice>
							</xml>";          
				if(!empty( $keyword )){
        			$setmsg = $pdo->query("SELECT * FROM we_words WHERE w_keywords='".$keyword."' AND aid=".AID)->fetch();
                    $setmsg2 = $pdo->query("SELECT * FROM we_pictures WHERE p_keywords='".$keyword."' AND aid=".AID)->fetch();
                    $med=$setmsg2['mediaid'];
                    $setmsg3 = $pdo->query("SELECT * FROM we_voices WHERE v_keywords='".$keyword."' AND aid=".AID)->fetch();
                    $med2=$setmsg3['mediaid'];
                    if($setmsg){
                        $contentStr=$setmsg['w_content'];
                        $msgType = "text";
                         //$contentStr = "Hello, Little wizard!";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }else if($setmsg2){
                        $msgType = "image";
                        $MediaId = "$med";
                        $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                        echo $resultStr;
                    }else if($setmsg3){
                        $msgType = "voice";
                        $MediaId = "$med2";
                        $resultStr = sprintf($voiceTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                        echo $resultStr;
                    }else{

                        $url="http://www.tuling123.com/openapi/api?key=7a13cc8ea47a7b4d6712e25db831a8f3&info=$keyword";
                        $file=file_get_contents($url);
                        $arr=json_decode($file);
                        $contentStr = $arr->text;
                        $msgType = "text";
                         //$contentStr = "Hello, Little wizard!";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }


        			/*if($keyword=="hello"){
        				$contentStr = "Nice to meet you!";
        			}else if($keyword=="who are you"){
        				$contentStr = "Dont't surprise!We are the same!";
        			}else if($keyword=="你好"){
        				$contentStr = "再次见面了,小巫师!";
        			}else if($keyword=="你是谁"){
                        $contentStr = "不要惊讶!我们是同类!";
                    }else if($keyword=="美女"){
                        $msgType = "image";
                        $MediaId = "Jq4rrb3hFxMSTAfYB7APrVwuA32lysuXMU8_SAYhNlG0QQzksM7fHkUqlXYi1jRQ";
                        $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                        echo $resultStr;
                    }else if($keyword=="枪声"){
                        $msgType = "voice";
                        $MediaId = "LMx_8GE04rXR_EqNc-udUp4cwAnBEl6KVGY1pBx9bbDkeg-kb88HWNb8TkkDOu7I";
                        $resultStr = sprintf($voiceTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                        echo $resultStr;
                    }else{
                        $url="http://www.tuling123.com/openapi/api?key=7a13cc8ea47a7b4d6712e25db831a8f3&info=$keyword";
                        $file=file_get_contents($url);
                        $arr=json_decode($file);
        				$contentStr = $arr->text;
        			}*/
        			
                }else{
			$msgType = "text";
                		$contentStr = "Welcome to come here for the first time! Little wizard!";
                		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                		echo $resultStr;
                	
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>