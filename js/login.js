function login(){
    document.getElementById('submit').disabled = true;
  var name = document.getElementById('name').value;
  var speed = document.getElementById('speed').value;
  var fabrication = document.getElementById('fabrication').value;
  var opengl = document.getElementById('opengl').value;
  var opencl = document.getElementById('opencl').value;
  var direct = document.getElementById('direct').value;
  var date = document.getElementById('date').value;
  var input = "name=" + name + "&speed=" + speed + "&fabrication=" + fabrication + "&opengl=" + opengl
              + "&opencl=" + opencl + "&direct=" + direct + "&date=" + date;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.status == 200 && ajaxRequest.readyState == 4) {
      var response = ajaxRequest.responseText;
      document.getElementById('respon').innerHTML = response;
    }
  }
  ajaxRequest.open("POST", "control/submitInsertGPU.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}