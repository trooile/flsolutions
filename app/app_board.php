<?php include "include_view.php";
 session_start();
  if(!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])){
    echo "<script>window.location='/user/login.php'</script>";
  }
    $courses = $controller->toCourses->getAll();
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCard"><?=$_SESSION['studyplan']?></button>
<button class="btn btn-danger mx-2" id="deleteAll"><?=$_SESSION['deleteall']?></button>

<div class="modal fade" id="modalCard" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="controls p-3">
      <form class="form-inline">
        <div class="form-group col-sm-12">
          <label for="course"><?=$_SESSION['course']?></label>
          <div class="input-group">
          <select type="text" class="form-control" id="course" name="course">
                <option value="" selected disabled><?=$_SESSION['select-course']?></option>
                <?php foreach($courses as $value){?>
                  <option value='<?=$value['id_courses']?>'><?=$value['name']?></option>
                <?php } ?>
            </select>
        </div>
        </div><p></p>
        <div class="form-group col-sm-12">
          <label for="semester"><?=$_SESSION['semester']?></label>
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
        <div class="form-group col-sm-12">
          <label for="titleInput"><?=$_SESSION['subject']?></label>
          <div class="input-group">
          <input class="form-control form-control-sm" type="text" name="title" id="titleInput" autocomplete="off">
        </div>
        </div>
        <div class="form-group col-sm-12">
          <label for="descriptionInput"><?=$_SESSION['description']?></label>
          <div class="input-group">
          <input class="form-control form-control-sm" type="text" name="description" id="descriptionInput" autocomplete="off">
        </div>
        </div>
      </form>
      <img src="../images/studyplan-background.svg" class="logo">
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add"><?=$_SESSION['save']?></button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
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
    initializeBoards();
    if(JSON.parse(localStorage.getItem('@kanban:data'))){
        dataCards = JSON.parse(localStorage.getItem('@kanban:data'));
        initializeComponents(dataCards);
    }
    initializeCards();
    $('#add').click(()=>{
        const title = $('#titleInput').val()!==''?$('#titleInput').val():null;
        const description = $('#descriptionInput').val()!==''?$('#descriptionInput').val():null;
        const course = $('#course').find(":selected").val();
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
            // $('#modalCard').modal('hide');
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
          $('#modalAlert .modal-body').html(back.message);
          $('#modalAlert').modal('toggle');
        } else {
          $('#modalAlert .modal-body').html('OK');
          $('#modalAlert').modal('toggle');
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
}

function appendComponents(card){
    let htmlString = `
        <div id=${card.id.toString()} class="kanbanCard ${card.position}" draggable="true">
            <div class="content">
                <h4 class="title">${card.title}</h4>
                <p class="description">${card.description}</p>
            </div>
            <form class="row mx-auto justify-content-between">
                <span id="span-${card.id.toString()}" onclick="togglePriority(event)" class="material-icons priority ${card.priority? "is-priority": ""}">
                    star
                </span>
                <button class="invisibleBtn">
                    <span class="material-icons delete" onclick="deleteCard(${card.id.toString()})">
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
            console.log(dataCards.cards);
            save();
        }
    })
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

</script>