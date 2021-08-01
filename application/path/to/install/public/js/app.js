(function ($) {
    $(document).ready(function () {
        const domain = "http://localhost:8080/";

        $(".dropdown-toggle").dropdown();
        $(document).on("click", "#submitBtn", function () {_app.submit_form( $(this) );});

        const _app = {
            'init': function () {
                return true;
            },
            'submit_form': function ( $this ) {
                let _b1 = $("#" + $this.attr('aria-controls'));
                let _b2 = $($this.attr('data-toggle'));
                let text = $("#inputWords").val();
                if ( text.length < 2 ) {return false;}
                this.toggle_aria(_b1, true);this.toggle_aria(_b2, false);
                let data = {'action': ajaxUrl, 'text': text,};
                this.send_ajax( 'post', data, $("#resultBlock"));return true;
            },
            'toggle_aria': function ( $element, toHide ) {
                if ( toHide === true ) {$element.attr('aria-hidden', 'true').attr('aria-controls','false');$element.slideUp(300);}else{$element.attr('aria-hidden', 'false').attr('aria-controls','true');$element.slideDown(300);}return true;
            },
            'send_ajax': function ( method, data, $element ) {
                let ajax_data, _s_ajax;
                ajax_data = data;
                _s_ajax = $.ajax({
                    data: ajax_data,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    type: method,
                });
                _s_ajax.done(function (response, msg) {
                    if ( response ) {
                        console.log(response);
                        $element.html("").append('data');
                        return true;
                    }
                });
                _s_ajax.fail(function (error, textStatus) {
                    console.log(error);
                });
            },
        };
        _app.init();

    });
})(jQuery);
