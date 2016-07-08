var textColor = function(backgroundColor)
{
    var regex = /^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i;
    var color = regex.exec(backgroundColor);

    if (color.length< 3) {
        return '#000000';
    }

    for(var i = 1; i <= 3; i++) {
        color[i] = parseInt(color[i], 16);
    }

    color.shift();
    var withWhite =    Math.max(255,color[0]) - Math.min(255,color[0]) +
        Math.max(255,color[1]) - Math.min(255,color[1]) +
        Math.max(255,color[2]) - Math.min(255,color[2]);
    var withBlack =    Math.max(0,color[0]) - Math.min(0,color[0]) +
        Math.max(0,color[1]) - Math.min(0,color[1]) +
        Math.max(0,color[2]) - Math.min(0,color[2]);

    return withWhite >= withBlack ? '#FFFFFF' : '#000000';
}

function colorDarker(backgroundColor, percent)
{
    var regex = /^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i;
    var color = regex.exec(backgroundColor);
    var percentValue = percent.replace('%', '');
    var res = "#";

    if (color.length < 3) {
        return '#000000';
    }

    var str;

    for(var i = 1; i <= 3; i++) {
        color[i] = parseInt(color[i], 16);
        color[i] = Math.round(color[i] * (100-(percentValue*2))/100);
        color[i] = color[i] >= 0 ? color[i] : 0;
        str = color[i].toString(16);
        pad = '00';
        res += pad.substring(0, pad.length - str.length) + str
    }

    return res;
}

function colorLighter(backgroundColor, step)
{
    var regex = /^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i;
    var color = regex.exec(backgroundColor);
    var stepValue = step.replace('%', '');
    var res = "#";

    if (color.length < 3) {
        return '#000000';
    }

    var str;

    for(var i = 1; i <= 3; i++) {
        color[i] = parseInt(color[i], 16);
        color[i] = color[i] + parseInt(stepValue);
        color[i] = color[i] <=255 ? color[i] : 255;
        str = color[i].toString(16);
        pad = '00';
        res += pad.substring(0, pad.length - str.length) + str
    }

    return res;
}

var init = function()
{
    var element = document.getElementsByClassName('btn')[0];
    var btnColor = CT.Common.getColor(element);
    var txtColor = textColor(btnColor);
    var style = '<style> .book-now .btn, .toggleBox .btn { ' +
        'background-color: ' + btnColor + ' !important;' +
        'box-shadow: 0 -2px 0 ' + colorDarker(btnColor, "20") + ' inset;' +
        'color: ' + txtColor + ';}' +
        '.book-now .btn:hover, .book-now .btn:focus, .toggleBox .btn:hover, .toggleBox .btn:focus { ' +
        'background-color: ' + colorLighter(btnColor, "30") + ' !important;' +
        'box-shadow: 0 -2px 0 ' + colorDarker(btnColor, "20") + ' inset;}' +
        '.heapbox ul.heap-options li.selected a { ' +
        'background-color:' + btnColor + ';' +
        'color: ' + txtColor + ';}' +
        '.heapbox ul.heap-options li.selected a:hover { ' +
        'background-color:' + colorLighter(btnColor, "20") + ';' +
        'color:' + txtColor + ';}' +
        '.heapbox ul.heap-options li.selected .text-right{ ' +
        'color:' + txtColor + ';} </style>';

    document.getElementsByTagName('head')[0].innerHTML += style;
}

window.onload = init;

