<?php
class qa_html_theme_layer extends qa_html_theme_base {




	function main(){
		$content = $this->content;
		if($GLOBALS['endpoint'] == 'category'){
			$this->content["title"] = "Fragen zum Thema ".$this->content['description'];
		}else if($GLOBALS['endpoint'] == 'ask'){
			$content["title"] = "Eine Frage Stellen zum Thema";
			if(isset($_REQUEST["desc"])){
				$this->content["title"] = "Eine Frage Stellen zum Thema </br>".'<a href="/Q2A/index.php/'.$_REQUEST["cat"].'">'.$_REQUEST["desc"].'</a>';
			}		
		}
		$hidden = !empty($content['hidden']) ? ' qa-main-hidden' : '';
		$extratags = isset($this->content['main_tags']) ? $this->content['main_tags'] : '';
		$this->output('<div class="qa-main' . $hidden . '"' . $extratags . '>');
		$this->widgets('main', 'top');

		if($GLOBALS["dContent"] == true){
			$this->search();
		}
		$this->suggest_next();
		$this->output();
		$this->page_title_error();
		if($GLOBALS['endpoint'] == 'category'){
			$this->output_raw('<div class="qa-suggest-next">
			Stelle eine Frage zum Thema </br><a href="/Q2A/index.php/ask?cat='.preg_replace("(questions\/)","",$this->content['script_var']['qa_request']).'&desc='.$this->content['description'].'">'.$this->content['description'].'</a>
			</div>');
		}
		$this->widgets('main', 'high');	
		$this->main_parts($content);
		$this->widgets('main', 'low');
		$this->page_links();
		$this->suggest_next();
		$this->widgets('main', 'bottom');
		$this->output('</div> <!-- END qa-main -->', '');
	}

	function head_script() // add a Javascript file from plugin directory
    {
		$this->output('<script src="/Resources/jquery.min.js"></script>');
        $this->output('<script src="/Resources/jquery-ui.min.js"></script>');
		$this->output('<script src="/Templates/template.js"></script>');
		qa_html_theme_base::head_script();
	}
	function head_css(){
		$this->output('<link rel="stylesheet" type="text/css" href="/Templates/template.css">');
		$this->output('<link rel="stylesheet" type="text/css" href="/Templates/conditional.css">');
		$this->output('<link rel="shortcut icon" href="/Images/favicon.ico" type="image/png" />');
		$this->output('<link rel="icon" href="/Images/favicon.ico" type="image/png" />');
		qa_html_theme_base::head_css();	
	}
	

}


