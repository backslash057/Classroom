button = document.querySelector(".button");
output = document.querySelector(".output");
button.addEventListener("click", event => logout());


function logout() {
    fetch("/logout", {method: "POST"}
    ).then(response => response.json()
    ).then((data) => {
        if(data.success) {
            button.remove();
            output.innerText = data.success
        }
        else if(data.error) {
            output.innerText = data.error;
        }
    })
    .catch(e => {
        output.innerText = "An error occured. Try again later";
    });
}