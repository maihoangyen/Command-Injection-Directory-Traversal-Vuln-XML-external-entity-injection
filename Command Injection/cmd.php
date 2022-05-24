<!DOCTYPE html>

<html lang="en-GB">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
    <div >
    <h1>Welcom to myweb</h1>

    <div >
        <form name="ping" action="#" method="post">
			<p>
				Mời nhập địa chỉ IP:
				<input type="text" name="ip" size="30">
				<input type="submit" name="Submit" value="Submit">
			</p>

		</form>
        
    </div>
    </body>

</html>
<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
   
    $target = $_REQUEST[ 'ip' ];

    $target = str_replace(array("&&", ";","|","'"),"",$target);
  
    if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
        
        $cmd = shell_exec( 'ping  ' . $target );
    }
    else {
       
        $cmd = shell_exec( 'ping  -c 4 ' . $target );
    }

    
    echo "<pre>{$cmd}</pre>";
}

?>