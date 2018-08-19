function updateNota(idNota) {
    let ask, request, input, respon, json;
    ask = confirm("Apakah anda yakin menerima nota " + idNota);
    if (ask) {
        input = 'idNota=' + idNota;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                respon = request.responseText;
                
                json = JSON.parse(respon);

                if (json['status'] == 1) {
                    window.location = "payment.php";
                }
                else{
                    alert(json['message']);
                }
                
            }
        }
        request.open("POST", "notaUpdate.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}