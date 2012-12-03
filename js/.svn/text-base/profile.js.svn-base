$(document).ready(function(){
    $('#tabs div').hide();
    $('#tabs div:first').show();
    $('#tabs ul li:first').addClass('active');
    $('.active').css('backgroundColor', '#D9D9D9');
                 
    $('#tabs ul li a').click(function(){
        $('.active').css('backgroundColor', '');
        $('#tabs ul li').removeClass('active');
        $(this).parent().addClass('active');
        var currentTab = $(this).attr('href');
        $('#tabs div').hide();        
        $(currentTab).show();
        $('.active').css('backgroundColor', '#D9D9D9');
        return false;
    });
});

