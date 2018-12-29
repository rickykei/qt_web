<?php



class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
		 $this->render('index', array('tag'=>$_GET['tag']));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->redirect('loginSuccess');
				return;
			}
		}

		// Clear password
		$model->password = '';
		
		// display the login form
		$this->layout = '//layouts/popup';
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionLoginSuccess()
	{
		$this->renderPartial('loginSuccess');
	}

	public function actionSendMail() {
	Yii::import('ext.PHPMailer.*');
//include('application.extensions.class.smtp.php');
		$mail= new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		//$mail->Host = "smtp.mail.yahoo.com";
		$mail->Port = 465;
		$mail->CharSet = "utf-8";
		
		$mail->Username = Yii::app()->params['enquiryEmailUserID'];
		$mail->Password = Yii::app()->params['enquiryEmailUserPW'];
		
		$mail->From = Yii::app()->params['enquiryEmail'];
		
		$mail->IsHTML(true);
		$mail->AddAddress(Yii::app()->params['enquiryEmail'], "Enquiry");
		
		$customerName = $_REQUEST['name2'];
		$enquiryTeyp = $_REQUEST['select'];
		
		$mail->FromName = $customerName;
		
		$mail->Subject = "[Enquiry] ".$enquiryTeyp." from ".$customerName;
		
		// Set email content
		$message = 'Enquiry Type: '.$enquiryTeyp.
		'<br>Name: '.$customerName.
		'<br>Company: '.$_REQUEST['company2'].
		'<br>Email : '.$_REQUEST['email2'].
		'<br>Phone: '.$_REQUEST['phone2'].
		'<br>Message: '.$_REQUEST['textarea'];
		
		$mail->Body = $message;
		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo."<br>";
		} else {	
			$this->redirect(Yii::app()->homeUrl.'?tag=contactus_thankyou');
		}
	}

		
/********************** Testing Start *******************************************/
	public function actionTest() {
		
		
		$this->renderPartial('test');
	}
 
	public function actionLoginBuyer() {
		//Yii::app()->user->logout();
	
		$model=new LoginForm;
		$model->username = "buyer";
		$model->password = "buyer";
	
		// validate user input and redirect to the previous page if valid
		if($model->validate() && $model->login()) {
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	
	public function actionLoginAuditor() {
		//Yii::app()->user->logout();
	
		$model=new LoginForm;
		$model->username = "quser";
		$model->password = "quser";
	
		// validate user input and redirect to the previous page if valid
		if($model->validate() && $model->login()) {
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	
	public function actionLoginAdmin() {
		//Yii::app()->user->logout();
	
		$model=new LoginForm;
		$model->username = "qadmin";
		$model->password = "qadmin";
	
		// validate user input and redirect to the previous page if valid
		if($model->validate() && $model->login()) {
			$this->redirect(Yii::app()->homeUrl);
		}
	}
/********************** Testing End *******************************************/
 
}