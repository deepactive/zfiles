<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>
		<div>
            To reset your password, complete this form: <br><br>
			 {{ URL::to('password/reset', array($token)) }}.<br><br>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes. 
			<br><br><br>
            <hr>
            <span style="font-family:tahoma;">Regards,</span><br>
            
            <span style="font-family:tahoma;">
                {{ Settings::find(1)->sitename }} Team
            </span>
		</div>
	</body>
</html>
