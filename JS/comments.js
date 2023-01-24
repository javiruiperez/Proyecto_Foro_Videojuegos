const createCommentGuide = () => {
    let li = document.createElement("li");
    let textComment = document.getElementById("newComment").value;
    let text = document.createTextNode(textComment);
    li.appendChild(text);

    if(textComment === "") {
        console.log("error, no puede estar vacío");
    } else{
        document.getElementById("readComments").appendChild(li);
    }


}