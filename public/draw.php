<!doctype html>
<html>
	<head>
		<title>The Big Picture</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />		
		<link rel="stylesheet" href="css/jsPlumbDemo.css">
		<link rel="stylesheet" href="css/perimeterAnchorsDemo.css">	
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
<!-- 		<link href='http://fonts.googleapis.com/css?family=Stint+Ultra+Expanded' rel='stylesheet' type='text/css'> -->
	    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js'></script>
	    <script type='text/javascript' src='js/jquery.ui.touch-punch.min.js'></script>
		<script type='text/javascript' src='js/jquery.jsPlumb-1.3.16-all-min.js'></script>			

	</head>
	<body style="padding-top:50px;">


<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <a class="brand app-title" href="#" style="margin-left:3px;">THE BIG PICTURE <?=$mockup_folder?' | '.$mockup_folder:''?></a>
    <ul class="nav">
      <li><a href="/">Projects</a></li>
      <li><a class="save-layout" href="#">Save Layout <i class="icon-file"></i></a></li>
      <li><a href="#" class="">Autosave: <input id="auto-save-toggle" type="checkbox" style="top:-4px;position:relative;" checked> - <i id="auto-save-icon" class="icon-ok"></i></a></li>
      <li><a class="refresh-layout" href="/?selected=<?=$mockup_folder?>">Refresh <i class="icon-refresh"></i></a></li>
      <li class="pull-right"><a href="#">Weather: 65F</a></li>
    </ul>
  </div>
