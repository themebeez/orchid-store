(function( $ ) {

	wp.customize.bind( 'ready', function() {

		/**
		 * Dropdown Select2 Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		 */

		$('.customize-control-dropdown-select2').each(function(){
			$('.customize-control-select2').select2({
				allowClear: true
			});
		});

		$(".customize-control-select2").on("change", function() {
			var select2Val = $(this).val();
			$(this).parent().find('.customize-control-dropdown-select2').val(select2Val).trigger('change');
		});
	});
}) ( jQuery );