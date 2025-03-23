let courseListTable = document.quesrySelector("course-table");

let addCourseButton = document.querySelector("course-add");

class Course extends HTMLTableRowElement {
    construct(datas) {
        this.classList.add("course-item");

        // create the child nodes
        suppBtn = document.createElement("td");
        suppBtn.classList.add("course-item");
        
        
    }

    update() {

    }
}


addCourseButton.addEventListener("click", ()=>{
    
    fetch("/api/courses",
        {}
    ).then(response => response.json()
    ).then(data => {

    });

});

