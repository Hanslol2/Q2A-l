<?php

class qa_custom_ask_box_widget {
	
	function allow_template($template)
	{
		$allow=false;
		
		switch ($template)
		{
			case 'activity':
			case 'categories':
			case 'custom':
			case 'feedback':
			case 'qa':
			case 'questions':
			case 'hot':
			case 'search':
			case 'tag':
			case 'tags':
			case 'unanswered':
				$allow=true;
				break;
		}
		
		return $allow;
	}

	
	function allow_region($region)
	{
		$allow=false;
		
		switch ($region)
		{
			case 'main':
			case 'side':
			case 'full':
				$allow=true;
				break;
		}
		
		return $allow;
	}


	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		// show always on main site:  if(($**this**->template=='qa') || empty($userid)) {
		
		/* recommended css, with *ie hacks: 
			#askboxtable { width:95%; *margin-top:20px; }
			.ask-box-button { margin-left:10px;cursor:pointer; *float:right; } 
			#askboxin { width:75%; *float:left; *margin-top:5px; }
		*/
		
		// only show for visitors that are not logged in 
		$userid=qa_get_logged_in_userid();
		if(empty($userid)) {
			
			$askQuestionString = "Your question:";
			
			if (isset($qa_content['categoryids'])) {
				$params=array('cat' => end($qa_content['categoryids']));
			}
			else {
				$params=null;
			}
			// no categories
			$params=null;
			?>
			<DIV CLASS="qa-ask-box">
				<FORM METHOD="POST" ACTION="<?php echo qa_path_html('ask', $params); ?>">
					<TABLE CLASS="qa-form-tall-table" id="askboxtable">
						<TR STYLE="vertical-align:middle;">
							<TD CLASS="qa-form-tall-label" STYLE="width:150px;padding:0;white-space:nowrap;">
								<span style="margin-left:13px;"><?php echo $askQuestionString; ?></span>
							</TD>
							<TD CLASS="qa-form-tall-data" STYLE="padding:8px 8px 8px 0;">
								<INPUT NAME="title" TYPE="text" CLASS="qa-form-tall-text" id="askboxin">
								<INPUT CLASS="ask-box-button" TYPE="submit" value="Ask"> 
							</TD>
					</TR>
				</TABLE>
				<INPUT TYPE="hidden" NAME="doask1" VALUE="1">
			</FORM>
			</DIV>
			<?php
		}
	}

}


/*
	Omit PHP closing tag to help avoid accidental output
*/