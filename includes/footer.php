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
	.msg-row{
		position: fixed;
		bottom: 0px;
		right: 0px;
		z-index: 100;
		height: 300px;
	}
	.msgbox{
		z-index: 1000;
		height: 300px;
		background: white;
		width: 250px;
		border: 3px solid #666;
		margin-right: 15px;
		float: right;
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
	.msg-cut .msg-hide{
		font-weight: normal;
		cursor: pointer;
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
</style>
<div class="msg-row" >

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
					$i = 2;
					while ($i < sizeof($msg)){
						$txt = $msg[$i];
						echo "<b>" . $txt[1] . "</b> : ";
						echo $txt[2];
						echo "<br>";
						$i++;
					}
				?>
			</div>
			<div class="msgboxinput">
				<input>
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
jQuery( document ).ready(function( $ ) {
    $('.msg-cut').click(function(){
    	var id = $(this).data('id');
    	$('#msg-box-'+id).toggle();
    	var ind = openedArr.indexOf(id);
    	if(ind >= 0){
    		openedArr.splice(ind, 1);
    	}
    	else{
    		openedArr.push(id);
    	}
    	localStorage.setItem("open-box", JSON.stringify(openedArr));
    });
    $('.msg-hide').click(function(){
    	var id = $(this).data('id');
    	var a = parseInt($('#msg-box-'+id).css('height'));
    	if(a > 100){
    		a = "40px";
    		mt = "260px"
    	}
    	else{
    		a = "300px";
    		mt = "0px";
    	}
    	$('#msg-box-'+id).css('height',a);
    	$('#msg-box-'+id).css('margin-top',mt);
    	$('#msg-body-'+id).toggle();
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

    });

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
	   for (var i = opens.length - 1; i >= 0; i--) {
		   	$('#msg-box-'+opens[i]).toggle();
	   };

	   opens = localStorage.getItem("min-box");
	   if(opens==null){
	   	localStorage.setItem("min-box", JSON.stringify([]));
	   }
	   opens = JSON.parse(JSON.parse(localStorage.getItem("min-box")));
		minArr = opens;
	   for (var i = opens.length - 1; i >= 0; i--) {
		   	$('#msg-hide-'+opens[i]).click();
	   };
	   flag = 1;
	} 

});
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
