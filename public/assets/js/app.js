
window.onload = () => {
    const moreButton = document.getElementsByClassName('matches__match__more')
    for (let i = 0 ; i < moreButton.length; i++) {
        moreButton[i].addEventListener('click', moreOnClick(), false)
    }


    function showMore(container){
        container.style.display = "flex";
    }
    function moreOnClick(){
        let moreContainer;

        let nextSibling = moreButton.nextElementSibling

        // loop through nodes and find next container with additional data
        while (nextSibling) {

            if (nextSibling.classList.contains('match__match__details')){

                moreContainer = nextSibling
                showMore(moreContainer)
                break
            }

            nextSibling = nextSibling.nextElementSibling
        }
    }
}