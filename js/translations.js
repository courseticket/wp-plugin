var ct_lang = window.ct_lang || {};

ct_lang.translation = function() {

    var classes = $(".translate");
    var lang = document.getElementById('lang').value;
    if (ct_lang[lang]) {
        classes.each(function () {
            if(this.tagName == 'LABEL') {
                this.innerHTML = ct_lang[lang][this.innerHTML];
            }
            if(this.placeholder) {
                this.placeholder = ct_lang[lang][this.placeholder];
            }
        });
    }
};