function enableEditMode() {
    richTextField.document.designMode = "on";
}
function Edit(command) {
    richTextField.document.execCommand(command, false, null);
}
function execVal(command, value) {
    richTextField.document.execCommand(command, false, value);
}
// go to top function
// Get the button
let topBtn = document.getElementById("topBtn");

// Show the button when the user scrolls down 20px from the top of the document
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topBtn.style.display = "block"; // Show button
    } else {
        topBtn.style.display = "none"; // Hide button
    }
}

// When the user clicks on the button, scroll to the top of the document
function goToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll to top
    });
}

// this is for sending content 

// function Edit(command, value) {
//     var iframe = document.getElementById("blogTextt");
//     iframe.contentWindow.document.execCommand(command, false, value);
// }

// document.querySelector("form").addEventListener("submit", function() {
//     var iframe = document.getElementById("blogTextt");
//     var content = iframe.contentWindow.document.body.innerHTML;
//     document.getElementById("blogContent").value = content;
// });

// sending contents: 
function Edit(command, value) {
    var iframe = document.getElementById("blogTextt");
    iframe.contentWindow.document.execCommand(command, false, value);
}

function execVal(command, value) {
    var iframe = document.getElementById("blogTextt");
    iframe.contentWindow.document.execCommand(command, false, value);
}

document.querySelector("form").addEventListener("submit", function() {
    var iframe = document.getElementById("blogTextt");
    var content = iframe.contentWindow.document.body.innerHTML;
    document.getElementById("blogContent").value = content;
});

function enableEditMode() {
    var iframe = document.getElementById("blogTextt");
    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write('<!DOCTYPE html><html><head><style>body {font-family: Arial, sans-serif;}</style></head><body contenteditable="true"></body></html>');
    doc.close();
}