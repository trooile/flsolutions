<?=include "include_view.php"?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">NEW</h5>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="controls p-3">
      <form class="form-inline">
          <label for="titleInput"><?=$_SESSION['title']?></label>
          <input class="form-control form-control-sm" type="text" name="title" id="titleInput" autocomplete="off">
          <label for="descriptionInput"><?=$_SESSION['description']?></label>
          <input class="form-control form-control-sm" type="text" name="description" id="descriptionInput" autocomplete="off">
          <button class="btn btn-dark" id="add">Add</button>
          <button class="btn btn-danger mx-2" id="deleteAll"><?=$_SESSION['deleteall']?></button>
      </form>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
Add
</button>
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
        }
    });
    $("#deleteAll").click(()=>{
        dataCards.cards = [];
        save();
    });

});

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
    else if(this.id ==="blue"){
        removeClasses(cardBeignDragged, "blue");
    }
    else if(this.id ==="purple"){
        removeClasses(cardBeignDragged, "purple");
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