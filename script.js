const switchButton = document.getElementById('light-dark');
const input = document.querySelectorAll('input')
const loginForm = document.getElementById('login-container')
const loginButton = document.getElementsByClassName('login-button')

let i = 0 ;

switchButton.addEventListener('click', () =>{
    let body = document.body;
    if(i % 2== 0 ){
        body.style.backgroundColor = "#385170";
        switchButton.src = "include/sun-2-svgrepo-com (1).svg"
        switchButton.style.width = "30px"
        loginForm.style.color = "#f7f5f5"
        loginForm.style.backgroundColor= "black"

        console.log(i)
    }
    else{
        body.style.backgroundColor = "#0056b3";
        switchButton.src = "include/moon.svg"
        switchButton.style.width = "30px"
        loginForm.style.color = "black"
        loginForm.style.backgroundColor= "white"
        console.log(i)
    }
    i++
})


function showpassd(){
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "Text";
    }else
        x.type = "password";
}