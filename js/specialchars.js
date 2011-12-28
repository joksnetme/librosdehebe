function insertAtCaret( event, text )
{
    if ( !( obj && event ) )
        return false;

    if ( document.selection )
    {
        obj.focus();

        var orig = obj.value.replace(/\r\n/g, "\n");
        var range = document.selection.createRange();

        if ( range.parentElement() != obj )
            return false;

        range.text = text;

        var actual = tmp = obj.value.replace(/\r\n/g, "\n");

        for ( var diff = 0; diff < orig.length; diff++ )
        {
            if ( orig.charAt(diff) != actual.charAt(diff) )
                break;
        }

        for ( var index = 0, start = 0; tmp.match(text) && ( tmp = tmp.replace(text, "") ) && index <= diff; index = start + text.length )
            start = actual.indexOf(text, index);

    }
    else if ( obj.selectionStart )
    {
        var start = obj.selectionStart;
        var end   = obj.selectionEnd;

        obj.value = obj.value.substr(0, start) + text
                  + obj.value.substr(end, obj.value.length);
    }

    if ( start != null )
        setCaretTo(obj, start + text.length);
    else
        obj.value += text;

    // event.preventDefault();
    // event.stopPropagation();

    DOMAssistant.preventDefault(event);
    DOMAssistant.cancelBubble(event);
}

function setCaretTo( obj, pos )
{
    if ( obj.createTextRange )
    {
        var range = obj.createTextRange();
            range.move('character', pos);
            range.select();
    }
    else if ( obj.selectionStart )
    {
        obj.focus();
        obj.setSelectionRange(pos, pos);
    }
}

DOMAssistant.DOMReady(function()
{
    $('ul.specialchars li.char a').addEvent('click', function( event )
    {
        insertAtCaret(event, this.innerHTML);
    });

    $('ul.specialchars li.toogle a').addEvent('click', function( event )
    {
        if ( this.id == 'more' )
        {
            this.id = 'less';

            $(this).replaceContent('menos');
            $('ul.specialchars li.extras').removeClass('hidden');
        }
        else
        {
            this.id = 'more';

            $(this).replaceContent('m&aacute;s');
            $('ul.specialchars li.extras').addClass('hidden');
        }

        DOMAssistant.preventDefault(event);
        DOMAssistant.cancelBubble(event);
    });
});