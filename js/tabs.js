$(document).ready(function() 
{
	$('div.htmltabs div.tabsContent').hide();
	$('div.tab1').show(); 
	$('div.htmltabs ul.tabs li.tab1 a').addClass('tab-current');
        $('div.htmltabs ul li a').click(function()
	{
		var thisClass = this.className.slice(0,4);
		$('div.htmltabs div.tabsContent').hide();
		$('div.' + thisClass).show(); 
		$('div.htmltabs ul.tabs li a').removeClass('tab-current');
		$(this).addClass('tab-current');
	});
});