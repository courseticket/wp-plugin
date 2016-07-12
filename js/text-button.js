
var $ = window.jQuery;

( function() {

    var pluginUrl = '../wp-content/plugins/courseticket';
    var NAME = 'Courseticket';
    var optionsArray = ['showOrganizer', 'smallLayout', 'showTrainers', 'showLectures', 'linkToEvent', 'showDiscounts', 'showTitle'];
    var checkedArray = [];
    var event;
    var ctID = $('#data').data('ct-id');
    var ctKey = $('#data').data('ct-key');

    var build = function () {
        var voucherCode = document.getElementById('voucherCode').value;
        var title = document.getElementById('button-display-input').value;
        var lang = $('#data').data('ct-lang');
        var token = "";

        optionsArray.forEach(function(x) {
           if (document.getElementById(x).checked) { 
               checkedArray.push(x);
           }
        });
        if (voucherCode!='') {
            checkedArray.push('voucher:' + voucherCode);
        }
        if (event.token) {
            token = "/k:" + event.token;
        }

        return '<span class="courseticket-button" contenteditable="false" title="' + title + '" data-options="' + checkedArray.join(";") +
            '" data-href="https://www.courseticket.com/' + lang + '/e/' + event.id + token + '">.</span>';
    };

    tinymce.PluginManager.add( 'ct_button', function( editor, url ) {

        editor.addButton('ct_button', {
            text: NAME,
            icon: false,
            cmd: 'plugin_command'
        });

        editor.addCommand('plugin_command', function () {

            editor.windowManager.open({
                title: NAME + ' Options',
                width: 500,
                height: 200,
                inline: 1,
                maximizable: 1,
                resizable: 1,
                id: 'ct-insert-button',

                buttons: [
                    {
                        text: 'Insert',
                        id: 'ct-save-buttonl',
                        class: 'insert',
                        onclick: function() {
                            editor.insertContent(build());
                            var $span = $(editor.getDoc()).find('span.courseticket-button');

                            var addRemoveBtn = function(e) {    //Unused
                                 var $rmButton;
                                var $target = $(e.currentTarget);
                                var pos = $target.position();

                                $rmButton = $('<div style="left: ' + (pos.left+153) + 'px; top:' + (pos.top+48)  + 'px;" class="rm-button mce-container-body mce-container mce-stack-layout mce-widget mce-flow-layout-item mce-btn mce-last rm-button"><button type="button" tabindex="-1"><i class="mce-ico mce-i-dashicon dashicons-no "></i></button></div>')
                                    .insertBefore(editor.getElement());
                                hasButton = false;

                                $rmButton.click(function (x) {
                                    e.currentTarget.remove();
                                    x.currentTarget.remove();
                                    $span.click(addRemoveBtn);
                                });
                                $span.unbind("click");
                                $target.click(function() {
                                    $rmButton.remove();
                                    $span.click(addRemoveBtn);
                                });
                            };
                            //$span.click(addRemoveBtn);
                            editor.windowManager.close();
                        },
                    },
                    {
                        text: 'Close',
                        id: 'ct-cancel-buttonl',
                        onclick: 'close'
                    }],
            });

            $.ajax({
                url: pluginUrl + "/html/ct-window.html"
            }).done(function(res) {
                $('#ct-insert-button-body').html(res);
                var search = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    prefetch: {
                       url: 'https://www.courseticket.com/api/v1/sellers/' + ctID + '/events',
                        cache: false,
                        prepare: function(settings) {
                            settings.beforeSend = function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer ' + ctKey);
                            };
                            return settings;
                        },
                        transform: function(response) {
                            return response.data;
                        }
                    }

                });

                $('#ct-search-box .typeahead').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'search',
                        display: 'title',
                        source: search
                    })
                    .on('typeahead:select', function(x, evt) {
                        event = evt;
                    });
                ct_lang.translation();
            });
        });
    });
})();