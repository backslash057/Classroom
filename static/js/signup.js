let form = document.querySelector(".form");

function display_result(message, positive) {
    // TODO: Actually display the result in the error_frame element
    console.log("positive: " + positive + ", message: " + message);
}


function signup(path, datas) {
    fetch(path,
        {
            headers: {"Content-Type" : 'application/json'},
            method: "POST",
            body: JSON.stringify(datas)
        }
    ).then(response => response.json()
    ).then((data) => {
        console.log(data);

        if(data.success) {
            display_result(data.success, true);
            /*
                TODO:
                    redirect the user manually to where he left off
                    his navigation (the page which asked for
                    authentification)
                OR automativally send to home ( / )
            */
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
    
    formData.forEach((key, value) => {
        datas[value] = key;
    });

    console.log(datas);
    signup(form.action, datas);
});