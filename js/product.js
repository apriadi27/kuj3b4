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