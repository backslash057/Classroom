let form = document.querySelector(".form");
let error_frame = document.querySelector(".error_frame");

function display_result(message, positive) {
    error_frame.innerText = message;
    // TODO: Modifiy the color of error_frames
    //console.log("positive: " + positive + ", message: " + message);
}


function signup(path, datas) {
    fetch(path,
        {
            headers: {"Content-Type" : 'application/json'},
            method: "POST",
            body: JSON.stringify(datas)
        }
    )
    .then(response => {
        console.log(response);
        return response.json();
    })
    .then((data) => {
        if(data.success) {
            display_result(data.message, true);

            setTimeout(() => {
                // rediurect the user to home page
                window.location.replace("/");
            }, 1000);
        }
        else display_result(data.message, false);
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
    signup(form.action, datas);
});