// JavaScript Document
function confdel() {
	answer=confirm("Wollen sie den Eintrag wirklich löschen?");
	return answer;
}

function disable()
{
    document.getElementById('id').disabled = false;

}

function removeLabelAndFillDiv($tags)
{
    $('.contentMustRemove' ).html('your new content');
    $( '.contentMustRemove' ).empty();

    var $contentMustRemoveElement = document.getElementsByClassName('contentMustRemove')
	foreach($tags as $tag)
	{
	    //fügt das Tag an
		$contentMustRemoveElement.add('<label class="taglabel"><?php $tag->tagText?></label>')
	}
}
/**
$(document).ready(function()
{
    $('#search').keyup(function()
    {
        if($(this).val().length >= 3)
        {}
    });
});

**/




