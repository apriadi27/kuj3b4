function detailProduct(id, name) {
    if (ask) {
        let request, input;
        input = 'id=' + id;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "category.php";
                }
                else{
                    alert("Failed to delete");
                }
            }
        }
        request.open("POST", "categoryDelete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}

function editProduct(idProduct){
    document.getElementById('productEdit').style.display='block';
    let request, input, respon, json, size, picture;
    input = 'id=' + idProduct;
    request =  ajax(request);
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            respon = request.responseText;
            console.log(respon);
            json = JSON.parse(respon);

            size = json['product']['size'].split("-");
            picture = "../productPicture/" + json['product']['picture'];
            console.log(picture);
            document.getElementById('idProductEdit').value = idProduct;
            document.getElementById('nameEdit').value = json['product']['name'];
            document.getElementById('descriptionEdit').value = json['product']['description'];
            document.getElementById('smallSizeEdit').value  = size[0];
            document.getElementById('bigSizeEdit').value = size[1];
            document.getElementById('showPictureEdit').src = picture;
            document.getElementById('colorEdit').value = json['product']['color'];
            document.getElementById('categoryEdit').value = json['product']['category'];
            document.getElementById('capitalEdit').value = json['product']['capital'];
            document.getElementById('sellingPriceEdit').value = json['product']['sellingprice'];
            document.getElementById('stockEdit').value = json['product']['stock'];
        }
    }
    request.open("POST", "productGet.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(input);
}

function productDelete(idProduct, name) {
    let ask, request, input;
    ask = confirm("Apakah anda yaking menghapus " + name);
    if (ask) {
        input = 'id=' + idProduct;
        request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
                console.log(request.responseText);
                
                if (request.responseText == 1) {
                    window.location = "product.php";
                }
                else{
                    alert("Failed to delete");
                }
            }
        }
        request.open("POST", "productDelete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    }
}