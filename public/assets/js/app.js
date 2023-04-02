window.onload = (event) => {
    //
    //
    //-----SHOW MORE
    //

    // more 'link'
    const moreButton = document.querySelectorAll('.matches__match__more')

    // add event listener
    for (let i = 0; i < moreButton.length; i++) {
        moreButton[i].addEventListener('click', function (){
            // get next sibling
            const nextSibling = moreButton[i].nextElementSibling
            // show more
            if (nextSibling.classList.contains('match__match__details')) showMoreORless(nextSibling, moreButton[i])

        });
    }

    // change display value
    function showMoreORless(container, button) {
        if(container.style.display === 'none'){
            container.style.display = "flex";
            button.innerHTML = 'less'
        } else {
            container.style.display = "none";
            button.innerHTML = 'more'
        }

    }


    //
    //
    // ----- Disabled button
    //
    const submitButton = document.getElementById('submit-button')

    function checkIfDisableCookieExists() {
        // get cookies
        const cookiesDecoded = decodeURIComponent(document.cookie);
        const cookiesArr = cookiesDecoded.split("; ");

        cookiesArr.forEach(val => {
            if (val.indexOf('disable=')) return true
        })

        return false
    }


    function setDisableButtonCookie() {
        // prepare 30 days expiry date
        const now = new Date();
        const time = now.getTime();
        const expireTime = time + 1000 * 36000;
        now.setTime(expireTime);

        document.cookie = 'disable=true;expires=' + now.toUTCString()

    }

    // set cookie if there results where shown
    if (moreButton.length > 0 && checkIfDisableCookieExists()) {
        console.log('test')
        setDisableButtonCookie()
    }

    // disable button if cookie exists
    if (submitButton && checkIfDisableCookieExists()) {
        submitButton.disabled = true
    }
}
