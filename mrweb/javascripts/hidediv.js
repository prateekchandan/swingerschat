
function ShowMe(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   tar.className = "show";
  } else {
   tar.className = "hide";
  }
 }
}
