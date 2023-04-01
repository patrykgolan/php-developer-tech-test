
window.onload = () => {
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
}