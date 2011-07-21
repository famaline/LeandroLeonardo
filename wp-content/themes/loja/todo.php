<ol>
  <li>UPDATE wp_posts SET post_title = 'Produtos' WHERE post_title = 'Products Page' and post_status = 'publish';</li>
  <li>UPDATE wp_posts SET post_title = 'Fechar Pedido' WHERE post_title = 'Checkout' and post_status = 'publish';</li>
  -------------------------
  <li>Fiz a pesquisa pensando que todos os atributos da pesquisa é uma categoria. Assim, vai ter que ter as categorias       dos tipos do produto</li>
  <li>Ex: O produto Sandália 2011 vai estar associado a Lancamento, Sandália, Primavera-Verão, etc. Se o cliente digitar qualquer um desses itens, vai aparecer esse produlo </li>
</ol>