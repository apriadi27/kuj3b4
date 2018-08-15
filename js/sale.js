function editDashboard(idSale, idProduct, name) {
    document.getElementById('saleEdit').style.display = "block";
    document.getElementById('editProduct').value = idProduct;
    document.getElementById('editIdSale').value = idSale;
}

function stopSale(idSale, name) {
    let ask, input, request;
    ask = confirm("Apakah anda yaking menghentikan diskon terhadap produk " + name);
    if (ask) {
        input = 'idSale=' + idSale;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "sale.php";
                }
                else{
                    alert("Failed to stop");
                }
            }
        }
        request.open("POST", "saleStop.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}

function deleteSale(idSale, name) {
    let ask, input, request;
    ask = confirm("Apakah anda yaking menghentikan diskon terhadap produk " + name);
    if (ask) {
        input = 'idSale=' + idSale;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "sale.php";
                }
                else{
                    alert("Failed to delete");
                }
            }
        }
        request.open("POST", "saleDelete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}