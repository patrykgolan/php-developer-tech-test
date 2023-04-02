window.onload = () => {
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
            if (nextSibling.classList.contains('match__match__details')) showMoreOrLess(nextSibling, moreButton[i])

        });
    }

    // change display value
    function showMoreOrLess(container, button) {
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

    function checkIfCookieExists(name) {
        // get cookies
        const cookiesDecoded = decodeURIComponent(document.cookie);
        const cookiesArr = cookiesDecoded.split("; ");
        for(let i = 0; i < cookiesArr.length; i++){
            const cookiePair = cookiesArr[i].split("=");
            if (cookiePair[0] === name) {
                return true
            }
        }

        return false
    }


    function setCookie(name,value) {
        // prepare 30 days expiry date
        const now = new Date();
        const time = now.getTime();
        const expireTime = time + 1000 * 36000;
        now.setTime(expireTime);

        document.cookie = name + '=' + value + ';expires=' + now.toUTCString()

    }
    // disable button if cookie exists
    if (submitButton && checkIfCookieExists('disable')) {
        submitButton.disabled = true
    }

    // set cookie if there results where shown
    if (moreButton.length > 0 && !checkIfCookieExists('disable')) {
        setCookie('disable', true)
    }

}
