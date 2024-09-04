function setupStickyHeader(tableid) {

    var table = document.getElementById(tableid);
    var thead = table.querySelector('thead');
    var tbody = table.querySelector('tbody');
    var parentElement = table.parentElement;

    var offsetTop = 70; // Desired offset from the top
    var isScrolling = false;

    function hideStickyHeader() {
        thead.style.transition = 'opacity 0.1s';
        thead.style.opacity = '0';
    }

    function showStickyHeader() {
        thead.style.transition = 'opacity 0.2s';
        thead.style.opacity = '1';
    }

    thead.style.position = 'relative';
    thead.style.transform = 'translateY(0px)';
    function adjustStickyHeader() {
        var parentRect = parentElement.getBoundingClientRect();
        var tableRect = table.getBoundingClientRect();
        var tbodyRect = tbody.getBoundingClientRect();

        var isHeaderOverflowed = tableRect.top <= offsetTop;
        var shouldApplyOpacity = window.pageYOffset >= offsetTop && isHeaderOverflowed;

        if (shouldApplyOpacity) {
            if (isScrolling) {
                hideStickyHeader();
            } else {
                showStickyHeader();
            }
        } else {
            showStickyHeader();
        }

        if (isHeaderOverflowed && window.pageYOffset >= 400) {
            thead.style.position = 'relative';
            thead.style.transform = 'translateY(' + Math.max(offsetTop - tableRect.top, 0) + 'px)';
        } else {
            thead.style.position = '';
            thead.style.transform = '';
        }

        isScrolling = false;
    }

    window.addEventListener('scroll', function() {
        isScrolling = true;
        adjustStickyHeader();
        resetOpacityTimer();
    });

    window.addEventListener('resize', adjustStickyHeader); // Adjust on window resize

    var opacityTimer;
    function resetOpacityTimer() {
        clearTimeout(opacityTimer);
        opacityTimer = setTimeout(function() {
            showStickyHeader();
        }, 500); // Hide Time
    }

    adjustStickyHeader();
}