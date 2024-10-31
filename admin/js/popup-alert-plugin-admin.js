(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */
	 $(document).ready(function(){
	 	// $("#popup-alert-plugin").find("input[type=checkbox]").each(function () {
	 	// 	alert($(this).val());
	 	// });
	 	function attachListeners() {
	 		var checkboxes = document.getElementsByClassName('sl-meta-box-sidebar')

	 		for (var i = 0; i < checkboxes.length; i++) {
	 			checkboxes[i].addEventListener('click', getAndPutValues, false);
	 		}
	 	}

	 	function getAndPutValues() {
	 		var result = [];
	 		document.querySelectorAll(".sl-meta-box-sidebar:checked").forEach(function(item) { result.push(item.value);});

	 		document.querySelector('.sl-meta-box-sidebar-pages').value = result.join(',');
	 	}

	 	attachListeners();
	 })

	})( jQuery );
