var cellIds = new Array();
var cellId=-1;
var intervalId = -1;
var step = 0;
var firstSolution = "22 17 04 07 17 20 16 17 22 22 17 04 07";
var secondSolution = "20 15 02 05 15 18 14 15 20 20 15 02 05";
var famousSentence = "To be or not to be";
var showAnimation = true;
var question;
var quote;
var author;
var pictureName = "know";
var currentQuestion=-1;
var source=null;
var userType=-1; // Leader is 0 and Team is 1;
var gameStarted=false;
var puzzleId=1;
var markPuzzleSolvedCount=0;
var markPictureSolvedCount=0;
var showSuccessAlready = false;

$(document).ready( function(){
    loadAllCellIds();
    if ( showAnimation ){
        $("#showDemo").hide();
        intervalId = window.setInterval("flipRandomCell()", 1000);
    }else if( userType == 1) {
        // start event for Team
        startEvent();
    } 
    
    $("#buttonDemo").click(function(){
        showDemo();
    });
});



function flipRandomCell(){
    var cellId = getRandomCellId();
    if ( cellId == "" ) return;
    $(cellId).fadeTo("slow", 0);
}

/*
 * Generate a unduplicated cell id randomly.
 */
function getRandomCellId(){
    var length = cellIds.length;
    if ( length == 0 ){ 
        window.clearInterval(intervalId);
        return "";
    }
    var randomNumber = Math.floor(Math.random() * length);
    var id = cellIds[randomNumber];
    cellIds.splice(randomNumber, 1);
    return id;
}

function loadAllCellIds(){
    for ( var i = 0; i < numOfRows; i++ ){
        for( var j = 0; j < numOfColumns; j++){
            cellIds.push("#cell"+i+j);
        }
    }
}

function showDemo(){
    window.clearInterval(intervalId);
    setTimeout(function(){
        hideImage();
    }, 500);
    stepOne();
}

function stepOne(){
    $("#description").fadeOut(200, function(){
        $("#answer1").hide();
        $("#answer2").hide();
        $("#answer3").hide();
        
        document.getElementById("process").innerHTML = "Step 1:";
        document.getElementById("hint").innerHTML = "Decrypt following charaters"; 
        $("#showDemo").fadeIn(300, function(){
            });
    });

}

function replay(){
    $("#answer1").hide();
    $("#answer2").hide();
    $("#answer3").hide();
    $("#question").show();
    $("#process").show();
    $("#hint").show();
    $("#answer").show();
    $("#next").show();
    document.getElementById("process").innerHTML = "Step 1:";
    document.getElementById("hint").innerHTML = "Decrypt following charaters";
}


function hideImage(){
    
    cellIds = new Array();
    for ( var i = 0; i < numOfRows; i++ ){
        for( var j = 0; j < numOfColumns; j++){
            var id = "#cell"+i+j;
            cellIds.push(id);
            $(id).css("opacity", "1");
        }
    }
}

/*
 * Animate answer to textArea
 */
function animateText(textArea, text, duaration){
    $("#next").hide();
    textArea.value = "";
    var length = text.length;
    var index = 0;
    intervalId = window.setInterval(function(){
        if ( index >= length ){
            window.clearInterval(intervalId);
            $("#next").show();        
        }
        textArea.value += text.charAt(index);
        index++;
    }, duaration);
    
}
function showNext(){

    if( step === 11 ){
        return;
    }
    step++;
    showStep();
}

function showStep(){
    switch ( step ){
        case 1:
            animateText(document.getElementById("answer"), "Solution is algebraic \u2013 first convert to numeric", 50);
            break;
        case 2:
            animateText(document.getElementById("answer"), firstSolution, 50);
            break;
        case 3:
            stepThree();
            break;
        case 4:
            animateText(document.getElementById("answer1"), "Find solution \u2013 in this case subtract 2", 50);
            break;
        case 5:
            animateText(document.getElementById("answer1"), secondSolution, 50);
            break;
        case 6:
            stepSix();
            break;
        case 7:
            animateText(document.getElementById("answer2"), famousSentence, 50);
            break;
        case 8:
            stepEight();
            break;
        case 9:
            animateText(document.getElementById("answer3"), "Shakspeare", 50);
            break;
        case 10:
            document.getElementById("answer3").value = "Cong! You just unveil one cell, you can guess the name of the picture";
            flipRandomCell();
            document.getElementById("next").innerHTML = "Replay";
            break;
        case 11:
            document.getElementById("next").innerHTML = "Next";
            step = 0;
            repositionAnswer();
            replay();
            break;
    }
    
}

