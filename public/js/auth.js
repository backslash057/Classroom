let form = document.querySelector(".form");
let error_frame = document.querySelector(".error_frame");

function display_result(message, positive) {
    error_frame.innerText = message;
    // TODO: Modifiy the color of error_frames
    //console.log("positive: " + positive + ", message: " + message);
}


function authenticate(path, datas) {
    fetch(path,
        {
            headers: {"Content-Type" : 'application/json'},
            method: "POST",
            body: JSON.stringify(datas)
        }
    ).then(response => response.json()
    ).then((data) => {
        if(data.success) {
            display_result(data.message, true);

            // redirect the user to home page
            setTimeout(() => {
                window.location.replace("/");
            }, 1000);
        }
        else display_result(data.message, false);
    })
    .catch(e => {
        // TODO: empty all the form entries here
        display_result("An error occured. Try again later", false);
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
    authenticate(form.action, datas);
});