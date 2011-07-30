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
        <table cellpadding="0" cellspacing="0" id="lancamentos">
          <tr>
            <td><?php Renders::render_image('tit-lancamentos.png', array('width' => '133', 'height' => '22'))?></td>
          </tr>
          <tr>
            <td><?php Renders::render_galeria('lancamentos', 4)?></td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" id="promocoes">
          <tr>
            <td><?php Renders::render_image('tit-promocoes.png', array('width' => '110', 'height' => '22'))?></td>
          </tr>
          <tr>
            <td><?php Renders::render_galeria('promocoes', 4)?></td>
          </tr>
        </table>
      </div>
		</div>
<?php get_footer(); ?>
