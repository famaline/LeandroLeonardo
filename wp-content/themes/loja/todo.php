<ol>
  <li>UPDATE wp_posts SET post_title = 'Produtos' WHERE post_title = 'Products Page' and post_status = 'publish';</li>
  <li>UPDATE wp_posts SET post_title = 'Fechar Pedido' WHERE post_title = 'Checkout' and post_status = 'publish';</li>
  -------------------------
  <li>Fiz a pesquisa pensando que todos os atributos da pesquisa é uma categoria. Assim, vai ter que ter as categorias       dos tipos do produto</li>
  <li>Ex: O produto Sandália 2011 vai estar associado a Lancamento, Sandália, Primavera-Verão, etc. Se o cliente digitar qualquer um desses itens, vai aparecer esse produlo </li>
  <li>Mineiro, crie uma página (eu chamei de queryviewer) e associe o template QueryViewer. Ai vc pode fazer suas buscas nessa página.</li>
  <li>Mandei um e-mail da páginal institucional com todas as instruçoes</li>
  <li>Mandei um e-mail  da página amigos de di'rô com todas as instruçoes</li>
  <li>Outro e-mail com Localização	</li>
   <li>Mais um.  Contato	</li>
    <li>Para visualizar os produtos em R$, altere a coluna tabela wp_wpsc_currency_list, UPDATE wp_wpsc_currency_list SET code = 'R$'  where id= 107	</li>
</ol>