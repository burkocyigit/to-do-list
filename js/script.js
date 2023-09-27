const statusArr = ["In Progress", "Finished", "Cancelled", "Postponed"];
let i = 0;
retrieveTableData();

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

function saveTableData() {
  const rows = document.getElementById("todoTable").rows;
  const tableData = [];

  let no, taskName, taskStatus;

  for (let i = 1; i < rows.length; i++) {
    no = rows[i].querySelector("td:nth-child(1)").innerHTML;
    taskName = rows[i]
      .querySelector("td:nth-child(2)")
      .querySelector("input[type='text']").value;
    const taskStatusName = rows[i].querySelector("td:nth-child(3)").innerText;
    switch (taskStatusName) {
      case "In Progress":
        taskStatus = 0;
        break;
      case "Finished":
        taskStatus = 1;
        break;
      case "Cancelled":
        taskStatus = 2;
        break;
      case "Postponed":
        taskStatus = 3;
        break;
    }
    const rowData = {
      taskNo: no,
      taskName: taskName,
      taskStatus: taskStatus,
    };

    tableData.push(rowData);
  }

  const jsonData = JSON.stringify(tableData);

  $.ajax({
    type: "POST",
    url: "includes/save_list.inc.php",
    data: { dataArray: jsonData },
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
}

function retrieveTableData() {
  const data = {
    retrieve: true,
  };

  $.ajax({
    type: "POST",
    url: "includes/save_list.inc.php",
    data: { retrieveData: data },
    success: function (response) {
      var script = document.createElement("script");
      script.text = response;
      console.log(script);
      document.head.appendChild(script);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
}
