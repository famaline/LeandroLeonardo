var LLRenders = {
  showProduct: function(categoria, slug) {
    window.location.href = Loja.get_bloginfo('url') + '/' + categoria + '/' + slug;
  }
}

function submitLLform(frm, categoria) {
  var id = frm.product_id.value;
  var indicatorId = 'loadingindicator_' + categoria + '_' + id;

	ajax.post("index.php?ajax=true&user=true",function(results){
    jQuery("#" + indicatorId).css('visibility','hidden');
    getresults(results);
  },ajax.serialize(frm));
  
  var loadImage = document.getElementById('loadingimage');
  var loadIndicator = document.getElementById(indicatorId);

  if(loadImage != null)	{
    loadImage.src = WPSC_CORE_IMAGES_URL + '/indicator.gif';
    loadIndicator.style.visibility = 'visible';
  }else if(document.getElementById('alt_loadingimage') != null){
    document.getElementById('alt_loadingimage').src = WPSC_CORE_IMAGES_URL + '/indicator.gif';
    document.getElementById('alt_loadingindicator').style.visibility = 'visible';
  }
    
	return false;
}