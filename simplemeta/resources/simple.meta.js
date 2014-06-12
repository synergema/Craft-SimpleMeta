$(document).ready(function() {

	//   $$$$$$\  $$\                                                $$\                                $$$$$$\                                 $$\
	//  $$  __$$\ $$ |                                               $$ |                              $$  __$$\                                $$ |
	//  $$ /  \__|$$$$$$$\   $$$$$$\   $$$$$$\  $$$$$$\   $$$$$$$\ $$$$$$\    $$$$$$\   $$$$$$\        $$ /  \__| $$$$$$\  $$\   $$\ $$$$$$$\ $$$$$$\
	//  $$ |      $$  __$$\  \____$$\ $$  __$$\ \____$$\ $$  _____|\_$$  _|  $$  __$$\ $$  __$$\       $$ |      $$  __$$\ $$ |  $$ |$$  __$$\\_$$  _|
	//  $$ |      $$ |  $$ | $$$$$$$ |$$ |  \__|$$$$$$$ |$$ /        $$ |    $$$$$$$$ |$$ |  \__|      $$ |      $$ /  $$ |$$ |  $$ |$$ |  $$ | $$ |
	//  $$ |  $$\ $$ |  $$ |$$  __$$ |$$ |     $$  __$$ |$$ |        $$ |$$\ $$   ____|$$ |            $$ |  $$\ $$ |  $$ |$$ |  $$ |$$ |  $$ | $$ |$$\
	//  \$$$$$$  |$$ |  $$ |\$$$$$$$ |$$ |     \$$$$$$$ |\$$$$$$$\   \$$$$  |\$$$$$$$\ $$ |            \$$$$$$  |\$$$$$$  |\$$$$$$  |$$ |  $$ | \$$$$  |
	//   \______/ \__|  \__| \_______|\__|      \_______| \_______|   \____/  \_______|\__|             \______/  \______/  \______/ \__|  \__|  \____/
	//
	//
	//
	// http://stackoverflow.com/questions/1250748/countdown-available-spaces-in-a-textarea-with-jquery-or-other/1250788#1250788

	var characterCount = {

		init: function() {
			this.bindUIActions();
		},

		bindUIActions: function() {
			$('body').on('keyup', '.max input, .max textarea', this.updateCount );
		},

		updateCount: function( event ) {
			var $this = $(this),
				max = $this.closest('.max'),
				input = max.find('input, textarea'),
				maxCharacters = max.find('.countdown').attr('data-max'),
				liveNumber = max.find('.live'),
				charactersLeft = input.val().length
			;

			// Live Update
			liveNumber.text(charactersLeft);

			if ( maxCharacters >= charactersLeft ) {
				liveNumber.removeClass('nope').addClass('yup');
			}
			else {
				liveNumber.removeClass('yup').addClass('nope');
			}
		}
	}

	characterCount.init();

	//  $$$$$$\  $$\                                     $$\ $$\   $$\ $$\       $$\
	// $$  __$$\ $$ |                                   $$  |$$ |  $$ |\__|      $$ |
	// $$ /  \__|$$$$$$$\   $$$$$$\  $$\  $$\  $$\     $$  / $$ |  $$ |$$\  $$$$$$$ | $$$$$$\
	// \$$$$$$\  $$  __$$\ $$  __$$\ $$ | $$ | $$ |   $$  /  $$$$$$$$ |$$ |$$  __$$ |$$  __$$\
	//  \____$$\ $$ |  $$ |$$ /  $$ |$$ | $$ | $$ |  $$  /   $$  __$$ |$$ |$$ /  $$ |$$$$$$$$ |
	// $$\   $$ |$$ |  $$ |$$ |  $$ |$$ | $$ | $$ | $$  /    $$ |  $$ |$$ |$$ |  $$ |$$   ____|
	// \$$$$$$  |$$ |  $$ |\$$$$$$  |\$$$$$\$$$$  |$$  /     $$ |  $$ |$$ |\$$$$$$$ |\$$$$$$$\
	//  \______/ \__|  \__| \______/  \_____\____/ \__/      \__|  \__|\__| \_______| \_______|
	//
	//
	//

	var showHide = {

		init: function() {
			this.bindUIActions();
			this.onPageLoad();
		},

		bindUIActions: function() {
			$('body').on('change', '.has-addl-fields', this.showHideFields );
		},

		// Show additional fields for selected content type on page load
		onPageLoad: function() {
			var contentTypeSelect = $('.simple-meta .has-addl-fields select'),
				selected  = contentTypeSelect
			;

			// Show selected content type addtl field(s) on load
			selected.each(function( index ) {
				var $this = $(this),
					selection = $this.val().replace(/\./g, '_'), // replace periods with underscores
					showFields = $this.attr('id') + '_' + selection,
					addlFields = $this.closest('.field').next('.addl-fields').find('.block')
				;

				addlFields.removeClass('is-visible').addClass('is-hidden');
				$('#' + showFields).toggleClass('is-hidden is-visible');

			});

		},

		showHideFields: function( event ) {

			var $this = $(this).find('select'),
				selection  = $this.val().replace(/\./g, '_'), // replace periods with underscores
				showFields = $this.attr('id') + '_' + selection,
				addlFields = $this.closest('.field').next('.addl-fields').find('.block')
			;

			// Hide all additional fields
			addlFields.each(function( index ) {
				$(this).removeClass('is-visible').addClass('is-hidden');
			});

			// Show additional fields based on selection
			$('#' + showFields).toggleClass('is-hidden is-visible');

		}
	}

	showHide.init();

});
