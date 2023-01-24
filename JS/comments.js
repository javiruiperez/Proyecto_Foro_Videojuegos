//FORMA DE AÑADIR COMENTARIOS CON JAVASCRIPT

const createCommentGuide = () => {
    let div = document.createElement("div");
    let textComment = document.getElementById("newComment").value;
    let text = document.createTextNode(textComment);
    div.appendChild(text);
    div.classList.add(`newCommentUser`);

    if(textComment === "") {
        console.log("error, no puede estar vacío");
    } else{
        document.getElementById("readComments").appendChild(div);
        document.getElementById("newComment").value = "";
    }
}