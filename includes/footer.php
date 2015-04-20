<!--fotoer-->
<?php
	session_start();
	if(isset($_SESSION['memberloggedin'])){

		include 'msgfn.php';

		$memberid = $_SESSION['memberloggedin'];

		$messages = mysql_query("SELECT * FROM `messages` WHERE 
		(`memberid` = '$memberid' || `friendid` = $memberid )");

		$allmsg = array();

		while($row = mysql_fetch_assoc($messages)){
			if($row['memberid'] == $memberid)
				$fnid = $row['friendid'];
			else
				$fnid = $row['memberid'];
			$allmsg[$fnid] = GetAllMessages($fnid);
		}


?>
<style type="text/css">

	.msgbox{
		z-index: 1000;
		height: 300px;
		background: white;
		width: 250px;
		border: 3px solid #666;
		margin-right: 15px;
		float: right;

		position: fixed;
		bottom: 0px;
		right: 0px;
		z-index: 100;
		height: 300px;
	}
	.msgboxinput{
		width: 100%;
		bottom: 0px;
		left : 0px;
	}
	.msgboxinput input{
		width: 100%;
		height: 30px;
		color:#333;
	}
	.msg-box-head{
		width: 100%;
		background-color: #333;
		color: #fff;
		height: 40px;
		padding: 7px;
		padding-left: 15px;
		vertical-align: middle;
		font-weight: bold;;
		font-size: 1.3em;
	}
	.msg-box-msgs{
		width: 100%;
		height: 230px;
		color: #333;
		padding: 10px;
		overflow: auto;
	}
	.msg-cut , .msg-hide{
		font-weight: normal;
		cursor: pointer;
		padding: 5px;
		margin-top: -5px;

	}
	.header-right{
	float:right;font-weight: normal;font-size: 14px;padding-top: 5px;
	}
	.msg-head-name , .msg-head-name:hover , .msg-head-name:visited ,.msg-head-name:active{
		text-decoration: none;
		color: #fff;
	}
	.footer{
		position: relative;
		z-index: 10;
	}

	.bubble {
	  box-sizing: border-box;
	  float: left;
	  width: auto;
	  max-width: 80%;
	  position: relative;
	  clear: both;
	 
	  background: #95c2fd;
	  background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.15, #bee2ff), color-stop(1, #95c2fd));
	  background-image: -webkit-linear-gradient(bottom, #bee2ff 15%, #95c2fd 100%);
	  background-image: -moz-linear-gradient(bottom, #bee2ff 15%, #95c2fd 100%);
	  background-image: -ms-linear-gradient(bottom, #bee2ff 15%, #95c2fd 100%);
	  background-image: -o-linear-gradient(bottom, #bee2ff 15%, #95c2fd 100%);
	  background-image: linear-gradient(bottom, #bee2ff 15%, #95c2fd 100%);
	  filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#95c2fd', endColorstr='#bee2ff');
	 
	  border: solid 1px rgba(0,0,0,0.5);
	  -webkit-border-radius: 20px;
	  -moz-border-radius: 20px;
	  border-radius: 20px;
	 
	  -webkit-box-shadow: inset 0 8px 5px rgba(255,255,255,0.65), 0 1px 2px rgba(0,0,0,0.2);
	  -moz-box-shadow: inset 0 8px 5px rgba(255,255,255,0.65), 0 1px 2px rgba(0,0,0,0.2);
	  box-shadow: inset 0 8px 5px rgba(255,255,255,0.65), 0 1px 2px rgba(0,0,0,0.2);
	  margin-bottom: 20px;
	  padding: 6px 20px;
	  color: #000;
	  text-shadow: 0 1px 1px rgba(255,255,255,0.8);
	  word-wrap: break-word;
	}

	.bubble:before, .bubble:after {
	  border-radius: 20px / 5px;
	  content: '';
	  display: block;
	  position: absolute;
	}
	.bubble:before {
	  border: 10px solid transparent;
	  border-bottom-color: rgba(0,0,0,0.5);
	  bottom: 0px;
	  left: -7px;
	  z-index: -2;
	}
	.bubble:after {
	  border: 8px solid transparent;
	  border-bottom-color: #bee2ff; /* arrow color */
	  bottom: 1px;
	  left: -5px;
	}

	.bubble-alt {
	  float: right;
	}
	.bubble-alt:before {
	  left: auto;
	  right: -7px;
	}
	.bubble-alt:after {
	  left: auto;
	  right: -5px;
	}
	 
	.bubble p {
	  font-size: 1.4em;
	}

	/* yellow bubble */
	.yellow {
	  background: #7acd47;
	  background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0.15, #fcf3c3),color-stop(1, #f4e371));
	  background-image: -webkit-linear-gradient(bottom, #fcf3c3 15%, #f4e371 100%);
	  background-image: -moz-linear-gradient(bottom, #fcf3c3 15%, #f4e371 100%);
	  background-image: -ms-linear-gradient(bottom, #fcf3c3 15%, #f4e371 100%);
	  background-image: -o-linear-gradient(bottom, #fcf3c3 15%, #f4e371 100%);
	  background-image: linear-gradient(bottom, #fcf3c3 15%, #f4e371 100%);
	  filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#f4e371', endColorstr='#fcf3c3');
	}
	.yellow:after {
	  border-bottom-color: #fcf3c3;
	}



</style>
<div class="msg-row" id="msg-row" >

<?php 
	foreach ($allmsg as $key => $msg) {
	
?>
	<div class="msgbox" id="msg-box-<?php echo $key;?>" style="display:none">
		<div class="msg-box-head" id="msg-box-head-<?php echo $key;?>">
			<span class="text-left">
				<a class="msg-head-name" onclick="return false" href="#"><?php echo $msg[1];?></a>
			</span>
			<span class="text-right header-right">
				<span data-id="<?php echo $key;?>" id="msg-hide-<?php echo $key;?>" class="msg-hide glyphicon glyphicon-minus" aria-hidden="true"></span>
				<span data-id="<?php echo $key;?>" id="msg-cut-<?php echo $key;?>" class="msg-cut glyphicon glyphicon-remove" aria-hidden="true"></span>
			</span>
		</div>
		<div class="msg-box-body" id="msg-body-<?php echo $key;?>">
			<div class="msg-box-msgs">
				<?php
					$i = sizeof($msg) - 1;
					while ($i > 1 ){
						$txt = $msg[$i];
						if($txt[1]=="Me")
							echo '<div class="bubble">';
						else
							echo '<div class="bubble bubble-alt yellow">';
						echo "<b>" . $txt[1] . "</b> : ";
						echo $txt[2];
						echo "</div>";
						$i--;
					}
				?>
			</div>
			<div class="msgboxinput">
				<input class="msg-send" id="msg-input-<?php echo $key;?>" data-id="<?php echo $key;?>">
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<script type="text/javascript">
jQuery.noConflict();
 
var openedArr=[];
var minArr=[];
var flag = 0;
function clickfunction(){
    	var id = jQuery(this).data('id');
    	jQuery('#msg-box-'+id).toggle();
    	var ind = openedArr.indexOf(id);
    	if(flag==1){
	    	if(ind >= 0){
	    		openedArr.splice(ind, 1);
	    	}
	    	else{
	    		openedArr.push(id);
	    	}
	    	localStorage.setItem("open-box", JSON.stringify(openedArr));
	    }

	    offset = 20;

	    for (var i = 0; i <= openedArr.length - 1; i++) {
	    	jQuery("#msg-box-"+openedArr[i]).css("right",offset+"px");
	    	offset+=270;
	    };
 }
function hidefunction(){
    	var id = jQuery(this).data('id');
    	var a = parseInt(jQuery('#msg-box-'+id).css('height'));
    	if(a > 100){
    		a = "40px";
    		mt = "260px"
    	}
    	else{
    		a = "300px";
    		mt = "0px";
    	}
    	jQuery('#msg-box-'+id).css('height',a);
    	jQuery('#msg-box-'+id).css('margin-top',mt);
    	jQuery('#msg-body-'+id).toggle();
    	if(flag==1){
	    	var ind = minArr.indexOf(id);
	    	if(ind >= 0){
	    		minArr.splice(ind, 1);
	    	}
	    	else{
	    		minArr.push(id);
	    	}
	    	localStorage.setItem("min-box", JSON.stringify(minArr));
	    }
}

function sendmsgfunction(e){
	var id = jQuery(this).data('id');
	sendMessage(id,e.keyCode);
}
jQuery( document ).ready(function( $ ) {
    $('.msg-cut').unbind().click(clickfunction);
    $('.msg-hide').unbind().click(hidefunction);
    $('.msg-send').keydown(sendmsgfunction);

    if(typeof(Storage) !== "undefined") {
    	var toshow=[<?php
    		$i = 0;
    		foreach ($allmsg as $key => $msg) {
    			if($msg[0] == "Show"){
    				if($i>0)
    				echo ',';
    				echo $key;
    				$i++;
    			}
    		}
    	?>];
	    opens = localStorage.getItem("open-box");
	   if(opens==null){
	   	localStorage.setItem("open-box", JSON.stringify(toshow));
	   }
	   opens = JSON.parse(JSON.parse(localStorage.getItem("open-box")));
		openedArr = opens;
		for (var i = openedArr.length - 1; i >= 0; i--) {
			if($("#msg-box-"+openedArr[i]).length==0){
		    		openedArr.splice(i, 1);
		    }
		};
	   for (var i = openedArr.length - 1; i >= 0; i--) {

		   	$('#msg-cut-'+openedArr[i]).click();
	   };
	   localStorage.setItem("open-box", JSON.stringify(openedArr));
	   opens = localStorage.getItem("min-box");
	   if(opens==null){
	   	localStorage.setItem("min-box", JSON.stringify([]));
	   }
	   opens = JSON.parse(JSON.parse(localStorage.getItem("min-box")));
		minArr = opens;
		for (var i = minArr.length - 1; i >= 0; i--) {
			if($("#msg-box-"+minArr[i]).length==0){
		    		minArr.splice(i, 1);
		    }
		};
	   for (var i = minArr.length - 1; i >= 0; i--) {
		   	$('#msg-hide-'+minArr[i]).click();
	   };
	   localStorage.setItem("min-box", JSON.stringify(minArr));
	   flag = 1;
	}

});
	
	function update_messages(id,data,flag){
		if(typeof(flag)=="undefined")
			flag = 0;

		var body = jQuery('#msg-body-'+id+" div")[0];
		body.innerHTML = "";

		for (var i = data.length - 1; i >1 ; i--) {
			var msg = data[i];
			var html = "";
			if(msg[0] == 0)
				html += '<div class="bubble bubble-alt yellow">';
			else
				html += '<div class="bubble">'
			html += "<b>" + msg[1] + "</b> : " + msg[2] + "</div>";
			body.innerHTML += html;
		};
		if(flag==1)
		body.scrollTop = body.scrollHeight;
	}

	function update_chatbox(){

		var toputhtml = '<div class="msgbox" id="msg-box-IDOFUSER" style="display:none">\
		<div class="msg-box-head" id="msg-box-head-IDOFUSER">\
			<span class="text-left">\
				<a class="msg-head-name" onclick="return false" href="#">NAMEOFUSER</a>\
			</span>\
			<span class="text-right header-right">\
				<span data-id="IDOFUSER" id="msg-hide-IDOFUSER" class="msg-hide glyphicon glyphicon-minus" aria-hidden="true"></span>\
				<span data-id="IDOFUSER" id="msg-cut-IDOFUSER" class="msg-cut glyphicon glyphicon-remove" aria-hidden="true"></span>\
			</span>\
		</div>\
		<div class="msg-box-body" id="msg-body-IDOFUSER">\
			<div class="msg-box-msgs">\
				\
			</div>\
			<div class="msgboxinput">\
				<input class="msg-send" id="msg-input-IDOFUSER" data-id="IDOFUSER">\
			</div>\
		</div>\
	</div>';

		jQuery.ajax({
			url:"./includes/checkmessage.php",
			type:"PSOT",
			success:function(data){
				data = JSON.parse(data);
				if(data.length==0)
					return;
				for (var id in data) { 
					id = parseInt(id);
					box = jQuery('#msg-box-'+id);
					if(box.length == 0){
						toputhtml =toputhtml.replace(/NAMEOFUSER/gi, data[id][1]);
						toputhtml = toputhtml.replace(/IDOFUSER/gi, id);
						jQuery('#msg-row').append(toputhtml);
					}

					jQuery('.msg-cut').unbind().click(clickfunction);
    				jQuery('.msg-hide').unbind().click(hidefunction);
    				jQuery('.msg-send').on('keydown',sendmsgfunction);

					if(data[id][0]=='Show'){
						if(openedArr.indexOf(id) == -1)
							jQuery("#msg-cut-"+id).click();
						if(minArr.indexOf(id) != -1)
							jQuery("#msg-hide-"+id).click();
						update_messages(id,data[id],1);
					}
					else{
						update_messages(id,data[id]);
					}
				};
			}
		})
	} 


	function sendMessage(id,code){
		if(code == 13){
			var val1 = jQuery('#msg-input-'+id).val();
			if(val1.trim().length==0){
				return;
			}
			jQuery('#msg-input-'+id).val("");

			jQuery.ajax({
				url : './includes/checkmessage.php',
				type : 'POST',
				data:{
					post_type : "SEND_MESSAGE",
					message : val1,
					userid : id
				},
				success : function(data){
					console.log(data);
					var html = '<div class="bubble">';
					html += "<b>Me</b> : " + val1 + "</div>";
					var box = jQuery('#msg-body-'+id+">div")[0];
					box.innerHTML += html;
					box.scrollTop = box.scrollHeight;
				}
			});
		}
	}
	setInterval(update_chatbox, 2000);

</script>

<?php } else{?>

<script type="text/javascript">
	localStorage.clear();
</script>
<?php } ?>
	    <div class="navbar-default footer">
		    <div class="container clearfix">
			    <div class="row">
				    <div class="col-sm-12">
		      <div class="cpyrgt">Copyright 2015. SwingersChatOnline. All Rights Reserved.</div>
		     <div class="ftrnav">
					    <ul>
					    <?php require('includes/footernav.php'); ?>
					    </ul>
		    </div>
		    
			    </div>
		    </div>
	    </div>
    </div>
    <!--fotoer-->
