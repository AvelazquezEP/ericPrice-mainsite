// CONSOLE LOG SHORT
var log = console.log;

$(document).ready(function () {
    $("#ButtonSend").on("click", function () {
        $(this).attr("disabled", "disabled");
        let firstName = document.getElementById("first_name").value;
        let lastName = document.getElementById("last_name").value;
        let email = document.getElementById("email").value;
        let mobilePhone = document.getElementById("mobile").value;
        let location = document.getElementById("00N5f00000SB1X0").value;
        let language = document.getElementById("00N5f00000SB1Ws").value;
        let meetingType = document.getElementById("meetingTypePerson").value;
        let comment = document.getElementById("message").value;
        let sms = document.getElementById("00N5f00000SB1XU").value;

        var name_input = name_input_validation(firstName);
        var location_input = location_input_validation(location);
        var phone_number = phone_input_validation(mobilePhone);

        if (name_input == true && location_input == true && phone_number == true) {
            // log('Return true - se crea lead');
            sendData(firstName, lastName, email, mobilePhone, location, language, meetingType, comment, sms); //this method contains your logic
            // setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);
        } else {
            // log('Return false - faltan datos');
            setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);
        }

        // sendData(firstName, lastName, email, mobilePhone, location, language, meetingType, comment, sms); //this method contains your logic

    });
});

const sendData = (firstName, lastName, email, mobilePhone, location, language, meetingType, comment, sms) => {

    document.getElementById('locationInput').innerHTML = '';
    document.getElementById('nameInput').innerHTML = '';
    document.getElementById('emailInput').innerHTML = '';
    document.getElementById('ButtonSend').style.backgroundColor = 'gray';
    document.getElementById('ButtonSend').innerHTML = 'Sending Data';

    createLeadApi(firstName, lastName, email, mobilePhone, location, language, sms, comment);
    // log('Crear el lead');



    // if (!/^ *$/.test(location) && mobilePhone.length >= 10) {
    //   // Creación del LEAD
    //   createLeadApi(firstName, lastName, email, mobilePhone, location, language, sms, comment);

    //   document.getElementById('mobileInput').innerHTML = '';
    //   document.getElementById('locationInput').innerHTML = '';

    //   document.getElementById('ButtonSend').style.backgroundColor = 'gray';
    //   document.getElementById('ButtonSend').innerHTML = 'Sending Data';
    //   // setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);

    // } else if (/^ *$/.test(location) && mobilePhone.length >= 10) {
    //   // Falta location    

    //   document.getElementById('mobileInput').innerHTML = '';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   document.getElementById('locationInput').innerHTML = 'select a location please';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);
    // } else if (!/^ *$/.test(location) && mobilePhone.length < 10) {
    //   // Falta numero telefónico    

    //   document.getElementById('mobileInput').innerHTML = 'The phone number must be 10 digits';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   document.getElementById('locationInput').innerHTML = '';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);
    // } else {
    //   // Falta Location / Phone Number    

    //   document.getElementById('mobileInput').innerHTML = 'The phone number must be 10 digits';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   document.getElementById('locationInput').innerHTML = 'select a location please';
    //   document.getElementById('mobileInput').style.color = "#F93C17";

    //   setTimeout('$("#ButtonSend").removeAttr("disabled")', 3800);
    // }
}

