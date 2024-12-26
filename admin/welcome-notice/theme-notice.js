(function ($) {

    $(document).ready(function () {

        // If required plugins are active, then when Get Started button is clicked, will be redirected to  theme dashboard.
        if (themeNotice.pluginsStatus) {

            let allInstalled = Object.values(themeNotice.pluginsStatus).every(function (status) {
                return status;
            });

            if (allInstalled) {
                $('#get-started-btn').on('click', function () {
                    window.location.href = themeNotice.redirectUrl;
                });
            }
        }  


        // Required plugins are installed and activated via AJAX, if required plugins are not installed or active.
        $(document).on('click', '#get-started-btn', function (e) {
            
            e.preventDefault();

            let $button = $(this);
            let $spinner = $button.find('.get-started-btn-icon');

            $button.prop('disabled', true);
            $spinner.css('display', 'inline-block').addClass('spinning');

            $.post(
                themeNotice.ajaxUrl,
                {
                action: 'themebeez_install_required_plugins',
                nonce: themeNotice.nonce
                }
            ).done(function (response) {
                if (response.success && response.data.redirectUrl) {
                    window.location.href = response.data.redirectUrl;
                }
            }).fail(function () {
                alert('An error occurred. Please try again.');
            }).always(function () {
                $button.prop('disabled', false);
                $spinner.css('display', 'none').removeClass('spinning');
            });
        });
        
        // Dismisses the theme welcome notice and makes AJAX request to save the action.
        $(document).on('click', '.themebeez-theme-welcome-notice .notice-dismiss', function (e) {

            e.preventDefault();

            $(this).parent().hide();
            $.post(
                themeNotice.ajaxUrl,
                {
                    action: 'themebeez_dismiss_theme_notice',
                    nonce: themeNotice.dismissNonce
                }
            );
        });
    });
})(jQuery);