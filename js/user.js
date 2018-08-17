function submitTrolli() {
    let input, request, idAccount, idProduct, stock;

    idAccount = document.getElementById('idAccount').value;
    idProduct = document.getElementById('idProduct').value;
    stock = document.getElementById('trolliStock').value;

    input = "idAccount=" + idAccount + "&idProduct=" + idProduct + "&stock=" + stock;
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

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}

function getProvince() {
    let request;
    request =  ajax(request);
    
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            var json = JSON.parse(respon);
            var results = json['rajaongkir']['results'];

            var province = document.getElementById('addProvince');
            var option;
            for (let i = 0; i < results.length; i++) {
                option = document.createElement("option");
                option.text = results[i]['province'];
                option.value = results[i]['province_id'];
                province.add(option);
            }
        }
    }
    request.open("GET", "config/getProvince.php", true);
    request.send();
}

function getCity(){
    let request, input, idProvince;
    idProvince = document.getElementById('addProvince').value;

    input = "idProvince=" + idProvince;

    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var respon = request.responseText;
            var json = JSON.parse(respon);
            
            var results = json['rajaongkir']['results'];

            var city = document.getElementById('addCity');
            city.innerHTML = "";
            var option;
            for (let i = 0; i < results.length; i++) {
                option = document.createElement("option");
                option.text = results[i]['city_name'];
                option.value = results[i]['city_id'];
                city.add(option);
            }
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
