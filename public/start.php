<!doctype html>
<html>
	<head>
		<title>The Big Picture</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />		

		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		
	</head>
	<body style="padding-top:50px;">
		<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand app-title" href="#" style="margin-left:3px;">THE BIG PICTURE</a>
		    <ul class="nav">
		      <li class="active"><a href="/">Projects</a></li>
		      <li><a href="#">Save</a></li>
		      <li><a href="#">Refresh</a></li>
		      <li class="pull-right"><a href="#">Weather: 65F</a></li>
		    </ul>
		  </div>
		</div>


	    <div class="container">
			<div class="row">
				<div class="span6">
					<h1>The Big Picture</h1>
					<p><strong>TBP</strong> is a tool that allows you to visulaize the structure of your HTML mockups in a site-map drag and drop interface with task lists attached to your pages.</p>

					<h2>Directions:</h2>
					<p><ol>
							<li>Create a folder with your project name in the <strong>/mockups/</strong> directory.</li>
							<li>Create mockups the usual way, using your project's css/js/img assets.</li>
							<li>Your page files should all be in the root of the directory, named <strong>filename.html</strong></li>
							<li>When you want to link pages, create regular link tags, with <strong>href="filename.html"</strong></li>
						</ol>
					</p>

					<h2>Features:</h2>
					<p><ol>
							<li>Page positioning get saved.</li>
							<li>Hover over the left sidebar pages to have them highlighted.</li>
							<li>Click on the list icon to flip the page to a task list!</li>
						</ol>
					</p>

					<hr>

					<h2><a href="https://github.com/invalidka/the-big-picture">Fork it on Github</a></h2>
					<p>And help make it into a real product!</p>

				</div>
				<div class="span6">
					<img class="media-object" style="border:1px solid #ccc; margin-top: 20px;" src="/img/sample.png">
				</div>
	    	</div>


			<div class="row">
				<div class="span6 offset6">
					<h2>Your Projects</h2>
					<?php foreach($files['mockups'] as $project_name => $folder) : ?>
						<a class="btn btn-small project-link" href="/?selected=<?=$project_name?>"><?=$project_name?></a><br>
			 		<?php endforeach; ?>
				</div>
	    	</div>
	    </div>

    	
    	<footer>
    		<div class="container">
    			<hr>
    			<div class="row">
    				<div class="span12">
    				<p style="font-size:18px">The Big Picture - Disrupt NY 2013 - <a href="https://github.com/invalidka">Pasha Riger</a></p>
    				</div>
		    	</div>
		    </div>
    	</footer>

	</body>
</html>
