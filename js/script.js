const statusArr = ["In Progress", "Finished", "Cancelled", "Postponed"];
let todoList = [];
let i = 0;
retrieveList();

let btn = document.getElementById("newTask");
btn.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    addTask();
  }
});

let srch = document.getElementById("search-input");
srch.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    search();
  }
});

function addTask() {
  const task = document.getElementById("newTask").value;

  if (task.trim() !== "") {
    const table = document.getElementById("todoTable");

    const newRow = table.insertRow(table.rows.length);
    const taskNoCell = newRow.insertCell(0);
    const taskCell = newRow.insertCell(1);
    const statusCell = newRow.insertCell(2);
    const editCell = newRow.insertCell(3);
    const deleteCell = newRow.insertCell(4);

    taskNoCell.innerHTML = table.rows.length - 1;
    taskCell.innerHTML = `<input type='text' id='tableTask' name='taskName' value='${task}' readonly /> `;
    statusCell.innerHTML = `<span id="status" onclick="changeStatus(this)">${statusArr[0]}</span>`;
    editCell.innerHTML =
      "<span id='edit-btn' onclick='editTask(this)'>🖋️</span>";
    deleteCell.innerHTML =
      "<span id='delete-btn' onclick='deleteTask(this)'>❌</span>";

    document.getElementById("newTask").value = "";
  } else alert("Please enter a task.");

  saveList();
}

function changeStatus(status) {
  i++;

  status.innerHTML = statusArr[i % statusArr.length];

  saveList();
}

function deleteTask(button) {
  const row = button.parentNode.parentNode;

  const table = document.getElementById("todoTable");

  table.deleteRow(row.rowIndex);

  saveList();
}

function editTask(button) {
  const row = button.parentNode.parentNode;

  const taskEdit = row.querySelector("td:nth-child(2)");

  const taskInput = taskEdit.querySelector("input[type='text']");

  if (button.innerHTML == "🖋️") {
    button.innerHTML = "✅";
    taskInput.removeAttribute("readonly");
    taskInput.focus();
  } else {
    button.innerHTML = "🖋️";
    taskInput.setAttribute("readonly", "readonly");
  }

  saveList();
}

function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-input");
  filter = input.value.toUpperCase();
  table = document.getElementById("todoTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    let inp = td.getElementsByTagName("input")[0].value;
    if (inp) {
      if (inp.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
