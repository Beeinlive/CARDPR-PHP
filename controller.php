<?php 
	if( isset($_POST['data']['send'])){
		$errorArray = [];
		$post_array = [
			"email" => "",
			"name" => "",
			"middlename" => "",
			"surname" => "",
			"phone" => ""
		];

		foreach( $_POST['data'] as $key => $value ){
			$_POST['data'][$key] = trim( $value );
		}

		if( !empty( $_POST['data']['name'] ) ){
			if(!preg_match('@[A-Za-z]{3,8}@', $_POST['data']['name'])){
				$errorValues['name'] = 'This field is not valid (count must be 3-8)';	
			}
		}else{
			$errorValues['name'] = 'This Field Is required';
		}
			
		if( !empty( $_POST['data']['surname'] ) ){
			if(!preg_match('/[A-Za-z]{3,15}/', $_POST['data']['surname'])){
				$errorValues['surname'] = 'This field is not valid (count must be 3-15)';	
			}
		}

		if( !empty( $_POST['data']['middlename'] ) ){
			if(!preg_match('/[A-Za-z]{3,15}/isu', $_POST['data']['middlename'])){
				$errorValues['middlename'] = 'This field is not valid (count must be 3-15)';	
			}
		}

		// Mail from Laravel
		if( !empty( $_POST['data']['email'] ) ){
			if(!preg_match('/[a-zA-Z0-9\.\_\%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,6}/isu', $_POST['data']['email'])){
				$errorValues['email'] = 'This field is not valid';	
			}
		}else{
			$errorValues['email'] = 'This Field Is required';
		}

		if(!isset($_POST['data']['phone']) || empty($_POST['data']['phone']) ){
			$errorValues['phone'] = 'This Field Is required';
		}else{
			$_POST['data']['phone'] = '+'.$_POST['data']['phone'];
		}

		if(!empty($errorValues)){
			echo json_encode($errorValues);
			exit();
		}else{
			$differents = array_diff_key($_POST['data'],$post_array);
			foreach ( $differents as $key => $value) {
				unset($_POST['data'][$key]);
			}
			require_once './api.php';
			$apiClass = new ApiCardPr('5240f691-60b0-4360-ac1f-601117c5408f' , 'testphp.codepr.ru');
			echo $apiClass->user_create_or_update($_POST['data']);
			exit;
		}


	}else{
		exit("You Have not permision");
	}
