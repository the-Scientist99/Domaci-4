$(document).ready(function () {
    // Pitamo da li se u URL-u nalazi parametar msg i da li je njegov sadržaj "error"
    // ako jeste pokazujemo poruku, ako nije krijemo je
    $('#error_msg').hide();
    let params = new URLSearchParams(document.location.search.substring(1));
    if(params.get('msg') == "error") {
        $('#error_msg').show();
    }
});