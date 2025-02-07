let form = document.querySelector(".form");

function display_result(message, positive) {
    // TODO: Actually display the result in the error_frame element
    console.log("positive: " + positive + ", message: " + message);
}


function login(path, datas) {
    fetch(path,
        {
            headers: {"Content-Type" : 'application/json'},
            method: "POST",
            body: JSON.stringify(datas)
        }
    ).then(response => response.json()
    ).then((data) => {
        if(data.success) {
            display_result(data.success, true);

            // after succesful login, redirect the user to home
            setTimeout(() => {
                window.location.replace("/");
            }, 1000);
        }
        else if(data.error) display_result(data.error, false);
    })
    .catch(e => {
        display_result("An error occured. Try again later", false);
    });
}


form.addEventListener("submit", event => {
    event.preventDefault();

    let formData = new FormData(event.target);
    let datas = {};

    console.log(form, formData, new FormData(form));
    
    formData.forEach((key, value) => {
        datas[value] = key;
    });

    console.log(datas);
    // login(form.action, datas);
});