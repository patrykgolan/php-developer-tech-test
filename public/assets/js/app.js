
window.onload = () => {
    //
    //
    //-----SHOW MORE
    //

    // more 'link'
    const moreButton = document.getElementsByClassName('matches__match__more')

    // add event listiner
    for (let i = 0 ; i < moreButton.length; i++) {
        moreButton[i].addEventListener('click', moreOnClick(), false)
    }

    // change display value
    function showMore(container){
        container.style.display = "flex";
    }

    // onClick event for moreButton
    function moreOnClick(){
        let moreContainer;

        // get next sibling
        let nextSibling = moreButton.nextElementSibling

        // loop through nodes and find next container with additional data
        while (nextSibling) {
            // if next sibling is match__match__details show more and break
            if (nextSibling.classList.contains('match__match__details')){

                moreContainer = nextSibling
                showMore(moreContainer)
                break
            }

            // go to another sibling if not
            nextSibling = nextSibling.nextElementSibling
        }
    }

    //
    //
    // ----- Disabled button
    //
    const submitButton = document.getElementById('submit-button')

    function checkIfDisableCookieExists(){
        // get cookies
        const cookiesDecoded = decodeURIComponent(document.cookie);
        const cookiesArr = cookiesDecoded.split("; ");

        cookiesArr.forEach(val =>{
            if(val.indexOf('disable=')) return true
        })

        return false
    }


    function setDisableButtonCookie(){
        // prepare 30 days expiry date
        const now = new Date();
        const time = now.getTime();
        const expireTime = time + 1000*36000;
        now.setTime(expireTime);

        document.cookie = 'disable=true;expires='+now.toUTCString()

    }

    // set cookie if there results where shown
    if(moreButton.length > 0 && checkIfDisableCookieExists()){
        setDisableButtonCookie()
    }

    // disable button if cookie exists
    if(submitButton && checkIfDisableCookieExists()){
        submitButton.disabled = true
    }

}