function stepThree(){
    $("#process").text("Step 2:");
    $("#hint").text("Arithmetic solutions");
    moveUp("#question", "#answer", "#answer1");
}

function stepSix(){
    $("#process").text("Step 3:");
    $("#hint").text("Find a famous sentence");
    moveUp("#answer", "#answer1", "#answer2");
}

function stepEight(){
    $("#process").text("Step 4:");
    $("#hint").text("Find the author of the sentence");
    moveUp("#answer1","#answer2", "#answer3" );
}

function repositionAnswer(){
    
    moveDown();
    
    $("#answer").css({
        "color": "red"
    });
 
}

function moveUp(disappearElement, moveElement, appearElement){
    $(disappearElement).fadeOut(300, function(){
        $(moveElement).animate({
            top: "-=90"
        }, 600, function(){
            $(this).css("color", "black");
            $(appearElement).fadeIn(500);
        });
    });
}

function moveDown(){
    document.getElementById("answer3").value = "";
    $("#answer3").fadeOut(300);
    $("#answer2").animate({
        top: "+=90"
    },300, function(){
        $(this).css({
            "color": "red"
        });
        document.getElementById("answer2").value = "";
        $(this).fadeOut();
        $("#answer1").show();
        $("#answer1").animate({
            top: "+=90"
        }, 300, function(){
            $("#answer1").css({
                "color": "red"
            });
            document.getElementById("answer1").value = "";
            $("#answer1").fadeOut();
            $("#answer").show();
            $("#answer").animate({
                top: "+=90"
            }, 300, function(){
                $("#answer").css({
                    "color": "red"
                });
                document.getElementById("answer").value = "";
                $("#question").fadeIn(500);
            })
        });
    });
    
}

//////////////////////////////////////////////////////////////
// Methods use for game mode
//////////////////////////////////////////////////////////////

/*
 * Recycle event source and web worker, free up resource for client machine 
 */
function recycleResouce(){
    console.log("recycle resources");
    if( source != null ){
        source.close();
        source = null;
    }
    
    stopTimer();
}

function verifyAnswer(){
    var userQuote = $("#answer").val().toLowerCase();
    var userAuthor = $("#author").val().toLowerCase();
    userAnswer = userQuote.replace(/\s{2,}/g, ' ');
    var rightQuote = ( userQuote ==  quote.trim() );
    var rightAuthor =  ( userAuthor == author.trim() );
    
    var text;
    if( userQuote != ""){
        text= rightQuote ? "Correct" : "Incorrect";
        $("#labelQuote span").text(text);
    }
    
    if( userAuthor != "" ){
        text = rightAuthor ? "Correct" : "Incorrect";
        $("#labelAuthor span").text(text);
    }
    
    if( rightQuote && rightAuthor ){
        markPuzzleSolved();
        resetPuzzle();
    }
}

function flipCell(){
    var id = ( cellId > 10 ) ? "#cell"+cellId : "#cell0"+cellId;
    $(id).fadeTo("slow", 0);
}

function resetPuzzle(){
    $("#question").text("Please wait for next puzzle....");
    document.getElementById("answer").value = "";
    document.getElementById("author").value = "";
    $("#labelQuote span").text("");
    $("#labelAuthor span").text("");
}

function requestNewPuzzle(){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            parseAJAXresponse(xmlhttp.responseText);
            if( userType == 1){
                $("#question").text(question);
            }else{
                $("#currentQuestion").text(question);
            }
        }
    }
    xmlhttp.open("GET","requestPuzzleInfo.php?id="+puzzleId, true);
    xmlhttp.send();
}

function parseAJAXresponse(response){
    var info = response.split("&", 3);
    quote=info[0];
    question=info[1];
    author=info[2];
}

