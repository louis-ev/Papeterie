<?php if(!$page->shareable()->bool() && !$site->user()) go('home'); ?>
<?php
  // Remember to use $delimiter
  $delimiter = c::get('papeterie.page_break','===');
  // Define an array with warning messages in different languages
  $overflow = array(
    'en' => 'Warning, it looks like your content overflows the page. To fix this, edit the document and use ' . $delimiter . ' to add page breaks.',
    'pl' => 'Wygląda na to, że treść dokumentu w którymś miejscu wykracza poza stronę. Edytuj ten dokument i użyj '.$delimiter.', aby dodać przełamania strony.',
    'fr' => 'Attention, il y a probalement du texte en excès dans votre document. Utilisez '.$delimiter.' pour passer à la page suivante.',
  );
?>
<!DOCTYPE html>
<html lang="<?php echo $site->language() ?>" class="no-js">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="description" content="<?php echo $site->description()->html() ?>">
  <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
  <meta name="author" content="<?php echo $site->author()->html() ?>">
  <meta name="robots" content="noindex">

  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>

  <!-- load here your CSS file -->
  <?= css('assets/css/main.css') ?>

  <?= css('assets/plugins/papeterie/css/papeterie.css'); ?>
  <style>
    @media screen {
      .is--overflowing::after {
        content: '<?php echo(array_key_exists($site->language(), $overflow) ? $overflow[$site->language()] : $overflow['en']) ?>';
      }
    }
  </style>

</head>
<body>
  <div class="papeterie-main">
    <?php
      // check how many breaks there is in our page block
      $docContent = $page->text();
      // cut text by c::get('papeterie.page_break') , adding space next to it to prevent tables to bug big time
      $docPerPage = explode( c::get('papeterie.page_break','==='), $docContent);
      $idx = 0;
      foreach($docPerPage as $doc):
    ?>
      <div class="papeterie-onepage">
        <div class="papeterie-colGauche type-small type-grey">
          <img class="papeterie-logo" src="<?php echo $page->parent()->logo() ?>" alt="">
          <?= $page->entetehaut()->kirbytext(); ?>
          <div class="stick-to-bottom">
            <div class="margin-small">
              <div class="type-smaller">PAGE</div>
              <?= $idx+1 ?> / <?= count($docPerPage); ?>
            </div>
            <?= $page->entetebas()->kirbytext(); ?>
          </div>
        </div>
        <div class="papeterie-mainContent js--detectOverflows">
          <?php if($idx == 0): ?>
            <div class="type-bigger margin-small">
              <?= $page->intitule()->kirbytext(); ?>
            </div>
          <?php endif; ?>
          <?= kirbytext($doc); ?>
        </div>
      </div>
    <?php
      $idx++;
      endforeach;
    ?>
  </div>
</body>


<script>
// detect overflow text
function isOverflowing(el) {
  return (el.offsetHeight + 15 < el.scrollHeight);
}

(function() {
  var elements = document.querySelectorAll('.js--detectOverflows');
  Array.prototype.forEach.call(elements, function(el, i){
    if(isOverflowing(el)) {
      debugger;
      if(el.classList)
        el.classList.add('is--overflowing');
      else
        el.className += ' is--overflowing';
    }
  });
})();

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
//unpack FigureImage-lazy images
(function() {
  var elements = document.querySelectorAll('.FigureImage-lazy');
  Array.prototype.forEach.call(elements, function(el, i){
    el.innerHTML = el.getElementsByTagName('noscript')[0].innerText;
  });
})();


</script>
