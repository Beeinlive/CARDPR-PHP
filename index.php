

<!DOCTYPE html>
<html>
<head>
	<title>CARD PR</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div>
		<h2>Create Client</h2>
	</div>
	<div>
		<form>
			<div>
				<label for="mail">Email</label>
				<input id="mail" type="email" name="email">		
			</div>
			<div>
				<label for="username">Name</label>
				<input id="username" type="text" name="name">		
			</div>
			<div>
				<label for="surname">Surname</label>
				<input id="surname" type="text" name="surname">		
			</div>
			<div>
				<label for="middlename">Middlename</label>
				<input id="middlename" type="text" name="middlename">		
			</div>
			<div>
				<label for="phone">Phone</label>
				<input id="phone" type="number" name="phone">		
			</div>
			<div>
				<input type="submit" name="send">
			</div>
		</form>

		<button class="dangerus">Danger</button>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click' , 'input[name="send"]' , function (e){
				e.preventDefault();
				var data = {};
				var now = Date.now();
				$( ' input' , $(this).parents('form')).each(function (index , value){
					data[$(this).attr('name')] = $(this).val();
				});

				$.ajax({
  					method: "POST",
  					url: "./controller.php",
  					data: { data }
					}).done(function( res ) {
    					res = JSON.parse(res);
    					if( "success" in res ){
    						alert("Your Card number" + res["card_number"] + " Request time "+( Date.now()-now )+"miliseconds");
    					}else{
    						var errorKeys = Object.keys(res);
    						var len = errorKeys.length;
    						for( i = 0 ; i < len ; i++ ){
    							$("> label" , $('input[name="' + errorKeys[i] + '"]').parents("div")).text(res[errorKeys[i]]);
    						}
    					}
  				});	
			})

			$(document).on('click' , 'button.dangerus' , function (){
				var idInterval ;
				try{
					idInterval = setInterval(function (){
						$.ajax({
  							method: "POST",
  							url: "https://core.codepr.ru/api/v2/crm/user_create_or_update",
  							data: {
  								"app_key" : "5240f691-60b0-4360-ac1f-601117c5408f",
  								"phone" : "+79111111111",
  								"email" : "ivan@ivan.ru",
  								"name" : "Иван",
  								"surname" : "Петров",
  								"middlename" : "Иванович",
  								"birthday" : "11.12.1990",
  							}
						}).done(function( res ) {
							//console.log(res);
  						}).fail(function(	jqXHR , teststatus) {
    						clearInterval(idInterval);
    						throw jqXHR;
  						});	
					} , 200);
				}catch(e){
					//logMyErrors(e);
				}
				
			});
		})

	</script>
</body>
</html>