let form = document.querySelector(".form");
let error_frame = document.querySelector(".error_frame");

function display_result(message, positive) {
    error_frame.innerText = message;
    // TODO: Modifiy the color of error_frames
    //console.log("positive: " + positive + ", message: " + message);
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
        // TODO: empty all the form entries here
        display_result("Une erreur est survenue. Veuillez reesayer", false);
    });
}


form.addEventListener("submit", event => {
    event.preventDefault();

    let formData = new FormData(event.target);
    let datas = {};
    
    formData.forEach((key, value) => {
        datas[value] = key;
    });

    console.log(datas);
    login(form.action, datas);
});