<?php
require_once('calendar/classes/tc_calendar.php');
?>

<?php
	//Start session
	session_start();	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_PASSWORD']);
?>

<?php
	$conn=mysql_connect("localhost","root","") or die(mysql_error());
	$sdb=mysql_select_db("fyp",$conn) or die(mysql_error());
	if(isset($_POST['submit'])!=""){
	$name=$_FILES['photo']['name'];
	$size=$_FILES['photo']['size'];
	$type=$_FILES['photo']['type'];
	$temp=$_FILES['photo']['tmp_name'];
	$caption1=$_POST['caption'];
	$link=$_POST['link'];
	move_uploaded_file($temp,"gallery/".$name);
	$insert=mysql_query("insert into content_gallery(name)values('$name')");
	if($insert){
	header("location:home_admin.php");
	}
	else{
	die(mysql_error());
	}
	}
	

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Applied Informatics Research Group</title>

<link href="default.css" rel="stylesheet" type="text/css" media="screen" />

	<link href="themes/4/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/4/js-image-slider.js" type="text/javascript"></script>
   
 
 
<script type="text/javascript" src="amcharts_3.11.3.free/amcharts/amcharts.js"></script>
<script type="text/javascript" src="amcharts_3.11.3.free/amcharts/pie.js"></script>

   
   
   
    
    <link href="generic.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="favicon.ico">









<style type="text/css">
.clockStyle {
background-color:white;
border:#999 0px inset;
padding:6px;
color:black;
font-family:"Arial Black", Gadget, sans-serif;
        font-size:16px;
        font-weight:bold;
letter-spacing: 2px;
display:inline;
}
#div1{
	position: absolute;
	left: 300px;
	top: 320px;
	padding: 0px;
	margin: 0px;
	width: 740px;
	height: 870px;
	background-color:#999;
	box-shadow: #000 50px 50px 50px;
	border-radius: 25px;	
	display:none;
	}
	#div2{
		position:absolute;
		left:680px;
		top:340px;
		width:260px;
		height:220px;
		background-color:#000
		
		}

body,td,th {
	color: #000000;
}
</style>
</head>
<body>
<div id="header">
	<div id="logo">
		<h1><a href="#"><span>ai</span>research group</a></h1>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <form action="login.php" method="">
			<p style="text-align:center">
			
			<input type="submit" name="submit" value="Login">
			<a href="register.php"><br><br>Dont have an account? Sign Up</a></p>
			</form>
            </p>
        
	</div>
	<div id="menu">
	<div id="shadow"></div><div id="shadow1"></div><div id="shadow2"></div><div id="shadow3"></div>
			<div id="shadow4"></div><div id="shadow5"></div><div id="shadow6"></div><div id="shadow7"></div>

		<ul id="main">
			<li class="current_page_item"><a id="ii1" href="home.php">Home</a></li>
			<li><a id="ii2" href="objectives.php">Objectives</a></li>
            <li><a id="ii3" href="group_members.php">Group Members</a></li>
			<li><a id="ii4" href="research_fields.php">Research Fields</a></li>
            <li><a id="ii5" href="research_papers.php">Research Papers</a></li>
			<li><a id="ii6" href="archives.php">Archives</a></li>
			<li><a id="ii7" href="contact_us.php">Contact Us</a></li>
            <li><a id="ii8"  href="news.php">News</a></li>
		</ul>
	</div>
	
