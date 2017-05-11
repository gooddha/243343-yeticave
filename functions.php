<?php
function include_template($template, $template_data) {
    $template = "templates/" . $template;
    $result='';

    if (!file_exists($template)) {
      return $result;
    }

    ob_start();
    require_once $template;
    $result = ob_get_clean();

    return $result;
}
?>
