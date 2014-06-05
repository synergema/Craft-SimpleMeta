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

});