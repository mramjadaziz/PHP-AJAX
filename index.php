<?php 
include("inc/config.php"); 
include("inc/db_conn.php"); 
include("inc/functions.php"); 
include("header.php"); 

$sql_questions="select * from questions order by que_id";
$rs_questions=mysql_query($sql_questions);
?>
 <script type="text/javascript"  src="js/jquery.min.js"></script>
  <script type="text/javascript"  src="js/jquery.js"></script>
  <script type="text/javascript"  src="js/jquery.1.9.1.js"></script>
   <script type="text/javascript"  src="js/functions.js"></script>
    <!-- FORM START -->
<form name="frm_fsa" method="post" action="submit_inquiry.php">
<div id="answers_ids"></div>
<div class="main_contents" id="sfa_form1">
	<?php
    $count=0;
	while($row_questions=mysql_fetch_object($rs_questions))
	{
		$count+=1;
		echo '<strong>'.$count.': '.$row_questions->question."</strong><br>";
		
		$sql_options="select * from answers where que_id='".$row_questions->que_id."'";
		$rs_options=mysql_query($sql_options);
		
		$sql_groups="select * from answers where que_id='".$row_questions->que_id."' GROUP BY opt_group";
		$rs_groups=mysql_query($sql_groups);
		
		echo '<ul>';
		if($row_questions->question_type==0)
		{		
			while($row_options=mysql_fetch_object($rs_options))
			{
			 echo '<li style="border:1px solid #a9bdc7; margin:2px; padding:3px 2px 3px 5px; border-radius:3px; width:395px; background:#d1dde3"> <input type="radio" id="opt_'.$row_options->opt_id.'" name="'.$row_questions->que_id.'" value="'.$row_options->opt_text.'" onclick="javascript:show_answer('.$row_questions->que_id.','.$row_options->opt_id.');"> '.$row_options->opt_text. '</li>';
			}
		}
		else
		{
			while($row_groups=mysql_fetch_object($rs_groups))
			{
				 echo '<li style="border:1px solid #a9bdc7; margin:2px;padding:3px 2px 3px 5px; border-radius:3px; width:395px; background:#d1dde3"> <input type="radio" id="'.$row_groups->opt_id.'" name="group_'.$row_questions->que_id.'" value="'.$row_groups->opt_group.'" onclick="javascript:show_options('.$row_questions->que_id.',\''.$row_groups->opt_group.'\','.$row_groups->opt_id.');"> '.$row_groups->opt_group.'<div class="group_options_class_'.$row_questions->que_id.'" id="group_options_'.$row_questions->que_id.'_'.$row_groups->opt_id.'"></div></li>';
			}			
		}
		
		echo '</ul>';	
	}
	?>
    <br /><br />
    <div class="inquiry_form_title" id="inquiry_form_title">
    
    <!--<input name="btn_yes" type="button" value="Yes" class="inquiry_button" onclick="window.location.replace('https://secure3.athabascau.ca/registrar/lsp/');" />-->
    <input name="btn_no" type="button" value="Submit" class="inquiry_button" onclick="javascript:show_answers_page();" />
    <input type="button" name="btn_reset" value="Reset" class="inquiry_button" onclick="javascript:reset_page();" />
    </div>
</div>
<div class="right_panel" id="sfa_right_panel">
<?php
$sql_que="select * from questions order by que_id";
$rs_que=mysql_query($sql_que);
	while($row_quebox=mysql_fetch_object($rs_que))
	{
		echo '<div class="answer_box" id="que_'.$row_quebox->que_id.'"></div>';
	}
?>
</div>


<div class="answer_panel" id="sfa_answer_panel">
<h2>ANSWERS:</h2>
<?php
$sql_que2="select * from questions order by que_id";
$rs_que2=mysql_query($sql_que2);
	while($row_quebox2=mysql_fetch_object($rs_que2))
	{
		echo '<div class="answer_box2" id="ans_'.$row_quebox2->que_id.'" ></div>';
	}
?>
<br /><div style="clear:both"></div>
<strong>Did you obtain the answers to your student loan questions?</strong> 
<input name="btn_yes" type="button" value="Yes" class="inquiry_button" onclick="window.location.replace('https://secure3.athabascau.ca/registrar/lsp/');" />
    <input name="btn_no" type="button" value="No" class="inquiry_button" onclick="javascript:show_inquiry_form();" />
</div>


<div class="inquiry_form" id="sfa_form2">
<h2>WEB INQUIRY</h2>
<p>Please complete the inquiry form below. You may expect a response from an AU Student Financial Aid Advisor within 2 business days.</p>
	<label>First Name</label>
    <input type="text" name="fname" id="fname" />

	<label>Last Name</label>
    <input type="text" name="lname" id="lname" />

	<label>Student ID</label>
    <input type="text" name="student_id" id="student_id" />

	<label>Home Phone</label>
    <input type="text" name="phone_home" id="phone_home" />

	<label>Business Phone</label>
    <input type="text" name="phone_business" id="phone_business" />

	<label>Email</label>
    <input type="text" name="email" id="email" />

	<label>Please use the space below to ask your question (300 word max)</label>
    <textarea name="inquiry_detail" id="inquiry_detail" rows="8" cols="80"></textarea>
    <br />
    <input name="btn_sfa_submit" type="submit" value="Submit Inquiry" />
</div>

</form>
    <!-- FORM START -->
    
<?php include("footer.php"); ?>
