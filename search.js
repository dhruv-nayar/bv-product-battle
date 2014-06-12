
var resultsPanel = document.getElementById("results-panel");
var numResults;
var html;

window.generateResults = function(){
	resultsPanel.innerHTML = "";
	numResults = parseInt(document.getElementById("search").value);
	if (numResults == 0) {
	    document.getElementById("txtHint").innerHTML="";
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
  xmlhttp.open("GET","get_results.php?q="+numResults, true);
  xmlhttp.send();
}


window.checkEnter = function(e){
	if (e.keyCode == 13) {
            generateResults();
         }
}