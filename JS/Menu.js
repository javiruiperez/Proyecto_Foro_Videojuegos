function menu() {
    var x = document.getElementById("misCategorias");
    if (x.className === "categorias") {
      x.className += " responsive-menu";
    } else {
      x.className = "categorias";
    }
  }