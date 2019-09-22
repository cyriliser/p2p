const share_web_api = ()=>{
    console.log("clicked");
    const overlay = document.querySelector(".overlay");
    const share = document.querySelector(".share");

    const title = window.document.title;
    // const url = window.document.location.href;
    const url = window.document.querySelector("#share_url").value;
    // const url = "cyriliser.co.za";

    // check if able to use webapi
    if (navigator.share) {
        navigator
            .share({
                // title = `${title}`,
                // url = `${url}`
                title ,
                url 
            })
            .then(() =>{
                console.log("Thanks for sharing");
            })
            .catch(console.error);
    } else {
        console.log(url);
        overlay.classList.add("show-share");
        share .classList.add("show-share");
    }
    
}

const page_name = window.document.title;

if (page_name == "Dashboard") {
    const sharebtn = document.querySelector("#web-share-btn");
    const overlay = document.querySelector(".overlay");

    sharebtn.addEventListener("click",share_web_api);
    overlay.addEventListener("click",()=>{
        const share = document.querySelector(".share");
        overlay.classList.remove("show-share");
        share.classList.remove("show-share");    
    });
}

