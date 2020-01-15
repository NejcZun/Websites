var slike=[];
function addImageToStorage(slika){
	slike=JSON.parse(localStorage.getItem("slike") || "[]");
	slike.push(slika);
	localStorage.setItem("slike", JSON.stringify(slike));
}
function addTempDOM(id, name, picture, category){
	let tr= ['<tr><td data-title="ID">'+id+'</td>',
					  '<td data-title="Name">'+name+'</td>',
					  '<td data-title="Picture">'+picture.substring(12,picture.length)+'</td>',
					  '<td data-title="Category">'+category+'</td>',
					  '<td data-title="Action"><a href="admin.html?edit='+id+'" class="action-button edit">Edit</a><a href="admin.html?delete='+id+'" class="action-button delete">Delete</a></td>',
					'</tr>'].join("\n");
		$("#table").append(tr);
}
function addImage() {
    const name = document.getElementById("name").value;
    const picture = document.getElementById("picture").value;
    const category = document.getElementById("category").value;
	let temp_id = 0;
	slike=JSON.parse(localStorage.getItem("slike") || "[]");
	if(slike.length > 0){
		temp_id=slike[slike.length-1].id+1;
	}
	const id = temp_id;
    document.getElementById('name').value = ''
	document.getElementById('picture').value = ''
	document.getElementById('category').value = ''
    const slika = {
		id: id,
        name: name,
        picture: picture,
        category: category
    };
	if(id != "" || name != "" || picture != "" || category != ""){
	addTempDOM(id, name, picture, category);
    addImageToStorage(slika);
	}
}
/* displays */
function displayImages(slike){
	if(slike.length>0){
		for(let i=0;i<slike.length;i++){
			let tr= ['<tr><td data-title="ID">'+slike[i].id+'</td>',
						  '<td data-title="Name">'+slike[i].name+'</td>',
						  '<td data-title="Picture">'+slike[i].picture.substring(12,slike[i].picture.length)+'</td>',
						  '<td data-title="Category">'+slike[i].category+'</td>',
						  '<td data-title="Action"><a href="admin.html?edit='+slike[i].id+'" class="action-button edit">Edit</a><a href="admin.html?delete='+slike[i].id+'" class="action-button delete">Delete</a></td>',
						'</tr>'].join("\n");
			$("#table").append(tr);
		}
	}
}
function display_edit(slike, edit){
	if(slike.length>0){
		for(let i=0;i<slike.length;i++){
			if(edit == slike[i].id){
				let tr= ['<tr><td data-title="ID" id="u_id">'+slike[i].id+'</td>',
							  '<td data-title="Name"><input id="u_name" type="text" value="'+slike[i].name+'"/></td>',
							  '<td data-title="Picture"><input type="text" value="'+slike[i].picture.substring(12,slike[i].picture.length)+'" disabled/></td>',
							  '<td data-title="Category"><input id="u_category" type="text" value="'+slike[i].category+'"/></td>',
							  '<td data-title="Action"><button class="action-button update" id="updatePic">Update</button><a href="admin.html" class="action-button back">Back</a></td>',
							'</tr>'].join("\n");
				$("#table").append(tr);
			}
		}
	}
}
function display_delete(slike, edit){
	if(slike.length>0){
		for(let i=0;i<slike.length;i++){
			if(edit == slike[i].id){
				let tr= ['<tr><td data-title="ID" id="u_id">'+slike[i].id+'</td>',
							  '<td data-title="Name">'+slike[i].name+'</td>',
							  '<td data-title="Picture">'+slike[i].picture.substring(12,slike[i].picture.length)+'</td>',
							  '<td data-title="Category">'+slike[i].category+'</td>',
							  '<td data-title="Action"><button class="action-button delete" id="deletePic">Delete</button><a href="admin.html" class="action-button edit">Back</a></td></form>',
							'</tr>'].join("\n");
				$("#table").append(tr);
			}
		}
	}
}
/* actions crude */
function updatePic(){
	const id = document.getElementById("u_id").innerHTML;
    const name = document.getElementById("u_name").value;
    const category = document.getElementById("u_category").value;
	slike=JSON.parse(localStorage.getItem("slike") || "[]");
	for(let i=0;i<slike.length;i++){
		if(slike[i].id == id){
			slike[i].name=name;
			slike[i].category=category;
			break;
		}
	}
	localStorage.setItem("slike", JSON.stringify(slike));
	window.location.replace("admin.html?edit="+id);
	
}
function deletePic(){
	const id = document.getElementById("u_id").innerHTML;
	slike=JSON.parse(localStorage.getItem("slike") || "[]");
	for(let i=0;i<slike.length;i++){
		if(slike[i].id == id){
			slike.splice(i, 1);
		}
	}
	localStorage.setItem("slike", JSON.stringify(slike));
	window.location.replace("admin.html");
}
/* https://html-online.com/articles/get-url-parameters-javascript/ */
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
document.addEventListener("DOMContentLoaded", () => {
	//localStorage.clear();
	slike=JSON.parse(localStorage.getItem("slike") || "[]");
	console.log(slike);
	let del = getUrlVars()['delete'];
	let edit = getUrlVars()['edit'];
	if(del != null || edit != null){
		document.getElementById("card").style.display="none";
		if(edit!=null){
			display_edit(slike, edit);
		}else{
			display_delete(slike, del);
		}
	}else{
		displayImages(slike);
	}
	if(del !=null ||edit !=null){
		if(edit!=null){
		document.getElementById("updatePic").onclick = updatePic;
		}else{
		document.getElementById("deletePic").onclick = deletePic;
		}
	}
    document.getElementById("addPic").onclick = addImage;
})