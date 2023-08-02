const changeLocation = () => {
    var location = document.getElementById('00N5f00000SB1X0').value;
    const meetingTypePhone = document.getElementById('meetingTypePhone');
    const meetingTypePerson = document.getElementById('meetingTypePerson');

    if (location == "San Bernardino") {
        meetingTypePhone.checked = false;
        meetingTypePerson.checked = true;

        meetingTypePhone.disabled = true;
        document.getElementById("personTxt").style.color = 'black';
        document.getElementById("phoneTxt").style.color = 'gray';

    } else if (location == "National") {
        meetingTypePhone.checked = true;
        meetingTypePerson.checked = false

        meetingTypePerson.disabled = true;
        document.getElementById("personTxt").style.color = 'gray';
        document.getElementById("phoneTxt").style.color = 'black';

    } else {
        meetingTypePhone.disabled = false;
        meetingTypePerson.disabled = false;
        meetingTypePerson.checked = true;
    }

}
