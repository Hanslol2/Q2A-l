<?php  
function getCategoryID($category,$description){
    $q2aDirectory = dirname(__DIR__,2);
    require_once ($q2aDirectory."/qa-include/qa-base.php");
    require_once ($q2aDirectory."/qa-include/app/format.php");
    require_once QA_INCLUDE_DIR . 'app/page.php';
    require_once QA_INCLUDE_DIR . 'app/admin.php';
    require_once QA_INCLUDE_DIR . 'db/selects.php';
    require_once QA_INCLUDE_DIR . 'db/admin.php';
    require_once QA_INCLUDE_DIR . 'app/format.php';
    require_once QA_INCLUDE_DIR . 'util/string.php';
    
    $inname = $category;
    $incontent = $description;
    $inparentid = NULL;
    $inposition = 1;
    $errors = array();
    // Check the parent ID
    $incategories = qa_db_select_with_pending(qa_db_category_nav_selectspec($inparentid, true));
    // Verify the name is legitimate for that parent ID
    if (empty($inname))
        $errors['name'] = qa_lang('main/field_required');
    elseif (qa_strlen($inname) > QA_DB_MAX_CAT_PAGE_TITLE_LENGTH)
        $errors['name'] = qa_lang_sub('main/max_length_x', QA_DB_MAX_CAT_PAGE_TITLE_LENGTH);
    else {
        foreach ($incategories as $category) {
            if (!strcmp($category['parentid'], $inparentid) &&
                strcmp($category['categoryid'], @$editcategory['categoryid']) &&
                qa_strtolower($category['title']) == qa_strtolower($inname)
            ) {
                $errors['name'] = qa_lang('admin/category_already_used');
            }
        }
    }
    // Verify the slug is legitimate for that parent ID
    for ($attempt = 0; $attempt < 100; $attempt++) {
        switch ($attempt) {
            case 0:
                $inslug = qa_post_text('slug');
                if (!isset($inslug))
                    $inslug = implode('-', qa_string_to_words($inname));
                break;
            case 1:
                $inslug = qa_lang_sub('admin/category_default_slug', $inslug);
                break;
            default:
                $inslug = qa_lang_sub('admin/category_default_slug', $attempt - 1);
                break;
        }
        $matchcategoryid = qa_db_category_slug_to_id($inparentid, $inslug); // query against DB since MySQL ignores accents, etc...
        if (!isset($inparentid))
            $matchpage = qa_db_single_select(qa_db_page_full_selectspec($inslug, false));
        else
            $matchpage = null;
        if (empty($inslug))
            $errors['slug'] = qa_lang('main/field_required');
        elseif (qa_strlen($inslug) > QA_DB_MAX_CAT_PAGE_TAGS_LENGTH)
            $errors['slug'] = qa_lang_sub('main/max_length_x', QA_DB_MAX_CAT_PAGE_TAGS_LENGTH);
        elseif (preg_match('/[\\+\\/]/', $inslug))
            $errors['slug'] = qa_lang_sub('admin/slug_bad_chars', '+ /');
        elseif (!isset($inparentid) && qa_admin_is_slug_reserved($inslug)) // only top level is a problem
            $errors['slug'] = qa_lang('admin/slug_reserved');
        elseif (isset($matchcategoryid) && strcmp($matchcategoryid, @$editcategory['categoryid']))
        {
            $errors['slug'] = qa_lang('admin/category_already_used');
            return $matchcategoryid;
        }
        elseif (isset($matchpage))
            $errors['slug'] = qa_lang('admin/page_already_used');
        else
            unset($errors['slug']);
        if (isset($editcategory['categoryid']) || !isset($errors['slug'])) // don't try other options if editing existing category
            break;
    }
    // Perform appropriate database action
    if (empty($errors)) {
        if (isset($editcategory['categoryid'])) { // changing existing category
            qa_db_category_rename($editcategory['categoryid'], $inname, $inslug);
            $recalc = false;
            if ($setparent) {
                qa_db_category_set_parent($editcategory['categoryid'], $inparentid);
                $recalc = true;
            } else {
                qa_db_category_set_content($editcategory['categoryid'], $incontent);
                qa_db_category_set_position($editcategory['categoryid'], $inposition);
                $recalc = $hassubcategory && $inslug !== $editcategory['tags'];
            }
            qa_redirect(qa_request(), array('edit' => $editcategory['categoryid'], 'saved' => true, 'recalc' => (int)$recalc));
        } else { // creating a new one
            $categoryid = qa_db_category_create($inparentid, $inname, $inslug);
            qa_db_category_set_content($categoryid, $incontent);
            if (isset($inposition))
                qa_db_category_set_position($categoryid, $inposition);
                return $categoryid;
        }
    } 
}