function verifyPictureName(){
    var answer=$("#imageAnswer").val().toLowerCase();
    
    if( answer == "") return;
    
    if(answer != pictureName){
        $("#imageQuestion span").text("Incorrect");
    } else {
        $("#imageQuestion span").text("Correct");
        showSuccessAlready=false;
        markPictureSolved();
        alert("Wait for a new game......");
    }
}

function markPuzzleSolved(){
    if( markPuzzleSolvedCount > 2 ){
        return;
    }
    markPuzzleSolvedCount = markPuzzleSolvedCount + 1;
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            if(xmlhttp.responseText != 1 ){
                markPuzzleSolved();
            } else {
                markPuzzleSolvedCount = 0;
                
            }
        }
    }
    xmlhttp.open("GET","markPuzzleSolved.php", true);
    xmlhttp.send();
}


function markPictureSolved(){
    if( markPictureSolvedCount > 2 ){
        return;
    }
    markPictureSolvedCount = markPictureSolvedCount + 1;
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            if(xmlhttp.responseText != 1 ){
                markPictureSolved();
            } else {
                markPictureSolvedCount = 0;
                clearFields();
            }
        }
    }
    xmlhttp.open("GET","markPictureSolved.php", true);
    xmlhttp.send();
}

function clearErrorMessage(){
    if( $("#imageAnswer").val() == "" ){
        $("#imageQuestion span").text("");
    }
}

function skipQuestion(){
    var c = confirm("Are you sure you want to skip this question?");
    if( c == true ){
        resetPuzzle();
        requestNewPuzzle();
    }
}

function doAtTimeOut(){
    $("#timer").text("Time's up! Guess the picture");
    $("#question").attr("disabled", "disabled");
    $("#answer").attr("disabled", "disabled");
    $("#author").attr("disabled", "disabled");
    $("#skip").attr("disabled", "disabled");
    $("#answerSubmit").attr("disabled", "disabled");
}

function startGame(){
    $("#startGame").hide();
    startEvent();
}

function startEvent(){
    if ( source != null ){
        source=null;
        return;
    }
    if(typeof(EventSource)!== "undefined"){
        source=new EventSource("serverSentEvent.php");
        source.addEventListener("updateLeader", function(event){
            var data = JSON.parse(event.data);
            if( data.pictureSolved){
                alert("Congrad! Picture is solved by "+data.pictureSolvedBy+". Please click OK to start new game");
                resetGame();
                return;
            }
            
            if( data.solved ){
                document.getElementById("lastProblemTeam").innerHTML=data.team;
                flipCell();
                cellId = data.cellId;
                puzzleId=data.puzzleId;
                currentQuestion = data.currentQuestion;
                requestNewPuzzle();
            }else if(data.cellId != cellId ){
                document.getElementById("lastProblemTeam").innerHTML="";
                currentQuestion = data.currentQuestion;
                cellId = data.cellId;
                puzzleId=data.puzzleId;
                requestNewPuzzle();
            }
            
        }, false);
        
        source.addEventListener("updateTeam", function(event){
            var data = JSON.parse(event.data);
            console.log("picture solved: " + data.pictureSolved );
            if( data.pictureSolved ){
                alert("Congrad! Picture is solved by "+data.pictureSolvedBy+". Please click OK to start new game");
                resetGame();
                return;
            }
            
            if( data.leader == 1){
                if( !gameStarted ){
                    currentQuestion = data.currentQuestion;
                    puzzleId=data.puzzleId;
                    cellId = data.cellId;
                    gameStart();
                    gameStarted=true;
                } else if( data.cellId !== cellId && currentQuestion !== data.currentQuestion){
                    flipCell();
                    currentQuestion = data.currentQuestion;
                    cellId = data.cellId;
                    puzzleId=data.puzzleId;
                    requestNewPuzzle();
                }
                
            } else {
                document.getElementById("waitMessage").innerHTML="Leader does not yet start the game, please wait...";
            }
        }, false);
    }else{
        alert("This browser is not supported");
    }
}

function gameStart(){
    $("#teamMessage").hide();
    $("#team").show();
    $("#guessImage").show();
    requestNewPuzzle();
    CreateTimer("timer", 3600, doAtTimeOut);
}

function resetGame(){
    clearFields();
    gameStarted = false;
}

function clearFields(){
    hideImage();
    document.getElementById("imageAnswer").value='';
    $("#imageQuestion span").text("");
}
