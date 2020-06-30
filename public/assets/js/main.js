$(function () {
    $(document).on('click', 'a', function () {
        let url = $(this).attr('data-href');
        if (url) {
            $.LoadingOverlay("show", {
                background: "rgba(255,255,255,0.76)",
                imageAnimation: '1500ms rotate_right',
                fade: '800 800'
            });
            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'data-ajax': true
                },
            }).then(function (res) {
                return res.json();
            }).then(function (res) {
                $.LoadingOverlay("hide");
                window.history.pushState({}, 'url', url)
                res = JSON.parse(atob(res));
                $('body').html(res.data)
                $('title').text(res.title);
            });
        }
    })
    $.actions = {
        click: function () {
            alert(23546)
        }
    }
    $.data = 11111
})