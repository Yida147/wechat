<?php
namespace Home\Controller;
use Think\Controller;
use Org\Net\Wechat;
class WeixinController extends Controller {

public function index(){
$gpaApiUrl="http://gpa.fyscu.com";
$repairUrl="http://r.fyscu.com";
$devUrl="http://dev.fyscu.com";
$options = array(
		'token'=>'fyscu' //填写你设定的key
	);
$w=new Wechat($options);
$w->valid();
$type = $w->getRev()->getRevType();
switch($type) {
	case Wechat::MSGTYPE_TEXT:

	switch($w->getRevContent()){
		case 'test':
			$sign=md5('u_can_u_up'.$w->getRevFrom(). 'xiaohua_is_baka' . intval(time()/300) .'dsgygb');
			$url=C('SUPER_URL').'?appid='.C('APP_ID').'&superid='.$w->getRevFrom().'&sign='.$sign;
			$arr=array(
				'0'=>array(
					'Title'=>'点击进入一键报修',
					'Description'=>'一键报修是四川大学飞扬俱乐部提供的针对四川大学学生的免费公益电脑维修服务，报修后将会有技术员主动联系您，请您保持手机畅通。',
					'PicUrl'=>$devUrl.'/Public/images/one.png',
					'Url'=>$url
				),


			);
			$w->news($arr)->reply();
			break;
		case '报修':
		case '1':
		case 'bx':
		case 'Bx':
		case 'BX':
		case '保修':
		case '一键报修':
		//$sign=md5('u_can_u_up'.$w->getRevFrom(). 'xiaohua_is_baka' . intval(time()/300) .'dsgygb');
		//$url=C('SUPER_URL').'?appid='.C('APP_ID').'&superid='.$w->getRevFrom().'&sign='.$sign;
		// $sign=encode(time());
		// $url='http://dev.fyscu.com/Home/Index/expire?weixin_key='.$w->getRevFrom().'&sign='.$sign;

		$url = "http://r.fyscu.com";

		$arr=array(
			'0'=>array(
				'Title'=>'点击进入一键报修',
				'Description'=>'一键报修是四川大学飞扬俱乐部提供的针对四川大学学生的免费公益电脑维修服务，报修后将会有技术员主动联系您，请您保持手机畅通。',
				'PicUrl'=>$devUrl.'/Public/images/one.png',
				'Url'=>$url
			),


		);
		$w->news($arr)->reply();
		break;
// 		$content='你好，新版一键报修正在内测,内测完毕我们将会通知你。
// 感谢你的关注！';
// $w->text($content)->reply();
			
		//break;
       	case '接单':
			// $sign=encode(time());
			// $url='http://dev.fyscu.com/Home/Index/expire?weixin_key='.$w->getRevFrom().'&sign='.$sign;
		$url = "http://r.fyscu.com";

			$arr=array(
			'0'=>array(
				'Title'=>'点击进入一键接单',
				'Description'=>'辛苦了技术员',
				'PicUrl'=>$devUrl.'/Public/images/one.png',
				'Url'=>$url
				)

			);
		$w->news($arr)->reply();

		break;
		case 'Log':
		case 'log':
		case '博客':
		case '术业有专攻':
		$sign=md5('u_can_u_up'.$w->getRevFrom(). 'xiaohua_is_baka' . intval(time()/300) .'dsgygb');
		$url=C('SUPER_URL').'?appid='.'1011'.'&superid='.$w->getRevFrom().'&sign='.$sign;
				$arr=array(
			'0'=>array(
				'Title'=>'术业有专攻',
				'Description'=>'点击进入飞扬俱乐部博客',
				'PicUrl'=>'https://mmbiz.qlogo.cn/mmbiz/icXrYrDQetLv7qePaMTKTZub1yurEkLrpxoMYJZH0ibkx0NsvtBVxUtHuJ6NDiaAv85iaBUjhiauzZMsXcic1h8OCkVQ/0',
				'Url'=>$url,
				),


			);
		$w->news($arr)->reply();
		break;
		case 'fly-young组合2':

		case 'fly-young组合1':
		$w->text('飞扬传媒祝您愚人节快乐~随手转发  传播感动传递爱  蟹蟹！')->reply();
		break;
		case '管理':
			// $sign=encode(time());
			// $url='http://dev.fyscu.com/Home/Index/expire?weixin_key='.$w->getRevFrom().'&sign='.$sign;
		$url = "http://r.fyscu.com";

			$arr=array(
			'0'=>array(
				'Title'=>'报修管理',
				'Description'=>'',
				'PicUrl'=>$devUrl.'/Public/images/one.png',
				'Url'=>$url
				)


			);
		$w->news($arr)->reply();

		break;
		case '绩点':
        case 'jd':
        case 'JD':
        case 'Jd':
        case 'jD':
        case '平均分':
        case 'Pjf':
        case 'pjf':

            /*
		$user=json_decode(curl($gpaApiUrl.'/Home/Api/is_user?weixin_key='.$w->getRevFrom()));

        if($user->status==10000){
        $psw=json_decode(curl($gpaApiUrl.'/Home/Api/check_password?id='.$user->school_id.'&password='.$user->school_password));


        if($psw->status==10000){
 
        
        	$gpa=json_decode(curl($gpaApiUrl.'/Home/Api/gpa?id='.$user->school_id.'&password='.$user->school_password));

        	for($i=0;$i<count($gpa->every);$i++){
        		$semester[$i]=$gpa->every[$i]->SemesterName.'
 总学分:'.$gpa->every[$i]->SemesterAllCredit.'
 必修绩点:'.$gpa->every[$i]->required_gpa.'
 所有绩点:'.$gpa->every[$i]->all_gpa.'
 必修平均分:'.$gpa->every[$i]->required_ave.'
 所有平均分:'.$gpa->every[$i]->all_ave.'
 ';
        	}
        	$content='您好,'.$psw->name.'的分学期绩点/平均分计算结果如下:
';
        	foreach ($semester as $k => $v) {
        		$content =$content.$semester[$k];
        	}
         $content=$content.'*本查询结果仅供参考
点击<a href="'.$gpaApiUrl.'/Home/Account/login?weixin_key='.$w->getRevFrom().'">查看详情</a>来自定义计算您的任意门课程的绩点/平均分。';
        $w->text(getsubstr($content,0,590))->reply();

        }else{
	$arr=array(
			'0'=>array(
				'Title'=>'点击进入重新绑定您的教务处账号与密码',
				'Description'=>'系统检测到您已修改过您的教务处密码',
				'PicUrl'=>$devUrl.'/Public/images/gpa.jpg',
				'Url'=>$gpaApiUrl.'/Home/Account/login/weixin_key/'.$w->getRevFrom()
				)


			);
$w->news($arr)->reply();
        }

        }else{
        	$arr=array(
			'0'=>array(
				'Title'=>'点击进入一键计算绩点/平均分',
				'Description'=>'应该是川大做的最好的绩点/加权平均分在线工具。提供每个学期的绩点/平均分，以及所有科目/必修科目的绩点/平均分，并能方便的计算出你选择的任意几门课的成绩。飞扬俱乐部·研发实验室出品',
				'PicUrl'=>$devUrl.'/Public/images/gpa.jpg',
				'Url'=>$gpaApiUrl.'/Home/Account/login/weixin_key/'.$w->getRevFrom()
				)


			);
$w->news($arr)->reply();

        }
*/
            $arr=array(
                '0'=>array(
                    'Title'=>'点击进入一键计算绩点/平均分',
                    'Description'=>'应该是川大做的最好的绩点/加权平均分在线工具。提供每个学期的绩点/平均分，以及所有科目/必修科目的绩点/平均分，并能方便的计算出你选择的任意几门课的成绩。飞扬俱乐部·研发实验室出品',
                    'PicUrl'=>$devUrl.'/Public/images/gpa.jpg',
                    'Url'=>$gpaApiUrl.'/Home/Account/login/weixin_key/'.$w->getRevFrom()
                )


            );
            $w->news($arr)->reply();

		break;
		
		default:
			/*
		$url='http://xxx.com/api?keyword='.$w->getRevContent();
		$regex=curl($url);
        if($regex->status==1){
        switch ($regex->result->type) {
        	case 0:
        		$w->text($regex->result->text)->reply();
        		break;
        	case 1:
        	$arr=array(
			'0'=>array(
				'Title'=>$regex->result->article->title,
				'Description'=> $regex->result->article->description,
				'PicUrl'=>$regex->result->article->picUrl,
				'Url'=>$regex->result->article->url
				)


			);
        	    $w->news($arr)->reply();

        	    break;
        	default:
        		# code...
        		break;
        }

        }else{
        	$url='http://xxx.com/api?mark=else';
		  $regex=curl($url);
          switch ($regex->result->type) {
        	case 0:
        		$w->text($regex->result->text)->reply();
        		break;
        	case 1:
        	$arr=array(
			'0'=>array(
				'Title'=>$regex->result->article->title,
				'Description'=> $regex->result->article->description,
				'PicUrl'=>$regex->result->article->picUrl,
				'Url'=>$regex->result->article->url
				)


			);
        	    $w->news($arr)->reply();

        	    break;
        	default:
        		# code...
        		break;
        }



        }
		*/

			   $w->text("微信菌已收到你的留言啦~
            在每个上完课的晚上，微信菌都会坐在电脑前，倾听你的心声，解答你的疑惑哦~
            回复:
            报修 (进入一键报修)
            绩点 (进入一键查看绩点/平均分)")->reply();


		break;
	}
			
			break;
	case Wechat::MSGTYPE_EVENT:
	$event=$w->getRevEvent();
            if($event['event']=='subscribe'){
	// $url='http://xxx.com/api?mark=else';
	// 	  $regex=curl($url);
 //          switch ($regex->result->type) {
 //        	case 0:
 //        		$w->text($regex->result->text)->reply();
 //        		break;
 //        	case 1:
 //        	$arr=array(
	// 		'0'=>array(
	// 			'Title'=>$regex->result->article->title,
	// 			'Description'=> $regex->result->article->description,
	// 			'PicUrl'=>$regex->result->article->picUrl,
	// 			'Url'=>$regex->result->article->url
	// 			)


	// 		);
 //        	    $w->news($arr)->reply();

 //        	    break;
 //        	default:
 //        		# code...
 //        		break;
 //        }

            	$w->text("终于等到你。
坐。
飞扬俱乐部所有工作人员将竭诚为您服务。有什么技术上的问题可以直接给微信君留言~
回复:
报修 (进入一键报修)
绩点 (进入一键查看绩点/平均分)")->reply();

            }
			break;
	case Wechat::MSGTYPE_IMAGE:
			break;
	default:
	$url='http://xxx.com/api?mark=else';
		  $regex=curl($url);
          switch ($regex->result->type) {
        	case 0:
        		$w->text($regex->result->text)->reply();
        		break;
        	case 1:
        	$arr=array(
			'0'=>array(
				'Title'=>$regex->result->article->title,
				'Description'=> $regex->result->article->description,
				'PicUrl'=>$regex->result->article->picUrl,
				'Url'=>$regex->result->article->url
				)


			);
        	    $w->news($arr)->reply();

        	    break;
        	default:
        		# code...
        		break;
        }
			break;
}
}
}