</div>
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<li>
					<a href="events.php"><h2>Recent Activity</h2></a>
					<ul>
						<li>
					<?php
						$con=mysqli_connect("localhost","root","","fyp");
						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						
						$result = mysqli_query($con,"SELECT * FROM news");
						
						echo '<br>'; // column1

						while($row = mysqli_fetch_array($result))
						  { 
							echo '  ';
							echo $row["content"];
							echo '<br>';
							echo '<br>';
							echo 'Date Updated :',$row["date"];
							echo '<br>';
							echo '<br>';
						}
						
						mysqli_close($con);
					?>	
                    

						</li>
						
					</ul>
				</li>
				<li>
					<h2>Calendar</h2>
                    <div id="calendar_wrap">
                    <br>
				<?php
					  $myCalendar = new tc_calendar("date2");
					  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(1890, 2080);
									  
					  $myCalendar->dateAllow('1890-01-01', '2045-05-01', false);
									  
					  $myCalendar->setSpecificDate(array("2039-01-10", "2039-01-13", "2039-01-23"), 0, 'month');
									  
					  $myCalendar->writeScript();
	  			?>
                    </div>
				</li>
				
				<li>
					<a href="archives.php"><h2>Archives</h2></a>
					<ul>
						<li>
                        <?php
                    $select=mysql_query("select * from content_file_management");
                    while($row1=mysql_fetch_array($select)){
                    $name=$row1['name'];
					$content_no=$row1['content_no'];
					
                    ?>
                        <a href="download.php?filename=<?php echo $name;?>"><?php echo $name ;?></a><br>
                    <?php }?>
                    
                    </li>

					</ul>
				</li>
			</ul>
		</div>
		<!-- start content -->
		<div id="content">
			
       
			<div class="post">
            <h1 class="title"><a href="#">Research Papers</a></h1>
				<h1 class="title"><a href="#">Welcome to AI Research Group Website!</a></h1>
			<p class="byline"><small style="font-size:15px;font-style:italic; color:#000;"> <br/> </small></p>
                
		
         
          
		</div>
        
        
		  <div class="post">
          
          
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Research Papers Archive</b>
            <br>
            <br>

            <!--<table border="0" align="center" id="table1" cellpadding="0"cellspacing="0">
                    <tr>
                    <td align="left">Date Posted</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td align="left">Click to Download</td>
                    </tr>
                    
                   <?php
                    $select=mysql_query("select * from content_research_paper");
                    while($row1=mysql_fetch_array($select)){
                    $name=$row1['name'];
					$content_no=$row1['content_no'];
					$date=$row1['date'];
					
                    ?>
                    <tr>
                   		<td>
                       	 <?php echo $date;?>
                        </td>
                        
                        <td>
                        </td>
                        
                        <td width="300">
                        <a href="download.php?filename=<?php echo $name;?>"><?php echo $name ;?></a>
                        </td>
                        
                        
                        
                    </tr>
                    <?php }?>
                </table>-->
                
                <?php

					// Error reporting:
					error_reporting(E_ALL^E_NOTICE);
					
					// Including the DB connection file:
					require 'connect_paper.php';
					
					$extension='';
					$files_array = array();
					
					
					/* Opening the thumbnail directory and looping through all the thumbs: */
					
					$dir_handle = @opendir($directory) or die("There is an error with your file directory!");
					
					while ($file = readdir($dir_handle)) 
					{
						/* Skipping the system files: */
						if($file{0}=='.') continue;
						
						/* end() returns the last element of the array generated by the explode() function: */
						//$extension = strtolower(end(explode('.',$file)));
						
						/* Skipping the php files: */
						if($extension == 'php') continue;
					
						$files_array[]=$file;
					}
					
					/* Sorting the files alphabetically */
					sort($files_array,SORT_STRING);
					
					$file_downloads=array();
					
					$result = mysql_query("SELECT * FROM download_paper");
					
					if(mysql_num_rows($result))
					while($row=mysql_fetch_assoc($result))
					{
						/* 	The key of the $file_downloads array will be the name of the file,
							and will contain the number of downloads: */
						
							
						$file_downloads[$row['filename']]=$row['downloads'];
						
										
					}

?>


				
				<div class="entry">
					
					<?php 

        foreach($files_array as $key=>$val)
        {
            echo '<li>
			<a href="download_counter_paper.php?file='.urlencode($val).'">'.$val.
			'<span class="download-count" title="Times Downloaded">'
			.'&nbsp;&nbsp;&nbsp;&nbsp;'.(int)$file_downloads[$val].'</span> <span class="download-label">download</span></a>
                    </li>';
		}
		
		
//man neveshtam 

	
		$co=mysqli_connect("localhost","root","","fyp");
						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						
						$ros = mysqli_query($co,"SELECT * FROM download_paper ORDER BY id DESC  LIMIT 5");
						
						$tr=array();
						$br=array();
						while($rak =mysqli_fetch_array($ros))
						{
							 array_push($tr, $rak['filename']);
							array_push($br, $rak['downloads']);
						}
											
					echo "
					<script type=\"text/javascript\">
            var chart;
            var legend;

            var chartData = [
                {
                    \"country\": \"$tr[0]\",
                    \"value\": $br[0]
                },
                {
                    \"country\": \"$tr[1]\",
                    \"value\": $br[1]
                },
                {
                    \"country\": \"$tr[2]\",
                    \"value\": $br[2]
                },
                {
                    \"country\": \"$tr[3]\",
                    \"value\": $br[3]
                },
                {
                    \"country\": \"$tr[4]\",
                    \"value\": $br[4]
                }
            ];


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = \"country\";
                chart.valueField = \"value\";
                chart.outlineColor = \"#FFFFFF\";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                chart.balloonText = \"[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>\";
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
			});
