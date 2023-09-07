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
    taskCell.innerHTML = task;
    statusCell.innerHTML = "In Progress";
    editCell.innerHTML = "<span id='edit-btn'>🖋️</span>";
    deleteCell.innerHTML =
      "<span id='delete-btn' onclick='deleteTask(this)'>❌</span>";

    document.getElementById("newTask").value = "";
  } else alert("Please enter a task.");
}

function deleteTask(button) {
  const row = button.parentNode.parentNode;

  const table = document.getElementById("todoTable");

  table.deleteRow(row.rowIndex);
}

function search(button) {}
