<?php  

    function qa_page_q_post_rules($post, $parentpost=null, $siblingposts=null, $childposts=null)
    {
        $rules =  qa_page_q_post_rules_base($post, $parentpost=null, $siblingposts=null, $childposts=null);
        $userlevel = qa_user_level_for_post($post);
        if($userlevel < QA_USER_LEVEL_ADMIN){
            $rules['recatable'] = false;
        }
        return $rules;
    }
    
    function qa_set_request($request, $relativeroot, $usedformat = null)
    {
        session_start();
        if(isset($_REQUEST["cat"]) && isset($_REQUEST["desc"])){
            include_once(QA_BASE_DIR."/qa-plugin/loolex-custom/loolex-exc.php");
            getCategoryID($_REQUEST["cat"],$_REQUEST["desc"]);
        }
        //var_dump($request);
        $endpoint = "base";
        $dContent = true;
        if(preg_match("(questions\/)",$request)){
            $endpoint = "category";
            $dContent = true;
        }elseif(preg_match("(questions)",$request)){
            $endpoint = "all";
            $dContent = true;
        }elseif(preg_match("(ask)",$request)){
            $endpoint = "ask";
            $dContent = false;
        }elseif(preg_match("(tags)",$request)){
            $endpoint = "tags";
            $dContent = true;
        }elseif($request == ''){
            $endpoint = "base";
            $dContent = true;
        }elseif(preg_match("(admin\/)",$request)){
            $endpoint = "admin";
            $dContent = false;
        }elseif(preg_match("(\/)",$request)){
            $endpoint = "question";        
            $dContent = true;
        }elseif(preg_match("(account)",$request)){
            $endpoint = "account";
            $dContent = false;
        }elseif(preg_match("(favorites)",$request)){
            $endpoint = "favorites";
            $dContent == true;
        }else if(preg_match("(feedback)",$request)){
            $endpoint = "feedback";
            $dContent = false;
        }else if(preg_match("(hot)",$request)){
            $endpoint = "hot";
            $dContent = true;
        }else if(preg_match("(categories)",$request)){
            $endpoint = "cagetories";
            $dContent = true;
        }else if(preg_match("(activity)",$request)){
            $endpoint = "activity";
            $dContent = true;
        }else if(preg_match("(unanswered)",$request)){
            $endpoint = "unanswered";
            $dContent = true;
        }else if(preg_match("(users)",$request)){
            $endpoint = "users";
            $dContent = false;
        }else{
            $endpoint = "category";
        }
        $GLOBALS['endpoint'] = $endpoint;
        $GLOBALS['dContent'] = $dContent;
        
        global $qa_request, $qa_root_url_relative, $qa_used_url_format;
        $qa_request = $request;
        $qa_root_url_relative = $relativeroot;
        $qa_used_url_format = $usedformat;
    }

    function qa_post_html_fields($post, $userid, $cookieid, $usershtml, $dummy, $options = array()){
        require_once QA_INCLUDE_DIR.'qa-db-metas.php';
        $fields = qa_post_html_fields_base($post, $userid, $cookieid, $usershtml, $dummy, $options);
        if( $post["categoryid"] !== ''){
            $query = qa_db_read_one_value(qa_db_query_sub(
                'SELECT content FROM ^categories WHERE categoryid=#',
                $post["categoryid"]
            ),true);
            if($query !== null){
                if (@$options['categoryview'] && isset($post['categoryname']) && isset($post['categorybackpath'])) {
                    $favoriteclass = '';
                    if (count(@$favoritemap['category'])) {
                        if (@$favoritemap['category'][$post['categorybackpath']]) {
                            $favoriteclass = ' qa-cat-favorited';
                        } else {
                            foreach ($favoritemap['category'] as $categorybackpath => $dummy) {
                                if (substr('/' . $post['categorybackpath'], -strlen($categorybackpath)) == $categorybackpath)
                                    $favoriteclass = ' qa-cat-parent-favorited';
                            }
                        }
                    }
                $fields['where'] = qa_lang_html_sub_split('main/in_category_x',
                '<a href="' . qa_path_html(@$options['categorypathprefix'] . implode('/', array_reverse(explode('/', $post['categorybackpath'])))) .
                '" class="qa-category-link' . $favoriteclass . '">' . qa_html(substr($query,0,35).'...') . '</a>');
                }
            }
        }     
		return $fields;
    }
    
    function qa_get_user_avatar_html($flags, $email, $handle, $blobId, $width, $height, $size, $padding = false){
        if (qa_to_override(__FUNCTION__)) { $args=func_get_args(); return qa_call_override(__FUNCTION__, $args); }
		require_once QA_INCLUDE_DIR . 'app/format.php';
		if (strlen($handle) == 0) {
			return null;
		}
		$avatarSource = qa_get_user_avatar_source($flags, $email, $blobId);
		switch ($avatarSource) {
			case 'gravatar':
				$html = qa_get_gravatar_html($email, $size);
				break;
			case 'local-user':
				$html = qa_get_avatar_blob_html($blobId, $width, $height, $size, $padding);
				break;
			case 'local-default':
				$html = qa_get_avatar_blob_html(qa_opt('avatar_default_blobid'), qa_opt('avatar_default_width'), qa_opt('avatar_default_height'), $size, $padding);
				break;
			default: // NULL
				return null;
		}
		return sprintf('<a href="/Q2A/%s" class="qa-avatar-link">%s</a>', qa_path_html('user/' . $handle), $html);
    }


    function qa_get_avatar_blob_html($blobId, $width, $height, $size, $padding = false)
{
	if (qa_to_override(__FUNCTION__)) { $args=func_get_args(); return qa_call_override(__FUNCTION__, $args); }
	require_once QA_INCLUDE_DIR . 'util/image.php';
	require_once QA_INCLUDE_DIR . 'app/users.php';
	if (strlen($blobId) == 0 || (int)$size <= 0) {
		return null;
	}
	$avatarLink = qa_html(qa_get_avatar_blob_url($blobId, $size));
	qa_image_constrain($width, $height, $size);
	$params = array(
		$avatarLink,
		$width && $height ? sprintf(' width="%d" height="%d"', $width, $height) : '',
	);
	$html = vsprintf('<img src="/Q2A/%s"%s class="qa-avatar-image" alt=""/>', $params);
	if ($padding && $width && $height) {
		$padleft = floor(($size - $width) / 2);
		$padright = $size - $width - $padleft;
		$padtop = floor(($size - $height) / 2);
		$padbottom = $size - $height - $padtop;
		$html = sprintf('<span style="display:inline-block; padding:%dpx %dpx %dpx %dpx;">%s</span>', $padtop, $padright, $padbottom, $padleft, $html);
	}
	return $html;
}
