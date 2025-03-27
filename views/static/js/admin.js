

class Course extends HTMLTableRowElement {
    constructor(data) {
        super();
        this.innerHTML = columns.map(
            col => `<td>${data[col] || ''}</td>`
        ).join('') + `<td><button class="delete">Delete</button></td>`;
        this.querySelector(".delete").addEventListener("click", () => this.delete());
    }

    delete() {
        // call the API and ask to delete. if it accepts, call this.remove()
        this.remove();
    }
}

function loadData(url, tableId) {
    fetch(url

    )
    .then(response => response.json())
    .then(data => {
        const tbody = document.querySelector(`#${tableId} tbody`);
        tbody.innerHTML = "";

        data.forEach(item => tableId.appendChild(new Course(item)));
    })
    .catch(error => {
        console.error("Error loading data:", error)
    });
}

document.querySelector("#course-add").addEventListener("click", () => loadData("/api/courses", "course-table"));
document.querySelector("#student-add").addEventListener("click", () => loadData("/api/students", "student-table"));
document.querySelector("#teacher-add").addEventListener("click", () => loadData("/api/teachers", "teacher-table"));
