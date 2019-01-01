<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/_forms.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <header></header>

    <!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	
    <div class="container">

        <div class="row">
            <div class="col-lg-6 col-md-offset-3">
	    		<form class="submit" method="post">
					<div id="contact-form" class="form-container" data-form-container style="color: rgb(46, 125, 50); background: rgb(200, 230, 201);">
						<div class="row">
							<div class="form-title">
								<span> Create Post </span>
							</div>
						</div>
						<div class="input-container">
							<div class="row">
								<span class="req-input valid" >
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Input your post title."> </span>
									<input type="text" data-min-length="8" placeholder="Card count" name="cardCount">
								</span>
							</div>
						
							<div class="row">
								<div class="message-box">
									<span class="input-status" data-toggle="tooltip" data-placement="top" title="Post Contents."> </span>
										<div class="form-group">
			  								<label for="cardType">Card quality:</label>
										  	<select id="cardType" name="cardType" class="form-control" required>
										  		<option value="" disabled selected>Please Choose...</option>
										  		<?php 
										  			include_once 'calculator.php'; 
										  			$Calculator = new cardLevelCalculator();
										  			foreach ($Calculator::$cardTypesLevels as $key => $value) {
										  				echo '<option value="'.$key.'">'.$key.'</option>';
										  			}
										  		?>
												
											</select>
										</div>
										<div class="form-group">
			  								<label for="cardTypeLevels">Select list:</label>
										  	<select id="cardTypeLevels" name="cardTypeLevels" class="form-control">										  		
											</select>
										</div>
									<div class="row submit-row">
										<button class="btn btn-info btn btn-block submit-form valid">Calculate</button>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
