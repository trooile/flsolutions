<?php 
session_start();
include "include_view.php";
if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
}
$id_course = '';
$course = $_SESSION['notregistered'];
$usersame = $controller->toUsers->getAll('id_courses = 0');
$user = $controller->toUsers->getAll('id_users ='.$_SESSION['userLogged']);
if(isset($user['id_courses'])){
    $courses = $controller->toCourses->getAll('id_courses ='.$user['id_courses']);
    if(!empty($courses)){
        $course = $courses[0]['name'];
        $id_course = $courses[0]['id_courses'];
        $usersame = $controller->toUsers->getAll('id_courses ='.$user['id_courses']);
    }
}
$board_name = $controller->toAppBoard->getAll('id_app_board ='.$_REQUEST['id_app_board'])[0]['name'];
include_once "../includes/menu.php";
?>
<a href="../user/home.php"><img src="../images/logo.svg" class="logo-black "></a>
<div class="title-giant">
    <label class='giant'><?=$_SESSION['studyplan']?></label>
</div>
<div role="alert" aria-live="assertive" style="position:relative;" id="toastCard" aria-atomic="true" class="toast hide" data-autohide="true">
    <div class="toast-header">
        <img src="../images/flsolutionsdx.svg" class="rounded mr-2" alt="5" style="width:12%;">
        <strong class="mr-auto"><?=$_SESSION['flsolutions']?></strong>
        <small>CollegeTool</small>
        <button type="button" class="ml-2 mb-1 close" id="close-toast" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        <?=$_SESSION['cardadded']?>!
    </div>
</div>
<button type="button" class="btn btn-orange btncard btn-sm"  data-toggle="modal" data-target="#modalCard"><?=$_SESSION['addcard']?></button>
<label class="app-name"><?=$_SESSION['board'] .': '. $board_name?><br>
<a href="/app/new_app_board.php?editBoard=<?=$_REQUEST['id_app_board']?>"><button type="button" class="btn btn-orange btneditboard btn-sm"><?=$_SESSION['editboard']?></button></a>
</label>
<!-- MODAL CARD -->
<div class="modal fade" id="modalCard" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="course"><?=$_SESSION['course']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text"  value="<?=$course?>" disabled>
                                <input type="hidden" name="course" id="course" value="<?=$id_course?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="semester"><?=$_SESSION['semester']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select type="text" class="form-control" id="semester" name="semester">
                                    <option value="1"><?=$_SESSION['first-semester']?></option>
                                    <option value="2"><?=$_SESSION['second-semester']?></option>
                                    <option value="3"><?=$_SESSION['third-semester']?></option>
                                    <option value="4"><?=$_SESSION['fourth-semester']?></option>
                                    <option value="5"><?=$_SESSION['fifth-semester']?></option>
                                    <option value="6"><?=$_SESSION['sixth-semester']?></option>
                                    <option value="7"><?=$_SESSION['seventh-semester']?></option>
                                    <option value="8"><?=$_SESSION['eighth-semester']?></option>
                                    <option value="9"><?=$_SESSION['ninth-semester']?></option>
                                    <option value="10"><?=$_SESSION['tenth-semester']?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="titleInput"><?=$_SESSION['matter']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" name="title" id="titleInput" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <label for="descriptionInput"><?=$_SESSION['description']?></label>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text" name="description" id="descriptionInput" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </form>
                <img src="../images/studyplan-background.svg" class="logo-white">
            </div>
            <div class="modal-footer" style="text-align:center;">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add"><?=$_SESSION['save']?></button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL CARD -->
<div class="container">
    <div class="boards overflow-auto p-0" id="boardsContainer">
    </div>
</div>
<?=include_once "../includes/footer.php"?>

<script type="text/javascript">
let cardBeignDragged;
let dropzones = document.querySelectorAll('.dropzone');
let priorities;
let dataColors = [
    {color:"red", title:"<?=$_SESSION['toDo']?>"},
    {color:"yellow", title:"<?=$_SESSION['inprogress']?>"},
    {color:"green", title:"<?=$_SESSION['done']?>"}
];
let dataCards = {
    config:{
        maxid:0
    },
    cards:[]
};

$(document).ready(()=>{
    $('#usersame').select2();
    initializeBoards();
    // $.ajax({
    //         url: "/app/actions.php?action=searchCards",
    //         type: "POST",
    //         dataType: "json",
    //         data: {id_app_board: <?=$_REQUEST['id_app_board']?>}
    //     }).done(function(back) {
    //         dataCards = back.data;
    //         initializeComponents(dataCards);
    //         console.log(dataCards)
    //     });
    if(JSON.parse(localStorage.getItem('@kanban:data'))){
        dataCards = JSON.parse(localStorage.getItem('@kanban:data'));
        initializeComponents(dataCards);
        console.log(dataCards)
    }
    initializeCards();
    $('#add').click(()=>{
        const title = $('#titleInput').val()!==''?$('#titleInput').val():null;
        const description = $('#descriptionInput').val()!==''?$('#descriptionInput').val():null;
        const course = $('#course').val();
        const semester = $('#semester').find(":selected").val();
        $('#titleInput').val('');
        $('#descriptionInput').val('');
        if(title && description){
            let id = dataCards.config.maxid+1;
            const newCard = {
                id,
                title,
                description,
                position:"red",
                priority: false
            }
            dataCards.cards.push(newCard);
            dataCards.config.maxid = id;
            save();
            appendComponents(newCard);
            initializeCards();
            newCardDB = {
                    newCard,
                    course,
                    semester
            }
            saveInDB(newCardDB);
        }
    });
    $("#deleteAll").click(()=>{
        dataCards.cards = [];
        save();
    });

});

