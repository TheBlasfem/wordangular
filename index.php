<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php 
			//if ( have_posts() ) :
				// Start the Loop.
				//while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );

				//endwhile;
				// Previous/next post navigation.
				//twentyfourteen_paging_nav();

			//else :
				// If no content, include the "No posts found" template.
				//get_template_part( 'content', 'none' );

			//endif;
		?>

		<div id="wrapperapp" ng-controller="mycontroller">
			<div id="backgroundpop" ng-class="{display: openpopup}"></div>
			<input type="text" ng-model="search" placeholder="Search...">
			<label>Select Category</label>
			<select ng-model="searchcategory">
				<option value="">--All--</option>
				<option ng-repeat="category in categories">{{category.title}}</option>
			</select>

		  <section id="blqs">
		    <div class="blq" ng-repeat="post in posts | filter:search | filter:searchcategory | startFrom: pagination.page * pagination.perPage | limitTo: pagination.perPage">
					<div class="greencat">
						<span ng-repeat="category in post.categories">{{category.title}}</span>
					</div>
					<img ng-src="{{post.thumbnail}}" alt="">
					<h3>{{post.title}}</h3>
					<div ng-bind-html="post.content | limitTo:70"></div>
					<span class="detail" ng-click="detailpost(post)">Seguir leyendo</span>
		    </div>
		  </section>

		    <button ng-click="pagination.prevPage()">Previous</button>
				<button ng-click="pagination.nextPage()">Next</button>

				<popup></popup>

		</div>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
