var xhr=new XMLHttpRequest();
xhr.open('GET','PRUEBA.PHP');
xhr.onload=function(){
    if(xhr.status===200){
var json=JSON.parse(xhr.responseText);
console.log(json);
    }else{
        console.log("No se paso bien ");
        
    }
}
xhr.send();




