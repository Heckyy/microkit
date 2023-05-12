var client;
var access_token;

function initClient() {
    client = google.accounts.oauth2.initTokenClient({
        client_id:
            "88675706361-cqitae7ndv1qpm9ac9eo24va69sdncag.apps.googleusercontent.com",
        scope: "https://www.googleapis.com/auth/user.phonenumbers.read https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
        callback: (tokenResponse) => {
            access_token = tokenResponse.access_token;

            window.location.href = `/sign-up/${access_token}`;

            localStorage.setItem("token", access_token);

            // if (access_token) {
            //     const headers = new Headers({
            //         Authorization: `Bearer ${access_token}`,
            //         "Content-Type": "application/json",
            //     });
            //     fetch("https://www.googleapis.com/oauth2/v2/userinfo", {
            //         method: "GET",
            //         headers: headers,
            //     })
            //         .then((response) => response.json())
            //         .then((data) => {

            //         })
            //         .catch((error) => {
            //             console.error(error);
            //         });
            // } else {
            // }
        },
    });
}

function getToken() {
    client.requestAccessToken();
}
function revokeToken() {
    google.accounts.oauth2.revoke(localStorage.getItem("token"), () => {
        console.log("access token revoked");
    });
}
