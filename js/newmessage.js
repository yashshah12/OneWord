//Test code for adding checkboxes when clicked

//$(document).ready(function() {
//    var i = 0;
//    for(i=0;i<5;i++) {
//         addCheckbox("object: "+i);
//    }
//});

function addCheckbox(name) {
   var container = $('#cblist');
   var inputs = container.find('input');
   var id = inputs.length+1;
    $( "<br></br>" ).appendTo(container);
   $('<input />', { type: 'checkbox', id: 'cb'+id, value: name }).appendTo(container);
   $('<label />', { 'for': 'cb'+id, text: name }).appendTo(container);
}
