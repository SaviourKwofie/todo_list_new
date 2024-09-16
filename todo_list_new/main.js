document.addEventListener("DOMContentLoaded", () => {
  // const apiUrl = "http://localhost:8080/todo_list_new/api/todoController.php";
  const apiUrl =
    "http://192.168.3.10:8080/todo_list_new/api/todoController.php";

  const form = document.getElementById("task-form");
  const taskInput = document.getElementById("task-input");
  const taskList = document.getElementById("task-list");
  const deletedItemsList = document.getElementById("deleted-items");
  const deletedItems = [];

  getAllTasks();
  function getAllTasks() {
    fetch(`${apiUrl}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        data.forEach((task) => {
          addTask(task.task, task.id);
        });
        console.log(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const todoData = {
      task: taskInput.value.trim(),
      // id: Date.now()
    };
    fetch(apiUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(todoData),
    })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message);
        form.reset();
        location.reload();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  function addTask(task, id = Date.now()) {
    const li = document.createElement("li");
    li.textContent = task;
    li.dataset.id = id;
    saveTaskToAPI(task);
    const buttons = createDoneBtn(li);
    taskList.appendChild(li);
    li.appendChild(buttons.doneBtn);
    li.appendChild(buttons.editBtn);
    li.appendChild(buttons.deleteBtn);
  }

  function createDoneBtn(list) {
    const doneBtn = document.createElement("button");
    const editBtn = document.createElement("button");
    const deleteBtn = document.createElement("button");
    doneBtn.innerHTML = "Done";
    editBtn.innerHTML = "Edit";
    deleteBtn.innerHTML = "Delete";

    doneBtn.addEventListener("click", () => {
      if (doneBtn.innerText === "Done") {
        doneTask(list);
        doneBtn.innerText = "Restore";
      } else {
        restoreTask(list);
        doneBtn.innerHTML = "Done";
      }
    });

    editBtn.addEventListener("click", () => editTask(list));
    deleteBtn.addEventListener("click", () => deleteTask(list));

    return { doneBtn, editBtn, deleteBtn };
  }

  function editTask(taskItem) {
    const newTask = prompt(
      "Please edit your task here:",
      taskItem.firstChild.textContent
    );
    if (newTask) {
      fetch(`${apiUrl}?id=` + taskItem.dataset.id, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ task: newTask }),
      })
        .then((response) => response.json())
        .then((data) => {
          alert(data.message);
          location.reload();
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  }

  function doneTask(taskItem) {
    taskItem.classList.add("completed");
  }

  function restoreTask(taskItem) {
    taskItem.classList.remove("completed");
  }

  function deleteTask(taskItem) {
    id = taskItem.dataset.id;
    console.log("Deleting task with id:", id);
    if (confirm("Are you sure you want to permanently delete this task?")) {
      fetch(`${apiUrl}?id=` + id, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: taskItem.dataset.id }),
      })
        .then((response) => response.json())
        .then((data) => {
          alert(data.message);
          // getAllTasks();
          location.reload();
        })
        .catch((error) => {
          console.error("Error:", error);
        });

      //   deletedItems.push(taskItem);
      //   deletedItemsList.append(...deletedItems);
      //   console.log("deleted items", deletedItems);
      //   taskItem.remove();
      //   deleteTaskFromAPI(taskItem.dataset.id);
    }
  }

  function saveTaskToAPI(task) {
    console.log("Saving task to API:", task);
  }

  function updateTaskInAPI(id, updatedTask) {
    console.log("Updating task in API:", id, updatedTask);
  }

  function deleteTaskFromAPI(id) {
    console.log("Deleting task from API:", id);
  }
});
