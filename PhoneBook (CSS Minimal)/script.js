"use strict";

function domRemoveParticipant(event) {
    
}

function domAddParticipant(participant) {
    var table = document.getElementById("participant-table");
	var row_id = document.getElementById("participant-table").rows.length;
	localStorage.setItem(row_id, JSON.stringify(participant));
	var row = table.insertRow(-1);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	cell1.innerHTML = participant.first;
	cell2.innerHTML = participant.last;
	cell3.innerHTML = participant.role;
	var item = JSON.parse(localStorage.getItem(row_id))
	alert(item.first);
}

function addParticipant() {
    // TODO: Get values
    const first = document.getElementById("first").value;
    const last = document.getElementById("last").value;
    const role = document.getElementById("role").value;
    
    // TODO: Set input fields to empty values
    document.getElementById('first').value = ''
	document.getElementById('last').value = ''
    // Create participant object
    const participant = {
        first: first,
        last: last,
        role: role
    };
	
    // Add participant to the HTML
    domAddParticipant(participant);
	
    // Move cursor to the first name input field
    document.getElementById("first").focus();
}

document.addEventListener("DOMContentLoaded", () => {
    // This function is run after the page contents have been loaded
    // Put your initialization code here
    document.getElementById("addButton").onclick = addParticipant;
})

// The jQuery way of doing it
$(document).ready(() => {
	$('#participant-table').on('click', 'tbody tr', function(event) {
		var id = this.rowIndex;
		var ime = document.getElementById("participant-table").rows[id].cells[0].innerHTML;
		var conAlert = "Are you sure you want to delete " + ime + "? ";
		var r = confirm(conAlert);
		if (r == true) {
			document.getElementById("participant-table").deleteRow(id);
		}
      });
	  
});
