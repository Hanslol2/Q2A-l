<?php
/*
*   Q2A Market Royal Minimal
*
*   Theme class
*   File: qa-theme.php
*   
*   @author         Q2A Market
*   @category       Theme
*   @Version:       1.2.1
*   @author URL:    http://www.q2amarket.com
*   
*   @Q2A Version    1.7
*
*/

class qa_html_theme extends qa_html_theme_base {

    private $brand_slug    = 'qm';
    private $theme_name    = 'RoyalMinimal';
    private $theme_version = '1.0';
    private $theme_prefix  = 'rm_';
    
    
    // updating html class for off canvance menu js
    function html()
    {
        
        $this->output(
                '<HTML class="no-js">', '<!-- Powered by Question2Answer - http://www.question2answer.org/ -->'
        );

        $this->head();
        
        $pathToFile= dirname(__DIR__, 3);
        $templateContent = file_get_contents($pathToFile."/Templates/template.php");
        $this->output_raw($templateContent);
        
        $this->body();
		
        $this->output(
                '<!-- Powered by Question2Answer - http://www.question2answer.org/ -->', '</HTML>'
        );
        
    }

    // head title for device width meta tag
    function head_title()
    {
        $this->output('<META NAME="viewport" CONTENT="width=device-width, initial-scale=1, minimum-scale=1"/>');
        qa_html_theme_base::head_title();
    }

    function get_lang_type()
    {
        return $this->isRTL ? '-rtl' : null;
    }

    // register all theme css
    function head_css()
    {

        $google_heading = (qa_opt($this->theme_prefix . 'heading_fonts') == 'Open Sans') ? str_replace(' ', '+', 'Open Sans') : str_replace(' ', '+', qa_opt($this->theme_prefix . 'heading_fonts'));

        $google_body = (qa_opt($this->theme_prefix . 'body_fonts') == 'Open Sans') ? str_replace(' ', '+', 'Open Sans') : str_replace(' ', '+', qa_opt($this->theme_prefix . 'body_fonts'));

        // check whether heading and body font family is the same
        $get_fonts = ($google_heading == $google_body || $google_body == $google_heading) ? $google_body . ':300' : $google_heading . ':300|' . $google_heading . ':400|' . $google_body . ':300|' . $google_body . ':400';

        $this->output('<link href="http://fonts.googleapis.com/css?family=' . $get_fonts . '" rel="stylesheet" type="text/css"/>');
        
        qa_html_theme_base::head_css();

        // theme stylesheets
        $this->output('<LINK REL="stylesheet" TYPE="text/css" HREF="' . $this->rooturl . $this->theme_css() . '"/>');
        $this->output('<LINK REL="stylesheet" TYPE="text/css" HREF="' . $this->rooturl . $this->icons_css() . '"/>');
        $this->output('<LINK REL="stylesheet" TYPE="text/css" HREF="' . $this->rooturl .
                $this->color_css() . '"/>');
		$this->output('<link rel="stylesheet" type="text/css" href="/Templates/template.css">');
		$this->output('<link rel="shortcut icon" href="/Images/favicon.ico" type="image/png" />');
		$this->output('<link rel="icon" href="/Images/favicon.ico" type="image/png" />');
		
        // setting up fonts
        $this->font_css();
       
    }

    // register theme_css
    function theme_css()
    {
        return 'css/' . $this->brand_slug . '-style' . $this->get_lang_type() . '.css?' . $this->theme_name . '-' . $this->theme_version;
    }

    // register icon css
    function icons_css()
    {
        return 'css/fontello.css?' . $this->theme_name . '-' . $this->theme_version;
    }

    function color_css()
    {
        return 'css/' . $this->brand_slug . '-' . strtolower(qa_opt($this->theme_prefix . 'color_scheme')) . '.css?' . $this->theme_name . '-' . $this->theme_version;
    }