</script>
";
			
			
			
			echo "
			<script type=\"text/javascript\">
			
			
                // WRITE
				AmCharts.ready(function () {
                chart.write(\"chartdiv\");
            });
			
			
			
        </script>
		"
		;
		mysqli_close($co);				
					


 // ta inja
		
?>					
				</div>
                
                <?php
			$con=mysqli_connect("localhost","root","","fyp");
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			
			/*$result = mysqli_query($con,"SELECT content_research_paper.name,person.name,content_research_paper.date FROM content_research_paper INNER JOIN persons ON content_research_paper.username = person.username");*/
			
			$result = mysqli_query($con,"SELECT * FROM content_research_paper ORDER BY date desc");
			
			echo '<br>';
			echo '<b>Reseach Paper</b>'; // column1
			echo '<table border = 2 align="center">';  // <-- starting tags of table
			echo '<tr>'; 
							  echo '<td>'.'<b>'.'Filename'.'</b>'.'</td>';
							  echo '<td>'.'<b>'.'User'.'</b>'.'</td>';
							  echo '<td>'.'<b>'.'Date Uploaded'.'</b>'.'</td>';
							  //echo '<td>'.mysqli_query($result).'</td>';
							  echo '</tr>';
				while($row = mysqli_fetch_array($result))
							  {		 
							  
							    echo '<tr>'; 

								echo '<td>' .$row["name"];	
								echo '<td>' .$row["username"];
								echo '<td>' .$row["date"];	
			 							

								echo '</td>';
								echo '</tr>';
							}
			echo '</table>';		  
			mysqli_close($con);
	?>
			</div>
			<div class="post">
				
				<div class="entry">
					
				</div>
			</div>
		
        
   
        <!--marboot b chart-->

 <div id="chartdiv" style="width:190%; height: 200px;margin-top:0px;margin-left:-230px;"></div>



</div>

 
  

		<!-- end content -->
		<!-- start sidebars -->
        
        
        
        
        
        <!---chart-->
        
       
        
        
        
        
        
        
         
        
        
        
        
        
       
        
        
        
        
        
        
        
        
        
        
		<div id="sidebar2" class="sidebar">
			<ul>
            
            <li>
					<h2>Clock Time</h2>
                    <div id="calendar_wrap">
                    <br>
                    <div id="clockDisplay" class="clockStyle"></div>
					<script type="text/javascript" language="javascript">
                    function renderTime() {
                    var currentTime = new Date();
                    var diem = "AM";
                    var h = currentTime.getHours();
                    var m = currentTime.getMinutes();
                        var s = currentTime.getSeconds();
                    setTimeout('renderTime()',1000);
                        if (h == 0) {
                    h = 12;
                    } 
                    else if (h > 12) { 
                    h = h - 12;
                    diem="PM";
                    }
                    if (h < 10) {
                    h = "0" + h;
                    }
                    if (m < 10) {
                    m = "0" + m;
                    }
                    if (s < 10) {
                    s = "0" + s;
                    }
                        var myClock = document.getElementById('clockDisplay');
                    myClock.textContent = h + ":" + m + ":" + s + " " + diem;
                    myClock.innerText = h + ":" + m + ":" + s + " " + diem;
                    }
                    renderTime();
                    </script>
            </div>
                    </li>
				<li>
					
                   <a href="shoutbox_page.php"><h2>Shoutbox</h2></a>
					<ul>
						<li>
                                <div class="content">
                                     <ul>
                                    <ul>
                                </div>
                     
                        <script type="text/javascript" src="js/jquery.js"></script>
						<script type="text/javascript" src="js/shoutbox.js"></script>
                        </li>
					</ul> 
                    
                    
                    
				</li>
				
                    
                    
				
			</ul>
            <div id="sidebar2" class="sidebar">
			<ul>
            
            <li>
					<h2>Social Media</h2>
                    <div id="calendar_wrap">
                    <br>
                    <div  id="clockDisplay" class="clockStyle">
                    <a  target="_blank" href="http:\\www.facebook.com"><img src="images/64_bm.png" style="cursor:pointer;" /></a>
                   <a target="_blank" href="http:\\www.twitter.com"> <img src="images/700_bm.png" style="cursor:pointer;"/></a>
                    <a target="_blank" href="http:\\www.google.com"><img src="images/702_bm.png"style="cursor:pointer;"/></a>
                  <a target="_blank" href="http:\\www.upm.edu.my">  <img src="images/upm-link.png"style="cursor:pointer;"/></a>
                    </div>
				</div>
            </div>
                    </li>
            
            
		</div>
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>



<div id="footer">
	<p class="copyright"></p>
	<p class="link"><a href="#">Privacy Policy</a>&nbsp;&#8226;&nbsp;<a href="#">Terms of Use</a></p>
</div>
<script type="text/javascript">

$("#div1").fadeIn(800);

$("#ii1").mousemove(function(){
$("#shadow").fadeIn(100);
});
$("#ii1").mouseout(function(){
$("#shadow").fadeOut(100);
});
$("#ii2").mousemove(function(){
$("#shadow1").fadeIn(100);
});
$("#ii2").mouseout(function(){
$("#shadow1").fadeOut(100);
});
$("#ii3").mousemove(function(){
$("#shadow2").fadeIn(100);
});
$("#ii3").mouseout(function(){
$("#shadow2").fadeOut(100);
});
$("#ii4").mousemove(function(){
$("#shadow3").fadeIn(100);
});
$("#ii4").mouseout(function(){
$("#shadow3").fadeOut(100);
});
$("#ii5").mousemove(function(){
$("#shadow4").fadeIn(100);
});
$("#ii5").mouseout(function(){
$("#shadow4").fadeOut(100);
});
$("#ii6").mousemove(function(){
$("#shadow5").fadeIn(100);
});
$("#ii6").mouseout(function(){
$("#shadow5").fadeOut(100);
});
$("#ii7").mousemove(function(){
$("#shadow6").fadeIn(100);
});
$("#ii7").mouseout(function(){
$("#shadow6").fadeOut(100);
});
$("#ii8").mousemove(function(){
$("#shadow7").fadeIn(100);
});
$("#ii8").mouseout(function(){
$("#shadow7").fadeOut(100);
});

</script>


</body>
</html>