slike=JSON.parse(localStorage.getItem("slike") || "[]");
build_gallery(slike);
console.log(slike);
function build_gallery(slike){
	if(slike.length>0){
		for(let i=0;i<slike.length;i++){
			let img = '<img data-tags="'+slike[i].category+'" src="images/'+slike[i].picture.substring(12,slike[i].picture.length)+'" alt="'+slike[i].name+'" />';
				$("#gallery").append(img);
		}
	}
}