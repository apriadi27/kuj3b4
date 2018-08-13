let globalUser, globalType;

function confirmAddPass() {
    let pass1, pass2;
    pass1 = document.getElementById('addPass1').value;
    pass2 = document.getElementById('addPass2').value;
    if (pass1 != pass2) {
        document.getElementById('labelAddPass').innerHTML = "Password tidak cocok";
    }
    else{
        document.getElementById('labelAddPass').innerHTML = "Password cocok";
    }
}

function confirmEditPass() {
    let pass1, pass2;
    pass1 = document.getElementById('editPass1').value;
    pass2 = document.getElementById('editPass2').value;
    if (pass1 != pass2) {
        document.getElementById('labelEditPass').innerHTML = "Password tidak cocok";
    }
    else{
        document.getElementById('labelEditPass').innerHTML = "Password cocok";
    }
    permissionChangePassword();
}

function editSosmed(id, user, type) {
    globalUser = user;
    globalType = type;
    document.getElementById('sosmedEdit').style.display = "block";
    document.getElementById('labelEditUser').innerHTML  = user + " : " + type;
    document.getElementById('editIdSosmed').value = id;
}

function checkPass() {
    let input, label, request;
    label = document.getElementById('labelEditUser').innerHTML.split(" : ");
    
    input = "pass=" + document.getElementById('editOldPass').value + 
            "&id=" + document.getElementById('editIdSosmed').value +
            "&type=" + label[1] ;
    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            if (request.responseText != 1) {
                document.getElementById('labelEditOldPass').innerHTML = request.responseText;
                permissionChangePassword();
            }
            else{
                document.getElementById('labelEditOldPass').innerHTML = "Benar";
            }
        }
    }
    request.open("POST", "sosmedCheckPass.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function permissionChangePassword() {
    let oldPass, newPass;
    oldPass = document.getElementById('labelEditOldPass').innerHTML;
    newPass = document.getElementById('labelEditPass').innerHTML;
    if (oldPass == "Benar" && newPass == "Password cocok") {
        document.getElementById('editSubmit').disabled = false;
    }
    else{
        document.getElementById('editSubmit').disabled = true;
    }
}

function sosmedDelete(id, user) {
    let ask, request, input;
    ask = confirm("Apakah anda yaking menghapus " + user);
    if (ask) {
        input = 'id=' + id;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "sosmed.php";
                }
                else{
                    alert("Failed to delete");
                }
            }
        }
        request.open("POST", "sosmedDelete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}