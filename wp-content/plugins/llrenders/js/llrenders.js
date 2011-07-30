var LLRenders = {
  showProduct: function(categoria, slug) {
    window.location.href = Loja.get_bloginfo('url') + '/' + categoria + '/' + slug;
  },
  chooseVariation: function(type, item) {
    var otherType = type == 'color'? 'size' : 'color';
    var form = LLRenders.findParentNodeByNodeName(item, 'FORM');
        
    var divs = form.getElementsByTagName('div');
    var divChooser = null;
    var found = 0;
    
    for(var i=0; i<divs.length;i++) {
      element = divs[i];
      if(element.className=='variations-' + type + '-chooser-div') {
        element.style.display = 'block';
        found++;
        
        if(found == 2) break;
      } else if(element.className=='variations-' + otherType + '-chooser-div') {
        element.style.display = 'none';
        found++;
        
        if(found == 2) break;
      }
    }
  },  
  chooseColor: function(variation, item) {
    var divVars = LLRenders.findParentNodeByClass(item, 'variations-color-chooser-div');
    divVars.style.display = 'none';
    
    var form = LLRenders.findParentNodeByNodeName(item, 'FORM');
    var divs = form.getElementsByTagName('div');
    var found = 0;
    var id = variation['id'];
    var parentId = variation['parentId'];
    
    for(var i=0; i<divs.length;i++) {
      element = divs[i];

      if(element.className == 'caixa-cor selecionado') {
        element.style.backgroundColor = '#' + variation.hexa;
        found++;
      } else if(element.className == 'color-name') {
        element.innerHTML = variation.name;
        found++;
      }
      
      if(found >= 2)
        break;
    }
    
    form['variation[' + parentId + ']'].value = id;
  },
  chooseSize: function(variation, item) {
    var divVars = LLRenders.findParentNodeByClass(item, 'variations-size-chooser-div');
    divVars.style.display = 'none';
    
    var form = LLRenders.findParentNodeByNodeName(item, 'FORM');
    var divs = form.getElementsByTagName('div');
    
    var id = variation['id'];
    var parentId = variation['parentId'];
    
    for(var i=0; i<divs.length;i++) {
      element = divs[i];

      if(element.className == 'tamanho-name') {
        element.innerHTML = variation.size;
        break;
      }
    }
    
    form['variation[' + parentId + ']'].value = id;
  },
  findParentNodeByClass: function(item, className) {
    var pai = item.parentNode;
    
    while(pai && pai.className != className) {
      pai = pai.parentNode;
    }
    
    return pai;
  },
  findParentNodeByNodeName: function(item, nodeName) {
    var pai = item.parentNode;
    
    while(pai && pai.nodeName != nodeName) {
      pai = pai.parentNode;
    }
    
    return pai;
  },
  Galeria: {
    moveNext: function(id) {
      var indice = id.match(/\d+$/);
      var prefixo = id.substring(0, id.length - indice.length);
      var next = parseInt(indice) + 1;
      var galeriaProxima = document.getElementById(prefixo + next);
      if(!galeriaProxima)
        galeriaProxima = document.getElementById(prefixo + 0);
        
      var galeriaAtual = document.getElementById(prefixo + indice);
      galeriaAtual.style.display = 'none';
      galeriaProxima.style.display = 'block';
    },
    movePrevious: function(id) {
      var indice = id.match(/\d+$/);        
      var prefixo = id.substring(0, id.length - indice.length);
      var anterior = parseInt(indice) - 1;
      var galeriaAnterior = null;
      
      if(anterior < 0)
        galeriaAnterior = LLRenders.Galeria.findLast(prefixo, indice);
      else
        galeriaAnterior = document.getElementById(prefixo + anterior);
        
      var galeriaAtual = document.getElementById(prefixo + indice);
      galeriaAtual.style.display = 'none';
      galeriaAnterior.style.display = 'block';
    },
    findLast: function(prefixo, id) {
      var indice = id;
      var retorno = document.getElementById(prefixo + indice);
      var next = document.getElementById(prefixo + ++indice);
      
      
      while(next) {
        retorno = next;
        next = document.getElementById(prefixo + ++indice);
      }
      
      return retorno;
    }
  }
}

var LLRendersEventManager = function() {
	this.observers = {};

	this.listenTo = function(eventName, callback) {
		l_eventName = eventName.toLowerCase();
		l_observers = this.observers[l_eventName];
		if(l_observers == null) {
			l_observers = [];
			this.observers[l_eventName] = l_observers;
		}

		l_observers.push(callback);
	}

	this.fireEvent = function(eventName, json) {
		l_eventName = eventName.toLowerCase();
		l_observers = this.observers[l_eventName];

		if(l_observers) {
			for (i = 0; i < l_observers.length; i++) {
				try {
					l_observers[i](json);
				} catch (e) {
					if(e == 'ABORT')
            return false;
				}
			}
		}
    
    return true;
	}
}

var eventManager = new LLRendersEventManager();

function submitLLform(frm, categoria) {
  if(!eventManager.fireEvent('before:submitLLform', {'form':frm,'categoria':categoria}))
    return false;
    
  var id = frm.product_id.value;
  var indicatorId = 'loadingindicator_' + categoria + '_' + id;

	ajax.post("index.php?ajax=true&user=true",function(results){
    jQuery("#" + indicatorId).css('visibility','hidden');
    jQuery("#" + indicatorId).css('display','none');
    getresults(results);
  },ajax.serialize(frm));
  
  var loadImage = document.getElementById('loadingimage');
  var loadIndicator = document.getElementById(indicatorId);

  if(loadImage != null)	{
    loadImage.src = WPSC_CORE_IMAGES_URL + '/indicator.gif';
    loadIndicator.style.visibility = 'visible';
    loadIndicator.style.display = 'block';
  }else if(document.getElementById('alt_loadingimage') != null){
    document.getElementById('alt_loadingimage').src = WPSC_CORE_IMAGES_URL + '/indicator.gif';
    document.getElementById('alt_loadingindicator').style.visibility = 'visible';
  }
    
	return false;
}

