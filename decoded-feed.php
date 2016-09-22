<!DOCTYPE HTML>
<html>
    <head>
        <title>Facebook Feed Decoder</title>
        <!-- 
        Author: Dustin Hesse
        Version: 1.0.0
        -->
    <meta charset="utf-8">
    </head>
    <body>
    
        <?php
		
			echo	'<h1> Facebook Feed Decoder</h1>';
		
		$jsonfb = $_POST["text"];	
		
		$jsonfb = preg_replace( "/\r|\n/", "", $jsonfb);	
		
		$jsonfb = str_replace("'", "´", $jsonfb);		
	
		$fb = json_decode($jsonfb);
		
		for ($i = 0; $i <= sizeof($fb->{"data"})-1; $i++) {
			
			echo 	'<div style=" width: 300px; padding: 10px; border: 1px solid black;">
						<strong>ID: '.$fb->{"data"}[$i]->{"id"}.'</strong>
						</div>'.
			
					'<div style=" width: 300px; padding: 10px; border: 1px solid black;">
						Created_Time: '.$fb->{"data"}[$i]->{"created_time"}.
						'</div>'.
						
					 '<div style=" width: 300px; padding: 10px; border: 1px solid black;">
						Name: <br />'. $fb->{"data"}[$i]->{"from"}->{"name"}.
						'</div>'.
						
					'<div style="width: 300px; padding: 10px; border: 1px solid black;">
						Message:<br /><br />'.$fb->{"data"}[$i]->{"message"}.'<br /><br />';
						if(strlen($fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"type"})>0) {
						echo 
						'Shared data: <br />'.
						'Type: ' .$fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"type"}.'<br />'.
						'Title: '.$fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"title"}.'<br />'.
						'Reference: <a href="'.$fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"url"}.'">Link</a><br /><br />';
						}
						
				for ($x = 0; $x <= sizeof($fb->{"data"}[$i]->{"attachments"}->{"data"})-1; $x++) {	
				if(strlen($fb->{"data"}[$i]->{"attachments"}->{"data"}[$x]->{"media"}->{"image"}->{"src"})>0){
					echo '<img src="'.$fb->{"data"}[$i]->{"attachments"}->{"data"}[$x]->{"media"}->{"image"}->{"src"}.'" width=250px /><br />		
					<br />Image Description: '.$fb->{"data"}[$i]->{"attachments"}->{"data"}[$x]->{"description"}.'<br /><br />';		
				}
				}
				
				for ($s = 0; $s <= sizeof($fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"subattachments"}->{"data"})-1; $s++) {		
					echo 'Subattachments: <br /><img src="'.$fb->{"data"}[$i]->{"attachments"}->{"data"}[0]->{"subattachments"}->{"data"}[$s]->{"media"}->{"image"}->{"src"}.'" width=250px />';	
				}
			
			if ($_POST['additional_data'] == "value1") {
				echo	'<div style="width: 280px; padding: 10px; border: 1px solid black;">
						Likes: <br /><br />';
						
				for ($n = 0; $n <= sizeof($fb->{"data"}[$i]->{"likes"}->{"data"})-1; $n++) {
					echo $fb->{"data"}[$i]->{"likes"}->{"data"}[$n]->{"name"}.'<br />';
				}
				
					echo '</div><br /><br /><div style="width: 280px; padding: 10px; border: 1px solid black;">
					Comments: <br /><br />';
					
					for ($y = 0; $y <= sizeof($fb->{"data"}[$i]->{"comments"}->{"data"})-1; $y++) {
					echo $fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"created_time"}.'<br />'.
					$fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"from"}->{"name"}.'<br />'.
					$fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"message"}.'<br />';
					if(strlen($fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"attachment"}->{"media"}->{"image"}->{"src"})> 0)
					echo 'Attachment:<br /><img src="'. $fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"attachment"}->{"media"}->{"image"}->{"src"}.'" width=200px /><br /><br />';
					if(strlen($fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"parent"}->{"message"})> 0) {
				    echo 'is a reply to: '.$fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"parent"}->{"message"}.'<br/ >';
					}
					echo 'Likes:'.$fb->{"data"}[$i]->{"comments"}->{"data"}[$y]->{"like_count"}.
					'<br /><br />';
				}
				
			}
					echo '</div><br /></div><br />';
			
				
					
			
					
		}
		
		echo 'Parsed data:<br /><br />';
		print_r($jsonfb);
		
				?>
    </body>
</html>