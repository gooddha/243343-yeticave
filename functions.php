<?php
function include_template($template, $template_data) {
    $template = "templates/" . $template;
    $result='';


    if (!file_exists($template)) {
      return $result;
    }

    ob_start();
    // $lots = $template_data['lots'];
    // $categories = $template_data['categories'];
    // $lot_time_remaining = $template_data['lot_time_remaining'];
    extract($template_data);


    if ($lots) {
      print_r($lots);
        foreach ($lots as &$lot) {
          foreach ($lot as $key => &$value) {
            $value = htmlspecialchars($value);
          }
        }
    }
    // $lots = htmlspecialchars($lots);
    // print_r($lots);
    require_once $template;
    $result = ob_get_clean();

    return $result;
}
?>
