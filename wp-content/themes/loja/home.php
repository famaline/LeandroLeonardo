<?php
get_header(); ?>
<script>
eventManager.listenTo('before:submitLLform', function(json) {
  var form = json.form;
  var element = null;
  var elementName = null;
  for(var i = 0; i < form.elements.length; i++) {
    element = form.elements[i];
    elementName = element.name;
    
    if(elementName.match(/^variation\[\d+\]$/) && element.value == "") {
      alert("Favor escolher uma cor e tamanho");
      throw 'ABORT';
    }
  }
});

eventManager.listenTo('previous:galeria', function(json){
    LLRenders.Galeria.movePrevious(json.id);
});

eventManager.listenTo('next:galeria', function(json){
    LLRenders.Galeria.moveNext(json.id);
});
</script>
		<div id="container">
			<div id="content" role="main">
        <table cellpadding="0" cellspacing="0" id="destaque">
          <tr>
            <td><?php Renders::render_destaque(1);?></td>
            <td><?php Renders::render_destaque(2);?></td>
          </tr>
        </table>
<?php
function galeria_before($categoria) {
  $width = $categoria == 'lancamentos'? '133' : '110';
  echo '<table cellpadding="0" cellspacing="0" id="' . $categoria . '"><tr><td>';
  Renders::render_image('tit-' . $categoria . '.png', array('width' => $width, 'height' => '22'));
  echo '</td></tr><tr><td>';
}

function galeria_after($categoria) {
  echo '</td></tr></table>';
}

add_action('before_render_galeria', 'galeria_before');
add_action('after_render_galeria', 'galeria_after');
?>
<?php Renders::render_galeria('lancamentos', 4)?>
<?php Renders::render_galeria('promocoes', 4)?>
      </div>
		</div>
<?php get_footer(); ?>
