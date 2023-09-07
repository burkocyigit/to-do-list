function addTask() {
  // Get the input value
  var task = document.getElementById("newTask").value;

  if (task.trim() !== "") {
    // Get the table
    var table = document.getElementById("todoTable");

    // Create a new row and cells
    var newRow = table.insertRow(table.rows.length);
    var taskNoCell = newRow.insertCell(0);
    var taskCell = newRow.insertCell(1);
    var statusCell = newRow.insertCell(2);
    var editCell = newRow.insertCell(3);
    var deleteCell = newRow.insertCell(4);

    // Add the task text to the task cell
    taskNoCell.innerHTML = 3;
    taskCell.innerHTML = task;
    statusCell.innerHTML = "In Progress";
    editCell.innerHTML = "<span id='edit-btn'>🖋️</span>";
    deleteCell.innerHTML = "<span id='delete-btn'>❌</span>";

    // Clear the input field
    document.getElementById("newTask").value = "";
  } else {
    alert("Please enter a task.");
  }
}

function deleteTask() {}

function search() {}