    function font_css()
    {
        $this->output('
	    	<style>
	    		body{font-family:"Varela Round", sans-serif;}    		
	    		h1, h2, .qa-q-item-title, h1.entry-title{font-family:"Varela Round", sans-serif;font-weight:300}
	    	</style>
	    	');
    }

    // register all head js script
    function head_script() // change style of WYSIWYG editor to match theme better
    {
        qa_html_theme_base::head_script();
        $this->output('<script src="' . $this->rooturl . 'js/modernizr.custom.js"></script>');
        $this->output('<script src="' . $this->rooturl . 'js/classie.js"></script>');
        $this->output('<script src="' . $this->rooturl . 'js/theme.js"></script>');
        $this->output('<script src="/Resources/jquery.min.js"></script>');
        $this->output('<script src="/Resources/jquery-ui.min.js"></script>');
        $this->output('<script src="/Templates/template.js"></script>');
                
    }

    // override body tags for off canvace menu
    function body_tags()
    {
        $class = 'qa-template-' . qa_html($this->template);

        if (isset($this->content['categoryids']))
            foreach ($this->content['categoryids'] as $categoryid)
                $class.=' qa-category-' . qa_html($categoryid);

        $this->output('CLASS="' . $class . ' qa-body-js-off qa-spmenu-push"');
    }

    // unset user navigation item for customer header part
    function nav_user_search() // outputs login form if user not logged in
    {
        unset($this->content['navigation']['user']['account']);
        unset($this->content['navigation']['user']['updates']);
        unset($this->content['navigation']['user']['logout']);

        qa_html_theme_base::nav('user');
    }

    // this entire section has been override with blank output
    function logged_in()
    {
        // if (qa_is_logged_in()) // output user avatar to login bar
        // 	$this->output(
        // 		'<div class="qa-logged-in-avatar">',
        // 		QA_FINAL_EXTERNAL_USERS
        // 		? qa_get_external_avatar_html(qa_get_logged_in_userid(), 24, true)
        // 		: qa_get_user_avatar_html(qa_get_logged_in_flags(), qa_get_logged_in_email(), qa_get_logged_in_handle(),
        // 			qa_get_logged_in_user_field('avatarblobid'), qa_get_logged_in_user_field('avatarwidth'), qa_get_logged_in_user_field('avatarheight'),
        // 			24, true),
        //          		'</div>'
        //          	);	
        //$login=@$this->content['navigation']['user']['loggedin'];
        //unset($this->content['navigation']['user']['updates']);
        //qa_html_theme_base::logged_in(); // this will render user name with greetings
        // echo '<pre>';
        // print_r($this->content['navigation']['user']);
        // echo '</pre>';
    }

    // removed main nav
    function nav_main_sub()
    {
        //$this->nav('main');
        $this->nav('sub');
    }

    // top bar method
    function top_bar()
    {   //-------------------
        //------Loolex Change--------
        //----------------------
        //$this->output('<i id="showLeftPush" class="sm-icon button icon-th-list"></i>');
        /*$this->logo();

        $this->output('</div>');
        $this->output('<div id="qa-nav-group" class="qa-spmenu qa-spmenu-vertical qa-spmenu-left" style="display:none;">');
        //$this->output('<h3>Menu</h3>');
        $this->nav_user_search();
        $this->nav('main');
        $this->output('</div><!-- qa-nav-group -->');
        */
        $pathToFile= dirname(__DIR__, 3);
        $templateContentTopbar = file_get_contents($pathToFile."/Templates/template-topbar.php");
        $this->output_raw($templateContentTopbar);
    }

    // adding topbar and sidepane close icon for mobile
    function body_header() // adds login bar, user navigation and search at top of page in place of custom header content
    {
        $this->output('<div id="qa-top-bar"><div id="qa-topbar-group" style="width:100%;">');
        $this->top_bar();
        //$this->output('<DIV ID="sidepanelclose"><i class="icon-cancel close"></i></DIV>');
        $this->output('</div></div>');
    }

    // set q2a default custom header html layout
    function header_custom() // allows modification of custom element shown inside header after logo
    {
        if (isset($this->content['body_header'])) {
            $this->output('<div class="header-banner">');
            $this->output_raw($this->content['body_header']);
            $this->output('</div>');
        }
    }

    // override default heder to add custom markup and sbu nav
    function header() // removes user navigation and search from header and replaces with custom header content. Also opens new <div>s
    {
        $this->output('<div class="qa-header">');

        //$this->logo();						
        $this->header_clear();
        $this->header_custom();

        $this->output('</div> <!-- END qa-header -->', '');

        //$this->output('<div class="qa-main-shadow">', '');
        $this->output('<div class="qa-main-wrapper">', '');
        $this->output('<DIV CLASS="sub-nav-top">');
        $this->nav_main_sub();
        $this->output('</DIV>');
        $this->output('<div class="qa-layout-wrapper">', '');
        
       

    }

    // cusstom method for sidepane navigation
    function q2am_ask_button()
    {
        // ask button based on the admin option
        if (qa_opt('permit_post_q') == 150 || qa_is_logged_in())
            $this->output('<a class="q2am-ask-side" href="' . qa_path('ask', null, qa_path_to_root()) . '">' . qa_lang_html('main/nav_ask') . '</a>');
    }

    function q2am_feedback_button()
    {
        // add site feedback button
        $this->output('<a class="q2am-ask-side" href="' . qa_path('feedback', null, qa_path_to_root()) . '">' . qa_lang_html('main/nav_feedback') . '</a>');
    }

    // sidepanel user account details based on logged in
    function q2am_user_details()
    {      //-----Loolex Change ----
    //     deactivate whole function because the elements are being used in the drop down menu
        // looged in user account
        /*if (qa_is_logged_in()) {

            $this->output('<h2>My Account</h2>', '<ul class="qa-widget-side q2am-nav-user-side-list">', '<li class="q2am-nav-user-side qa-user-info-item">');

            if (qa_is_logged_in()) // output user avatar to login bar
                $this->output(
                        '<div class="qa-logged-in-avatar">', QA_FINAL_EXTERNAL_USERS ? qa_get_external_avatar_html(qa_get_logged_in_userid(), 24, true) : qa_get_user_avatar_html(qa_get_logged_in_flags(), qa_get_logged_in_email(), qa_get_logged_in_handle(), qa_get_logged_in_user_field('avatarblobid'), qa_get_logged_in_user_field('avatarwidth'), qa_get_logged_in_user_field('avatarheight'), 32, true), '</div>'
                );

            qa_html_theme_base::logged_in(); // this will render user name with greetings

            if (qa_is_logged_in()) { // adds points count after logged in username
                $userpoints = qa_get_logged_in_points();

                $pointshtml = ($userpoints == 1) ? qa_lang_html_sub('main/1_point', '1', '1') : qa_lang_html_sub('main/x_points', qa_html(number_format($userpoints)));

                $this->output(
                        '<span class="qa-logged-in-points">', '(' . $pointshtml . ')', '</span>'
                );
            }

            $this->output('</li>');

            $u_account_iatems = array('account' => 'My Account', 'updates' => 'My Updates', 'logout' => 'Logout');
            foreach ($u_account_iatems as $key => $value)
            {
                $this->output('<li class="q2am-nav-user-side">');
                $this->output('<a href="' . qa_path($key, null, qa_path_to_root()) . '">' . $value . '</a>');
                $this->output('</li>');
            }

            $this->output('</ul>');
        }*/
    }

    function search_field($search)
    {
        $this->output('<input type="text" ' . $search['field_tags'] . ' value="' . @$search['value'] . '" class="qa-search-field" placeholder="start searching..."/>');
    }

    // override default sidepanel with custom elements like my account and ask button
    function sidepanel()
    {
        if (qa_is_mobile_probably() || $this->template != 'user') {

            $this->output('<DIV CLASS="qa-sidepanel">');
            //$this->output('<DIV ID="sidepanelclose"><i class="icon-cancel close"></i></DIV>');

            $this->output('<DIV CLASS="qa-sidepanel-ask top">');
            $this->q2am_ask_button();
            $this->output('</DIV>');

            $this->search();

            $this->q2am_user_details(); // cusstom method for sidepane navigation

            $this->widgets('side', 'top');
            $this->sidebar();
            $this->widgets('side', 'high');
            $this->nav('cat', 1);
            $this->widgets('side', 'low');
            $this->output_raw(@$this->content['sidepanel']);
            //$this->feed();
            $this->widgets('side', 'bottom');

            $this->output('<DIV CLASS="qa-sidepanel-ask">');
            //$this->q2am_feedback_button();
            $this->output('</DIV>');

            $this->output('</DIV>', '');

            //$this->output('<DIV id="sidepanelpull"><span>' . (qa_is_logged_in() ? 'Account / ' : '' ) . 'Sidebar</span> <i id="sidepull-icon" class="icon-down-open-big right-side"></i></DIV>');

            $this->output('<DIV CLASS="sub-nav-bottom">');
            $this->nav_main_sub();
            $this->output('</DIV>');

            $this->output('<DIV CLASS="qa-sidepanel-ask bottom">');
            $this->q2am_ask_button();
            $this->output('</DIV>');
        }
    }

    function q_item_main($q_item)
    {
        $this->output('<div class="qa-q-item-main">');

        $this->view_count($q_item);
        $this->q_item_title($q_item);
        $this->q_item_content($q_item);

        $this->post_tags($q_item, 'qa-q-item');
        $this->post_avatar_meta($q_item, 'qa-q-item');

        $this->q_item_buttons($q_item);

        $this->output('</div>');
    }

    function footer() // prevent display of regular footer content (see body_suffix()) and replace with closing new <div>s
    {
        $this->output('</div> <!-- END qa-layout-wrapper -->');
        $this->output('</div> <!-- END qa-main-wrapper -->');
        //$this->output('</div> <!-- END main-shadow -->');		
    }

    // function title() // add RSS feed icon after the page title
    // {
    // 	qa_html_theme_base::title();
    // 	$feed=@$this->content['feed'];
    // 	if (!empty($feed))
    // 		$this->output('<a href="'.$feed['url'].'" title="'.@$feed['label'].'"><i class="icon-rss qa-rss-icon"></i></a>');
    // }
    // custome view counter with k,m,b
    function short_num($num, $precision = 2)
    {

        if ($num >= 1000 && $num < 1000000) {
            $n_format = number_format($num / 1000, $precision) . 'K';
        }
        else if ($num >= 1000000 && $num < 1000000000) {
            $n_format = number_format($num / 1000000, $precision) . 'M';
        }
        else if ($num >= 1000000000) {
            $n_format = number_format($num / 1000000000, $precision) . 'B';
        }
        else {
            $n_format = $num;
        }

        return $n_format;
    }

    function q_item_stats($q_item) // add view count to question list
    {
        $this->output('<div class="qa-q-item-stats">');

        $this->voting($q_item);
        $this->a_count($q_item);

        //echo '<pre>',print_r($q_item['raw']),'</pre>';

        $this->output(
                '<SPAN CLASS="qa-view-count">', '<SPAN CLASS="qa-view-count-data">', $this->short_num($q_item['raw']['views'], 1), '</SPAN>', '<SPAN CLASS="qa-view-count-pad">', 'views', '</SPAN>', '</SPAN>'
        );
        //qa_html_theme_base::view_count($q_item);

        $this->output('</div>');
    }

    function view_count($q_item) // prevent display of view count in the usual place
    {
        if ($this->template == 'question')
            qa_html_theme_base::view_count($q_item);
    }

    // adding view count to the question view
    function q_view_stats($q_view)
    {
        $this->output('<div class="qa-q-view-stats">');

        $this->voting($q_view);
        $this->output(
                '<SPAN CLASS="qa-view-count">', '<SPAN CLASS="qa-view-count-data">', $this->short_num($q_view['raw']['views'], 1), '</SPAN>', '<SPAN CLASS="qa-view-count-pad">', 'views', '</SPAN>', '</SPAN>'
        );
        $this->a_count($q_view);

        $this->output('</div>');
    }

    // question view elements arrangment
    function q_view_main($q_view)
    {
        $this->output('<div class="qa-q-view-main">');

        if (isset($q_view['main_form_tags']))
            $this->output('<form ' . $q_view['main_form_tags'] . '>'); // form for buttons on question


            
//$this->view_count($q_view);
        $this->post_avatar_meta($q_view, 'qa-q-view');
        $this->q_view_content($q_view);
        $this->q_view_extra($q_view);
        $this->q_view_follows($q_view);
        $this->q_view_closed($q_view);
        $this->post_tags($q_view, 'qa-q-view');

        $this->q_view_buttons($q_view);
        $this->c_list(@$q_view['c_list'], 'qa-q-view');

        if (isset($q_view['main_form_tags'])) {
            $this->form_hidden_elements(@$q_view['buttons_form_hidden']);
            $this->output('</form>');
        }

        $this->c_form(@$q_view['c_form']);

        $this->output('</div> <!-- END qa-q-view-main -->');
    }

    function a_item_main($a_item)
    {
        $this->output('<div class="qa-a-item-main">');

        if (isset($a_item['main_form_tags']))
            $this->output('<form ' . $a_item['main_form_tags'] . '>'); // form for buttons on answer

        if ($a_item['hidden'])
            $this->output('<div class="qa-a-item-hidden">');
        elseif ($a_item['selected'])
            $this->output('<div class="qa-a-item-selected">');

        $this->a_selection($a_item);
        $this->error(@$a_item['error']);
        $this->a_item_content($a_item);
        $this->post_avatar_meta($a_item, 'qa-a-item');

        if ($a_item['hidden'] || $a_item['selected'])
            $this->output('</div>');

        $this->a_item_buttons($a_item);

        $this->c_list(@$a_item['c_list'], 'qa-a-item');

        if (isset($a_item['main_form_tags'])) {
            $this->form_hidden_elements(@$a_item['buttons_form_hidden']);
            $this->output('</form>');
        }

        $this->c_form(@$a_item['c_form']);

        $this->output('</div> <!-- END qa-a-item-main -->');
    }

    function c_item_main($c_item)
    {
        $this->post_avatar_meta($c_item, 'qa-c-item');

        $this->error(@$c_item['error']);

        if (isset($c_item['expand_tags']))
            $this->c_item_expand($c_item);
        elseif (isset($c_item['url']))
            $this->c_item_link($c_item);
        else
            $this->c_item_content($c_item);

        $this->output('<div class="qa-c-item-footer">');

        $this->c_item_buttons($c_item);
        $this->output('</div>');
    }

    // function post_avatar_meta($post, $class, $avatarprefix=null, $metaprefix=null, $metaseparator='<br/>')
    // {
    // 	$this->output('<span class="'.$class.'-avatar-meta">');
    // 	$this->post_avatar($post, $class, $avatarprefix);
    // 	$this->post_meta($post, $class, $metaprefix, $metaseparator);
    // 	$this->output('</span>');
    // }

    function body_suffix() // to replace standard Q2A footer
    {
        //$this->output('<div class="qa-footer-bottom-group">');
        //qa_html_theme_base::footer();
        //-------------------------------
        //Loolex Change
        //-------------------------------
        $this->output('<div id="footer-filler" ></div>');
        $pathToFile= dirname(__DIR__, 3);
        $templateContentFooter = file_get_contents($pathToFile."/Templates/template-footer.php");
        $this->output_raw($templateContentFooter);
        //$this->output('</div> <!-- END footer-bottom-group -->', '');
    }

    function attribution()
    {

        $this->output('<div class="qa-copyatts">');

        $this->output(
                '<div class="qa-copyright">', '&copy ' . date('Y') . ' - <a href="' . qa_opt('site_url') . '" title="' . qa_opt('site_title') . '">' . qa_opt('site_title') . '</a> - All rights reserved.', '</div>'
        );

        $this->output(
                '<div class="qa-attribution">', '&nbsp;| ' . $this->theme_name . ' by <a href="http://www.q2amarket.com">Q2A Market</a>', '</div>'
        );

        qa_html_theme_base::attribution();

        $this->output('</div> <!-- END qa-copyatts -->');
    }

}

/*
	Omit PHP closing tag to help avoid accidental output
*/
