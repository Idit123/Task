function edit(id) {
    var x = id;
    document.getElementById('uid').value = x;
    var tr = document.getElementById(x);
    document.getElementById('editusername').value = tr.getAttribute('data-Username');
    document.getElementById('edituseremail').value = tr.getAttribute('data-Email');
    document.getElementById('edituserpassword').value = tr.getAttribute('data-Password');
    let rights = tr.getAttribute('data-Rights');
    myArr = rights.split(",");
    document.getElementById('editcheck1').checked = false;
    document.getElementById('editcheck2').checked = false;
    document.getElementById('editcheck3').checked = false;
    document.getElementById('editcheck4').checked = false;
    for (var i = 0; i < 5; i++) {
        switch (myArr[i]) {
            case 'Dashboard List':
                document.getElementById('editcheck1').checked = true;
                break;
            case 'Provider List':
                document.getElementById('editcheck2').checked = true;
                break;
            case 'Customer List':
                document.getElementById('editcheck3').checked = true;
                break;
            case 'Job List':
                document.getElementById('editcheck4').checked = true;
                break;
        }

    }
}

function dele(id) {
    var userid = id;
    document.getElementById('delid').value = userid;
}

function setFocusToSearchBox() {
    document.getElementById("search").focus();
}

function checkmain() {
    var main = document.getElementById('selectAll');
    var check = document.querySelectorAll("input[name='options[]']");
    if (main.checked) {
        for (i = 0; i < check.length; i++) {
            check[i].checked = true;
        }
    } else {
        for (i = 0; i < check.length; i++) {
            check[i].checked = false;
        }
    }
}
let data = [];

function check(id) {

    var tr = document.getElementById(id);
    var td = tr.firstElementChild;
    var span = td.firstElementChild;
    var input = span.firstElementChild;
    if (input.checked) {
        data.push(id);
        data.join();
    } else {
        for (var i = 0; i < data.length; i++) {

            if (data[i] === id) {

                data.splice(i, 1);
            }
        }
    }
    document.getElementById('deleted_id').value = data.join();
}