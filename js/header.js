var selectedId;
var isGameMode=false;
$(document).ready(function(){
    $(selectedId).css({
        "background-color": "#1B6453"
    });
    
})


function signout(){
    if( isGameMode ){
        recycleResouce();
    }
}



