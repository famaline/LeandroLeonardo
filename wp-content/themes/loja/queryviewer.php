<?php
/**
 * Template Name: QueryViewer
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

			<?php 
$query = $_POST['query'];
if(isset($query)):
  $query = str_replace('\\\'', '\'', $query);
endif

?>
Query:
<form action="" method="post">
<textarea name="query" style="width: 95%"><?php echo $query?></textarea><br/>
<input type="submit" value="Enviar" />
</form>
<?php
if(isset($query)):
  if(!endsWith($query, ';'))
    $query .= ';';
  
  try {
    Renders::render_query($query);
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
endif      
?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