</div>


		<div class="sidebar">
			<ul>
				<?php foreach($mockup as $page_name => $links) : ?>
				<li>
					<div class="page">
						<div class="pagename" data-title="<?=$page_name?>"><?=$page_name?></div>
						<ul class="links">
							<?php foreach($links as $linked_to) : ?>
							<li>
								<?=$linked_to?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<script>

		$(".pagename").hover(
		  function () {
		  	$(".thumbnail[data-title='" + $(this).attr('data-title') + "']").css('box-shadow','10px 10px 70px green');
		  },
		  function () {
		    $(".thumbnail[data-title='" + $(this).attr('data-title') + "']").css('box-shadow','none');
		  }
		);

		</script>

		<div class="modal hide fade" style="">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body" style="overflow:hidden;height:90%;">
			</div>	
		</div>

		<?php //set previous positions if positions file exists.

			$ignores = array();
			if(file_exists('ignore_rel.json')){
				$ignores = json_decode(file_get_contents('ignore_rel.json'),true);
			}

			//var_dump($ignores);


			if(file_exists('positions.json'))
			{
				//reorder json array for easy access.
				$old_positions = json_decode(file_get_contents('positions.json'),true);
				$new_positions = array();
				foreach($old_positions as $pos)
				{
					$new_positions[$pos['id']]['left'] = $pos['left'];
					$new_positions[$pos['id']]['top'] = $pos['top'];

					if(isset($pos['notes'])){
						$new_positions[$pos['id']]['notes'] = $pos['notes'];
					}
					
				}
			} 
		?>

		<style>
			.task-list{
				top:50px;
				width: 250px;
				height: 250px;
				position: absolute;
				z-index: 1000;
				background-color: white;
			    border: solid #ccc 1px;
			    padding: 20px 3px 3px 3px;
			}

			.task-list ul, .task-list ul li{
				list-style-type: none;
				   margin: 0px 0px 0px 0px;
				   padding: 0px 0px 0px 0px;
			}
		</style>

		<div style="position:absolute">
		    <div id="demo">
			    <?php foreach($mockup as $page_name => $links) : ?>
			    	<div class="shape page-thumb" data-shape="rectangle" data-title="<?=$page_name?>" style="<?php echo isset($new_positions[$page_name])?'left:'.$new_positions[$page_name]['left'].';top:'.$new_positions[$page_name]['top'].';':'' ?>" id="<?=$page_name?>">
			    		<div class="page-overlay"></div>
			    		<div class="page-title">
			    			<a class="maximize-thumb" data-title="<?=$page_name?>" href="/mockups/<?=$mockup_folder?>/<?=$page_name?>.html" target="_blank"><?=$page_name?> <i class="icon-resize-full"></i></a>
			    			<a class="flip-thumb" data-title="<?=$page_name?>" href="#"><i class="icon-th-list"></i></a>
			    		</div>
			    		<div class="task-list" style="display:none;" data-title="<?=$page_name?>">
			    			<ul>
			    				<li style="margin-bottom:8px;"><strong>TASKS FOR: <?=$page_name?></strong></li>
			    				<li><textarea class="thumb-notes" data-title="<?=$page_name?>" placeholder="Notes" rows="9"><?=isset($new_positions[$page_name]['notes'])?$new_positions[$page_name]['notes']:''?></textarea></li>
				    			</ul>
			    		</div>
			    		<iframe scrolling="no" class="thumbnail" data-title="<?=$page_name?>" src="/mockups/<?=$mockup_folder?>/<?=$page_name?>.html"></iframe>

			    	</div>
				<?php endforeach; ?>
		    </div>
		 </div>

		<script>
			$(".flip-thumb").click(function() {
				if($(".thumbnail[data-title='" + $(this).attr('data-title') + "']").is(":visible")){
					$(".thumbnail[data-title='" + $(this).attr('data-title') + "']").fadeOut();
					$(".task-list[data-title='" + $(this).attr('data-title') + "']").fadeIn();
				}
				else{
					$(".thumbnail[data-title='" + $(this).attr('data-title') + "']").fadeIn();
					$(".task-list[data-title='" + $(this).attr('data-title') + "']").fadeOut();
				}
			});




		</script>
		
		<!--  demo code -->
		<script type="text/javascript">
			;(function() {
				window.jsPlumbDemo = {
						
					init : function() {
						var stateMachineConnector = {				
							connector:"StateMachine",
							paintStyle:{lineWidth:3,strokeStyle:"#000000"},
							hoverPaintStyle:{strokeStyle:"#366"},
							endpoint:"Blank",
							anchor:"Continuous",
							overlays:[ ["PlainArrow", {location:1, width:20, length:12} ]]
						};

						jsPlumb.importDefaults({
							Connector:"StateMachine",
							paintStyle:{lineWidth:3,strokeStyle:"#056"},
							hoverPaintStyle:{strokeStyle:"#dbe300"},
							endpoint:"Blank",
							anchor:"Continuous",
							overlays:[ ["PlainArrow", {location:1, width:20, length:12} ]]
						});
						  
						// NOTE here we are just using getSelector so we don't have to rewrite the code for each of the supported libraries.
						// you can just use the approriate selector from the library you're using, if you want to. like $(".shape) on jquery, for example.
						var shapes = jsPlumb.getSelector(".shape");
							
						// make everything draggable
						jsPlumb.draggable(shapes);

						<?php foreach($mockup as $page_name => $links) : ?>
							<?php foreach($links as $linked_to) : ?>
								<?php if(isset($mockup[$linked_to]) && !(isset($ignores[$page_name]) && in_array($linked_to,$ignores[$page_name]))) : ?>
									jsPlumb.connect( { 
									   source:"<?=$page_name?>",
									   target:"<?=$linked_to?>", 
									   label:'<a href="#" class="relationdel" data-from="<?=$page_name?>" data-to="<?=$linked_to?>">X</a>'
									},stateMachineConnector);
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>

						//ignore relationship
						$('.relationdel').click(function() {
							$.post("/ignore_relationship.php", { from: $(this).data('from'), to: $(this).data('to') } );
							window.location.reload();
						});
			    }    
			  }
			})();
		</script>

		<script type="text/javascript">
			/*
			 *  This file contains the JS that handles the first init of each jQuery demonstration, and also switching
			 *  between render modes.
			 */
			jsPlumb.bind("ready", function() {

				//jsPlumb.DemoList.init();

				// chrome fix.
				document.onselectstart = function () { return false; };				

			    // render mode
				var resetRenderMode = function(desiredMode) {
					var newMode = jsPlumb.setRenderMode(desiredMode);
					$(".rmode").removeClass("selected");
					$(".rmode[mode='" + newMode + "']").addClass("selected");		

					$(".rmode[mode='canvas']").attr("disabled", !jsPlumb.isCanvasAvailable());
					$(".rmode[mode='svg']").attr("disabled", !jsPlumb.isSVGAvailable());
					$(".rmode[mode='vml']").attr("disabled", !jsPlumb.isVMLAvailable());

					//var disableList = (newMode === jsPlumb.VML) ? ",.rmode[mode='svg']" : ".rmode[mode='vml']"; 
				//	$(disableList).attr("disabled", true);				
					jsPlumbDemo.init();
				};
			     
				$(".rmode").bind("click", function() {
					var desiredMode = $(this).attr("mode");
					if (jsPlumbDemo.reset) jsPlumbDemo.reset();
					jsPlumb.reset();
					resetRenderMode(desiredMode);					
				});
				
				// explanation div is draggable
				$("#explanation,.renderMode").draggable();

				resetRenderMode(jsPlumb.SVG);
			       
			});
		</script>

		<script>



			//save layout to file
			function save_layout(){
				var shapes = $('.shape');
				var notes = $('.thumb-notes');
				var jsonObj = []; //declare array

				for (var i = 0; i < shapes.length; i++) {
				        jsonObj.push({id: $(shapes[i]).attr('data-title'), notes: $(notes[i]).val(),  left: $(shapes[i]).css('left'), top: $(shapes[i]).css('top')});
				    }
				$.post("/save_layout.php", { new_positions: JSON.stringify(jsonObj) } );
			    return false;
			}


			//maximizing thumbnails in modal
			$('.maximize-thumb').click(function() {
				console.log('event');
				var url = $(this).attr('href');
				var page_name = $(this).data('title');

			    $('.modal').modal('toggle');
			    $('.modal-title').html(page_name);
			    $('.modal-body').html('<iframe class="thumb-upclose"  frameBorder="0" style="overflow-x: hidden; overflow-y: scroll;width:100%;height:98%" src="'+url+'">');

			    return false;
			});

			//save layout button
			$('.save-layout').click(function() {
				save_layout();
			});

			//save layout to file
			// function save_layout(){
			// 	var shapes = $('.shape');
			// 	var jsonObj = []; //declare array

			// 	for (var i = 0; i < shapes.length; i++) {
			// 	        jsonObj.push({id: $(shapes[i]).attr('data-title'), left: $(shapes[i]).css('left'), top: $(shapes[i]).css('top')});
			// 	    }
			// 	$.post("/save_layout.php", { new_positions: JSON.stringify(jsonObj) } );
			//     return false;
			// }

			//auto save layout if checkbox is checked
			(function auto_save() {
			    setTimeout( function(){

			    	$('#auto-save-icon').attr('class', 'icon-exclamation-sign');
			    	if($('#auto-save-toggle').attr('checked'))
			    	{
			    		save_layout();
			    		$('#auto-save-icon').attr('class', 'icon-ok');
			    	}
			    	auto_save();
			    }, 3000);
			})();	
		</script>

	    <script src="js/bootstrap.min.js"></script>

	</body>
</html>
