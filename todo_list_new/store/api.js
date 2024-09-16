// async function getAllTasks() {
//     const response = await fetch('fetch_data.php');
//     const data = await response.json();
//     if (!response.ok) {
//         throw new Error('Failed to fetch data');
//     }
//     console.log('Data  ', data);
//     data.forEach(task => {
//         addTask(task.task, task.id);
//     });
//     console.log(data);
    
// }

// function getAllTasks() {
//     fetch('fetch_data.php')
//         .then(response => response.json())
//         .then(data => {
//             // data.forEach(task => {
//             //     addTask(task.task, task.id);
//             // });
//             console.log(data);
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
// }

// getAllTasks();


function getAllTasks() {
    fetch('backend-api-helper.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

getAllTasks();