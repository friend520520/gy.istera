
document.write("<script src='https://apis.google.com/js/plusone.js'>" + "<" + "/script>");
document.write("<script src='https://apis.google.com/js/client.js?onload=init'>" + "<" + "/script>");

$("body").append( '<div id="signin-button" class="show">' +
                        '<div class="g-signin" data-callback="loginFinishedCallback"' +
                        'data-approvalprompt="force"' +
                        'data-clientid="243099245928-chtbpd19iojnsn2tbak06hlhop1cdek9.apps.googleusercontent.com"' +
                        'data-scope="https://www.googleapis.com/auth/userinfo.email"' +
                        'data-height="short"' +
                        'data-cookiepolicy="single_host_origin"' +
                        '>' +
                      '</div>' +
                    '</div>');
            
            
function loginFinishedCallback(authResult) {
        if (authResult) {
          if (authResult['error'] == undefined){
            gapi.auth.setToken(authResult); // Store the returned token.
            toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
            getEmail();                     // Trigger request to get the email address.
          } else {
            console.log('An error occurred');
          }
        } else {
          console.log('Empty authResult');  // Something went wrong
        }
}

/*
* Initiates the request to the userinfo endpoint to get the user's email
* address. This function relies on the gapi.auth.setToken containing a valid
* OAuth access token.
*
* When the request completes, the getEmailCallback is triggered and passed
* the result of the request.
*/
function getEmail(){
// Load the oauth2 libraries to enable the userinfo methods.
        gapi.client.load('oauth2', 'v2', function() {
                var request = gapi.client.oauth2.userinfo.get();
                request.execute(getEmailCallback);
        });
}

function getEmailCallback(obj){
    
        Google_connected_callback_init( obj );
        /*var el = document.getElementById('email');
        var email = '';

        console.log( obj );

        if (obj['email']) {
          email = 'Email: ' + obj['email'];
        }

        //console.log(obj);   // Uncomment to inspect the full object.

        el.innerHTML = email;
        toggleElement('email');*/
}

function toggleElement(id) {
        var el = document.getElementById(id);
        if (el.getAttribute('class') == 'hide') {
            console.log("show");
            el.setAttribute('class', 'show');
        } else {
            console.log("hide");
            el.setAttribute('class', 'hide');
        }
}
