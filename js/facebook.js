var basepath = 'http://ephron.seersol.com';
window.fbAsyncInit = function () {
    FB.init({
        appId: '258443337952164',
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true,  // parse XFBML
        version: 'v2.5'
    });

    FB.Event.subscribe('auth.authResponseChange', function (response) {

        if (response.status === 'connected') {
            // connected
        } else if (response.status === 'not_authorized') {
            FB.login();
        } else {
            FB.login();
        }
    });


};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function get_query() {
    var url = location.search;
    var qs = url.substring(url.indexOf('?') + 1).split('&');
    for (var i = 0, result = {}; i < qs.length; i++) {
        qs[i] = qs[i].split('=');
        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
    }
    return result;
}

function login_facebook(basepath, ref) {
    if(!ref){
        return false;
    }
    FB.login(function (response) {
        if (response.authResponse) {
            FB.api('/me?fields=id,first_name,last_name,email,gender', function (response) {

                //alert(JSON.stringify(response));
                if (typeof response.email != 'undefined' && typeof response.first_name != 'undefined' && typeof response.last_name != 'undefined' && typeof response.id != 'undefined' && typeof response.gender != 'undefined') {
                    var fbimg = "https://graph.facebook.com/" + response.id + "/picture?type=large";
                    getData = {
                        'first_name': response.first_name,
                        'last_name': response.last_name,
                        'F_ID': response.id,
                        'email': response.email,
                        'type': 'F',
                        'username': '',
                        'gender': response.gender,
                        'image': fbimg,
                        'ref'  : ref
                    };
                    console.log(getData);
                    jQuery.ajax({
                        type: "POST",
                        dataType: "json",
                        url: basepath + "/includes/facebook_login.php",
                        data: getData,
                        success: function (data) {

                            if (data.status == true) {
                                var loginBtn ='<a  href="/login.php" class="btn btn-block btn-primary">Goto Login</a>';
                                $('#loginRef').html(loginBtn);
                                var mesgBox = $('#response_mesg');
                                mesgBox.html(data.mesg);
                                return false;
                            }else{
                                var mesgBox = $('#response_mesg');
                                mesgBox.html(data.mesg);
                                return false;
                            }
                            //location.reload(true);

                        }
                    });

                } else {
                    alert("Sorry, you can't login with facebook as we are not getting all your info that we required. Please try with regular signup.");
                }
            });
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {scope: 'email'});
}


function login_check_facebook() {
    FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
            window.location.href = basepath + "/users/feed/";
            exit;
        }
    });

}

$('#letmein').on('click', function () {
    var ref = get_query()['ref'];
    if(ref && ref !=undefined && ref.trim() !=''){
        $(this).prop('disabled', true);
       login_facebook(basepath,ref);
    }else{
        alert('Your Referral Is Invalid.');
    }

});

function logout_facebook() {

    FB.logout(function (response) {
        // user is now logged out

    });

}