function saveInDB(card){
    $.ajax({
          url: "/app/actions.php?action=saveCard",
          type: "POST",
          data: {
            card: card
          },
          dataType: "json",
      }).done(function(back) {
        if (back.error) {
            alert(back.message)
        } else {
            toggleAlertCard();
        }
      });
  };

function initializeBoards(){
    dataColors.forEach(item=>{
        let htmlString = `
        <div class="board">
            <h3 class="text-center">${item.title.toUpperCase()}</h3>
            <div class="dropzone" id="${item.color}">
            </div>
        </div>
        `
        $("#boardsContainer").append(htmlString)
    });
    let dropzones = document.querySelectorAll('.dropzone');
    dropzones.forEach(dropzone=>{
        dropzone.addEventListener('dragenter', dragenter);
        dropzone.addEventListener('dragover', dragover);
        dropzone.addEventListener('dragleave', dragleave);
        dropzone.addEventListener('drop', drop);
    });
}

function initializeCards(){
    cards = document.querySelectorAll('.kanbanCard');
    cards.forEach(card=>{
        card.addEventListener('dragstart', dragstart);
        card.addEventListener('drag', drag);
        card.addEventListener('dragend', dragend);
    });
}

function initializeComponents(dataArray){
    dataArray.cards.forEach(card=>{
        appendComponents(card);
    })
    // $.each(dataArray.cards, function (key, value) { 
    //     appendComponents(value)
    // });

}

function appendComponents(card){
    let htmlString = `
        <div id=${card.id} class="kanbanCard ${card.position}" draggable="true">
            <div class="content">
                <h4 class="title">${card.title}</h4>
                <p class="description">${card.description}</p>
            </div>
            <form class="row mx-auto justify-content-between">
                <span id="span-${card.id}" onclick="togglePriority(event)" class="material-icons priority ${card.priority? "is-priority": ""}">
                    star
                </span>
                <button class="invisibleBtn">
                    <span class="material-icons delete" onclick="deleteCard(${card.id})">
                        remove_circle
                    </span>
                </button>
            </form>
        </div>
    `
    $(`#${card.position}`).append(htmlString);
    priorities = document.querySelectorAll(".priority");
}

function togglePriority(event){
    event.target.classList.toggle("is-priority");
    dataCards.cards.forEach(card=>{
        if(event.target.id.split('-')[1] === card.id.toString()){
            card.priority=card.priority?false:true;
        }
    })
    save();
}

function deleteCard(id){
    dataCards.cards.forEach(card=>{
        if(card.id === id){
            let index = dataCards.cards.indexOf(card);
            console.log(index)
            dataCards.cards.splice(index, 1);
            deleteCardDB(id);
            console.log(id);
            save();
            
        }
    })
}

function deleteCardDB(id){
    $.ajax({
          url: "/app/actions.php?action=deleteCard",
          type: "POST",
          data: {
            id: id
          },
          dataType: "json",
      }).done(function(back) {}); 
}

function removeClasses(cardBeignDragged, color){
    cardBeignDragged.classList.remove('red');
    cardBeignDragged.classList.remove('blue');
    cardBeignDragged.classList.remove('purple');
    cardBeignDragged.classList.remove('green');
    cardBeignDragged.classList.remove('yellow');
    cardBeignDragged.classList.add(color);
    position(cardBeignDragged, color);
}

function save(){
    localStorage.setItem('@kanban:data', JSON.stringify(dataCards));
}

function position(cardBeignDragged, color){
    const index = dataCards.cards.findIndex(card => card.id === parseInt(cardBeignDragged.id));
    dataCards.cards[index].position = color;
    save();
}

function dragstart(){
    dropzones.forEach( dropzone=>dropzone.classList.add('highlight'));
    this.classList.add('is-dragging');
}

function drag(){
}

function dragend(){
    dropzones.forEach( dropzone=>dropzone.classList.remove('highlight'));
    this.classList.remove('is-dragging');
}

function dragenter(){
}

function dragover({target}){
    this.classList.add('over');
    cardBeignDragged = document.querySelector('.is-dragging');
    if(this.id ==="yellow"){
        removeClasses(cardBeignDragged, "yellow");
    }
    else if(this.id ==="green"){
        removeClasses(cardBeignDragged, "green");
    }
    else if(this.id ==="red"){
        removeClasses(cardBeignDragged, "red");
    }
    this.appendChild(cardBeignDragged);
}

function dragleave(){

    this.classList.remove('over');
}

function drop(){
    this.classList.remove('over');
}

$('#close-toast').click(function(){
    toggleAlertCard();
});

function toggleAlertCard(){
    $("#toastCard").toggleClass('show hide');
    return false;
}

</script>