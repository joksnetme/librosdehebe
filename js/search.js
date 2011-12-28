
var getAbsolutePos = function( el )
{
    var SL = 0, ST = 0;
    var is_div = /^div$/i.test(el.tagName);

    if ( is_div && el.scrollLeft )
        SL = el.scrollLeft;
    if ( is_div && el.scrollTop )
        ST = el.scrollTop;

    var r = { x: el.offsetLeft - SL, y: el.offsetTop - ST };

    if ( el.offsetParent )
    {
        var tmp = getAbsolutePos(el.offsetParent);

        r.x += tmp.x;
        r.y += tmp.y;
    }

    return r;
}

DOMAssistant.DOMReady(function()
{
    var prev;

    $('ul.libros > li > a').addEvent('mouseover', function( event )
    {
        if ( prev )
        {
            $(prev).removeClass('active');
            $(prev).next().addClass('hidden');
        }

        var libro = $(this);
            libro.addClass('active');

        var info = libro.next();
            info.removeClass('hidden');

        var top          = getAbsolutePos(libro).y - 120;
        var headerBottom = getAbsolutePos($$('container')).y + 15;
        var infoHeight   = info.offsetHeight;
        var footerHeight = $$('footer').offsetHeight;
        var scrollTop, innerHeight, offsetHeight;

        if ( document.all )
        {
            scrollTop    = document.body.scrollTop;
            innerHeight  = document.body.clientHeight;
            offsetHeight = document.body.scrollHeight;
        }
        else
        {
            scrollTop    = window.scrollY;
            innerHeight  = window.innerHeight;
            offsetHeight = document.body.offsetHeight;
        }

        if ( top < scrollTop )
            top = scrollTop + 10;

        if ( top + infoHeight > offsetHeight - footerHeight )
            top = offsetHeight - footerHeight - 20 - infoHeight;

        if ( top + infoHeight - scrollTop > innerHeight )
            top = innerHeight - infoHeight + scrollTop - 10;

        if ( top < headerBottom )
            top = headerBottom;

        info.setStyle('top', top + 'px');
        prev = this;
    });

    var keys   = [];
    var select = $('select[name=key]')[0];

    for ( var i = 0, len = select.options.length; i < len; i++ )
    {
        if ( i == select.selectedIndex )
            $$(select.options[i].value).removeClass('hidden');

        keys.push(select.options[i].value);
    }

    $('select[name=key]').addEvent('change', function( event )
    {
        for ( var i = 0, len = keys.length; i < len; i++ )
            $$(keys[i]).addClass('hidden');

        $$(this.options[ this.selectedIndex ].value).removeClass('hidden');
    });
});

