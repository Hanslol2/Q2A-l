<?php

class qa_html_theme extends qa_html_theme_base
{
	function form_reorder_fields(&$form, $keys, $beforekey = null, $reorderrelative = true)
		if(isset($form_fields["category"])){
			unset($form_fields["category"]);
		}
	}		
}
