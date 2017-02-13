<?php

/**
 * Papeterie plugin
 * Create and edit documents directly inside the panel
 *
 * v0.1
 */


$kirby->set('blueprint', 'papeterie', __DIR__ . '/blueprints/papeterie.yml');
$kirby->set('blueprint', 'papeterie_document', __DIR__ . '/blueprints/papeterie_document.yml');
$kirby->set('template',  'papeterie_document',     __DIR__ . '/templates/papeterie_document.php');
$kirby->set('role', 'writter', [
  'name'        => 'Rédacteur',
  'default'     => false,
  'permissions' => [
    'panel.access.options' => false,
    'panel.user.read' => false,
    'panel.page.read' => function() {
      return (
        $this->target()->page()->intendedTemplate() === 'papeterie'
        ||
        $this->target()->page()->intendedTemplate() === 'papeterie_document'
      );
    }
  ]
]);

// when a page is created, check if its template is document
// if it is, then copy fields from the parent page to the new page
kirby()->hook('panel.page.create', function($page) {
  if($page->intendedTemplate() === 'papeterie_document') {
    try {

      // get all available fields in document, that are not title and date
      $dontCopy = array('title', 'date');

      $c = $page->content();
      $allChildsFieldsName = array();
      foreach ($c as $key => $value) {
        if ($key == "fields") {
          foreach ($value as $field) {
            if(!in_array($field, $dontCopy))
              array_push($allChildsFieldsName, $field);
          }
        }
      }

      // get all fields in parent that are also in child, copy their content
      $copyFields = array();

      $pc = $page->parent()->content();
      foreach ($pc as $key => $value) {
        if ($key == "fields") {
          foreach ($value as $field) {
            if(in_array($field, $allChildsFieldsName)) {
              $copyFields[$field] = filterThisContent($page->parent()->$field());
            }
          }
        }
      }
      $page->sort('last');
      $page->update($copyFields);
    } catch(Exception $e) {
			return response::error($e->getMessage());
    }
  }

});

function debug_hook($msg) {
	$dir = kirby()->roots()->index() . DS . 'panel.page.create.txt';
	file_put_contents($dir, $msg);
}

function filterThisContent($str) {
  // replace DATE_DU_JOUR par date("j F Y");
  $str = str_replace("DATE_DU_JOUR", utf8_encode(strftime("%e %B %Y")), $str);
  return $str;
}