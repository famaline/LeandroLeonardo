<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
        <div>
        <table border="0" cellspacing="0" cellpadding="0" width="120" height="100&quot;">
        <tbody>
        <tr>
        <td style="text-align: left;" align="left">&nbsp;

          <strong>Tipo</strong>
          <a href="?s=Botas">Botas</a>
          <a href="?s=Festa">Festa</a>
          <a href="?s=Mocassim">Mocassim</a>
          <a href="?s=Peep Toe">Peep Toe</a>
          <a href="?s=Rasteira">Rasteiras</a>
          <a href="?s=Salto Alto">Salto Alto</a>
          <a href="?s=Sandália">Sandálias</a>
          <a href="?s=Sapatilha">Sapatilhas</a>
          <a href="?s=Scarpin">Scarpin</a> 
          <a href="?s=Tênis">Tênis</a>  
          <strong>Tamanho</strong>
          <a href="?s=25">25</a>
          <a href="?s=26">26</a>
          <a href="?s=27">27</a>
          <a href="?s=28">28</a>
          <a href="?s=31">31</a>
          <a href="?s=33">33</a>
          <a href="?s=34">34</a>
          <a href="?s=35">35</a>
          <a href="?s=36">36</a>
          <a href="?s=37">37</a>
          <a href="?s=38">38</a>
          <a href="?s=39">39</a>
          <a href="?s=40">40</a>
       </td>
        <td align="left">
        <table border="0" cellspacing="8" cellpadding="8" width="900" height="302">
        <tbody>
        <tr>
        <td>   <?php if ( have_posts() ) : ?>
          				<h2 class="entry-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
          				<div class="entry-content">
          				<?php
          				/* Run the loop for the search to output the results.
          				 * If you want to overload this in a child theme then include a file
          				 * called loop-search.php and that will be used instead.
          				 */
          				 
          				 get_template_part( 'loop', 'search' );
          				?>
          				</div>
          <?php else : ?>
          				<div id="post-0" class="post no-results not-found">
          					<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
          					<div class="entry-content">
          						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
          					</div><!-- .entry-content -->
          				</div><!-- #post-0 -->
          <?php endif; ?></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
