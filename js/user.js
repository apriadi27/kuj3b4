function submitTrolli() {
    let input, request, idAccount, idProduct, stock, message;

    idAccount = document.getElementById('idAccount').value;
    idProduct = document.getElementById('idProduct').value;
    stock = document.getElementById('trolliStock').value;
    message = document.getElementById('message').value;

    input = "idAccount=" + idAccount + "&idProduct=" + idProduct + "&stock=" + stock + "&message=" + message;
    request =  ajax(request);
    
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            console.log(respon);
            
            var json = JSON.parse(respon);

            if (json.status == 0) {
                alert(json.message);
            }
            else{
                alert("Berhasil masuk trolli");
            }
        }
    }
    request.open("POST", "trolli.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function getProvince(callback) {
    let request;
    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            
            var json = JSON.parse(respon);
            var results = json['rajaongkir']['results'];

            callback(results);
        }
    }
    request.open("POST", "config/getProvince.php", true);
    request.send();
}

function getCity(forms, idProvince, idCity){
    let request, input;

    input = "idProvince=" + idProvince;

    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            var json = JSON.parse(respon);
            
            var results = json['rajaongkir']['results'];

            var city = document.getElementById(forms+'City');
            city.innerHTML = "";
            var option;
            for (let i = 0; i < results.length; i++) {
                option = document.createElement("option");
                option.text = results[i]['city_name'];
                option.value = results[i]['city_id'];
                city.add(option);
            }
            city.value = idCity;
        }
    }
    request.open("POST", "config/getCity.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function getCost(idCity){
    let request, input;

    input = "idCity=" + idCity;

    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            
            var json = JSON.parse(respon);
            
            var results = json['rajaongkir']['results'][0]['costs'];
            var service = document.getElementById('service')
            var option;
            for (let i = 0; i < results.length; i++) {
                option = document.createElement("option");
                option.text = results[i]['service'] + " Rp " +  results[i]['cost'][0]['value'];
                option.value = results[i]['service'] + " Rp " +  results[i]['cost'][0]['value'];
                service.add(option);
            }
            document.getElementById('servicePrice').value = results[0]['cost'][0]['value'];
            updateCost(results[0]['cost'][0]['value']);
        }
    }
    request.open("POST", "config/getCost.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function addOrder() {
    let service, price, input, idContact, tmp, request, respon, json;
    service = document.getElementById('service').value;
    price = document.getElementById('servicePrice').value;
    idContact = document.getElementById('address').value;
    totalPrice = document.getElementById('totalPrice').innerHTML;
    tmp = idContact.split(" ");

    input = "service=" + service + "&price=" + price + "&contact=" + tmp[0];
    
    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            respon = request.responseText;
            console.log(respon);
            
            json = JSON.parse(respon);
            if (json['status'] == 1) {
                window.location = "confirmation.php";
            }
            else if(json['status'] == 2){
                alert(json['message']);
                window.location = "confirmation.php";
            }
            else{
                alert(json['message']);
            }
        }
    }
    request.open("POST", "addOrder.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function changeDestination() {
    let request, input;
    var city = document.getElementById('address').value;
    var tmp = city.split(" ");
    input = "idCity=" + tmp[1];

    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            var json = JSON.parse(respon);
            
            var results = json['rajaongkir']['results'][0]['costs'];
            var service = document.getElementById('service');
            service.innerHTML = "";
            var option;
            for (let i = 0; i < results.length; i++) {
                option = document.createElement("option");
                option.text = results[i]['service'] + " Rp " +  results[i]['cost'][0]['value'];
                option.value = results[i]['service'] + " Rp " +  results[i]['cost'][0]['value'];
                service.add(option);
            }

            document.getElementById('servicePrice').value = results[0]['cost'][0]['value'];
            updateCost(results[0]['cost'][0]['value']);
        }
    }
    request.open("POST", "config/getCost.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function updateCost(costService) {
    let hiddenTotalPrice, totalPrice, total;
    hiddenTotalPrice = document.getElementById('hiddenTotalPrice').value;
    total = Number(hiddenTotalPrice) + Number(costService);
    
    document.getElementById('totalPrice').innerHTML = total;
}

function changeService() {
    var changeService = document.getElementById('service').value;
    var tmp = changeService.split(" Rp ");
    updateCost(tmp[1]);
}

function addContactForm() {
    let results;
    document.getElementById('contactAdd').style.display='block';
    getProvince(function (respon) {
        results = respon;
        var province = document.getElementById('addProvince');
        var option;
        for (let i = 0; i < results.length; i++) {
            option = document.createElement("option");
            option.text = results[i]['province'];
            option.value = results[i]['province_id'];
            province.add(option);
        }
        getCity('add', document.getElementById('addProvince').value);
    });
}

function editContactForm(idContact, address, idCity, idProvince, postalCode) {
    let results;
    document.getElementById('contactEdit').style.display='block';
    document.getElementById('editAddress').value = address;
    document.getElementById('editPostalCode').value = postalCode;
    document.getElementById('editIdContact').value = idContact;
    getProvince(function (respon) {
        results = respon;
        var province = document.getElementById('editProvince');
        var option;
        for (let i = 0; i < results.length; i++) {
            option = document.createElement("option");
            option.text = results[i]['province'];
            option.value = results[i]['province_id'];
            province.add(option);
        }
        document.getElementById('editProvince').value = idProvince;
        getCity('edit', idProvince, idCity);
    });
    
}
function addChangeProvince() {
    getCity('add', document.getElementById('addProvince').value);
}
function editChangeProvince() {
    getCity('edit', document.getElementById('editProvince').value);
}

function contactDelete(id, address) {
    let ask, request, input;
    ask = confirm("Apakah anda yakin menghapus " + address);
    if (ask) {
        input = 'id=' + id;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "kontak.php";
                }
                else{
                    alert("Failed to delete");
                }
            }
        }
        request.open("POST", "contactDelete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}