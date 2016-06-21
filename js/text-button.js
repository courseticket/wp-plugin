
var $ = window.jQuery;

( function() {

    var optionsArray = ['showOrganizer', 'smallLayout', 'showTrainers', 'showLectures', 'linkToEvent', 'showDiscounts', 'showTitle'];
    var checkedArray = [];
    var eventID;
    
    var build = function () {
        var voucherCode = document.getElementById('voucherCode').value;
        var lang = document.getElementById('lang').value;
        optionsArray.forEach(function(x) {
           if (document.getElementById(x).checked) { 
               checkedArray.push(x);
           }
        });
        if (voucherCode!='') {
            checkedArray.push('voucher:' + voucherCode);
        }

        return '<span class="courseticket-button" title="Book now" data-options="' + checkedArray.join(";") +
            '" data-href="https://www.courseticket.com/' + lang + '/e/' + eventID + '">&nbsp;</span>';
    };

    tinymce.PluginManager.add( 'ct_button', function( editor, url ) {

            editor.addButton('ct_button', {
                text: 'Course Ticket',
                icon: false,
                cmd: 'plugin_command'
            });

            editor.addCommand('plugin_command', function () {

                editor.windowManager.open({
                    title: 'Course Ticket Options',
                    width: 500,
                    height: 200,
                    inline: 1,
                    maximizable: 1,
                    resizable: 1,
                    id: 'ct-insert-button',

                    buttons: [
                        {
                            text: 'Save',
                            id: 'ct-save-buttonl',
                            class: 'insert',
                            onclick: function() {
                                 editor.insertContent(build());
                            },
                        },
                        {
                            text: 'Close',
                            id: 'ct-cancel-buttonl',
                            onclick: 'close'
                        }],
                });


                $.ajax({
                    url: "/wp-content/plugins/wp-plugin/html/ct-window.html"
                }).done(function(res) {
                    $('#ct-insert-button-body').html(res);
                    
                    var search = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                           url: 'https://www.courseticket.com/api/v1/sellers/21/events',
                            cache: false,
                            prepare: function(settings) {
                                settings.beforeSend = function(xhr) {
                                    xhr.setRequestHeader('Authorization','Bearer 49ff0cac94e5ad3eccd2976e7c5e755929bd75e2')
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
                        .on('typeahead:select', function(x,y) {
                            eventID = y.id;
                        });
                    ct_lang.translation();
                });
            });
    });
})();
