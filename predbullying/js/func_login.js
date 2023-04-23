
// function to view modal

function checkForm(){
    function showMessageDialog(title, body) {
        document.getElementById('title-modal').innerHTML = ""+title;
        document.getElementById('body-modal').innerHTML = ""+body;
        var mes_diag = new bootstrap.Modal(document.getElementById('message-dialog'))
        mes_diag.show();
    }

    var txtEmail = document.getElementById("username").value;
    var txtPassword = document.getElementById("password").value;

    console.log("email : "+txtEmail)

    if(txtEmail.length === 0 ){
        showMessageDialog("Warning Message", "Please, provide your email address.");
    }else if(txtPassword.length === 0 ){
        showMessageDialog("Warning Message", "Please, provide your Password.");
    
    }
}