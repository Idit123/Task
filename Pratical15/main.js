function edit(id) {
    var x = id;
    document.getElementById('uid').value = x;
    console.log('id :>> ', id);
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