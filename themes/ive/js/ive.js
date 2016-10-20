(function($, Drupal, drupalSettings) {
	$(document).ready(function() {
		
		$("a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])").addClass("external").attr("target","_blank");

	    /*$('.block h2').click(function() {
	        this.siblings('.content').toggle(500); 
	        //$('.node__meta, .field--type-text-with-summary, .field--name-field-image, .field--name-field-tags, .tags, .colonne').toggle(500); 
	        return false; 
		*/
	    $('.page-node-type-article .field--name-title').click(function() {
	       $('.node--type-article').toggle(500); 
	        //$('.node__meta, .field--type-text-with-summary, .field--name-field-image, .field--name-field-tags, .tags, .colonne').toggle(500); 
	        return false; 
	    });

		console.log('Hello !');
	});
})(jQuery, Drupal, drupalSettings);
