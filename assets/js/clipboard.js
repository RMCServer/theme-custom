function clipboardCallback(element, status) {
    const message = element.dataset[status ? 'copied' : 'copyError'];

    if (element.tooltip && message) {
        const oldTitle = element.dataset['bsOriginalTitle'];
        element.setAttribute('data-bs-original-title', message);
        element.tooltip.show();
        element.setAttribute('data-bs-original-title', oldTitle ? oldTitle : '');
    }
}

function copyClipboard(button) {
    navigator.clipboard.writeText(button.innerText).then(function() {
        clipboardCallback(button, true);
    }, function(err) {
        console.error('Could not copy text to clipboard: ', err);
        clipboardCallback(button, false);
    });
}

document.querySelectorAll('[data-copied]').forEach(function (el) {
    if (!navigator.clipboard) {
        return;
    }

    el.tooltip = new bootstrap.Tooltip(el);

    el.addEventListener('click', function (ev) {
        ev.preventDefault();

        copyClipboard(el);
    });
});

let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
