
function showpassd(){
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "Text";
    }else
        x.type = "password";
}