const createLeadApi = (first_name, last_name, email, mobile_phone, location_name, language_site, sms_option, comment = "-") => {
    $.ajax({
        type: 'POST',
        url: 'apiData.php',
        data: {
            "FirstName": first_name,
            "LastName": last_name,
            "Email": email,
            "LeadSource": "EP-CA-Website",
            "MobilePhone": mobile_phone,
            "Location__c": location_name,
            "Language__c": language_site,
            "SMS_Opt_In__c": sms_option,
            "comments": comment
        },
        dataType: 'json',
        success: function (data) {
            var fullUrl = "";
            let leadID = data.id;
            log(`ID: ${leadID}`);

            let locationCode = getLocation(location_name);

            let inPerson = "OUR_LOCATION";
            let byPhone = "VID_CONFERENCE";

            sendEmail(first_name, last_name, email, mobile_phone, language_site, leadID, comment);

            if (leadID == "" || leadID == null || leadID == undefined) {
                let url_thanks = 'https://abogadoericprice.com/thanks.html';
                window.location.href = url_thanks;
            }
            else {
                if (location_name != "National") {
                    fullUrl = `https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationType=${inPerson}&WhatId=a1n5f0000006fzTAAQ&WhereID=${locationCode}&sumoapp_WhoId=0055f000007NE9T&clientId=${leadID}`;
                } else {
                    fullUrl = `https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationType=${byPhone}&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000enBiAAI&sumoapp_WhoId=0055f000007NE9T&clientId=${leadID}`;
                }

                window.location.href = fullUrl;
            }

        }, error: function (data) {
            window.location.href = "https://abogadoericprice.com/thanks.html";
        }
    });
}

// GET LOCATION CODE
const getLocation = (location) => {
    var code = "";
    let LACode = "a1b5f000000eT4OAAU";
    let OCCode = "a1b5f000000eT4PAAU";
    let SDCode = "a1b5f000000eT8bAAE";
    let SMCode = "a1b5f000000eT8gAAE";
    let CHCode = "a1b5f000000enBnAAI";
    let SBCode = "a1b5f000001signAAA";

    switch (location) {
        case "Los Angeles":
            code = LACode;
            break;
        case "Orange County":
            code = OCCode;
            break;
        case "San Diego":
            code = SDCode;
            break;
        case "San Marcos":
            code = SMCode;
            break;
        case "Chicago":
            code = CHCode;
            break;
        case "San Bernardino":
            code = SBCode;
            break;
        case "National":
            code = LACode;
            // $code = strval($NCode);
            break;
        default:
            code = strval(LACode);
            break;
    }

    return code;
}

const sendEmail = (first_name, last_name, email, mobile_phone, language_site, leadID, comment) => {
    $.ajax({
        type: 'POST',
        url: 'sendEmail.php',
        data: {
            "FirstName": first_name,
            "LastName": last_name,
            "Email": email,
            "MobilePhone": mobile_phone,
            "Language": language_site,
            "leadID": leadID,
            "question": comment
        }
    });
}

// Name validation
const name_input_validation = (name_element) => {

    if (/^ *$/.test(name_element)) {
        document.getElementById('nameInput').innerHTML = 'Please write your name';
        document.getElementById('nameInput').style.color = "#F93C17";
        return false;
    } else {
        document.getElementById('nameInput').innerHTML = '';
        document.getElementById('nameInput').style.color = "#F93C17";
        return true;
    }
}

// Email validation
const email_input_validation = (email_element) => {

    if (/^ *$/.test(email_element)) {
        document.getElementById('emailInput').innerHTML = 'Write an email please';
        document.getElementById('emailInput').style.color = "#F93C17";
        return false;
    } else {
        document.getElementById('emailInput').innerHTML = '';
        document.getElementById('emailInput').style.color = "#F93C17";
        return true;
    }
}

// location validation
const location_input_validation = (location_element) => {
    if (/^ *$/.test(location_element)) {
        document.getElementById('locationInput').innerHTML = 'select a location please';
        document.getElementById('locationInput').style.color = "#F93C17";
        return false;
    } else {
        document.getElementById('locationInput').innerHTML = '';
        document.getElementById('locationInput').style.color = "#F93C17";
        return true;
    }
}

// phone validation
const phone_input_validation = (mobilePhone) => {
    if (mobilePhone.length < 10) {
        document.getElementById('mobileInput').innerHTML = 'The phone number must be 10 digits';
        document.getElementById('mobileInput').style.color = "#F93C17";
        return false;
    } else {
        document.getElementById('mobileInput').innerHTML = '';
        document.getElementById('mobileInput').style.color = "#F93C17";
        return true;
    }
}