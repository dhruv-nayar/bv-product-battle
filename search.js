
var resultsPanel = document.getElementById("results-panel");
var numResults;
var html;

window.generateResults = function(){
	resultsPanel.innerHTML = "";
	search = document.getElementById("search").value;
	if (search == "") {
	    document.getElementById("resultsPanel").innerHTML="";
	    alert('hi');
	    return;
	  } 
	  if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      resultsPanel.innerHTML=xmlhttp.responseText;
	    }
	  }
  xmlhttp.open("GET","get_results.php?q="+search, true);
  xmlhttp.send();
}


window.checkEnter = function(event){
	if (event.keyCode == 13) {
            generateResults();
         }
}